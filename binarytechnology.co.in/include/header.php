<?php
	include ("include/config.inc.php");
	$urlwriting = 1;
	include ("classes/main.php");
	
	$mainObj 		= new mainClass($attributes,$config);
	$allpages 	 	= $mainObj->getPages();
	$allservices 	= $mainObj->getServices();
	$allhire 		= $mainObj->getHire();
	$data 			= $mainObj->addEditContactUs();
	//print_r($allservices);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php $mainObj->getTitle('Title'); ?></title>
<meta content="<?php $mainObj->getTitle('Description'); ?>" http-equiv="description" name="description" />
<meta content="<?php $mainObj->getTitle('keyword'); ?>" http-equiv="keywords" name="keywords" />
<link rel="stylesheet" type="text/css" href="<?php echo $config['siteurl']; ?>css/main.css" /> 
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/jquery.min.js"></script>
<script type='text/javascript' src='<?php echo $config['siteurl']; ?>js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='<?php echo $config['siteurl']; ?>js/contact.js'></script>
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/ddaccordion.js"></script>
<script src="<?php echo $config['siteurl']; ?>flash-js/reelslideshow.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/basic.js"></script>
</head>

<body>
<div id="rightcontact">
   <a href="#" onclick="window.open ('http://www.google.com/talk/service/badge/Start?tk=z01q6amlqfu9jqqk83bg4h55dtftubb72kea5f4lb27h6rb4rvvtj5sq2a4tad7lerclkul3sgvs1j7d8cgfd0atbuf64rbe6phd20b5tgfr69j9u9b22aov8929v84l699bq2f1l9pfndjca0a61m6nvmpfu4a9gdo2btj8p7l4di8n1gjbauhtnbm70mpbrv4', 'mywindow','location=0,status=1,scrollbars=0, width=300,height=500'); return false;" > <div style="position:absolute; padding-left:24px; padding-top:140px;">
        <img height="9" width="9" style="padding:0 2px 0 0;margin:0;border:none" src="http://www.google.com/talk/service/badge/Start?tk=z01q6amlqfu9jqqk83bg4h55dtftubb72kea5f4lb27h6rb4rvvtj5sq2a4tad7lerclkul3sgvs1j7d8cgfd0atbuf64rbe6phd20b5tgfr69j9u9b22aov8929v84l699bq2f1l9pfndjca0a61m6nvmpfu4a9gdo2btj8p7l4di8n1gjbauhtnbm70mpbrv4&amp;w=9&amp;h=9" alt="" border="0">
     </div></a>
    <a href="#" onclick="window.open ('http://www.google.com/talk/service/badge/Start?tk=z01q6amlqfu9jqqk83bg4h55dtftubb72kea5f4lb27h6rb4rvvtj5sq2a4tad7lerclkul3sgvs1j7d8cgfd0atbuf64rbe6phd20b5tgfr69j9u9b22aov8929v84l699bq2f1l9pfndjca0a61m6nvmpfu4a9gdo2btj8p7l4di8n1gjbauhtnbm70mpbrv4', 'mywindow','location=0,status=1,scrollbars=0, width=300,height=500'); return false;" >
        <img src="<?php echo $config['siteurl']; ?>images/livechat.png" border="0" />
    </a>
                
</div>
<div id="headermain">
	<div id="header">
    	<div id="logo">
        	<a href="<?php echo $config['siteurl']; ?>" style=""><!--<img src="<?php echo $config['siteurl']; ?>images/php-zone.jpg" border="0" />-->Binary Technology</a>
        </div><!--end logo -->
        <div id="follow">
        	<a style="float:left; padding-right:10px;" href="http://www.facebook.com/home.php?sk=group_149825311756303&ap=1"><img src="<?php echo $config['siteurl']; ?>images/facebook.jpg" border="0" /></a>
            <a href="http://twitter.com/#!/PHP_zone"><img src="<?php echo $config['siteurl']; ?>images/twitter.jpg" border="0" /></a>
        </div><!--end follow -->
        <div id="nav">
        
        <ul>
        <?php if($urlwriting==0){ ?>
            <li> <a href="<?php echo $config['siteurl']; ?>">Home </a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>aboutus.php">Who we are?</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>services.php">What we do?</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>portfolio.php">Showcase</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>hire.php">Hire</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>contact.php">Say Hi !</a></li>
	    <?php } else { ?>
            <li> <a href="<?php echo $config['siteurl']; ?>">Home </a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>aboutus/">Who we are?</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>services/">What we do?</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>portfolio/">Showcase</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>hire/">Hire</a></li>
            <li> <a href="<?php echo $config['siteurl']; ?>contact/">Say Hi !</a></li>
        <?php } ?>
        </ul>
        </div><!--end nav -->
      </div><!--end header -->
       <div id="headerbase">
        </div><!--end headerbase -->
        
</div><!--end headermain -->