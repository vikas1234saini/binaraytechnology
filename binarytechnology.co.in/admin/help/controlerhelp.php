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
//****************************************************    Add, Edit, Delete Route **********************************************************
function manageBtype($form,$order="",$where=""){
		if(isset($this->attributes['token'])){
			if($this->attributes['token']=="delete"){
							
				
				$where ="btypeId = '".$this->attributes['btypeId']."'";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."btype",$where)){
						$this->data['message'] = $this->errorObj->errorMessage(65);
					
				}
			}
			if($this->attributes['token']=="deleteall"){
				$btypeId = implode(",",$this->attributes['btypeIds']);
				
				$where = "btypeId in (".$btypeId.")";
				
					if($this->db->mysqldelete($this->config['tbl_prefix']."btype","btypeId in (".$btypeId.")")){
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
			$orderby = "btypeId desc ";
		}
		$table = $this->config['tbl_prefix']."btype";
		
		$this->manageList($form,$table,$where,$orderby);
		
		return $this->data;
		
	} // END OF manageBtype()
	
	function addEditBtype(){
		
		if((isset($this->attributes['addbtype']) && $this->attributes['addbtype']!='') || (isset($this->attributes['editbtype']) && $this->attributes['editbtype']!='')) {
			if($this->validateBtype()){
				
				$btypeName = $this->sqlInjection($this->attributes['txtBtypeName']);
				$btypeDesc = $this->sqlInjection($this->attributes['txtBtypeDesc']);
							
				$field   = array();
				$value   = array();
				
				$field[] = 'btypeName';
				$value[] = $btypeName;
				
				$field[] = 'btypeDesc';
				$value[] = $btypeDesc;
				
				$field[] = 'Date';
				$value[] = date('Y-m-d h:i:s');
				
				if($this->attributes['act']=='editbtype'){
				
					$whereupdate =" btypeId = '".$this->attributes['btypeId']."'"; 
					
					if($this->db->mysqlUpdate($this->config['tbl_prefix']."btype",$field,$value,$whereupdate)){
						
						$btypeDetails = $this->getBtypeDetails($whereupdate);
		
						$this->attributes['txtBtypeName'] = $btypeDetails[0]["btypeName"];
						$this->attributes['txtBtypeDesc'] = $btypeDetails[0]["btypeDesc"];
						
												
						$this->error[] = "68";
						$this->data['attributes'] = $this->attributes;
						$this->data['msg'] = $this->error; 
						return $this->data;
					}
				} else {
				
					if($this->db->mysqlInsert($this->config['tbl_prefix']."btype",$field,$value)){
						
						$this->attributes['txtBtypeName']	= "";
						$this->attributes['txtBtypeDesc']	= "";
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
			if(isset($this->attributes['btypeId']) && $this->attributes['btypeId']!='') {
				$where =" btypeId = '".$this->attributes['btypeId']."'";
				$btypeDetails = $this->getBtypeDetails($where);

				$this->attributes['txtBtypeName'] = $btypeDetails[0]["btypeName"];
				$this->attributes['txtBtypeDesc'] = $btypeDetails[0]["btypeDesc"];
				
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}else{
				$this->attributes['txtBtypeName'] 	= "";
				$this->attributes['txtBtypeDesc'] 	= "";
				
				$this->data['attributes'] = $this->attributes; 
				return $this->data;
			}
		}
	} // END OF addEditBtype()
	
	function validateBtype(){
		if($this->attributes['txtBtypeName']==''){
			$this->error[] = $this->errorObj->errorMessage(69);
		} 
		
		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}

	} // END OF validateBtype()
	
	function getBtypeDetails($where=''){
		$btypeDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."btype",
											$where
										);
		return $btypeDetail;
	} //END OF getBtypeDetails()

	

}
?>