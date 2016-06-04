<?php
class AdminClass {

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
			
			$option .= ">".$fetch_data[$i][$optionFiled]."</option>";
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
	
	
	function categoryList($paging,$form,$order=""){
		$data = array();
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
				if($this->db->mysqldelete($this->config['tbl_prefix']."category","categoryId='".$this->attributes['categoryId']."' ||   categoryParent='".$this->attributes['categoryId']."'")){
					$data['message'] = "Link has been deleted successfully.";
				}
				
			}
			if($this->attributes['token']=="deleteall"){
			
				$catid = implode(",",$this->attributes['categoryIds']);
				if($this->db->mysqldelete($this->config['tbl_prefix']."category","categoryId in (".$catid.") || categoryParent in (".$catid.")")){
						$data['message'] = "Link(s) has/have been deleted successfully.";
				}
			}
		}
		
		$where = "categoryParent='0'";
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "categoryId desc";
		}
		
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."category",$where,$orderby);
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
		$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."category",$where,$orderby,"","",$limit1);
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
			$fetch_data=$this->db->mysqlSelect("*",$this->config['tbl_prefix']."category",$where,$orderby,"","",$limit1);
		}
		// end of condition
		$data['paging'] = $pageNav->getListFooter();
		$data['categoryList'] = $fetch_data;
		$data['total'] = $total;
		$data['lstart'] = $limitstart;
		
		return $data;
	} // END OF categoryList();
	
	
	function addCategory(){
		if($this->validateAddCategory()){
			$catName = $this->sqlInjection($this->attributes['txtCategoryName']);
			//$catFor  = $this->sqlInjection($this->attributes['cmbCategoryFor']);
			$categoryDescription  = $this->sqlInjection($this->attributes['txtDescription']);
							
			$field[] = 'categoryDescription';
			$value[] = $categoryDescription;
			
			$field[] = 'categoryName';
			$value[] = $catName;
			
			$field[] = 'categoryParent';
			$value[] = "0";
			
			$field[] = 'date';
			$value[] = date('Y-m-d');
			
			if($this->attributes['act']=='editcategory'){
				$whereupdate =" categoryId = '".$this->attributes['categoryId']."'"; 
				if($this->db->mysqlUpdate($this->config['tbl_prefix']."category",$field,$value,$whereupdate)){
					$this->error[] = $this->errorObj->errorMessage(15);
					return $this->error;
				}
			} else {
				if($this->db->mysqlInsert($this->config['tbl_prefix']."category",$field,$value)){
					header('Location: index.php?act=managecategory&limitstart='.$this->attributes['lstart'].'&msg=16');
				}
			}
		} else {
			return $this->error;
		}
	} //END OF addCategory()
	
	
	function validateAddCategory(){
		if($this->attributes['txtCategoryName']==''){
			$this->error[] = $this->errorObj->errorMessage(9);
		}else if(!isset($this->attributes['editcategory']))  {
		if($this->attributes['categoryId']=='')
			$where =" categoryName = '".$this->attributes['txtCategoryName']."'";
		else
			$where =" categoryName = '".$this->attributes['txtCategoryName']."' and  categoryId != '".$this->attributes['categoryId']."'";
			
			$validate = $this->db->mysqlSelect("categoryId",
									$this->config['tbl_prefix']."category",
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
	} // END OF validateAddCategory()
	
	
	function getCategoryDetails($id='',$order="",$where1=""){
		if($where1!=""){
			$where = $where1;
		}
		if($id!=''){
			$where =" categoryId in (".$id.")";

		}
		
		$catdetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."category",
											$where,$order
										);
		return $catdetail;
	} // END OF getCategoryDetails()
	
	
	
	
		
	
	function manageAnnouncement($form,$order="",$where=""){
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
				$where =" announcementId = '".$this->attributes['announcementId']."'";
				
				if($this->db->mysqldelete($this->config['tbl_prefix']."announcement",$where)){
					$this->data['message'] = $this->errorObj->errorMessage(65);
				}
			}
			if($this->attributes['token']=="deleteall"){
				$announcementId = implode(",",$this->attributes['announcementIds']);
				$where = "announcementId in (".$announcementId.")";
	
    			if($this->db->mysqldelete($this->config['tbl_prefix']."announcement","announcementId in (".$announcementId.")")){
					$this->data['message'] = $this->errorObj->errorMessage(66);
				}
			}
			
		}
		
		
		//$where = "";
		if(isset($this->attributes['sleSortField']) && $this->attributes['sleSortField']!=''){
			$order = $this->attributes['sleSortField']." ".$this->attributes['sleSortOrder'];
		}
		if($order!=""){
			$orderby = $order;
		}else{
			$orderby = "announcementId desc ";
		}
		$table = $this->config['tbl_prefix']."announcement";
		$this->manageList($form,$table,$where,$orderby);
		
		return $this->data;
		
	} // END OF manageAnnouncement()
    
    /**
	 * addEditAnnouncement()	: Add Edit Announcement Details
	 * 
	 * @param $error	: Error object
	 * @return 			: Error Or Success Message
	 */
	
	function addEditAnnouncement(){
		
		if((isset($this->attributes['addannouncement']) && $this->attributes['addannouncement']!='') || (isset($this->attributes['editannouncement']) && $this->attributes['editannouncement']!='')) {
			if($this->validateAnnouncement()){
				$announcementHeading = $this->sqlInjection($this->attributes['txtAnnouncementHeading']);
				$announcementText 	 = $this->sqlInjection($this->attributes['txtAnnouncementText']);
				$announcementFor 	 = $this->sqlInjection($this->attributes['sleAnnouncementFor']);
							
				$field   = array();
				$value   = array();
				
				$field[] = 'announcementHeading';
				$value[] = $announcementHeading;
				
				$field[] = 'announcementText';
				$value[] = $announcementText;
                
				$field[] = 'announcementFor';
				$value[] = $announcementFor;
                
                $field[] = 'announcementDate';
				$value[] = date('Y-m-d');
				
				if($this->attributes['act']=='editannouncement'){
				
					$whereupdate =" announcementId = '".$this->attributes['announcementId']."'"; 
					
					if($this->db->mysqlUpdate($this->config['tbl_prefix']."announcement",$field,$value,$whereupdate)){
						
						$announcementDetails = $this->getAnnouncementDetails($whereupdate);
		
						$this->attributes['txtAnnouncementHeading'] = $announcementDetails[0]["announcementHeading"];
						$this->attributes['txtAnnouncementText'] 	= $announcementDetails[0]["announcementText"];
						$this->attributes['sleAnnouncementFor'] 	= $announcementDetails[0]["announcementFor"];
												
						$this->error[] = "68";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error; 
						return $this->data;
					}
				} else {
				
					if($this->db->mysqlInsert($this->config['tbl_prefix']."announcement",$field,$value)){
						
						$this->attributes['txtAnnouncementHeading']	= "";
						$this->attributes['txtAnnouncementText']	= "";
						$this->attributes['sleAnnouncementFor'] 	= "";
						$this->attributes['limitstart']				= "0";
						
						
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
			if(isset($this->attributes['announcementId']) && $this->attributes['announcementId']!='') {
				$where =" announcementId = '".$this->attributes['announcementId']."'";
				$announcementDetails = $this->getAnnouncementDetails($where);

				$this->attributes['txtAnnouncementHeading'] = $announcementDetails[0]["announcementHeading"];
				$this->attributes['txtAnnouncementText'] 	= $announcementDetails[0]["announcementText"];
				$this->attributes['sleAnnouncementFor'] 	= $announcementDetails[0]["announcementFor"];
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}else{
				$this->attributes['txtAnnouncementHeading'] = "";
				$this->attributes['txtAnnouncementText'] 	= "";
				$this->attributes['sleAnnouncementFor'] 	= "";
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}
		}
	} // END OF addEditAnnouncement()
	
	function validateAnnouncement(){
		if($this->attributes['txtAnnouncementHeading']==''){
			$this->error[] = $this->errorObj->errorMessage(69);
		} 
		if($this->attributes['txtAnnouncementText']==''){
			$this->error[] = $this->errorObj->errorMessage(70);
		}
		if($this->attributes['sleAnnouncementFor']==''){
			$this->error[] = $this->errorObj->errorMessage(71);
		}
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}

	} // END OF validateAnnouncement()
	
	function getAnnouncementDetails($where=''){
		$announcementDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."announcement",
											$where
										);
		return $announcementDetail;
	} //END OF getAnnouncementDetails()
		
	
    /**
	 * addEditTimetable()	: Add Edit Timetable Details
	 * 
	 * @param $error	: Error object
	 * @return 			: Error Or Success Message
	 */
	


	
} // END OF CLASS
?>