<?php 
class controler {
	
    public $attributes	= array();  // Post,Get and File Variables
    public $error 		= array();  // Array For Error To Display 
	public $config 		= array();  // Array For Basic Data Variable
	public $data 		= array();	// Array For List Data
	
	public $db 			= Null;     // Database Class Object Variable
    public $validate 	= Null;		// Validate Class Object Variable
    public $errorObj 	= Null;		// Error Class Object Variable
	
	/**
     * __construct()	    : Constructor of the class
     *
     * @param $attributes	: All post,get,file Variables     
     * @return
     */
    
    function __construct($attributes,$config) {
	
	    $this->attributes 	= $attributes;	// Assign Post,Get And File Variabls To An Array
		$this->config 		= $config;	// Assign Common Array To Class Array
        $this->validate 	= new classValidField();	// Assign Object Of Validation Class 
        $this->errorObj 	= new error();	// Assign Object Of Error Class
		$this->db 			= new CLSQueryMaker($config['dbHost'], $config['dbUser'], $config['dbPassword'], $config['dbName']);	// Assign Object Of Database Class
		
    } // END OF CONSTRUCTOR
	
   
    function sqlInjection($var) {
        $var = mysql_escape_string($var);
        return $var;
    } // END OF sqlInjection()
	
	
	function outputData($str){
		$outputData = stripslashes(trim($str));
		$outputData = stripslashes(html_entity_decode($str));
		return $outputData;
	} // END OF outputData()
	
		
	function checkSession(){
		if(!isset($_SESSION['admin_name'])){
			header("Location: login.php");
		}
	} // END OF checkSession()
	
	//**********************************************Date Diffrence**************************************************************
	function getDaysInBetween($start, $end) {
		// Vars
		$day = 86400; // Day in seconds
		$format = 'Y-m-d'; // Output format (see PHP date funciton)
		$sTime = strtotime($start); // Start as time
		$eTime = strtotime($end); // End as time
		$numDays = round(($eTime - $sTime) / $day) + 1;
		return $numDays;
		}//End Date Diffrence

	
	function login(){
		if($this->loginValidate()){
			$user_name		=	$this->sqlInjection($this->attributes['admin_name']);
			$user_password	=	$this->sqlInjection($this->attributes['admin_password']);
			
			$where = "adminLogin='$user_name' and (adminPassword='$user_password' || adminTempPassword='$user_password')";
			
			$login = $this->db->mysqlSelect("adminName,adminLogin",
											$this->config['tbl_prefix']."admin",
											$where
										);
			if($login){
				$_SESSION['admin_name'] = $login[0]['adminName'];
				$_SESSION['admin_login'] = $login[0]['adminLogin'];
			} else {
				$this->error[] = $this->errorObj->errorMessage(1);
				return $this->error;
			}
			if(isset($_SESSION['admin_name']))
			{
				header("Location: index.php?act=welcome");
			}
		} else {
			return $this->error;
		}
	} // END OF login()
	
		
	function loginValidate(){
		if($this->attributes['admin_name']==''){
			$this->error[] = $this->errorObj->errorMessage(2);
		}
		if($this->attributes['admin_password']==''){
			$this->error[] = $this->errorObj->errorMessage(3);
		}
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}
	} // END OF loginValidate()
	
	 
	function changePassword() {
		$where = "adminLogin='".$_SESSION['admin_login']."' and (adminPassword ='".$this->attributes['txtOldPassword']."' || adminTempPassword ='".$this->attributes['txtOldPassword']."')";
		if($this->changePasswordValidate($where)){
		
			$old_password = $this->sqlInjection($this->attributes['txtOldPassword']);
			$new_password = $this->sqlInjection($this->attributes['txtNewPassword']);
			
			$field[] = 'adminPassword';
			$value[] = $new_password;
			
			if($this->db->mysqlUpdate($this->config['tbl_prefix']."admin",$field,$value,$where)){
				return false;
			}
		} else {
			return $this->error;
		}
	} // END OF changePassword()
		

	function changePasswordValidate($where){
	
		if($this->attributes['txtOldPassword']==''){
			$this->error[] = $this->errorObj->errorMessage(4);
		} else {
			
			$validate = $this->db->mysqlSelect("adminLogin",
									$this->config['tbl_prefix']."admin",
									$where
								);
			if(!$validate){
				$this->error[] = $this->errorObj->errorMessage(8);
			}
		}
		
		if($this->attributes['txtNewPassword']==''){
			$this->error[] = $this->errorObj->errorMessage(5);
		}
		
		if($this->attributes['txtConfirmPassword']==''){
			$this->error[] = $this->errorObj->errorMessage(6);
		}
		
		if(($this->attributes['txtConfirmPassword']!= $this->attributes['txtNewPassword']) && ($this->attributes['txtConfirmPassword']!='' && $this->attributes['txtNewPassword']!='')){
			$this->error[] = $this->errorObj->errorMessage(7);
		}
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}
	} // END OF changePasswordValidate()
	
	
	function selectOption($table,$optionFiled,$valueField,$selected="",$where=""){
		
		if($selected!=""){
			$valCheck = explode(",",$selected);
		}
		
		//$where 		= "";
		$orderby 	= $optionFiled." asc";
		$option 	= "";
		
		$fetch_data=$this->db->mysqlSelect($optionFiled.",".$valueField,$this->config['tbl_prefix'].$table,$where,$orderby);
		
		for($i=0;$i<sizeof($fetch_data);$i++){
			$option .= "<option value='".$fetch_data[$i][$valueField]."'";
			
			if($selected!=""){
				if(in_array($fetch_data[$i][$valueField],$valCheck)){
					$option .= " selected='selected'";
				}
			}
			
			$option .= ">".$this->outputData($fetch_data[$i][$optionFiled])."</option>";
		}
		return $option;
	} // END OF selectOption()
	
	
	function uploadFile($path,$fieldName,$type,$thubmWidth="",$thubmHeight=""){
		
		if($this->attributes[$fieldName]['name']!=''){
			$objFileUploading = new FileUploading($path,$fieldName);
			if($objFileUploading->checkFileValidity($type)){
				//if((int)$_FILES[$fieldName]['size']>(int)$this->config['MAX_FILE_SIZE']){
					$strPhotoName =  date("H-i-s_m_y_").rand(6,666);
					if(false != $objFileUploading->fn_fileUpload($strPhotoName)){
						$strPhotoName = $strPhotoName.'.'.$objFileUploading->fileExt;
						if($type=='image'){
							$objFileUploading->make_thumb($path.$strPhotoName,$path."thumbs/".$strPhotoName,$thubmWidth,$thubmHeight,$objFileUploading->fileExt);
						}
						return $strPhotoName;
					}else{
					  $this->error[] = $objFileUploading->getErrorMessage();
					  return false;
					}
				//} else {	
				//	$this->error[] = "Size of image should not be more than ".$this->config['MAX_FILE_SIZE']."kb.";
				//	return false;
				//}						   
			}else{
			   $this->error[] = $objFileUploading->getErrorMessage();
			   return false;
			}
		}else{
			$this->error[] = 'Please select a file.';
			return false;
		}
	} // END OF uploadFile()

	function manageList($form,$table,$where="",$orderby=""){
		$fetch_data=$this->db->mysqlSelect("*",$table,$where,$orderby);
		$total=count($fetch_data);
				
		if(!isset($this->attributes['limitstart']))
			$limitstart=0;
		else
			$limitstart=$this->attributes['limitstart'];
		
		if(!isset($this->attributes['limit']) || $this->attributes['limit'] <= 0 || !is_int((int)$this->attributes['limit']))
			$limit=floor($this->config['item_per_page']);
		else
			$limit=floor($this->attributes['limit']);
		
		$limit1 = $limitstart.",".$limit;
		$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
		
		$fetch_data=$this->db->mysqlSelect("*",$table,$where,$orderby,"","",$limit1);
		
		// Applying condition 
		if(count($fetch_data)==0 && $total >0)
		{
			$limitstart=$limitstart-$this->config['item_per_page'];
			if($limitstart < 0)
			{
				$limitstart=0;
			}
			$limit1 = $limitstart.",".$limit;
			$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
			$fetch_data=$this->db->mysqlSelect("*",$table,$where,$orderby,"","",$limit1);
		}
		// end of condition
		$this->data['paging'] = $pageNav->getListFooter();
		$this->data['dataList'] = $fetch_data;
		$this->data['total'] = $total;
		$this->data['lstart'] = $limitstart;
		
		return $this->data;
		
	} // END OF manageList()
	
	
	
//***********************************************    Contact US *****************************
function manageContactUs($form,$order=""){
		$where = "";
		if(isset($this->attributes['sleSortField']) && $this->attributes['sleSortField']!=''){
			$order = $this->attributes['sleSortField']." ".$this->attributes['sleSortOrder'];
		}
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "contactId desc ";
		}
		$table = $this->config['tbl_prefix']."contact";
		$this->manageList($form,$table,$where,$orderby);
		
		return $this->data;
		
	} // END OF manageContactUs()
    
	function getContactUsDetails($where=''){
		$contactusDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."contact",
											$where
										);
		return $contactusDetail;
	} //END OF getContactUsDetails()
	
	function getContactUsRead(){
		
		$field = array();
		$value = array();
		
		$field[] = 'contactRead';
		$value[] = '1';		
		
		$whereupdate =" contactId = '".$this->attributes['contactId']."'"; 
		$this->db->mysqlUpdate($this->config['tbl_prefix']."contact",$field,$value,$whereupdate);
	}
//****************************************  Add, Edit Delete Manage Services    ***********************************************
function ServicesList($paging,$form,$order=""){
		$data = array();
		
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
				if($this->db->mysqldelete($this->config['tbl_prefix']."services","categoryId='".$this->attributes['categoryId']."' ||   categoryParent='".$this->attributes['categoryId']."'")){
					$data['message'] = "Link has been deleted successfully.";
				}
				
			}
			if($this->attributes['token']=="deleteall"){
			
				$catid = implode(",",$this->attributes['categoryIds']);
				if($this->db->mysqldelete($this->config['tbl_prefix']."services","categoryId in (".$catid.") || categoryParent in (".$catid.")")){
						$data['message'] = "Link(s) has/have been deleted successfully.";
				}
			}
			if($this->attributes['token']=="deactivate" || $this->attributes['token']=="activate"){
				$field = array();
				$value = array();
				
				$field[] = 'categoryStatus';
				if($this->attributes['token']=="deactivate"){
					$value[] = "0";
				}else{
					$value[] = "1";
				}
				
				$whereupdate = "categoryId='".$this->attributes['categoryId']."'"; 
				
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."services",$field,$value,$whereupdate))
				{	
					$this->data['message'] = $this->errorObj->errorMessage(38);
				}
			}
		}
		
		$where = "categoryParent='0'";
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "categoryId desc";
		}
		
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."services",$where,$orderby);
		$total=count($fetch_data);
		if($_REQUEST['limitstart']!='')
			$this->attributes['limitstart'] = $_REQUEST['limitstart'];
		if(!isset($this->attributes['limitstart']))
			$limitstart=0;
		else
			$limitstart=$this->attributes['limitstart'];
		
		if(!isset($this->attributes['limit']) || $this->attributes['limit'] <= 0 || !is_int((int)$this->attributes['limit']))
			$limit=floor($this->config['item_per_page']);
		else
			$limit=floor($this->attributes['limit']);
		
		$limit1 = $limitstart.",".$limit;
		$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."services",$where,$orderby,"","",$limit1);
		// Applying condition 
		if(count($fetch_data)==0 && $total >0)
		{
			$limitstart=$limitstart-$this->config['item_per_page'];
			if($limitstart < 0)
			{
				$limitstart=0;
			}
			$limit1 = $limitstart.",".$limit;
			$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
			$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."services",$where,$orderby,"","",$limit1);
		}
		// end of condition
		$data['paging'] = $pageNav->getListFooter();
		$data['categoryList'] = $fetch_data;
		$data['total'] = $total;
		$data['lstart'] = $limitstart;
		
		return $data;
	} // END OF categoryList();
	
	
	function addServices(){
		if($this->validateAddServices()){
			$categoryTitle = $this->sqlInjection($this->attributes['txtTitle']);
			$catName = $this->sqlInjection($this->attributes['txtCategoryName']);
			//$catFor  = $this->sqlInjection($this->attributes['cmbCategoryFor']);
			$categoryDescription  = $this->sqlInjection($this->attributes['txtDescription']);
			$categoryKeyword  = $this->sqlInjection($this->attributes['txtKeyword']);
			$categoryDesc  = $this->sqlInjection($this->attributes['txtDesc']);
			
			$field[] = 'categoryTitle';
			$value[] = $categoryTitle;
			
			$field[] = 'categoryDescription';
			$value[] = $categoryDescription;
			
			$field[] = 'categoryName';
			$value[] = $catName;
			
			$field[] = 'categoryKeyword';
			$value[] = $categoryKeyword;
			
			$field[] = 'categoryDesc';
			$value[] = $categoryDesc;
			
			$field[] = 'categoryParent';
			$value[] = "0";
			
			$field[] = 'date';
			$value[] = date('Y-m-d');
			
			if($this->attributes['act']=='editservices'){
				$whereupdate =" categoryId = '".$this->attributes['categoryId']."'"; 
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."services",$field,$value,$whereupdate)){
					$this->error[] = $this->errorObj->errorMessage(15);
					return $this->error;
				}
			} else {
				if($this->db->mysqlInsert($this->config['tbl_prefix']."services",$field,$value)){
					header('Location: index.php?act=manageservices&limitstart='.$this->attributes['lstart'].'&msg=16');
				}
			}
		} else {
			return $this->error;
		}
	} //END OF addServices()
	
	
	function validateAddServices(){
		if($this->attributes['txtTitle']==''){
			$this->attributes['txtTitle'] = $this->attributes['txtCategoryName'];
		}
		if($this->attributes['txtCategoryName']==''){
			$this->error[] = $this->errorObj->errorMessage(9);
		}else if(!isset($this->attributes['editcategory']))  {
		if($this->attributes['categoryId']=='')
			$where =" categoryName = '".$this->attributes['txtCategoryName']."'";
		else
			$where =" categoryName = '".$this->attributes['txtCategoryName']."' and  categoryId != '".$this->attributes['categoryId']."'";
			
			$validate = $this->db->mysqlSelect("categoryId",
									$this->config['tbl_prefix']."services",
									$where
								);
			if($validate){
				$this->error[] = $this->errorObj->errorMessage(10);
			}
		}
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}
	} // END OF validateAddServices()
	
	
	function getServicesDetails($id='',$order="",$where1=""){
		if($where1!=""){
			$where = $where1;
		}
		if($id!=''){
			$where =" categoryId in (".$id.")";

		}
		
		$catdetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."services",
											$where,$order
										);
		return $catdetail;
	} // END OF getServicesDetails()
	
	
	function subServicesList($paging,$form,$order=""){
		$data = array();
		
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
				if($this->db->mysqldelete($this->config['tbl_prefix']."services","categoryId='".$this->attributes['subCategoryId']."'")){
					$data['message'] = "Sub-Link has been deleted successfully.";
				}
			}
			if($this->attributes['token']=="deleteall"){
			
				$catid = implode(",",$this->attributes['subcategoryIds']);
				if($this->db->mysqldelete($this->config['tbl_prefix']."services","categoryId in (".$catid.")")){
					$data['message'] = "Sub-Link(s) has/have been deleted successfully.";
				}
			}
			if($this->attributes['token']=="deactivate" || $this->attributes['token']=="activate"){
				$field = array();
				$value = array();
				
				$field[] = 'categoryStatus';
				if($this->attributes['token']=="deactivate"){
					$value[] = "0";
				}else{
					$value[] = "1";
				}
				
				$whereupdate = "categoryId='".$this->attributes['subCategoryId']."'"; 
				
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."services",$field,$value,$whereupdate))
				{	
					$this->data['message'] = $this->errorObj->errorMessage(38);
				}
			}
		}
		
		$where = "categoryParent!='0'";
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "categoryId desc";
		}
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."services",$where,$orderby);
		$total=count($fetch_data);
		if($_REQUEST['limitstart']!='')
			$this->attributes['limitstart'] = $_REQUEST['limitstart'];
		if(!isset($this->attributes['limitstart']))
			$limitstart=0;
		else
			$limitstart=$this->attributes['limitstart'];
		
		if(!isset($this->attributes['limit']) || $this->attributes['limit'] <= 0 || !is_int((int)$this->attributes['limit']))
			$limit=floor($this->config['item_per_page']);
		else
			$limit=floor($this->attributes['limit']);
		
		$limit1 = $limitstart.",".$limit;
		$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."services",$where,$orderby,"","",$limit1);
		// Applying condition 
		if(count($fetch_data)==0 && $total >0)
		{
			$limitstart=$limitstart-$this->config['item_per_page'];
			if($limitstart < 0)
			{
				$limitstart=0;
			}
			$limit1 = $limitstart.",".$limit;
			$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
			$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."sub_services",$where,$orderby,"","",$limit1);
		}
		// end of condition
		$data['paging'] = $pageNav->getListFooter();
		$data['subCategoryList'] = $fetch_data;
		$data['total'] = $total;
		$data['lstart'] = $limitstart;
		
		return $data;
	} // END OF subCategoryList
	
	
	function addSubServices(){echo "<br /><br />DFvsdfvsd";
		if($this->validateAddSubServices($error)){
			$categoryTitle  = $this->sqlInjection($this->attributes['txtTitle']);
			$catName = $this->sqlInjection($this->attributes['txtSubCategoryName']);
			$catTag = $this->sqlInjection($this->attributes['txtSubCategoryTag']);
			$category  = $this->sqlInjection($this->attributes['cmbCategory']);
			$categoryDescription  = $this->sqlInjection($this->attributes['txtDescription']);
			$categoryKeyword  = $this->sqlInjection($this->attributes['txtKeyword']);
			$categoryDesc  = $this->sqlInjection($this->attributes['txtDesc']);
			
			
			$field[] = 'categoryTitle';
			$value[] = $categoryTitle;
			
			$field[] = 'categoryName';
			$value[] = $catName;
			
			$field[] = 'categoryTag';
			$value[] = $catTag;
			
			$field[] = 'categoryParent';
			$value[] = $category;
			
			$field[] = 'categoryDescription';
			$value[] = $categoryDescription;
			
			$field[] = 'categoryKeyword';
			$value[] = $categoryKeyword;
			
			$field[] = 'categoryDesc';
			$value[] = $categoryDesc;
			
			$field[] = 'date';
			$value[] = date('Y-m-d');
			
			if($this->attributes['act']=='editsubservices'){
				$whereupdate =" categoryId = '".$this->attributes['subCategoryId']."' "; 
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."services",$field,$value,$whereupdate)){
					header('Location: index.php?act=managesubservices&limitstart='.$this->attributes['lstart'].'&msg=17');
				}
			} else {
				if($this->db->mysqlInsert($this->config['tbl_prefix']."services",$field,$value)){
					header('Location: index.php?act=managesubservices&limitstart='.$this->attributes['lstart'].'&msg=18');
				}
			}
		} else {
			return $this->error;
		}
	} // END OF addSubCategory()
	
	
	function validateAddSubServices(){
		
		if($this->attributes['txtTitle']==''){
			$this->attributes['txtTitle'] = $this->attributes['txtSubCategoryName'];
		}
		if($this->attributes['txtSubCategoryName']==''){
			$this->error[] = $this->errorObj->errorMessage(12);
		} else {
			if($this->attributes['subCategoryId']=='')
			$where =" categoryName = '".$this->attributes['txtSubCategoryName']."' and categoryParent = '".$this->attributes['cmbCategory']."'";
		else
			$where =" categoryName = '".$this->attributes['txtSubCategoryName']."' and categoryParent = '".$this->attributes['cmbCategory']."' and  categoryId != '".$this->attributes['subCategoryId']."'";
			$validate = $this->db->mysqlSelect("categoryId",
									$this->config['tbl_prefix']."services",
									$where
								);
			if($validate){
				$this->error[] = $this->errorObj->errorMessage(13);
			}
		}
		
		if($this->attributes['cmbCategory']=='select'){
			$this->error[] = $this->errorObj->errorMessage(14);
		}
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}
	} // END OF validateAddSubServices()
	
	
	function getSubServicesDetails($id=''){
		if($id!=''){
			$where = " and subCategoryId in (".$id.")";
		}
		$catdetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."sub_services",
											$where
										);
		return $catdetail;
	} // END OF getSubCategoryDetails()
	
	/*function getSubCatDetailsByCat($id=''){
		if($id!=''){
			$where =" categoryId in (".$id.")";
		}
		$catdetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."sub_category",
											$where
										);
		return $catdetail;
	} // END OF getSubCatDetailsByCat()
// ******************************************* Manage Add Edit Delete Hire *******************************************/
function HireList($paging,$form,$order=""){
		$data = array();
		
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
				if($this->db->mysqldelete($this->config['tbl_prefix']."hire","categoryId='".$this->attributes['categoryId']."' ||   categoryParent='".$this->attributes['categoryId']."'")){
					$data['message'] = "Link has been deleted successfully.";
				}
				
			}
			if($this->attributes['token']=="deleteall"){
			
				$catid = implode(",",$this->attributes['categoryIds']);
				if($this->db->mysqldelete($this->config['tbl_prefix']."hire","categoryId in (".$catid.") || categoryParent in (".$catid.")")){
						$data['message'] = "Link(s) has/have been deleted successfully.";
				}
			}
			if($this->attributes['token']=="deactivate" || $this->attributes['token']=="activate"){
				$field = array();
				$value = array();
				
				$field[] = 'categoryStatus';
				if($this->attributes['token']=="deactivate"){
					$value[] = "0";
				}else{
					$value[] = "1";
				}
				
				$whereupdate = "categoryId='".$this->attributes['categoryId']."'"; 
				
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."hire",$field,$value,$whereupdate))
				{	
					$this->data['message'] = $this->errorObj->errorMessage(38);
				}
			}
		}
		
		$where = "categoryParent='0'";
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "categoryId desc";
		}
		
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."hire",$where,$orderby);
		$total=count($fetch_data);
		if($_REQUEST['limitstart']!='')
			$this->attributes['limitstart'] = $_REQUEST['limitstart'];
		if(!isset($this->attributes['limitstart']))
			$limitstart=0;
		else
			$limitstart=$this->attributes['limitstart'];
		
		if(!isset($this->attributes['limit']) || $this->attributes['limit'] <= 0 || !is_int((int)$this->attributes['limit']))
			$limit=floor($this->config['item_per_page']);
		else
			$limit=floor($this->attributes['limit']);
		
		$limit1 = $limitstart.",".$limit;
		$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."hire",$where,$orderby,"","",$limit1);
		// Applying condition 
		if(count($fetch_data)==0 && $total >0)
		{
			$limitstart=$limitstart-$this->config['item_per_page'];
			if($limitstart < 0)
			{
				$limitstart=0;
			}
			$limit1 = $limitstart.",".$limit;
			$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
			$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."hire",$where,$orderby,"","",$limit1);
		}
		// end of condition
		$data['paging'] = $pageNav->getListFooter();
		$data['categoryList'] = $fetch_data;
		$data['total'] = $total;
		$data['lstart'] = $limitstart;
		
		return $data;
	} // END OF categoryList();
	
	
	function addHire(){
		if($this->validateAddHire()){
			$categoryTitle = $this->sqlInjection($this->attributes['txtTitle']);
			$catName = $this->sqlInjection($this->attributes['txtCategoryName']);
			//$catFor  = $this->sqlInjection($this->attributes['cmbCategoryFor']);
			$categoryDescription  = $this->sqlInjection($this->attributes['txtDescription']);
			$categoryKeyword  = $this->sqlInjection($this->attributes['txtKeyword']);
			$categoryDesc  = $this->sqlInjection($this->attributes['txtDesc']);
			
			$field[] = 'categoryTitle';
			$value[] = $categoryTitle;
			
			$field[] = 'categoryDescription';
			$value[] = $categoryDescription;
			
			$field[] = 'categoryName';
			$value[] = $catName;
			
			$field[] = 'categoryKeyword';
			$value[] = $categoryKeyword;
			
			$field[] = 'categoryDesc';
			$value[] = $categoryDesc;
			
			$field[] = 'categoryParent';
			$value[] = "0";
			
			$field[] = 'date';
			$value[] = date('Y-m-d');
			
			if($this->attributes['act']=='edithire'){
				$whereupdate =" categoryId = '".$this->attributes['categoryId']."'"; 
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."hire",$field,$value,$whereupdate)){
					$this->error[] = $this->errorObj->errorMessage(15);
					return $this->error;
				}
			} else {
				if($this->db->mysqlInsert($this->config['tbl_prefix']."hire",$field,$value)){
					header('Location: index.php?act=managehire&limitstart='.$this->attributes['lstart'].'&msg=16');
				}
			}
		} else {
			return $this->error;
		}
	} //END OF addHire()
	
	
	function validateAddHire(){
		if($this->attributes['txtTitle']==''){
			$this->attributes['txtTitle'] = $this->attributes['txtCategoryName'];
		}
		if($this->attributes['txtCategoryName']==''){
			$this->error[] = $this->errorObj->errorMessage(9);
		}else if(!isset($this->attributes['editcategory']))  {
		if($this->attributes['categoryId']=='')
			$where =" categoryName = '".$this->attributes['txtCategoryName']."'";
		else
			$where =" categoryName = '".$this->attributes['txtCategoryName']."' and  categoryId != '".$this->attributes['categoryId']."'";
			
			$validate = $this->db->mysqlSelect("categoryId",
									$this->config['tbl_prefix']."hire",
									$where
								);
			if($validate){
				$this->error[] = $this->errorObj->errorMessage(10);
			}
		}
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}
	} // END OF validateAddHire()
	
	
	function getHireDetails($id='',$order="",$where1=""){
		if($where1!=""){
			$where = $where1;
		}
		if($id!=''){
			$where =" categoryId in (".$id.")";

		}
		
		$catdetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."hire",
											$where,$order
										);
		return $catdetail;
	} // END OF getHireDetails()
	
	
	function subHireList($paging,$form,$order=""){
		$data = array();
		
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
				if($this->db->mysqldelete($this->config['tbl_prefix']."hire","categoryId='".$this->attributes['subCategoryId']."'")){
					$data['message'] = "Sub-Link has been deleted successfully.";
				}
			}
			if($this->attributes['token']=="deleteall"){
			
				$catid = implode(",",$this->attributes['subcategoryIds']);
				if($this->db->mysqldelete($this->config['tbl_prefix']."hire","categoryId in (".$catid.")")){
					$data['message'] = "Sub-Link(s) has/have been deleted successfully.";
				}
			}
			if($this->attributes['token']=="deactivate" || $this->attributes['token']=="activate"){
				$field = array();
				$value = array();
				
				$field[] = 'categoryStatus';
				if($this->attributes['token']=="deactivate"){
					$value[] = "0";
				}else{
					$value[] = "1";
				}
				
				$whereupdate = "categoryId='".$this->attributes['subCategoryId']."'"; 
				
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."hire",$field,$value,$whereupdate))
				{	
					$this->data['message'] = $this->errorObj->errorMessage(38);
				}
			}
		}
		
		$where = "categoryParent!='0'";
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "categoryId desc";
		}
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."hire",$where,$orderby);
		$total=count($fetch_data);
		if($_REQUEST['limitstart']!='')
			$this->attributes['limitstart'] = $_REQUEST['limitstart'];
		if(!isset($this->attributes['limitstart']))
			$limitstart=0;
		else
			$limitstart=$this->attributes['limitstart'];
		
		if(!isset($this->attributes['limit']) || $this->attributes['limit'] <= 0 || !is_int((int)$this->attributes['limit']))
			$limit=floor($this->config['item_per_page']);
		else
			$limit=floor($this->attributes['limit']);
		
		$limit1 = $limitstart.",".$limit;
		$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."hire",$where,$orderby,"","",$limit1);
		// Applying condition 
		if(count($fetch_data)==0 && $total >0)
		{
			$limitstart=$limitstart-$this->config['item_per_page'];
			if($limitstart < 0)
			{
				$limitstart=0;
			}
			$limit1 = $limitstart.",".$limit;
			$pageNav = new mosPageNav($total, $limitstart, $limit,$form);
			$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."sub_hire",$where,$orderby,"","",$limit1);
		}
		// end of condition
		$data['paging'] = $pageNav->getListFooter();
		$data['subCategoryList'] = $fetch_data;
		$data['total'] = $total;
		$data['lstart'] = $limitstart;
		
		return $data;
	} // END OF subCategoryList
	
	
	function addSubHire(){echo "<br /><br />DFvsdfvsd";
		if($this->validateAddSubHire($error)){
			$categoryTitle  = $this->sqlInjection($this->attributes['txtTitle']);
			$catName = $this->sqlInjection($this->attributes['txtSubCategoryName']);
			$catTag = $this->sqlInjection($this->attributes['txtSubCategoryTag']);
			$category  = $this->sqlInjection($this->attributes['cmbCategory']);
			$categoryDescription  = $this->sqlInjection($this->attributes['txtDescription']);
			$categoryKeyword  = $this->sqlInjection($this->attributes['txtKeyword']);
			$categoryDesc  = $this->sqlInjection($this->attributes['txtDesc']);
			
			
			$field[] = 'categoryTitle';
			$value[] = $categoryTitle;
			
			$field[] = 'categoryName';
			$value[] = $catName;
			
			$field[] = 'categoryTag';
			$value[] = $catTag;
			
			$field[] = 'categoryParent';
			$value[] = $category;
			
			$field[] = 'categoryDescription';
			$value[] = $categoryDescription;
			
			$field[] = 'categoryKeyword';
			$value[] = $categoryKeyword;
			
			$field[] = 'categoryDesc';
			$value[] = $categoryDesc;
			
			$field[] = 'date';
			$value[] = date('Y-m-d');
			
			if($this->attributes['act']=='editsubhire'){
				$whereupdate =" categoryId = '".$this->attributes['subCategoryId']."' "; 
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."hire",$field,$value,$whereupdate)){
					header('Location: index.php?act=managesubhire&limitstart='.$this->attributes['lstart'].'&msg=17');
				}
			} else {
				if($this->db->mysqlInsert($this->config['tbl_prefix']."hire",$field,$value)){
					header('Location: index.php?act=managesubhire&limitstart='.$this->attributes['lstart'].'&msg=18');
				}
			}
		} else {
			return $this->error;
		}
	} // END OF addSubCategory()
	
	
	function validateAddSubHire(){
		
		if($this->attributes['txtTitle']==''){
			$this->attributes['txtTitle'] = $this->attributes['txtSubCategoryName'];
		}
		if($this->attributes['txtSubCategoryName']==''){
			$this->error[] = $this->errorObj->errorMessage(12);
		} else {
			if($this->attributes['subCategoryId']=='')
			$where =" categoryName = '".$this->attributes['txtSubCategoryName']."' and categoryParent = '".$this->attributes['cmbCategory']."'";
		else
			$where =" categoryName = '".$this->attributes['txtSubCategoryName']."' and categoryParent = '".$this->attributes['cmbCategory']."' and  categoryId != '".$this->attributes['subCategoryId']."'";
			$validate = $this->db->mysqlSelect("categoryId",
									$this->config['tbl_prefix']."hire",
									$where
								);
			if($validate){
				$this->error[] = $this->errorObj->errorMessage(13);
			}
		}
		
		if($this->attributes['cmbCategory']=='select'){
			$this->error[] = $this->errorObj->errorMessage(14);
		}
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}
	} // END OF validateAddSubHire()
	
	
	function getSubHireDetails($id=''){
		if($id!=''){
			$where = " and subCategoryId in (".$id.")";
		}
		$catdetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."sub_hire",
											$where
										);
		return $catdetail;
	}
	
//******************************************* Mange Add Edit Delete Pages ********************************************

function managePage($form,$order="",$where=""){
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
							
				
				$where ="pageId = '".$this->attributes['pageId']."'";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."page",$where)){
						$this->data['message'] = $this->errorObj->errorMessage(65);
					
				}
			}
			if($this->attributes['token']=="deleteall"){
				$pageId = implode(",",$this->attributes['pageIds']);
				
				$where = "pageId in (".$pageId.")";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."page","pageId in (".$pageId.")")){
						$this->data['message'] = $this->errorObj->errorMessage(66);
					}
				
			}
			
		}
		
		
		$where = "";
		if(isset($this->attributes['sleSortField']) && $this->attributes['sleSortField']!=''){
			$order = $this->attributes['sleSortField']." ".$this->attributes['sleSortOrder'];
		}
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "pageId desc ";
		}
		$table = $this->config['tbl_prefix']."page";
		
		$this->manageList($form,$table,$where,$orderby);
		
		return $this->data;
		
	} // END OF managePage()
	
	function addEditPage(){
		
		if((isset($this->attributes['addpage']) && $this->attributes['addpage']!='') || (isset($this->attributes['editpage']) && $this->attributes['editpage']!='')) {
			if($this->validatePage()){
				
				$pageName = $this->sqlInjection($this->attributes['txtPageName']);
				$pageDesc = $this->sqlInjection($this->attributes['txtPageDesc']);
				$pageTitle = $this->sqlInjection($this->attributes['txtPageTitle']);
				$pageKeyword = $this->sqlInjection($this->attributes['txtPageKeyword']);
				$pageDescription = $this->sqlInjection($this->attributes['txtPageDescription']);
							
				$field   = array();
				$value   = array();
				
				$field[] = 'pageName';
				$value[] = $pageName;
				
				$field[] = 'pageTitle';
				$value[] = $pageTitle;
				
				$field[] = 'pageKeyword';
				$value[] = $pageKeyword;
				
				$field[] = 'pageDescription';
				$value[] = $pageDescription;
				
				$field[] = 'pageDesc';
				$value[] = $pageDesc;
				
				$field[] = 'Date';
				$value[] = date('Y-m-d h:i:s');
				
				if($this->attributes['act']=='editpage'){
				
					$whereupdate =" pageId = '".$this->attributes['pageId']."'"; 
					
					if($this->db->mysqlUpdate($this->config['tbl_prefix']."page",$field,$value,$whereupdate)){
						
						$pageDetails = $this->getPageDetails($whereupdate);
		
						$this->attributes['txtPageName'] = $pageDetails[0]["pageName"];
						$this->attributes['txtPageDesc'] = $pageDetails[0]["pageDesc"];
						$this->attributes['txtPageTitle'] = $pageDetails[0]["pageTitle"];
						$this->attributes['txtPageKeyword'] = $pageDetails[0]["pageKeyword"];
						$this->attributes['txtPageDescription'] = $pageDetails[0]["pageDescription"];
						
												
						$this->error[] = "68";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error; 
						return $this->data;
					}
				} else {
				
					if($this->db->mysqlInsert($this->config['tbl_prefix']."page",$field,$value)){
						
						$this->attributes['txtPageName']	= "";
						$this->attributes['txtPageDesc']	= "";
						$this->attributes['txtPageTitle'] = "";
						$this->attributes['txtPageKeyword'] = "";
						$this->attributes['txtPageDescription'] = "";
						$this->attributes['limitstart']		= "0";
						
						
						$this->error[] = "67";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error;
						return $this->data;
								
					}
				}
			} else {
				$this->data['attributes'] = $this->attributes;
				$this->data['error'] = $this->error; 
				return $this->data;
			}
		}else{
			if(isset($this->attributes['pageId']) && $this->attributes['pageId']!='') {
				$where =" pageId = '".$this->attributes['pageId']."'";
				$pageDetails = $this->getPageDetails($where);

				$this->attributes['txtPageName'] = $pageDetails[0]["pageName"];
				$this->attributes['txtPageDesc'] = $pageDetails[0]["pageDesc"];
				$this->attributes['txtPageTitle'] = $pageDetails[0]["pageTitle"];
				$this->attributes['txtPageKeyword'] = $pageDetails[0]["pageKeyword"];
				$this->attributes['txtPageDescription'] = $pageDetails[0]["pageDescription"];
				
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}else{
				$this->attributes['txtPageName'] 	= "";
				$this->attributes['txtPageDesc'] 	= "";
				$this->attributes['txtPageTitle'] = "";
				$this->attributes['txtPageKeyword'] = "";
				$this->attributes['txtPageDescription'] = "";
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}
		}
	} // END OF addEditPage()
	
	function validatePage(){
		if($this->attributes['txtPageName']==''){
			$this->error[] = $this->errorObj->errorMessage(69);
		} 
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}

	} // END OF validatePage()
	
	function getPageDetails($where=''){
		$pageDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."page",
											$where
										);
		return $pageDetail;
	} //END OF getPageDetails()
//******************************************* Manage, Add, Edit, Delete, News	**************************************/
function manageNews($form,$order="",$where=""){
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
							
				
				$where ="newsId = '".$this->attributes['newsId']."'";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."news",$where)){
						$this->data['message'] = $this->errorObj->errorMessage(65);
					
				}
			}
			if($this->attributes['token']=="deleteall"){
				$newsId = implode(",",$this->attributes['newsIds']);
				
				$where = "newsId in (".$newsId.")";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."news","newsId in (".$newsId.")")){
						$this->data['message'] = $this->errorObj->errorMessage(66);
					}
				
			}
			
		}
		
		
		$where = "";
		if(isset($this->attributes['sleSortField']) && $this->attributes['sleSortField']!=''){
			$order = $this->attributes['sleSortField']." ".$this->attributes['sleSortOrder'];
		}
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "newsId desc ";
		}
		$table = $this->config['tbl_prefix']."news";
		
		$this->manageList($form,$table,$where,$orderby);
		
		return $this->data;
		
	} // END OF manageNews()
	
	function addEditNews(){
		
		if((isset($this->attributes['addnews']) && $this->attributes['addnews']!='') || (isset($this->attributes['editnews']) && $this->attributes['editnews']!='')) {
			if($this->validateNews()){
				
				$newsName = $this->sqlInjection($this->attributes['txtNewsName']);
				$newsDesc = $this->sqlInjection($this->attributes['txtNewsDesc']);
							
				$field   = array();
				$value   = array();
				
				$field[] = 'newsName';
				$value[] = $newsName;
				
				$field[] = 'newsDesc';
				$value[] = $newsDesc;
				
				$field[] = 'Date';
				$value[] = date('Y-m-d h:i:s');
				
				if($this->attributes['act']=='editnews'){
				
					$whereupdate =" newsId = '".$this->attributes['newsId']."'"; 
					
					if($this->db->mysqlUpdate($this->config['tbl_prefix']."news",$field,$value,$whereupdate)){
						
						$newsDetails = $this->getNewsDetails($whereupdate);
		
						$this->attributes['txtNewsName'] = $newsDetails[0]["newsName"];
						$this->attributes['txtNewsDesc'] = $newsDetails[0]["newsDesc"];
						
												
						$this->error[] = "68";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error; 
						return $this->data;
					}
				} else {
				
					if($this->db->mysqlInsert($this->config['tbl_prefix']."news",$field,$value)){
						
						$this->attributes['txtNewsName']	= "";
						$this->attributes['txtNewsDesc']	= "";
						$this->attributes['limitstart']		= "0";
						
						
						$this->error[] = "67";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error;
						return $this->data;
								
					}
				}
			} else {
				$this->data['attributes'] = $this->attributes;
				$this->data['error'] = $this->error; 
				return $this->data;
			}
		}else{
			if(isset($this->attributes['newsId']) && $this->attributes['newsId']!='') {
				$where =" newsId = '".$this->attributes['newsId']."'";
				$newsDetails = $this->getNewsDetails($where);

				$this->attributes['txtNewsName'] = $newsDetails[0]["newsName"];
				$this->attributes['txtNewsDesc'] = $newsDetails[0]["newsDesc"];
				
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}else{
				$this->attributes['txtNewsName'] 	= "";
				$this->attributes['txtNewsDesc'] 	= "";
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}
		}
	} // END OF addEditNews()
	
	function validateNews(){
		if($this->attributes['txtNewsName']==''){
			$this->error[] = $this->errorObj->errorMessage(69);
		} 
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}

	} // END OF validateNews()
	
	function getNewsDetails($where=''){
		$newsDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."news",
											$where
										);
		return $newsDetail;
	} //END OF getNewsDetails()
	
//**************************************** Manage add edit delete Testimonial **************************************<br />
function manageTestimonial($form,$order="",$where=""){
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
							
				
				$where ="testimonialId = '".$this->attributes['testimonialId']."'";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."testimonial",$where)){
						$this->data['message'] = $this->errorObj->errorMessage(65);
					
				}
			}
			if($this->attributes['token']=="deleteall"){
				$testimonialId = implode(",",$this->attributes['testimonialIds']);
				
				$where = "testimonialId in (".$testimonialId.")";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."testimonial","testimonialId in (".$testimonialId.")")){
						$this->data['message'] = $this->errorObj->errorMessage(66);
					}
				
			}
			
		}
		
		
		$where = "";
		if(isset($this->attributes['sleSortField']) && $this->attributes['sleSortField']!=''){
			$order = $this->attributes['sleSortField']." ".$this->attributes['sleSortOrder'];
		}
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "testimonialId desc ";
		}
		$table = $this->config['tbl_prefix']."testimonial";
		
		$this->manageList($form,$table,$where,$orderby);
		
		return $this->data;
		
	} // END OF manageTestimonial()
	
	function addEditTestimonial(){
		
		if((isset($this->attributes['addtestimonial']) && $this->attributes['addtestimonial']!='') || (isset($this->attributes['edittestimonial']) && $this->attributes['edittestimonial']!='')) {
			if($this->validateTestimonial()){
				
				$testimonialName = $this->sqlInjection($this->attributes['txtTestimonialName']);
				$personDesignation = $this->sqlInjection($this->attributes['txtPersonDesignation']);
				$testimonialDesc = $this->sqlInjection($this->attributes['txtTestimonialDesc']);

				$imagePath = $this->config['sitepath']."clients/";
				
				$field   = array();
				$value   = array();
				
				if($this->attributes['fleImage']['name']!='')
					{
					$flagname = $this->uploadFile($imagePath,'fleImage',"image","250","223");
					if($flagname){
						$field[] = 'testimonialImage';
						$value[] = $flagname;
						
						if(isset($this->attributes['oldImage']))
							{
							if($this->attributes['oldImage']!='')
								{
								if(file_exists($imagePath.$this->attributes['oldImage']))
									{
									unlink($imagePath.$this->attributes['oldImage']);
									}
								
								}
							}
						}
					}
					else {
						$this->data['attributes'] = $this->attributes;
						$this->data['error'] = $this->error; 
						return $this->data;
					}
				
				$field[] = 'testimonialName';
				$value[] = $testimonialName;
				
				$field[] = 'personDesignation';
				$value[] = $personDesignation;
				
				$field[] = 'testimonialDesc';
				$value[] = $testimonialDesc;
				
				$field[] = 'Date';
				$value[] = date('Y-m-d h:i:s');
				
				if($this->attributes['act']=='edittestimonial'){
				
					$whereupdate =" testimonialId = '".$this->attributes['testimonialId']."'"; 
					
					if($this->db->mysqlUpdate($this->config['tbl_prefix']."testimonial",$field,$value,$whereupdate)){
						
						$testimonialDetails = $this->getTestimonialDetails($whereupdate);
		
						$this->attributes['txtTestimonialName'] = $testimonialDetails[0]["testimonialName"];
						$this->attributes['txtTestimonialDesc'] = $testimonialDetails[0]["testimonialDesc"];
						$this->attributes['txtPersonDesignation'] = $testimonialDetails[0]["personDesignation"];
						$this->attributes['oldImage'] 		  = $testimonialDetails[0]["testimonialImage"];
												
						$this->error[] = "68";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error; 
						return $this->data;
					}
				} else {
				
					if($this->db->mysqlInsert($this->config['tbl_prefix']."testimonial",$field,$value)){
						
						$this->attributes['txtTestimonialName']	= "";
						$this->attributes['txtTestimonialDesc']	= "";
						$this->attributes['txtPersonDesignation'] = "";
						$this->attributes['oldImage'] 		  = "";
						$this->attributes['limitstart']		= "0";
						
						
						$this->error[] = "67";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error;
						return $this->data;
								
					}
				}
			} else {
				$this->data['attributes'] = $this->attributes;
				$this->data['error'] = $this->error; 
				return $this->data;
			}
		}else{
			if(isset($this->attributes['testimonialId']) && $this->attributes['testimonialId']!='') {
				$where =" testimonialId = '".$this->attributes['testimonialId']."'";
				$testimonialDetails = $this->getTestimonialDetails($where);

				$this->attributes['txtTestimonialName'] = $testimonialDetails[0]["testimonialName"];
				$this->attributes['txtTestimonialDesc'] = $testimonialDetails[0]["testimonialDesc"];
				$this->attributes['txtPersonDesignation'] = $testimonialDetails[0]["personDesignation"];
				$this->attributes['oldImage'] 		  = $testimonialDetails[0]["testimonialImage"];
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}else{
				$this->attributes['txtTestimonialName'] 	= "";
				$this->attributes['txtTestimonialDesc'] 	= "";
				$this->attributes['txtPersonDesignation'] = "";
				$this->attributes['oldImage'] 		  = "";
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}
		}
	} // END OF addEditTestimonial()
	
	function validateTestimonial(){
		if($this->attributes['txtTestimonialName']==''){
			$this->error[] = $this->errorObj->errorMessage(69);
		} 
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}

	} // END OF validateTestimonial()
	
	function getTestimonialDetails($where=''){
		$testimonialDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."testimonial",
											$where
										);
		return $testimonialDetail;
	} //END OF getTestimonialDetails()

//*****************************************************	Manage Add Edit Delete Portfolio **********************************************
function managePortfolio($form,$order="",$where=""){
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
							
				
				$where ="portfolioId = '".$this->attributes['portfolioId']."'";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."portfolio",$where)){
						$this->data['message'] = $this->errorObj->errorMessage(65);
					
				}
			}
			if($this->attributes['token']=="deleteall"){
				$portfolioId = implode(",",$this->attributes['portfolioIds']);
				
				$where = "portfolioId in (".$portfolioId.")";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."portfolio","portfolioId in (".$portfolioId.")")){
						$this->data['message'] = $this->errorObj->errorMessage(66);
					}
				
			}
			
		}
		
		
		$where = "";
		if(isset($this->attributes['sleSortField']) && $this->attributes['sleSortField']!=''){
			$order = $this->attributes['sleSortField']." ".$this->attributes['sleSortOrder'];
		}
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "portfolioId desc ";
		}
		$table = $this->config['tbl_prefix']."portfolio";
		
		$this->manageList($form,$table,$where,$orderby);
		
		return $this->data;
		
	} // END OF managePortfolio()
	
	function addEditPortfolio(){
		
		if((isset($this->attributes['addportfolio']) && $this->attributes['addportfolio']!='') || (isset($this->attributes['editportfolio']) && $this->attributes['editportfolio']!='')) {
			if($this->validatePortfolio()){
				
				$portfolioName = $this->sqlInjection($this->attributes['txtPortfolioName']);
				$portfolioDesc = $this->sqlInjection($this->attributes['txtPortfolioDesc']);
				$portfolioType = $this->sqlInjection($this->attributes['selPortfolioType']);
				$portfolioLink = $this->sqlInjection($this->attributes['txtPortfolioLink']);
				
				$imagePath = $this->config['sitepath']."portfolio/";
				
				
				
				
				$field   = array();
				$value   = array();
				
				
				if($this->attributes['fleImage']['name']!='')
					{
					$flagname = $this->uploadFile($imagePath,'fleImage',"image","250","223");
					if($flagname){
						$field[] = 'portfolioImage';
						$value[] = $flagname;
						
						if(isset($this->attributes['oldImage']))
							{
							if($this->attributes['oldImage']!='')
								{
								if(file_exists($imagePath.$this->attributes['oldImage']))
									{
									unlink($imagePath.$this->attributes['oldImage']);
									}
								
								}
							}
						}
					}
					else {
						$this->data['attributes'] = $this->attributes;
						$this->data['error'] = $this->error; 
						return $this->data;
					}
				
						
				
				$field[] = 'portfolioName';
				$value[] = $portfolioName;
				
				$field[] = 'portfolioDesc';
				$value[] = $portfolioDesc;
				
				$field[] = 'portfolioType';
				$value[] = $portfolioType;
				
				$field[] = 'portfolioLink';
				$value[] = $portfolioLink;
				
				$field[] = 'Date';
				$value[] = date('Y-m-d h:i:s');
				
				if($this->attributes['act']=='editportfolio'){
				
					$whereupdate =" portfolioId = '".$this->attributes['portfolioId']."'"; 
					
					if($this->db->mysqlUpdate($this->config['tbl_prefix']."portfolio",$field,$value,$whereupdate)){
						
						
						
						$portfolioDetails = $this->getPortfolioDetails($whereupdate);
		
						$this->attributes['txtPortfolioName'] = $portfolioDetails[0]["portfolioName"];
						$this->attributes['txtPortfolioDesc'] = $portfolioDetails[0]["portfolioDesc"];
						$this->attributes['selPortfolioType'] = $portfolioDetails[0]["portfolioType"];
						$this->attributes['txtPortfolioLink'] = $portfolioDetails[0]["portfolioLink"];
						$this->attributes['oldImage'] 		  = $portfolioDetails[0]["portfolioImage"];
												
						$this->error[] = "68";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error; 
						return $this->data;
					}
				} else {
				
					if($this->db->mysqlInsert($this->config['tbl_prefix']."portfolio",$field,$value)){
						
						$this->attributes['txtPortfolioName']	= "";
						$this->attributes['txtPortfolioDesc']	= "";
						$this->attributes['selPortfolioType'] = "";
						$this->attributes['txtPortfolioLink'] = "";
						$this->attributes['oldImage'] 		 	= "";
						$this->attributes['limitstart']		= "0";
						
						
						$this->error[] = "67";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error;
						return $this->data;
								
					}
				}
			} else {
				$this->data['attributes'] = $this->attributes;
				$this->data['error'] = $this->error; 
				return $this->data;
			}
		}else{
			if(isset($this->attributes['portfolioId']) && $this->attributes['portfolioId']!='') {
				$where =" portfolioId = '".$this->attributes['portfolioId']."'";
				$portfolioDetails = $this->getPortfolioDetails($where);

				$this->attributes['txtPortfolioName'] = $portfolioDetails[0]["portfolioName"];
				$this->attributes['txtPortfolioDesc'] = $portfolioDetails[0]["portfolioDesc"];
				$this->attributes['selPortfolioType'] = $portfolioDetails[0]["portfolioType"];
				$this->attributes['txtPortfolioLink'] = $portfolioDetails[0]["portfolioLink"];
				$this->attributes['oldImage'] 		  = $portfolioDetails[0]["portfolioImage"];
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}else{
				$this->attributes['txtPortfolioName'] 	= "";
				$this->attributes['txtPortfolioDesc'] 	= "";
				$this->attributes['selPortfolioType'] = "";
				$this->attributes['txtPortfolioLink'] = "";
				$this->attributes['oldImage'] 		  = "";
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}
		}
	} // END OF addEditPortfolio()
	
	function validatePortfolio(){
		if($this->attributes['txtPortfolioName']==''){
			$this->error[] = $this->errorObj->errorMessage(69);
		} 
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}

	} // END OF validatePortfolio()
	
	function getPortfolioDetails($where=''){
		$portfolioDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."portfolio",
											$where
										);
		return $portfolioDetail;
	} //END OF getPortfolioDetails()
}
?>