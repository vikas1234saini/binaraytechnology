<?php 
	$flag = 0;
	$error= array();
	//print_r($attributes);
	
	$data = $adminFunction->addEditPortfolio();

	if(isset($data['error']) && $data['error'][0]!=''){
		$error = $data['error'];
		$flag=1;
	} 
	
?>
<script language="javascript" type="text/javascript">
	function submitportfolio(var1){
		document.getElementById(var1).value=var1;
	}
</script>
<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>
        	<?php
				if(isset($attributes['portfolioId']) && $attributes['portfolioId']!='') {
					echo "Edit Portfolio Type";
				} else {
					echo "Add Portfolio Type";	
				}
			?>
		</th>
	</tr>
	<tr>
		<td align="left">
<form name="frmaddportfolio" id="frmaddportfolio" method="post" onsubmit="return validate_form(this);" action="" enctype="multipart/form-data" >
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
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Portfolio Name:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPortfolioName" id="txtPortfolioName" value="<?Php echo $data['attributes']['txtPortfolioName']; ?>" type="text" title="Portfolio Name::Please enter Portfolio Name."/>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Portfolio Desc:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPortfolioDesc" id="txtPortfolioDesc" value="<?Php echo $data['attributes']['txtPortfolioDesc']; ?>" type="text" title="Portfolio Desc::Please enter Portfolio Desc."/>
        </td>
	  </tr>
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Portfolio Link:</td>
		<td width="75%" align="left">
        	<input size="85" class="input" name="txtPortfolioLink" id="txtPortfolioLink" value="<?Php echo $data['attributes']['txtPortfolioLink']; ?>" type="text" />
        </td>
	  </tr>
      
      <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Portfolio Type:</td>
		<td width="75%" align="left">
           	<select name="selPortfolioType" id="selPortfolioType" >
            	<option value="0" <?php if($data['attributes']['selPortfolioType'] == 0){ ?> selected="selected"<?php }?>>Designing</option>
                <option value="1" <?php if($data['attributes']['selPortfolioType'] == 1){ ?> selected="selected"<?php }?>>Coding</option>
                <option value="2" <?php if($data['attributes']['selPortfolioType'] == 2){ ?> selected="selected"<?php }?>>Both</option>
            </select>
        </td>
	  </tr>
      
       <tr>
	  	<td width="25%" align="left" valign="top"><span class="red2">*</span>&nbsp;Portfolio Image</td>
			<td width="75%" align="left">
            	
           		<?php
				if($data['attributes']['oldImage']!='') {  ?>
                                        <input name="oldImage" id="oldImage" value="<?php echo $data['attributes']['oldImage']; ?>" type="hidden" />
                                        <img src="<?php echo $config['siteurl']."portfolio/thumbs/".$data['attributes']['oldImage']; ?>"  />    
                                    <?php } else { ?>
                                    	<img src="../portfolio/default.jpg" border="0" />    
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
            <?php if(isset($attributes['portfolioId']) && $attributes['portfolioId']!=''){ ?>
				<input type="image" name="submit" alt="Edit" src="images/edit-button.gif" onClick="return submitportfolio('editportfolio');" />
				<input type="hidden" name="editportfolio" id="editportfolio" value="" />
                <input type="hidden" name="portfolioId" id="portfolioId" value="<?php echo $attributes['portfolioId'];?>" />
                <input type="hidden" name="act" id="act" value="editportfolio" />
            <?php } else { ?>
            	<input type="image" name="submit" alt="Add" src="images/add.gif" onClick="return submitportfolio('addportfolio');" />
				<input type="hidden" name="addportfolio" id="addportfolio" value="" />
                <input type="hidden" name="act" id="act" value="addportfolio" />
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

<form name="frmBack" action="index.php?act=manageportfolio" method="post">
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