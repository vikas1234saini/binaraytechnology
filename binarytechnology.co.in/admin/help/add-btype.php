<?php 
	$flag = 0;
	$error= array();
	print_r($attributes);
	
	$data = $adminFunction->addEditBtype();

	if(isset($data['error']) && $data['error'][0]!=''){
		$error = $data['error'];
		$flag=1;
	} 
	
?>
<script language="javascript" type="text/javascript">
	function submitbtype(var1){
		document.getElementById(var1).value=var1;
	}
</script>
<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>
        	<?php
				if(isset($attributes['btypeId']) && $attributes['btypeId']!='') {
					echo "Edit Btype Type";
				} else {
					echo "Add Btype Type";	
				}
			?>
		</th>
	</tr>
	<tr>
		<td align="left">
<form name="frmaddbtype" id="frmaddbtype" method="post" onsubmit="return validate_form(this);" action="" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
        <td align="left">&nbsp;</td>
        <td align="right"><a href="#" onclick="document.frmBack.submit();"><img src="images/back.gif" alt="Back" border="0" /></a></td>
      </tr>
	 <tr>
        <td colspan="2" align="left">
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
                } 
            ?>
            </span>
            
        </td>
      </tr>
     
      
	  <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Btype Name:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtBtypeName" id="txtBtypeName" value="<?Php echo $data['attributes']['txtBtypeName']; ?>" type="text" title="Btype Name::Please enter Btype Name."/>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Btype Desc:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtBtypeDesc" id="txtBtypeDesc" value="<?Php echo $data['attributes']['txtBtypeDesc']; ?>" type="text" title="Btype Desc::Please enter Btype Desc."/>
        </td>
	  </tr>
      
      <tr>
        <td align="left">&nbsp;</td>
        <td align="left">
			<?php if($attributes['lstart']=='')
				$attributes['lstart']=0;
			?>
			<input type="hidden" name="lstart" value="<?php echo $attributes['lstart'];?>"/>
            <?php if(isset($attributes['btypeId']) && $attributes['btypeId']!=''){ ?>
				<input type="image" name="submit" alt="Edit" src="images/edit-button.gif" onClick="return submitbtype('editbtype');" />
				<input type="hidden" name="editbtype" id="editbtype" value="" />
                <input type="hidden" name="btypeId" id="btypeId" value="<?php echo $attributes['btypeId'];?>" />
                <input type="hidden" name="act" id="act" value="editbtype" />
            <?php } else { ?>
            	<input type="image" name="submit" alt="Add" src="images/add.gif" onClick="return submitbtype('addbtype');" />
				<input type="hidden" name="addbtype" id="addbtype" value="" />
                <input type="hidden" name="act" id="act" value="addbtype" />
            <?php } ?>
		
		<a href="#" onclick="document.frmBack.submit();"><img src="images/back.gif" alt="Back" border="0" /></a>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" colspan="2" valign="top"></td>
    </tr>
</table>
<input type="hidden" name="limitstart" value="<?php
													if(isset($data['attributes']['lstart'])){		
														echo $data['attributes']['lstart'];
													} else {
														echo $data['attributes']['limitstart'];	
													}
											?>" />
<?php
	if(isset($attributes['sleSortField'])){
?>
		<input type="hidden" name="sleSortField" value="<?php echo $attributes['sleSortField']; ?>" />
        <input type="hidden" name="sleSortOrder" value="<?php echo $attributes['sleSortOrder']; ?>" />
<?php
	}
?>
        
</form>

<form name="frmBack" action="index.php?act=managebtype" method="post">
<input type="hidden" name="limitstart" value="<?php
													if(isset($data['attributes']['lstart'])){		
														echo $data['attributes']['lstart'];
													} else {
														echo $data['attributes']['limitstart'];	
													}
											?>" />
<?php
	if(isset($data['msg']) && $data['msg'][0]!=''){
?>
<input type="hidden" name="msg" id='msg' value="" />
<?php
	}
	if(isset($attributes['sleSortField'])){
?>
		<input type="hidden" name="sleSortField" value="<?php echo $attributes['sleSortField']; ?>" />
        <input type="hidden" name="sleSortOrder" value="<?php echo $attributes['sleSortOrder']; ?>" />
<?php
	}
?>
</form>
<?php
	if(isset($data['msg']) && $data['msg'][0]!=''){
?>
<script language="javascript" type="text/javascript">
	document.getElementById('msg').value= "<?php echo $data['msg'][0]; ?>";
	document.frmBack.submit();
</script>
<?php } ?>
		</td>
	</tr>
</table>