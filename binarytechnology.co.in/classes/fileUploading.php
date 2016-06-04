<?php 
#include the common class for the common functions
//require_once("../includes/common.inc.php");
class FileUploading{
	var $uploaddir;			  // directory name where image to uploaded
	var $uploadfile;		  // file name of the new image
	var $strMessage;		  // message on uploading
	var $strOperationFor;     // store the information of clicking button
	var $strErrorMessage;     // display the error message
	var $arrFillData;          // retrive the filled post data variable
	var $strImageFolder;       // directory to upload the image
	var $strImType;				//detect type of the image
	var $strImSize;				//detect size of image
	var $strImName;				//name of the uploading file
	var $strImTemp;				//temp name of the uploading file
	var $fileExt;				//extension of the file
	var $strImageName;			//name of image store in database
	var $manageMessage;
	var $strUserFile;
	var $strRelativePath;
	var $validextensions;


	/**
		 * FileUploading()		   : Function to return the Error if any
		 * 
		 * @param					: NA
		 * 
		 * @return					: return the error message as string
		 */

	function FileUploading($strPUploadDir='',$strPFormField=''){
		$this->uploadfile				=  $this->uploaddir;
		$this->strUserFile 			= $strPFormField;
		$this->strMessage				=  "";		
		$this->strImageName			=  "";
      if($strPFormField!=''){
         $this->strImType				= $_FILES[$this->strUserFile]["type"];
         $this->strImSize				= $_FILES[$this->strUserFile]["size"];
         $this->strImName				= $_FILES[$this->strUserFile]["name"];
         $this->strImTemp				= $_FILES[$this->strUserFile]['tmp_name'];
	   }
	// get the file extension 
	if($this->strImName) {				
      $arrName=explode(".",$this->strImName);
		$strImageExt = end($arrName);	
		$this->fileExt		=  $strImageExt;					
	}		
	
//	echo $this->strImName;
//	echo $this->fileExt;
//	die;
	
	// set the name of directory where the image will upload
	if(!isset($strPUploadDir) || $strPUploadDir==""){
		 //$this->uploaddir   =  FILE_UPLOAD_PATH;
	} else {
		$this->uploaddir = $strPUploadDir;
		}
	
	//echo "file path:".$this->uploaddir;
}

// KP: 31-01-07 New fn to check validity of upload file

	function checkFileValidity($strPFileType=''){
		$arFileValidVals = array();
		if($strPFileType == "image") {
			$arFileValidVals = array("jpg","gif","jpeg","png");
		}
		
		if($strPFileType == "doc") {
			$arFileValidVals = array("doc","docx","rtf","txt","pdf","pptx","dxf");
		}
		
		if($strPFileType == "csv") {
			$arFileValidVals = array("csv","xls");
		}

		if($strPFileType == "video") {
			$arFileValidVals = array("avi","wmv", "mov", "mpg", "flv");
		}
		if($strPFileType == "pdf") {
			$arFileValidVals = array("pdf");
		}
		
		if($strPFileType == "all") {
			$arFileValidVals = array("jpg","gif","jpeg","png","doc","rtf","txt","pdf","csv","xls","ppt","pptx","dxf","docx");
		}
		
		
		if($this->fileExt)	{
			if(!in_array(strtolower($this->fileExt),$arFileValidVals)){
				if($strPFileType == "image") {
				   $this->strErrorMessage = " Please upload the valid file of jpg, gif, png Extension";
				}
				
				if($strPFileType == "doc") {
				   $this->strErrorMessage = " Please upload the valid file of doc,rtf,txt, doc Extension";
				}
				
				if($strPFileType == "csv") {
				   $this->strErrorMessage = "Please upload the valid file of csv,xls Extension";
				}
	
				if($strPFileType == "video") {
				   $this->strErrorMessage = "Please upload the valid file of avi,wmv,mov,mpg,flv Extension";
				}
				if($strPFileType == "pdf") {
				   $this->strErrorMessage = "Please upload the valid file of pdf Extension";
				}
				if($strPFileType == "all") {
				   $this->strErrorMessage = "Please upload the valid file of jpg, gif, jpeg, png, doc, rtf, txt, pdf, csv, xls, ppt, pptx, dxf, docx Extension";
				}
				return false;
			}
			else 
				return true;
		}else{
			return false;
		}
	}
	
	// KP: 31-01-07 New function craeted for file upload

	function fn_fileUpload($PFilename=''){ ##$arrPFileExt:: allow file exten.
      $this->setIniVariable();
//		echo "mas allow - ".FILE_MAX_SIZE_LIMIT;
//		echo "<br>this file - ".$this->strImSize;
//		die;
	//	if($this->strImSize > FILE_MAX_SIZE_LIMIT){
	//		$this->strErrorMessage = "File size is greater than allowed";
	//		return false;
	//	}
//		echo $this->strImTemp;	
		$strUploadFileName = $this->uploaddir.$PFilename.'.'.$this->fileExt;
//		echo $strUploadFileName;
		if(move_uploaded_file($this->strImTemp,$strUploadFileName)) {
			$this->strMessage = "SUCCESS_UPLOAD";				
			return true;
		}else{
			//$this->strErrorMessage = _FAILURE_UPLOAD;
			$this->strErrorMessage = "File uploading process have failed. Please Try again with small size file Less Than 100M.";
			return false;
		}
	}

	

	function fileUpload($PFilename='',$arrPFileExt){ ##$arrPFileExt:: allow file exten.
		$this->fileExt = end(explode(".",$_FILES[$this->strUserFile]['name']));
	
//		if($PFileExt !== ''){
//			if(strtoupper($this->fileExt) !== strtoupper($PFileExt)){
//				$this->strErrorMessage = "Please choose valid image file";
//				return false;
//			}
//		}
	
		if(in_array(strtolower($this->fileExt),$arrPFileExt)){ 

			if($PFilename==""){
				$imageName = uniqid("Im");//name of file request
			}else{
				$imageName = $PFilename;
			}

			$this->strImageName = $imageName.".".$this->fileExt;

			$this->uploadmaxfile = $this->uploadfile;
			$this->uploadmaxfile.= "max";
			$this->uploadmaxfile.= $this->strImageName;

			$this->uploadmidfile= $this->uploadfile;
			$this->uploadmidfile.= "mid";
			$this->uploadmidfile.= $this->strImageName;

			$this->uploadminfile= $this->uploadfile;
			$this->uploadminfile.= "min";
			$this->uploadminfile.= $this->strImageName;

			$this->strImageName = $imageName.".".$this->fileExt;

			$this->uploadfile = $this->uploadfile.$this->strImageName;

			$document_root = LIB_PATH;

			$this->strRelativePath = str_replace($document_root, substr(BASE_PATH, 0,-1), $this->uploadfile);
			$this->setIniVariable();
			print "limit :". FILE_MAX_SIZE_LIMIT;die;
			if($this->strImSize >  FILE_MAX_SIZE_LIMIT){
				$this->strErrorMessage = "File size is greater than allowed";
				return false;
			}
			$x=array($this->strImTemp,$this->uploadfile);

			/* failed to open stream: Permission denied :Error in line below */
			if (move_uploaded_file($this->strImTemp,$this->uploadfile)) {

				//			$this->image_resize($this->uploadfile,"300","200",$this->uploadmaxfile);
				//			$this->image_resize($this->uploadfile,"100","100",$this->uploadmidfile);
				//			$this->image_resize($this->uploadfile,"80","80",$this->uploadfile);
				//			$this->image_resize($this->uploadfile,"70","70",$this->uploadfile);

				$this->strMessage = SUCCESS_UPLOAD;

				//Switch the line below to work on local
				//$this->strRelativePath = "/hfb".$this->strRelativePath;
				//Switch the line below to work on Remote

				$this->strRelativePath = $this->strRelativePath;
				return true;

			}else{ 

				$this->strErrorMessage = _FAILURE_UPLOAD;
				return false;
			}
		}else{

			$this->strErrorMessage= "Please choose valid file";
			return false;
		}
	}

	function checkValidFile($strPExt){

		if($strPExt == 'csv') {
			$arrImg = array("csv");
		}else {
			$arrImg = array("jpg","png","JPEG","gif","tif");
		}
		if(in_array($strPExt,$arrImg)){ 

			return true;

		}else{ 

			$this->strErrorMessage =_IMAGE_FILEFORMAT;

			return false;

		}

	}



	/**

		 * getErrorMessage()		: Function to return the Error if any

		 * 

		 * @param					: NA

		 * 

		 * @return					: return the error message as string

		 */



	function getErrorMessage(){
		return $this->strErrorMessage;
//		$ErrorMessage=$this->strErrorMessage;
//
//		if($this->strErrorMessage == "")
//
//			return "";
//
//		else
//
//			return $ErrorMessage;

	}



	/**

		 * getSuccessMessage()		: Function to return the success

		 * 

		 * @param					: NA

		 * 

		 * @return					: return the Success message as string

		 */



	function getSuccessMessage(){

		$this->manageMessage	= new ManageMessage();

		$successMessage=$this->manageMessage->showDbMessage($this->strMessage,"70%","2");



		if($this->strMessage == "")

		return "";

		else

		return $successMessage;

	}





	/*

	@function name		:	setIniVariable()

	@Param				:	NA

	@Return				:	NA

	@Description		:	Function called at to set the ini variable



	*/



	function setIniVariable(){

		ini_set("upload_max_filesize" , "100M");

		ini_set("post_max_size" , "8M");

		ini_set("max_execution_time" , "120");

		ini_set("memory_limit" ,"128M");

		ini_set("FILE_MAX_SIZE_LIMIT" ,"8M");

		//ini_set("upload_tmp_dir", LIB_PATH."/images/new/");



	}



	/*

	@function name		:	insertImageDetail()

	@Param				:	NA

	@Return				:	NA

	@Description		:	Function called at to when the image is uploading and name of image is inserted into 						database



	*/



//	function insertImageDetail($strPImagePath='', $intPUserId=''){
//
//		global $objQueryMaker;
//
//		if($strPImagePath == ""){
//
//			$strImagePath = $this->strRelativePath;
//
//		}else{
//
//			$strImagePath = $strPImagePath;
//
//		}
//
//		if($intPUserId == ""){
//
//			$intListingId = $this->intAgentId;
//
//		}else{
//
//			$intListingId = $intPUserId;
//
//		}
//
//		$strInsertQuery = "insert into tblListingImages (fldListingId,fldImagePath) values ('".$intListingId."','".$strImagePath."')";
//
//		$objQueryMaker->mysqlRawquery($strInsertQuery);
//
//	}





//	function insertAgentImageDetail($intPUserId){
//
//		global $objQueryMaker;
//
//
//
//		$strInsertQuery = "insert into tblUserLogoAndPicture (fldUserId,fldUserImagePath) values ('".$intPUserId."','".$this->strRelativePath."')";
//
//		$objQueryMaker->mysqlRawquery($strInsertQuery);
//
//	}







	//	 function isExistFolder($intPListingAgentId){
	//
	//		$this->intListingAgentId = $intPListingAgentId;
	//
	//		if(	$this->intListingAgentId !=""){
	//
	//			if(!is_dir($this->uploaddir."/".$intPListingAgentId)){
	//
	//				if($this->createFolder($this->uploaddir."/".$intPListingAgentId)){
	//
	//					$this->uploadfile = $this->uploaddir."/".$this->intListingAgentId."/";
	//
	//					return true;
	//
	//				}else{
	//
	//					return false;
	//
	//				}
	//
	//			}else{
	//
	//				$this->uploadfile = $this->uploaddir."/".$this->intListingAgentId."/";	return true;
	//
	//			}
	//
	//		}else{
	//
	//			return false;
	//
	//		}
	//
	//	 }



//	function setUploadPath(){
//
//		//$this->uploadfile = $this->uploaddir."/".$this->intListingAgentId."/";	##if want to create member id folder
//		$this->uploadfile = $this->uploaddir."/";
//		return true;
//
//	}



	function createFolder($uploadPDir=''){

		if($uploadPDir == ""){

			$uploadDir = $this->uploadfile = $this->uploaddir."/".$this->intListingAgentId."/";

		}else{

			$uploadDir = $uploadPDir;

		}

		if(mkdir($uploadDir))

		return true;

		else

		return false;

	}



	function browseFolder($strPLibPath, $strPAgentId){

		if(!is_dir($strPLibPath."/".$strPAgentId)){

			return false;

		}else{



		}

	}



	function imageMove($intPSource, $intPDestination){



		if(!is_dir($intPDestination)){

			$this->createFolder($intPDestination);

			system("cp -R $intPSource/* $intPDestination/");

			$this->removeDir($intPSource);

			return true;

		}else{

			system("cp -R $intPSource/* $intPDestination/");

			$this->removeDir($intPSource);

			return true;

		}

	}



	function removeDir($strPSource){

		system("rm -rf $strPSource");

		return true;

	}



	function saveImageNames($intPDestination, $intPListingId){

		$document_root = LIB_PATH;

		$this->removeImageDetails($intPListingId);

		$strDestinationPath = str_replace($document_root, "", $intPDestination);

		//$strDestinationPath = "/hfb".$strDestinationPath;

		if (is_dir($intPDestination)) {

			if ($dh = opendir($intPDestination)) {

				while (($file = readdir($dh)) !== false) {

					if($file != "." && $file != ".." ){

						$strDestination = $strDestinationPath."/".$file;

						$this->insertImageDetail($strDestination, $intPListingId);

					}

				}

				closedir($dh);

			}

		}

	}

	function removeImageDetails($intPListingId, $imgListingImageId=''){

		global $objQueryMaker;

		if($listingImageId !=''){

			$strQueryToAppend = " and fldListingImageId = $imgListingImageId ";

		}else{

			$strQueryToAppend = '';

		}

		$strSql = "delete from tblListingImages where fldListingId = $intPListingId $strQueryToAppend";

		return $objQueryMaker->mysqlRawQuery($strSql);

	}

	function deleteFile($strPFilePath,$strPFileName){
		$fileToRemove = $strPFilePath.'/'.$strPFileName;
		//echo "$fileToRemove, $strPFilePath, $strPFileName";
		if (file_exists($fileToRemove)) {
		   if (@unlink($fileToRemove) === true) { 
			    $this->strErrorMessage = "File has been deleted successfully.";
			    return true;  	
		   } else { 
				$this->strErrorMessage = "File not deleted.";
				return false;
		   }
		} else { 
		   $this->strErrorMessage = "File not exists.";
		   return false;
		}
	}



	function setUploadPath(){
		//$this->uploadfile = $this->uploaddir."/".$this->intListingAgentId."/";	##if want to create member id folder
		$this->uploadfile = $this->uploaddir."/";
		return true;

	}
   function make_thumb($img_name,$filename,$new_w,$new_h,$ext)
   {
      define ("MAX_SIZE","100");
	  if($new_w == ""){
		  $new_w = 100;
	  }
	  
	  if($new_h == ""){
		  $new_h = 100;
	  }
	  
	  $ext = strtolower($ext);
      //creates the new image using the appropriate function from gd library
      if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext)){
         $src_img=imagecreatefromjpeg($img_name);
      }
      if(!strcmp("png",$ext)){
         $src_img=imagecreatefrompng($img_name);
      }
      if(!strcmp("gif",$ext)){
         $src_img=imagecreatefromgif($img_name);
      }
      //gets the dimmensions of the image
      $old_x=imageSX($src_img);
      $old_y=imageSY($src_img);

      // next we will calculate the new dimmensions for the thumbnail image
      // the next steps will be taken:
      // 1. calculate the ratio by dividing the old dimmensions with the new ones
      // 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
      // and the height will be calculated so the image ratio will not change
      // 3. otherwise we will use the height ratio for the image
      // as a result, only one of the dimmensions will be from the fixed ones
      $ratio1=$old_x/$new_w;
      $ratio2=$old_y/$new_h;
      if($ratio1>$ratio2) {
         $thumb_w=$new_w;
         $thumb_h=$old_y/$ratio1;
      }
      else {
         $thumb_h=$new_h;
         $thumb_w=$old_x/$ratio2;
      }

      // we create a new image with the new dimmensions
      $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);

      // resize the big image to the new created one
      imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

      // output the created image to the file. Now we will have the thumbnail into the file named by $filename
      if(!strcmp("png",$ext))
         imagepng($dst_img,$filename);
      if(!strcmp("gif",$ext))
         imagegif($dst_img,$filename);
      else
         imagejpeg($dst_img,$filename);

      //destroys source and destination images.
      imagedestroy($dst_img);
      imagedestroy($src_img);
   }
}

?>