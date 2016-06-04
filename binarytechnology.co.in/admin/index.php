<?php
	#Include Configration File
	include("../include/config.inc.php");
	include($config['sitepath']."classes/pageNavigation.php");
	include($config['sitepath']."classes/fileUploading.php");
	include($config['sitepath']."classes/querymaker.class.php");
	include($config['sitepath']."classes/error.php");
	include($config['sitepath']."classes/classValidField.php");
	
	#Include Admin Class   	 
	include("classes/controler.php");
	
	#Include FCK Editor For CMS
	include ($config['sitepath']."js/fckeditor/fckeditor.php");
	
	#Create Object OF Main Class
	$adminFunction = new controler($attributes,$config);
		
	$adminFunction->checkSession();
	
	include ('include/header.php');
	include ('include/left-menu.php');
		
	if(isset($attributes['act']))
	{
		$action  = $attributes['act'];
		switch($action){
			case 'welcome':
        		include ('welcome.php');	
       			break; 
			case 'changepassword':
        		include ('change-password.php');	
       			break; 
				
			case 'manageinbox':
        		include ('manage-inbox.php');	
       			break;
			case 'viewinbox':
        		include ('view-inbox.php');	
       			break; 
			
			
			case 'managepage':
        		include ('manage-page.php');	
       			break;
			case 'addpage':
        		include ('add-page.php');	
       			break; 
			case 'editpage':
        		include ('add-page.php');	
       			break;
				
			case 'manageservices':
        		include ('manage-services.php');	
       			break;
			case 'addservices':
        		include ('add-services.php');	
       			break; 
			case 'editservices':
        		include ('add-services.php');	
       			break;
			
			case 'managesubservices':
        		include ('manage-sub-services.php');	
       			break;
			case 'addsubservices':
        		include ('add-sub-services.php');	
       			break; 
			case 'editsubservices':
        		include ('add-sub-services.php');	
       			break;
			case 'managehire':
        		include ('manage-hire.php');	
       			break;
			case 'addhire':
        		include ('add-hire.php');	
       			break; 
			case 'edithire':
        		include ('add-hire.php');	
       			break;
				
			case 'managesubhire':
        		include ('manage-sub-hire.php');	
       			break;
			case 'addsubhire':
        		include ('add-sub-hire.php');	
       			break; 
			case 'editsubhire':
        		include ('add-sub-hire.php');
				break;
				
			case 'managenews':
        		include ('manage-news.php');	
       			break;
			case 'addnews':
        		include ('add-news.php');	
       			break; 
			case 'editnews':
        		include ('add-news.php');	
       			break;
			
			case 'managetestimonial':
        		include ('manage-testimonial.php');	
       			break;
			case 'addtestimonial':
        		include ('add-testimonial.php');	
       			break; 
			case 'edittestimonial':
        		include ('add-testimonial.php');	
       			break;
				
			case 'manageportfolio':
        		include ('manage-portfolio.php');	
       			break;
			case 'addportfolio':
        		include ('add-portfolio.php');	
       			break; 
			case 'editportfolio':
        		include ('add-portfolio.php');	
       			break;
			
			
			
			
			default :
				include ('welcome.php');	
       			break;
		}
	}
	include('include/footer.php');
?>