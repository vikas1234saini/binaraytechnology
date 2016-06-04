<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin-Panel</title>


<link href="<?php echo $config['siteurl']; ?>admin/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/validation.js"></script>
<!-- START  new menu -->
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/menu_js/accordion/jquery-1.2.2.pack.js"></script>
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/calendar.js"></script>
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/menu_js/accordion/ddaccordion.js">

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
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: "fast", "normal", or "slow"
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
width: 200px; /*width of accordion menu*/
}

.arrowlistmenu .menuheader{ /*CSS class for menu headers in general (expanding or not!)*/
font: bold 11px Arial;
color: white;
background: url(images/titlebar.png) repeat-x center left;
margin-bottom: 10px; /*bottom spacing between header and rest of content*/
text-transform: uppercase;
padding: 4px 0 4px 8px; /*header text is indented 10px*/
cursor: pointer;
}

.arrowlistmenu .openheader{ /*CSS class to apply to expandable header when it's expanded*/
background-image: url(images/listtop.gif);
color:#CCC;
}

.arrowlistmenu ul{ /*CSS for UL of each sub menu*/
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 8px; /*bottom spacing between each UL and rest of content*/
}

.arrowlistmenu ul li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}

.arrowlistmenu ul li a{
color: #A70303;
background: url(images/arrowbullet.png) no-repeat center left; /*custom bullet list image*/
display: block;
padding: 2px 0;
padding-left: 10px; /*link text is indented 19px*/
text-decoration: none;
font-weight: bold;
border-bottom: 1px solid #dadada;
font-size: 90%;
}

.arrowlistmenu ul li a:visited{
color: #A70303;
}

.arrowlistmenu ul li a:hover{ /*hover state CSS*/
color: #A70303;
background-color: #028cdb; 
}

</style>


<!-- END  new menu -->
</head>
<body id="change">
<center><table width="98%" border="0" cellpadding="0" cellspacing="0" id="inner"  background="images/logo.gif" style="background-repeat:no-repeat; background-color:#FFF;">
    <tr>
      <td align="left" valign="top" height="98px">&nbsp;</td>
      <td width="220" align="right">
	  <!-- top nav starts-->
        <div class="topnav-main">
          <div class="middle-bkg">
            <div id="topnav">
              <ul>
                <li class="left-round"><a href="index.php?act=changepassword"><div>Change Password</div></a></li>
                <li><div>&nbsp;</div></li>
                <li><a href="<?php echo $config['siteurl']; ?>admin/logout.php"><div>Logout</div></a></li>
              </ul>
            </div>
          </div>
          <div class="f-left bkg-right">&nbsp;</div>
        </div>
        </div>
        </div>
        <!-- top nav ends here-->
	  </td>
    </tr>
  </table>