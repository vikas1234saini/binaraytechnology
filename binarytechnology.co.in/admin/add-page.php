<?php 
	$flag = 0;
	$error= array();
	//print_r($attributes);
	
	$data = $adminFunction->addEditPage();

	if(isset($data['error']) && $data['error'][0]!=''){
		$error = $data['error'];
		$flag=1;
	} 
	
?>
<script language="javascript" type="text/javascript">
	function submitpage(var1){
		document.getElementById(var1).value=var1;
	}
</script>
<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>
        	<?php
				if(isset($attributes['pageId']) && $attributes['pageId']!='') {
					echo "Edit Page Type";
				} else {
					echo "Add Page Type";	
				}
			?>
		</th>
	</tr>
	<tr>
		<td align="left">
<form name="frmaddpage" id="frmaddpage" method="post" onsubmit="return validate_form(this);" action="" enctype="multipart/form-data" >
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
       <td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Page Title:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPageTitle" id="txtPageTitle" value="<?Php echo $data['attributes']['txtPageTitle']; ?>" type="text" title="Page Name::Please enter Page Title."/>
        </td>
        </tr>
        
        <tr>
        
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Page Name:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPageName" id="txtPageName" value="<?Php echo $data['attributes']['txtPageName']; ?>" type="text" title="Page Name::Please enter Page Name."/>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Page Desc:</td>
		<td width="75%" align="left">
        	<textarea name="txtPageDesc" id="txtPageDesc" cols="55" rows="5"><?php echo $adminFunction->outputData($data['attributes']['txtPageDesc']); ?></textarea>
            <?php
				/*$oFCKeditor = new FCKeditor('txtPageDesc') ;
				$oFCKeditor->BasePath = '../js/fckeditor/';
				$oFCKeditor->Value = $data['attributes']['txtPageDesc'];
				$oFCKeditor->Height = '300' ;
				$oFCKeditor->Width = '650' ;
				$oFCKeditor->Create();*/
			?>
        </td>
	  </tr>
      
       <tr>
       <td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Page Keyword</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPageKeyword" id="txtPageKeyword" value="<?Php echo $data['attributes']['txtPageKeyword']; ?>" type="text" title="Page Name::Please enter Page Keyword."/>
        </td>
        </tr>
        
         <tr>
       <td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Page Description</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPageDescription" id="txtPageDescription" value="<?Php echo $data['attributes']['txtPageDescription']; ?>" type="text" title="Page Name::Please enter Page Description."/>
        </td>
        </tr>
      
      
      <tr>
        <td align="left">&nbsp;</td>
        <td align="left">
			<?php if($attributes['lstart']=='')
				$attributes['lstart']=0;
			?>
			<input type="hidden" name="lstart" value="<?php echo $attributes['lstart'];?>"/>
            <?php if(isset($attributes['pageId']) && $attributes['pageId']!=''){ ?>
				<input type="image" name="submit" alt="Edit" src="images/edit-button.gif" onClick="return submitpage('editpage');" />
				<input type="hidden" name="editpage" id="editpage" value="" />
                <input type="hidden" name="pageId" id="pageId" value="<?php echo $attributes['pageId'];?>" />
                <input type="hidden" name="act" id="act" value="editpage" />
            <?php } else { ?>
            	<input type="image" name="submit" alt="Add" src="images/add.gif" onClick="return submitpage('addpage');" />
				<input type="hidden" name="addpage" id="addpage" value="" />
                <input type="hidden" name="act" id="act" value="addpage" />
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

<form name="frmBack" action="index.php?act=managepage" method="post">
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