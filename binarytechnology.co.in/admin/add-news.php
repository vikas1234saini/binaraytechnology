<?php 
	$flag = 0;
	$error= array();
	//print_r($attributes);
	
	$data = $adminFunction->addEditNews();

	if(isset($data['error']) && $data['error'][0]!=''){
		$error = $data['error'];
		$flag=1;
	} 
	
?>
<script language="javascript" type="text/javascript">
	function submitnews(var1){
		document.getElementById(var1).value=var1;
	}
</script>
<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>
        	<?php
				if(isset($attributes['newsId']) && $attributes['newsId']!='') {
					echo "Edit News Type";
				} else {
					echo "Add News Type";	
				}
			?>
		</th>
	</tr>
	<tr>
		<td align="left">
<form name="frmaddnews" id="frmaddnews" method="post" onsubmit="return validate_form(this);" action="" enctype="multipart/form-data" >
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
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;News Name:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtNewsName" id="txtNewsName" value="<?Php echo $data['attributes']['txtNewsName']; ?>" type="text" title="News Name::Please enter News Name."/>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;News Desc:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtNewsDesc" id="txtNewsDesc" value="<?Php echo $data['attributes']['txtNewsDesc']; ?>" type="text" title="News Desc::Please enter News Desc."/>
        </td>
	  </tr>
      
      <tr>
        <td align="left">&nbsp;</td>
        <td align="left">
			<?php if($attributes['lstart']=='')
				$attributes['lstart']=0;
			?>
			<input type="hidden" name="lstart" value="<?php echo $attributes['lstart'];?>"/>
            <?php if(isset($attributes['newsId']) && $attributes['newsId']!=''){ ?>
				<input type="image" name="submit" alt="Edit" src="images/edit-button.gif" onClick="return submitnews('editnews');" />
				<input type="hidden" name="editnews" id="editnews" value="" />
                <input type="hidden" name="newsId" id="newsId" value="<?php echo $attributes['newsId'];?>" />
                <input type="hidden" name="act" id="act" value="editnews" />
            <?php } else { ?>
            	<input type="image" name="submit" alt="Add" src="images/add.gif" onClick="return submitnews('addnews');" />
				<input type="hidden" name="addnews" id="addnews" value="" />
                <input type="hidden" name="act" id="act" value="addnews" />
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

<form name="frmBack" action="index.php?act=managenews" method="post">
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