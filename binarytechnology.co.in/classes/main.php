<?php
include($config['sitepath']."classes/pageNavigation.php");
include($config['sitepath']."classes/fileUploading.php");
include($config['sitepath']."classes/querymaker.class.php");
include($config['sitepath']."classes/error.php");
include($config['sitepath']."classes/classValidField.php");
/*
 *   Class for admin.
 */
class mainClass {
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
	
    /**
     * sqlInjection() 	: Prevent sql query varibale
     *
     * @param $var		: Varibale
     * @return			: Sql Injected Varibale
     */
    
    function sqlInjection($var) {
        $var = mysql_escape_string($var);
        return $var;
    } // END OF sqlInjection()
	
	/**
	 * outputData()	: get data form table
	 * 
	 * @param $str	: Sql Injected Varibale
	 * @return 		: Original Variable
	 */
	
	function outputData($str){
		$outputData = stripslashes(trim($str));
		//$outputData = stripslashes(html_entity_decode($str));
		return $outputData;
	} // END OF outputData()
	
	/**
	 * checkSession()	: To Check The Login Session
	 */
		
	function checkSession(){
		if(!isset($_SESSION['studentName'])){
			header("Location: index.php");
		}else if($_SESSION['studentName']==''){
			header("Location: index.php");
		}
	} // END OF checkSession()
	
	/**
	 * selectOption()		: To Get Options For An Select Control
	 * 
	 * @param $table		: Name Of The Table For Which Option Created
	 * @param $optionField	: Option Display Field Name
	 * @param $valueField	: Option Value Field Name
	 * @param $selected		: Optional Parameter To Show the Selected Field
	 * @return 				: Options For Select Control
	 */
	
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
	
	/**
	 * uploadFile()	````: To Upload File
	 * 
     * @param $path		: Image Path Where To Store It
	 * @return 			: Image Name Or Error Message
	 */
	
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

	/**
	 * login() : login for admin
     * @return 
     */
	 

	
    function getPages($pageId = "") {
        if ($pageId != "") {
            $where = " pageId = '".$pageId."'";
        }
        $orderby = " pageId asc";
        
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_page', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	function getHire($categoryParent = "") {
        if ($categoryParent!= "") {
            $where = " categoryParent = '".$categoryParent."' and categoryStatus='1'";
        }
		else
			{
			$where = " categoryParent = '0'"." and categoryStatus='1'";	
			}
        $orderby = " categoryId asc";
        
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_hire', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	
	
	
	function getHireById($categoryId = "") 
	{
        if ($categoryId!= "") 
			{
				$where = " categoryId = '".$categoryId."' and categoryStatus='1'";
			}
		else
			{
				$where = " categoryId = '0'"." and categoryStatus='1'";;	
			}
        $orderby = " categoryId asc";
        
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_hire', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	
	function getServices($categoryParent = "") {
        if ($categoryParent!= "") {
            $where = " categoryParent = '".$categoryParent."' and categoryStatus='1'";
        }
		else
			{
			$where = " categoryParent = '0'"." and categoryStatus='1'";	
			}
        $orderby = " categoryId asc";
        
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_services', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	function getServicesById($categoryId = "") 
	{
        if ($categoryId!= "") 
			{
				$where = " categoryId = '".$categoryId."' and categoryStatus='1'";
			}
		else
			{
				$where = " categoryId = '0'"." and categoryStatus='1'";;	
			}
        $orderby = " categoryId asc";
        
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_services', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	
	function getPortfolio() {
        
        $where = "";
        $orderby = " portfolioId asc";
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_portfolio', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	function getTestimonial($testimonialId = "") {
        
        $where = "";
		if($testimonialId != "") 
			{
			$where = "testimonialId = ".$testimonialId;
			}
        $orderby = " testimonialId asc";
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_testimonial', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	function getNews($newsId = "") {
        
        $where = "";
		if($newsId != "") 
			{
			$where = "newsId = ".$testimonialId;
			}
        $orderby = " newsId asc";
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_news', $where, $orderby, "", "", "");
        return $fetch_data;
    }
	
	function getTitle($field)	{
		//echo $field;
		if(!isset($this->attributes['service']) && !isset($this->attributes['hire'])){
			
			$fileName 	= str_replace("/","",$_SERVER["REQUEST_URI"]);
			$parentId 	= "";
			$categoryId = "";
			$table 		= "";
			$parentable	= "";
			$parenfield = "";
			//echo $fileName;
			if($fileName=='index.php' || $fileName==''){
				$categoryId = "4";
				$table = "tbl_page";
			} else if($fileName=='aboutus') {
				$categoryId = "7";
				$table = "tbl_page";
			} else if($fileName=='services') {
				$categoryId = "5";
				$parentId 	= "0";
				$parentable = "tbl_services";
				$parenfield = "category".$field;
				$table 		= "tbl_page";
				
			} else if($fileName=='portfolio') {
				$categoryId = "6";
				$table = "tbl_page";
			} else if($fileName=='hire') {
				$categoryId = "8";
				$parentId 	= "0";
				$parentable = "tbl_hire";
				$table 		= "tbl_page";
				$parenfield = "category".$field;
			} else if($fileName=='contact') {
				$categoryId = "9";
				$table = "tbl_page";
			}
		} else {
			if(isset($this->attributes['service'])){
				
				$categoryId = $this->attributes['service'];
				$table 		= "tbl_services";
				$parentId 	= $this->attributes['service'];
				$parentable = "tbl_services";
			}
			if(isset($this->attributes['hire'])){
				$categoryId = $this->attributes['hire'];
				$table 		= "tbl_hire";
				$parentId 	= $this->attributes['hire'];
				$parentable = "tbl_hire";
			}
		}
		$where 		= "";
		$orderby 	= "";
		$fieldName	= "";
		if($categoryId!=""){
			if($table == "tbl_page") {
				$where 		= "pageId='".$categoryId."'";
				$fieldName	= "page".$field;
			}else{
				$where 		= "categoryId='".$categoryId."'";
				$fieldName 	= "category".$field;
			}
		}
    	$fetch_data = $this->db->mysqlSelect($fieldName, $table, $where, $orderby);
		$fetch_data1 = array();
		if($parentId!="" && $parentable!=""){
			$fetch_data1 = $this->db->mysqlSelect($parenfield, $parentable, "categoryParent='".$parentId."'", $orderby);
		}
		//print_r($fetch_data);
        echo $this->outputData($fetch_data[0][$fieldName]);
		for($i=0;$i<sizeof($fetch_data1);$i++){
			echo " | ".$fetch_data1[$i][$parenfield];
		}
    }
	

	
	function getAnnouncement($where=""){
		$orderby = " announcementId desc";
        
        $fetch_data = $this->db->mysqlSelect("*", 'tbl_announcement', $where, $orderby, "", "", "");
        return $fetch_data;
	}
	
	
		function addEditContactUs(){
		if(isset($this->attributes['addcontact']) && $this->attributes['addcontact']!='') {
			if($this->validateContactUs()){
				
				$contactEmail		= $this->sqlInjection($this->attributes['txtEmail']);
                $contactSubject		= $this->sqlInjection($this->attributes['txtSubject']);
				$contactYourName	= $this->sqlInjection($this->attributes['txtYourName']);
				$contactPhone		= $this->sqlInjection($this->attributes['txtPhone']);
                $contactMessage		= $this->sqlInjection($this->attributes['txtMessge']);
				
				
				$field   = array();
				$value   = array();
				
				if(isset($this->attributes['contactFor']))
					{
						$contactFor = $this->sqlInjection($this->attributes['contactFor']);
						$field[] = 'contactFor';
						$value[] = $contactFor;
					}
				
				$field[] = 'contactEmail';
				$value[] = $contactEmail;
				
				$field[] = 'contactSubject';
				$value[] = $contactSubject;
				
				$field[] = 'contactYourName';
				$value[] = $contactYourName;
				
				$field[] = 'contactPhone';
				$value[] = $contactPhone;
				
				$field[] = 'contactMessage';
				$value[] = $contactMessage;
				
				$field[] = 'contactDate';
				$value[] = date('Y-m-d h:i:s');
				
                
				if($this->db->mysqlInsert($this->config['tbl_prefix']."contact",$field,$value)){					
					$this->attributes['txtEmail']	= "";
					$this->attributes['txtSubject']	= "";
					$this->attributes['txtYourName']= "";
					$this->attributes['txtMessge']	= "";
					$this->attributes['txtPhone']	= "";
					
					$this->data['attributes'] 	= $this->attributes;
					
					$this->data['msg'] 	= "Message has been submitted successfully."; 
					return $this->data;
				}
			
			} else {
				$this->data['attributes'] = $this->attributes;
				$this->data['error'] = $this->error; 
				return $this->data;
			}
		}
	} // END OF addEditContactUs()
	
	/**
	 * validateContactUs() : Validate ContactUs Fields
	 * 
	 * @return					: Validation Result 			
	 */
	
	function validateContactUs(){
		
		if($this->attributes['txtYourName']==''){
			$this->error[] = "Please enter your name.";
		}
		if($this->attributes['txtEmail']==''){
			$this->error[] = "Please enter email.";
		}
		if($this->attributes['txtSubject']==''){
			$this->error[] = "Please enter subject.";
		}

		if($this->error[0]==''){
			return true;
		} else {
			return false;
		}
	} // END OF validateContactUs()
	
	
	function getImageDetails($where=''){

		$imageDetail = $this->db->mysqlSelect("*",

											$this->config['tbl_prefix']."image",

											$where

										);

		return $imageDetail;

	} //END OF getImageDetails()
	
	function getEmailDetails($where=''){
		$emailDetail = $this->db->mysqlSelect("*",
											$this->config['tbl_prefix']."email",
											$where
										);
		return $emailDetail;
	} //END OF getEmailDetails()
	
} // END OF CLASS
?>