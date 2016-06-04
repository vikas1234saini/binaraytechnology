<?php 
	$flag = 0;
	$error= array();
	$data = $adminFunction->getContactUsDetails("contactId='".$attributes['contactId']."'");
	//$adminFunction->getContactUsRead();
?>
<script language="javascript" type="text/javascript">
	function submitcontactus(var1){
		document.getElementById(var1).value=var1;
	}
</script>
<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>
        	<?php
				if(isset($attributes['contactId']) && $attributes['contactId']!='') {
					echo "View Messsage";
				} else {
					echo "View Messsag";	
				}
			?>
		</th>
	</tr>
	<tr>
		<td align="left">
<form name="frmaddcontactus" id="frmaddcontactus" method="post" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
        <td align="left">&nbsp;</td>
        <td align="right"><a href="#" onclick="document.frmBack.submit();"><img src="images/back.gif" alt="Back" border="0" /></a></td>
      </tr>
		<tr>
	  	<td width="25%" align="left" valign="top">&nbsp;Name:</td>
		<td width="75%" align="left">
        	<?php echo $adminFunction->outputData($data[0]['contactYourName']); ?>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top">&nbsp;Email:</td>
		<td width="75%" align="left">
        	<?php echo $adminFunction->outputData($data[0]['contactEmail']); ?>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top">&nbsp;Phone Number:</td>
		<td width="75%" align="left">
        	<?php echo $adminFunction->outputData($data[0]['contactPhone']); ?>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top">&nbsp;Contact For:</td>
		<td width="75%" align="left">
        	<?php echo $adminFunction->outputData($data[0]['contactFor']); ?>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top">&nbsp;Subject:</td>
		<td width="75%" align="left">
        	<?php echo $adminFunction->outputData($data[0]['contactSubject']); ?>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top">&nbsp;Message:</td>
		<td width="75%" align="left" valign="top">
			<?php echo $adminFunction->outputData(str_replace("\n","<br />",$data[0]['contactMessage'])); ?>             
        </td>
	  </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td align="left">
			<?php if($attributes['lstart']=='')
				$attributes['lstart']=0;
			?>
			<input type="hidden" name="lstart" value="<?php echo $attributes['lstart'];?>"/>
		
		<a href="#" onclick="document.frmBack.submit();"><img src="images/back.gif" alt="Back" border="0" /></a>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" colspan="2" valign="top"></td>
    </tr>
</table>

</form>

<form name="frmBack" action="index.php?act=manageinbox" method="post">
</form>
		</td>
	</tr>
</table>