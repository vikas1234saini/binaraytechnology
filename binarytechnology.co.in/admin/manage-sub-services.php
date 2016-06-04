<?php
	$flag = 0; 	
	$data = $adminFunction->subServicesList($paging,"frmmanagesubcategory");
	$categoryList = $data['subCategoryList'];
		if(isset($data['message'])){
		$flag = 1;
	}
	if($flag!=1){
		if(isset($attributes['msg'])){
			$msg=$adminFunction->errorObj->errorMessage($attributes['msg']);
			$flag=2;
		}
	}
?>

<script language="javascript" type="text/javascript">
	function getFormValue(action,subcatid,catid,lstart){
		document.getElementById('subCategoryId').value = subcatid;
		document.getElementById('categoryId').value = catid;
		document.getElementById('lstart').value = lstart;
		if(action=='editsubservices'){
			document.getElementById('act').value = action
			//alert(action);
		} else if(action=='activate' || action=='deactivate'){
			document.getElementById('token').value = action;
		} else {
			if(confirm('Are you sure to delete the record?')){
				document.getElementById('token').value = action;
			}else{
				return false;
			}
		}
		document.frmmanagesubcategory.submit();
	}
</script>

<form method="post" name="frmmanagesubcategory" id="frmmanagesubcategory" action="" >
	<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
      <tr>
        <th>Sub-Link List</th>
        </tr>
		 <tr>
	        <td colspan="2" align="center">
				<?php 
					if($flag==1)
					{
						echo "<span class=green>".
							 $data['message'].
							 "</span>";					
					} else if($flag=2) {
						echo "<font color='#009900'>".
							 $msg.
							 "</font>";	
					}				
				?>
			</td>
		  </tr>
      <tr>
        <td align="center">
            <table width="90%" border="0" cellpadding="0" cellspacing="1" id="rightnav">
        <?php if($categoryList[0]['categoryId']!='') {?>
          <tr>
            <td width="15%" class="bg" align="center">Sr No.</td>
			<td width="25%" class="bg" align="center">Sub-Link</td>
            <td width="25%" class="bg" align="center">Link</td>
            <td width="10%" class="bg" align="center">Status</td>
		    <td width="15%" class="bg" align="center">Actions</td>
			<td width="10%" class="bg" align="center"><input name="chkall" type="checkbox"  value="1" onclick="javascript:CheckAll(this.form);" /></td>
          </tr>
	  <?php
		  for($i=0;$i<sizeof($categoryList);$i++)
		  {
	  ?>
          <tr>
            <td align="center"><?php echo $i+1+$data['lstart']; ?></td>
			<td align="center">	<?php echo $categoryList[$i]['categoryName'];	?></td>			
            <td align="center">
				<?php 
					$id = $categoryList[$i]['categoryParent'];
					$category = $adminFunction->getServicesDetails($id);
					echo $adminFunction->outputData($category[0]['categoryName']); 
				?>
			</td>
            <td align="center">
				<?php if($categoryList[$i]['categoryStatus']==0) {?>
						<a href="#" onclick="return getFormValue('activate','<?php echo $categoryList[$i]['categoryId']; ?>','<?php echo $categoryList[$i]['categoryParent']; ?>','<?php echo $data['lstart']; ?>');" title="To Activate Click On Image"><img src="images/deactivate_icon.gif" alt="Deactive" border="0" /></a>
				<?php } else if($categoryList[$i]['categoryStatus']==1) {	?>	
						<a href="#" onclick="return getFormValue('deactivate','<?php echo $categoryList[$i]['categoryId']; ?>','<?php echo $categoryList[$i]['categoryParent']; ?>','<?php echo $data['lstart']; ?>');" title="To De-activate Click On Image"><img src="images/active_icon.gif" alt="Active" border="0" /></a>
				<?php }	?>	
			</td>
            <td align="center"><a href="#" onclick="return getFormValue('editsubservices','<?php echo $categoryList[$i]['categoryId']; ?>','<?php echo $categoryList[$i]['categoryParent']; ?>','<?php echo $data['lstart']; ?>');"><img src="images/edit.gif" border="0" alt="Edit" /></a>&nbsp;&nbsp;<a href="#" onclick="return getFormValue('delete','<?php echo $categoryList[$i]['categoryId']; ?>','<?php echo $categoryList[$i]['categoryParent']; ?>','<?php echo $data['lstart']; ?>');"><img src="images/delete.gif" border="0" alt="Delete" /></a></td>
            <td align="center">
				<input type="checkbox" name="subcategoryIds[]" value="<?php echo $categoryList[$i]['categoryId']; ?>" />
			</td>
          </tr>
		 
		<?php
		  }
		  } else {
		  	echo "<tr><td align=center><b>No Sub-Link Exist.</b></td></tr>";
		  }
		  if($data['total']>$config['item_per_page']){
		?>
		
			<tr>
            	<td colspan="8" align="right">
			<?php
				echo $data['paging'];
			?> 
			</td>
          </tr>
		  
 <?php }?>
 		
         <tr>
		 	<td colspan="8" align="right"><a href="index.php?act=addsubservices&limitstart=<?php echo $data['lstart'];?>" alt="Add Sub Category" ><img src="images/add.gif" border="0" /></a> <?php if($categoryList[0]['categoryId']!='') {?><input name="deletesubservices" value="Delete Sub Category" src="images/delete-button.gif" alt="" type="image"  border="0" onClick="return CheckAll1(this.form,'subcategory');"/></a><?php } ?></td>
          </tr>
 
        </table></td>
      </tr>
    </table>
			<input name="lstart" id="lstart" type="hidden" value="<?php echo $data['lstart'];?>"  />
			<input name="subCategoryId" id="subCategoryId" type="hidden" value=""  />
			<input name="categoryId" id="categoryId" type="hidden" value=""  />
			<input type="hidden" id="token" name="token" value="" />
			<input type="hidden" id="act" name="act" value="<?php echo $attributes['act'];?>" />
      </form>