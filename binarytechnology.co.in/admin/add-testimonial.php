<?php 
	$flag = 0;
	$error= array();
	//print_r($attributes);
	
	$data = $adminFunction->addEditTestimonial();

	if(isset($data['error']) && $data['error'][0]!=''){
		$error = $data['error'];
		$flag=1;
	} 
	
?>
<script language="javascript" type="text/javascript">
	function submittestimonial(var1){
		document.getElementById(var1).value=var1;
	}
</script>
<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>
        	<?php
				if(isset($attributes['testimonialId']) && $attributes['testimonialId']!='') {
					echo "Edit Testimonial";
				} else {
					echo "Add Testimonial ";	
				}
			?>
		</th>
	</tr>
	<tr>
		<td align="left">
<form name="frmaddtestimonial" id="frmaddtestimonial" method="post" onsubmit="return validate_form(this);" action="" enctype="multipart/form-data" >
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
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Person Name:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtTestimonialName" id="txtTestimonialName" value="<?Php echo $data['attributes']['txtTestimonialName']; ?>" type="text" title="Testimonial Name::Please enter Testimonial Name."/>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top">&nbsp;Person Designation:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPersonDesignation" id="txtTestimonialName" value="<?Php echo $data['attributes']['txtPersonDesignation']; ?>" type="text" />
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Testimonial Desc:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtTestimonialDesc" id="txtTestimonialDesc" value="<?Php echo $data['attributes']['txtTestimonialDesc']; ?>" type="text" title="Testimonial Desc::Please enter Testimonial Desc."/>
        </td>
	  </tr>
      
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Portfolio Image</td>
			<td width="75%" align="left">
            	
           		<?php
				if($data['attributes']['oldImage']!='') {  ?>
                                        <input name="oldImage" id="oldImage" value="<?php echo $data['attributes']['oldImage']; ?>" type="hidden" />
                                        <img src="<?php echo $config['siteurl']."clients/thumbs/".$data['attributes']['oldImage']; ?>"  />    
                                    <?php } else { ?>
                                    	<img src="../clients/noimage.jpg" border="0" />    
                                    <?php } ?>
        	</td>
	  </tr>
      
      <tr>
      	<td align="left" style="padding-left:15px;" valign="top"><span class="red">*</span>&nbsp;Change Image&nbsp;:</td>
                            <td align="left"><input class="input" name="fleImage" id="fleImage" value="<?php echo $data['attributes']['fleImage']; ?>" type="file"  /></td>
                          </tr>
      
      <tr>
        <td align="left">&nbsp;</td>
        <td align="left">
			<?php if($attributes['lstart']=='')
				$attributes['lstart']=0;
			?>
			<input type="hidden" name="lstart" value="<?php echo $attributes['lstart'];?>"/>
            <?php if(isset($attributes['testimonialId']) && $attributes['testimonialId']!=''){ ?>
				<input type="image" name="submit" alt="Edit" src="images/edit-button.gif" onClick="return submittestimonial('edittestimonial');" />
				<input type="hidden" name="edittestimonial" id="edittestimonial" value="" />
                <input type="hidden" name="testimonialId" id="testimonialId" value="<?php echo $attributes['testimonialId'];?>" />
                <input type="hidden" name="act" id="act" value="edittestimonial" />
            <?php } else { ?>
            	<input type="image" name="submit" alt="Add" src="images/add.gif" onClick="return submittestimonial('addtestimonial');" />
				<input type="hidden" name="addtestimonial" id="addtestimonial" value="" />
                <input type="hidden" name="act" id="act" value="addtestimonial" />
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

<form name="frmBack" action="index.php?act=managetestimonial" method="post">
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