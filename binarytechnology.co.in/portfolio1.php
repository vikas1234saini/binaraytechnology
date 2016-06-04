<?php
	include ("include/config.inc.php");
	$urlwriting = 1;
	include ("classes/main.php");
	
	$mainObj 		= new mainClass($attributes,$config);
	$allpages 	 	= $mainObj->getPages();
	$allservices 	= $mainObj->getServices();
	$allhire 		= $mainObj->getHire();
	$data 			= $mainObj->addEditContactUs();

	$allportfolio 	= $mainObj->getPortfolio();
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
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/basic.js"></script>
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/filterable.pack.js"></script>
</head>
<body>
<div id="headermain">
	<div id="header">
    	<div id="logo">
        	<a href="<?php echo $config['siteurl']; ?>"><img src="<?php echo $config['siteurl']; ?>images/php-zone.jpg" border="0" /></a>
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
<div class="wrapper" id="contentWrapper" style="overflow:hidden; padding: 20px 0;">
	<div class="boundingBox" id="content">
    	<ul id="portfolio-filter">
			<li><a href="#all" title="">Our Works</a></li>
            <li><a href="#programming" title="" rel="university">Programming</a></li>
			<li><a href="#design" title="" rel="design">Design</a></li>
			<li><a href="#school" title="" rel="university">School/College</a></li>
            <li><a href="#wordpress" title="" rel="university">Wordpress</a></li>
		</ul>
        <ul id="portfolio-list" style="padding-left:40px;">
			
            <li style="display: block;" class="programming design">
				<a href="http://phpzon.net/sweepstake/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/sweepstack.png" alt=""></a>
				<p>
					Win Online Prizes
				</p>
			</li>
            <li style="display: block;" class="programming design wordpress">
				<a href="http://nsevision.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/nsevision.png" alt=""></a>
				<p>
					NSE Vision
				</p>
			</li>
            <li style="display: block;" class="design wordpress">
				<a href="http://phpzon.net/test/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/dpress.png" alt=""></a>
				<p>
					Wordpress Directory Press
				</p>
			</li>
			<li style="display: block;" class="programming design">
				<a href="http://www.infogurukul.com/" target="_blank" title=""><img src="<?php echo $config['siteurl']; ?>images/portfolio/infogurukul.png" alt=""></a>
				<p>
					Info Gurukul
				</p>
			</li>
            
			<li style="display: block;" class="programming design">
				<a href="http://hpmunique.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/hpm.png" alt=""></a>
				<p>
					HPM(INDIA) Unique Property Analysis Private limited
				</p>
			</li>
			<li style="display: block;" class="programming design">
				<a href="http://phpzon.net/super-fruit-health/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/sfh.png" alt=""></a>
				<p>
					Super Fruit Health
				</p>
			</li>
            <li style="display: block;" class="programming design">
				<a href="http://betibachao.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/betibachao.png" alt=""></a>
				<p>
					Beti Bachao
				</p>
			</li>
            <li style="display: block;" class="programming design">
				<a href="http://www.myindiandoctor.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/mid.png" alt=""></a>
				<p>
					My Indian Doctor
				</p>
			</li>
			
            <li style="display: block;" class="programming design school">
				<a href="http://dpsrohtak.org/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/dpsrtk.png" alt=""></a>
				<p>
					Delhi Public School Rohtak
				</p>
			</li>
            <li style="display: block;" class="programming design school">
				<a href="http://vpsrohtak.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/vps.png" alt=""></a>
				<p>
					Vaish Public School Rohtak
				</p>
			</li>
          
            <li style="display: block;" class="programming design school">
				<a href="http://lkpolytechnicinstitute.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/lkp.png" alt=""></a>
				<p>
					Loard Krishana College, Rohtak
				</p>
			</li>
          
            <li style="display: block;" class="programming design wordpress">
				<a href="http://www.aggarwalsurgicals.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/aggarwal.png" alt=""></a>
				<p>
					Aggarwal Surgiculs
				</p>
			</li>
            <li style="display: block;" class="programming">
				<a href="http://www.priyaklay.com/priyaklay/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/priyaklay.png" alt=""></a>
				<p>
					Priya Klay
				</p>
			</li>
              <li style="display: block;" class="programming design school">
				<a href="http://vpswing2.com/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/vpswing2.png" alt=""></a>
				<p>
					Vaish Public School, Wing 2 Rohtak
				</p>
			</li>
            <li style="display: block;" class="programming design">
				<a href="http://shivshakticonstructionco.org/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/shiv_shakti.png" alt=""></a>
				<p>
					Shiv Shakti Construction
				</p>
			</li>
            <li style="display: block;" class="programming school">
				<a href="http://spiet.org/" title="" target="_blank"><img src="<?php echo $config['siteurl']; ?>images/portfolio/satpriya.png" alt=""></a>
				<p>
					Satpriya Institute Of Engg.
				</p>
			</li>
            <li style="overflow: hidden; clear: both; height: 0px; position: relative; float: none; display: block;"></li>
        </ul>
        </div>
   </div>

 <?php 
include ("include/footer.php"); 
?>