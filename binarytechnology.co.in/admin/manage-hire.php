<?php
	$flag = 0; 	
	
	$data = $adminFunction->HireList($paging,"frmmanagecategory");
	if(!isset($attributes['order'])){
		$data = $adminFunction->HireList($paging,"frmmanagecategory","");
		$order = "asc";
		
	}else{
		$order	= $attributes['order'];
		$data = $adminFunction->HireList($paging,"frmmanagecategory","categoryName ".$order);
		if($attributes['order']=='asc'){
			$order = "desc";
		}else{
			$order = "asc";
		}
	}
	
	$categoryList = $data['categoryList'];
		if(isset($data['message'])){
		$flag = 1;
	}
	if($flag!=1){
		if(isset($attributes['msg'])){
			//$msg=$errorMessageObj->errorMessage($attributes['msg']);
			$flag=2;
		}
	}
?>

<script language="javascript" type="text/javascript">
	function getFormValue(action,catid,lstart){
		document.getElementById('categoryId').value = catid;
		document.getElementById('lstart').value = lstart;
		if(action=='edithire')
			{
				document.getElementById('act').value = action
				//alert(action);
			} 
		else if(action=='activate' || action=='deactivate')
			{
				document.getElementById('token').value = action;
			} 
		else {
			if(confirm('Are you sure to delete the record?'))
				{
					document.getElementById('token').value = action;
				}
			else{
				return false;
				}
			}
		document.frmmanagecategory.submit();
	}
</script>

<form method="post" name="frmmanagecategory" id="frmmanagecategory" action="">
	<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
      <tr>
        <th>Link List</th>
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
            <td width="20%" class="bg" align="center">S. No.</td>
			<!--<td width="130" class="bg" align="center">Category Id</td>-->
            <td width="35%" class="bg" align="center"><a href="?act=managecategory&order=<?php echo $order; ?>">Link Name</a></td>
            <td width="15%" class="bg" align="center">Status</td>
		    <td width="20%" class="bg" align="center">Actions</td>
			<?php //<td width="10%" class="bg" align="center"><input name="chkall" type="checkbox"  value="1" onclick="javascript:CheckAll(this.form);" /></td> ?>
          </tr>
	  <?php
		  for($i=0;$i<sizeof($categoryList);$i++)
		  {
	  ?>
          <tr>
            <td align="center"><?php echo ($i+1)+$data['lstart']; ?></td>
			<!--<td align="center">	<?php echo $categoryList[$i]['categoryId'];	?></td>		-->	
            <td align="center"><?php echo $adminFunction->outputData($categoryList[$i]['categoryName']); ?></td>
             <td align="center">
				<?php if($categoryList[$i]['categoryStatus']==0) {?>
						<a href="#" onclick="return getFormValue('activate','<?php echo $categoryList[$i]['categoryId']; ?>','<?php echo $data['lstart']; ?>');" title="To Activate Click On Image"><img src="images/deactivate_icon.gif" alt="Deactive" border="0" /></a>
				<?php } else if($categoryList[$i]['categoryStatus']==1) {	?>	
						<a href="#" onclick="return getFormValue('deactivate','<?php echo $categoryList[$i]['categoryId']; ?>','<?php echo $data['lstart']; ?>');" title="To De-activate Click On Image"><img src="images/active_icon.gif" alt="Active" border="0" /></a>
				<?php }	?>	
			</td>
            <td align="center"><a href="#" onclick="return getFormValue('edithire','<?php echo $categoryList[$i]['categoryId']; ?>','<?php echo $data['lstart']; ?>');" title="Edit"><img src="images/edit.gif" border="0" alt="Edit" /></a></td>
            
          </tr>
		 
		<?php
		  }
		  } else {
		  	echo "<tr><td align=center><b>No Link Exist.</b></td></tr>";
		  }
		  if($data['total']>$config['item_per_page']){
		?>
		
			<tr>
            	<td colspan="7" align="right">
			<?php
				echo $data['paging'];
			?> 
			</td>
          </tr>
		  
 <?php }?>
 		
         <tr>
		 	<td colspan="7" align="right"><a href="index.php?act=addhire&limitstart=<?php 
																		echo $data['lstart'];
																		if(isset($attributes['order'])){
																			echo "&order=".$attributes['order'];
																		}
																	?>" alt="Add Category" ><img src="images/add.gif" border="0" /></a></td>
          </tr>
 
        </table></td>
      </tr>
    </table>
			<input name="categoryId" id="categoryId" type="hidden" value=""  />
			<input name="lstart" id="lstart" type="hidden" value="<?php echo $data['lstart'];?>"  />
			<input type="hidden" id="token" name="token" value="" />
			<input type="hidden" id="act" name="act" value="<?php echo $attributes['act'];?>" />
      </form>