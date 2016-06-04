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
<link rel="stylesheet" type="text/css" href="css/main.css" /> 
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/contact.js'></script>
<script type="text/javascript" src="js/basic.js"></script>
<script type="text/javascript" src="js/ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>


<script type="text/javascript">


ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})


</script>

<style type="text/css">

.arrowlistmenu{
width: 228px; /*width of accordion menu*/
}

.arrowlistmenu .menuheader{ /*CSS class for menu headers in general (expanding or not!)*/
font: bold 14px Arial;
color: white;
background:url(images/titlebar.jpg) repeat-x center left;
margin-bottom: 0px; /*bottom spacing between header and rest of content*/
text-transform: uppercase;
padding: 0px 0 0 10px; /*header text is indented 10px*/
cursor: hand;
height:28px;
line-height:28px;
cursor: pointer;
}



.arrowlistmenu .openheader{ /*CSS class to apply to expandable header when it's expanded*/
background-image:url(images/titlebar-active.jpg);
}

.arrowlistmenu ul{ /*CSS for UL of each sub menu*/
list-style-type: none;
margin: 0;
padding: 0;

border-bottom:2px #dcdcdc solid;
border-left:2px #dcdcdc solid;
border-right:2px #dcdcdc solid;
margin-bottom: 0px; /*bottom spacing between each UL and rest of content*/
}

.arrowlistmenu ul li{
padding-bottom: 12px; /*bottom spacing between menu items*/
}

.arrowlistmenu ul li a{
color: #000;
background: url(arrowbullet.png) no-repeat center left; /*custom bullet list image*/
display: block;
padding-left: 19px; /*link text is indented 19px*/
text-decoration: none;
font-weight: bold;
font-size: 90%;
}

.arrowlistmenu ul li a:visited{
color: #000;
}

.arrowlistmenu ul li a:hover{ /*hover state CSS*/
color:#000;
background-color: #F3F3F3;
}

</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<style type="text/css">

#myreel{ /*sample CSS for demo*/

}

.paginate{
width: 330px;
margin-top:5px;
font:bold 14px Arial;
text-align:center;
}

</style>

<script src="flash-js/reelslideshow.js" type="text/javascript">

/***********************************************
* Continuous Reel Slideshow- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

</script>

<script type="text/javascript">

var firstreel=new reelslideshow({
	wrapperid: "myreel", //ID of blank DIV on page to house Slideshow
	dimensions: [960, 250], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		
		["images/flash-images/Web-development.png"],
		["images/flash-images/iphone.png"], //["image_path", "optional_link", "optional_target"]
		["images/flash-images/SEO.png"],
		["images/flash-images/Psd-Conversion.png"],
		["images/flash-images/Open-Source.png"],
		["images/flash-images/hire-web-developer.png"],
		["images/flash-images/E-commerce.png"],
		["images/flash-images/Android-Application.png"]//<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:3000, cycles:10, pauseonmouseover:false},
	orientation: "h", //Valid values: "h" or "v"
	persist: true, //remember last viewed slide and recall within same session?
	slideduration: 300 //transition duration (milliseconds)
})

</script>
</head>

<body>
<div id="headermain">
	<div id="header">
    	<div id="logo">
        	<a href="<?php echo $config['siteurl']; ?>"><img src="images/logo.jpg" border="0" /></a>
        </div><!--end logo -->
        <div id="follow">
        	<a style="float:left; padding-right:10px;" href="http://www.facebook.com/home.php?sk=group_149825311756303&ap=1"><img src="images/facebook.jpg" border="0" /></a>
            <a href="http://twitter.com/#!/PHP_zone"><img src="images/twitter.jpg" border="0" /></a>
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