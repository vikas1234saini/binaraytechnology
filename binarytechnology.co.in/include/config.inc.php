<?php
	ob_start();
	
	########################################################
	##          	Initializing session.                 ## 
	########################################################

	session_start(); 
	
	$ss = session_id();
	
	error_reporting(E_ALL & ~E_NOTICE | E_STRICT);
	
	date_default_timezone_set("Asia/Calcutta");
	
	//set_time_limit(0);
	
	########################################################
	##    Assign Post,Get and File varibale To An Array   ## 
	########################################################
	
	if(!isset($attributes) || !is_array($attributes)){
 		$attributes = array();
   		$attributes = array_merge($_GET, $_POST, $_FILES);
	}
	
	#######################################################
	##        Assign Common Varibales To An Array        ##    
	#######################################################
	
	if(!isset($config) || !is_array($config)){
 		$config = array();
	}
	
	$pathab = explode("include",dirname(__FILE__));
	
	$config['siteurl']			= "http://".$_SERVER['HTTP_HOST']."/";	// Set Varibale For Site Url
	//$config['siteurl']			= "http://".$_SERVER['HTTP_HOST']."/";	// Set Varibale For Site Url
	$config['sitepath'] 		= $pathab[0]."/";	// Set Varibale For Site Path
	$config['tbl_prefix']		= "tbl_";	// Set Varibale For Database Table Prefix
	$config['item_per_page']	= 20;	// Set Varibale For Page Limit For Paging
	$config['MAX_FILE_SIZE']	= 50000;	// Set Varibale For Page Limit For Paging
	
	$config['admin_email']		= "";	// Set Varibale For Admin Email
	$config['info_email']		= "";	// Set Varibale For Information Email
	$config['support_email'] 	= "";	// Set Varibale For Support Email
	$config['paypal_email']		= "";	// Set Varibale For Paypal Email
	$config['for']				= "phpzone.co.in";	// Set Varibale For Paypal Email
	
	
	#######################################################
	##           Assign Database Details                 ##    
	#######################################################
	
	$config['dbHost']		= "localhost";
	
	$config['dbUser']		= "infocity_mango";
	$config['dbPassword']	= "mango";
	$config['dbName']		= "infocity_mangocitizens";

?>