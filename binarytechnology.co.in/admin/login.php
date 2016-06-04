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
	#Create Object OF Main Class
	$adminFunction = new controler($attributes,$config);
	
	//$adminFunction->checkSession();
	if(isset($_SESSION['admin_name'])){
		header("Location: index.php?act=welcome");
	}
	if(isset($attributes['login']) && $attributes['login'] !=''){
		
		$error = $adminFunction->login();
		if($error){
			$flag=1;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin-Panel</title>
<!--<link href="<?php echo $config['siteurl']; ?>admin/style/style.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="<?php echo $config['siteurl']; ?>js/validation.js" language="javascript"></script>

</head>
<body style="background:#F1F2F5;">

<form action="" method="post" name="login" onsubmit="return validate_form(this);">
<table style="width:98%; text-align:center;">
	<tr>
    	<td>
        	<img src="images/logo.gif" />
        </td>
    </tr>
	<tr>
    	<td height="350px" valign="middle" align="center">
        	<table cellspacing="0" cellpadding="0" style="border:thin solid #036; background:#FFF;">
            	<tr>
	        		<td colspan="2" align="left" style="color:#CCC; font-weight:bolder; background:url(images/titlebar-active.gif) repeat-x; height:40px; padding-left:10px;">Admin Login Panel</td>
            	</tr>
            	<tr>
                	<td height="175px;"> 
                    	<table cellpadding="0" cellspacing="4" style="color:#004F75;" >
                        	<tr>
                                <td colspan="2" align="center">
                                    <span class="red">
                                    <?php 
										if($flag==1){
											for($i=0;$i<sizeof($error);$i++){
												echo "<br />".$error[$i];
											}
										}
                                    ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
    	                        <td width="120" align="left" style="padding-left:10px;"><strong>User Name:</strong></td>
        	                    <td align="left" width="280px" style="padding-left:10px;"><input name="admin_name" type="text"  class="border" title="Fill::Please enter user name." /></td>
                            </tr>
                            <tr>
            	                <td align="left" style="padding-left:10px;"><strong>Password:</strong></td>
                	            <td align="left" style="padding-left:10px;"><input name="admin_password" type="password" class="border" title="FillPassword::Please enter password." /></td>
                            </tr>
                            <tr>
                    	        <td colspan="2" align="center"><input type="image" name="Submit" src="images/login.gif" value="Submit" style="margin-right:10px;"/> </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<input type="hidden" name="login" id="login" value="Login" />
</form>
</center>
</body>
</html>