<?php 
	$error= array();
	$flag=0;
	if(isset($attributes['change']) && $attributes['change'] !=''){
		
		$error = $adminFunction->changePassword();
		if($error){
			$flag=1;
		} else {
			$flag=2;
		}
	}
?>


<table width="98%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>Change Password <br>
		</th>
	</tr>
	<tr>
		<td  height="280">
<form name="frmchangepassword" method="post" action="" onsubmit="return validate_form(this);">
<table width="50%" border="0" cellspacing="0" cellpadding="0">

 
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    
	 <tr>
		  	<td colspan="2" align="center">
				
				
				<?php 
					if($flag==1){
				
						$success = explode(" ",$error[0]);
						if(in_array("successfully.",$success)){
							echo "<span class=green>";
						}else{
							echo "<span class=red>";
						}
						for($i=0;$i<sizeof($error);$i++){
							echo "<br />".$error[$i];
						}
						echo "</span>";
						} else if($flag==2){
							echo "<font color=green>";
							echo "Password has been changed successfully.";
							echo "</font>";
					}
				?>
				</span>
				
			</td>
		  </tr>
      <tr>
	 
        <td width="44%" align="left"><span class="red2">*</span>&nbsp;Old Password&nbsp;:
				</td>
        <td width="56%" align="left" valign="top"><input type="password"  title="FillOldPassword::Please enter old password." name="txtOldPassword" id="txtOldPassword" class="input" value=""/>					</td>
      </tr>
      <tr>
        <td align="left"><span class="red2">*</span>&nbsp;New Password&nbsp;:
			</td>
        <td align="left"><input type="password" name="txtNewPassword" id="txtNewPassword" title="FillNewPassword::Please enter new password." class="input" /></td>
      </tr>
     <tr>
        <td align="left"><span class="red2">*</span>&nbsp;Confirm Password&nbsp;:
			</td>
        <td align="left"><input type="password" name="txtConfirmPassword" id="txtConfirmPassword" title="FillConfirmPassword::Please enter confirm password." class="input" /></td>
      </tr>
      <tr>
        <td height="30" colspan="2" align="right"></td>
        </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">
		<input type="image" name="submit" alt="Submit" src="images/submit.gif" />
		<input type="hidden" name="change" value="Submit" />
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" colspan="2" valign="top"></td>
    </tr>
</table>

</form>
		</td>
	</tr>
</table>

