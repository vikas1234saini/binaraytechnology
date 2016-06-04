<?php 
	$error= array();
	$flag=0;
	$name = '' ;
	$category  = '';
	print_r($attributes);
//	$categories = $adminFunction->getHireDetails("","","categoryParent='0'");

	if(isset($attributes['addsubhire']) && $attributes['addsubhire'] !=''){
		echo "dcsd";
		$error = $adminFunction->addSubHire();
		$title  = $attributes['txtTitle'];	
		$name = $attributes['txtSubCategoryName'];
		$tag = $attributes['txtSubCategoryTag'];
		$category  = $attributes['cmbCategory'];
		$description  = $attributes['txtDescription'];
		$keyword =   $attributes['txtKeyword'];
		$desc  = $attributes['txtDesc'];
			
		if($error){
			$flag=1;
		} 
	}
	if($attributes['act']=='editsubhire'){
		$catdetails = $adminFunction->getHireDetails($attributes['subCategoryId']);
		
		$title  = $adminFunction->outputData($catdetails[0]['categoryTitle']);
		$name = $catdetails[0]['categoryName'];
		$tag = $catdetails[0]['categoryTag'];
		$subCatId = $catdetails[0]['categoryId'];
		$category = $catdetails[0]['categoryParent'];
		$description  = $adminFunction->outputData($catdetails[0]['categoryDescription']);
		$keyword = $adminFunction->outputData($catdetails[0]['categoryKeyword']);
		$desc  = $adminFunction->outputData($catdetails[0]['categoryDesc']);
		
	}
	if(isset($attributes['editsubhire']) && $attributes['editsubhire'] !=''){
		$error = $adminFunction->addSubHire();
		
		$title  = $adminFunction->outputData($catdetails[0]['txtcategoryTitle']);
		$name = $attributes['txtSubCategoryName'];
		$tag = $attributes['txtSubCategoryTag'];
		$category  = $attributes['cmbCategory'];
		$description  = $attributes['txtDescription'];
		$keyword = $adminFunction->outputData($catdetails[0]['txtcategoryKeyword']);
		$desc  = $adminFunction->outputData($catdetails[0]['txtcategoryDesc']);
			
		if($error){
			$flag=1;
		} 
	}
?>


<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
	<tr>
        <th>
			<?php if($attributes['act']!='addsubhire'){?>
				Add Sub Category 
			<?php }else {?>
				Edit Sub Category 
			<?php } ?>
			<br>
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
				
						echo "<span class=red>";
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
        <input type="text"  name="txtTitle" id="txtTitle" class="input" value="<?php echo $title; ?>"/>					</td>
          <tr>
        <td align="left">
			Category <span class="red2">*</span>
		</td>
        <td align="left">
			<select name="cmbCategory" title="Fill36::Please select category.">
				<option value="select">Select</option>
				<?php for($i=0;$i<sizeof($categories);$i++){ ?>
					<option value="<?php echo $categories[$i]['categoryId']; ?>" <?php if($categories[$i]['categoryId']==$category){ ?> selected="selected"<?php }?> ><?php echo $categories[$i]['categoryName']; ?></option>
				<?php } ?>
			</select>
		</td>
      </tr>
      <tr>
	   <td width="44%" align="left">Sub Category Name<span class="red2">*</span>
				</td>
        <td width="56%" align="left" valign="top"><input type="text"  title="Fill::Please enter sub-category name." name="txtSubCategoryName" id="txtSubCategoryName" class="input" value="<?php echo $name; ?>"/>					</td>
      </tr>
      
      <tr>
	   <td width="44%" align="left">Sub Category Tag<span class="red2">*</span>
				</td>
        <td width="56%" align="left" valign="top"><input type="text"  title="Fill::Please enter sub-category name." name="txtSubCategoryTag" id="txtSubCategoryTag" class="input" value="<?php echo $tag; ?>"/>					</td>
      </tr>
      
	   <tr>
            <td align="left" colspan="2">Description: <br  />
            <textarea name="txtDescription" cols="55" rows="5" ><?php echo $description; ?></textarea>
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
        <textarea rows="5" cols="60" name="txtKeyword" id="txtKeyword">
        	<?php echo $keyword; ?>
        </textarea>
               					</td>
      </tr>
      
      <tr>
	 
        <td  align="left">Meta Description</td></tr>
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
		<?php if($attributes['act']!='editsubhire'){?>
			<input type="image" name="submit" alt="Add" src="images/add.gif" />
			<input type="hidden" name="addsubhire" value="addsubhire" />
		<?php } else {?>
			<input type="image" name="submit" alt="Edit" src="images/update.gif" />
			<input type="hidden" name="editsubhire" value="editsubhire" />
			<input type="hidden" name="act" value="<?php echo $attributes['act'];?>"/>
			<input type="hidden" name="subCategoryId" value="<?php echo $subCatId;?>"/>
		<?php } ?>
		<?php if($attributes['lstart']=='')
			$attributes['lstart']=0;
		?>
		<input type="hidden" name="lstart" value="<?php echo $attributes['lstart'];?>"/>
		<a href="index.php?act=managesubhire&limitstart=<?php echo $attributes['lstart'];?>"><img src="images/back.gif" alt="Back" border="0" /></a>
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