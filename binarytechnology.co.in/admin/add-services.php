<?php 
	$error= array();
	$flag=0;
	$name = '' ;
//	$for  = '';
	if(isset($attributes['addservices']) && $attributes['addservices'] !=''){
		$error = $adminFunction->addServices();
		
		$title  = $attributes['txtTitle'];	
		$name = $attributes['txtCategoryName'];
		$description  = $attributes['txtDescription'];
		$keyword =   $attributes['txtKeyword'];
		$desc  = $attributes['txtDesc'];
		
		
		
//		$for  = $attributes['cmbCategoryFor'];
			
		if($error){
			$flag=1;
		} 
	}
	if($attributes['act']=='editservices'){
		$catdetails = $adminFunction->getServicesDetails($attributes['categoryId']);
		
		$title  = $adminFunction->outputData($catdetails[0]['categoryTitle']);
		$name = $adminFunction->outputData($catdetails[0]['categoryName']);
		$description  = $adminFunction->outputData($catdetails[0]['categoryDescription']);
		$keyword = $adminFunction->outputData($catdetails[0]['categoryKeyword']);
		$desc  = $adminFunction->outputData($catdetails[0]['categoryDesc']);
		
//		$for = $catdetails[0]['categoryFor'];
	}
	if(isset($attributes['editservices']) && $attributes['editservices'] !=''){
		$error = $adminFunction->addServices();
		$title = $adminFunction->outputData($attributes['txtTitle']);
		$name = $adminFunction->outputData($attributes['txtCategoryName']);
		$description  = $attributes['txtDescription'];
		$keyword = $adminFunction->outputData($attributes['txtKeyword']);
		$desc  = $attributes['txtDesc'];
//		$for  = $attributes['cmbCategoryFor'];
			
		if($error){
			$flag=1;
		} 
	}
?>


<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th><?php if($attributes['act']!='editservices'){?>
				Add Link 
			<?php }else {?>
				Edit Link 
			<?php } ?> <br>
		</th>
	</tr>
	<tr>
		<td  height="280">
<form name="frmchangepassword" method="post" action="" onsubmit="return validate_form(this);">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
					} 
				?>
				</span>
				
			</td>
		  </tr>
          
           <tr>
	 
        <td width="44%" align="left">Title</td>
        <td width="56%" align="left" valign="top">
        <input type="text" name="txtTitle" id="txtTitle" class="input" value="<?php echo $title; ?>"/>					</td>
      </tr>
          
      <tr>
	 
        <td width="44%" align="left">Link Name<span class="red2">*</span>
				</td>
        <td width="56%" align="left" valign="top">
        <input type="text"  title="Fill::Please enter Link name." name="txtCategoryName" id="txtCategoryName" class="input" value="<?php echo $name; ?>"/>					</td>
      </tr>
	   <tr>
            <td align="left" colspan="2">Description: <br  />
            <textarea name="txtDescription" cols="55" rows="5"><?php echo $description; ?></textarea>
            <?php
				/*$oFCKeditor = new FCKeditor('txtDescription') ;
				$oFCKeditor->BasePath = '../js/fckeditor/';
				$oFCKeditor->Value = $description;
				$oFCKeditor->Height = '300' ;
				$oFCKeditor->Width = '650' ;
				$oFCKeditor->Create();*/
			?>
            </td>
          </tr>
          
          <tr>
	 
        <td  align="left">Keyword</td></tr>
        <tr>
        <td  align="left" valign="top">
        
        <input type="text" size="70" height="100px" name="txtKeyword" id="txtKeyword" value="<?php echo $keyword; ?>" />
        	
        
               					</td>
      </tr>
      
      <tr>
	 
        <td  align="left">Description</td></tr>
        <td  align="left" valign="top">
        <textarea rows="5" cols="60" name="txtDesc" id="txtDesc">
        	<?php echo $desc; ?>
        </textarea>
               					</td>
      </tr>
      
      <!--<tr>
        <td align="right">
			Category Type<span class="red2">*</span>
		</td>
        <td align="left">
			<select name="cmbCategoryFor">
				<option value="select">Select</option>
				<option value="0" <?php if($for=='0'){ ?> selected="selected"<?php }?>>For all Member</option>
				<option value="1" <?php if($for=='1'){ ?> selected="selected"<?php }?>>For paid Member</option>
			</select>
		</td>
      </tr>-->
     <tr>
        <td height="15" colspan="2" align="right"></td>
        </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">
		<?php if($attributes['act']!='editservices'){?>
			<input type="image" name="submit" alt="Add" src="images/add.gif" />
			<input type="hidden" name="addservices" value="addservices" />
		<?php } else {?>
			<input type="image" name="submit" alt="Edit" src="images/update.gif" />
			<input type="hidden" name="editservices" value="editservices" />
			<input type="hidden" name="act" value="<?php echo $attributes['act'];?>"/>
			<input type="hidden" name="categoryId" value="<?php echo $attributes['categoryId'];?>"/>
		<?php } ?>
		<?php if($attributes['lstart']=='')
			$attributes['lstart']=0;
		?>
		<input type="hidden" name="lstart" value="<?php echo $attributes['lstart'];?>"/>
			<a href="index.php?act=manageservices&limitstart=<?php 
																		echo $attributes['lstart'];
																		if(isset($attributes['order'])){
																			echo "&order=".$attributes['order'];
																		}
																	?>"><img src="images/back.gif" alt="Back" border="0" /></a>
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