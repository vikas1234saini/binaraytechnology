<?php
	$flag = 0;
	
	$data = $adminFunction->manageNews("frmmanagenews");
	$newsList = $data['dataList'];
	
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
	function getFormValue(action,newsId,lstart){
		document.getElementById('newsId').value = newsId;
		document.getElementById('lstart').value = lstart;
		
		if(action=='editnews' || action=='addnews'){
			document.getElementById('act').value = action;
			//alert(action);
		} 
		else {
			if(confirm('Are you sure to delete the record?')){
				document.getElementById('token').value = action;
			}else{
				return false;
			}
		}
		document.frmmanagenews.submit();
	}
</script>

<form method="post" name="frmmanagenews" id="frmmanagenews" action="" >
	<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
      <tr>
        <th>Manage News</th>
        </tr>
		 <tr>
	        <td colspan="5" align="center">
				<?php 
					if($flag==1)
					{
						$success = explode(" ",$data['message']);
						if(in_array("successfully.",$success)){
							echo "<span class=green>";
						}else{
							echo "<span class=red>";
						}
						 echo $data['message'].
						 "</span>";					
					} else if($flag=2) {
						echo "<font color=green>".
							 $msg.
							 "</font>";	
					}				
				?>
	  		</td>
      </tr>
      
      <tr>
        <td align="center">
            <table width="90%" border="0" cellpadding="0" cellspacing="1" id="rightnav">
          		 
        <?php if($newsList[0]['newsId']!='') {?>
          <tr>
            <td width="5%" class="bg" align="center">S. No.</td>
           	<td width="15%" class="bg" align="center">News</td>
 			<td width="35%" class="bg" align="center">News Desecription</td>
            <td width="20%" class="bg" align="center">Date</td>
            <td width="20%" class="bg" align="center">Action</td>
            
			<td width="10%" class="bg" align="center"><input name="chkall" type="checkbox"  value="1" onclick="javascript:CheckAll(this.form);" /></td>
          </tr>
	  	<?php for($i=0;$i<sizeof($newsList);$i++) {?>
          <tr>
            <td align="center"><?php echo $i+1+$data['lstart']; ?></td>	
            <td align="left">
				<?php 
					echo $adminFunction->outputData($newsList[$i]['newsName']);
				?>
			</td>
            <td align="left">
				<?php 
					echo $adminFunction->outputData($newsList[$i]['newsDesc']);
				?>
			</td>
           
            <td align="left">
				<?php
					
					echo $adminFunction->outputData($newsList[$i]['Date']);
					
				?>
			</td>
            
            <td align="center">
            	<a href="#" onclick="return getFormValue('editnews',<?php echo $newsList[$i]['newsId']; ?>,'<?php echo $data['lstart']; ?>');" title="Edit news"><img src="images/edit.gif" border="0" alt="Edit" /></a>&nbsp;&nbsp;<a href="#" onclick="return getFormValue('delete',<?php echo $newsList[$i]['newsId']; ?>);" title="Delete news" ><img src="images/delete.gif" border="0" alt="Delete" /></a>
            </td>
		    <td align="center">
				<input type="checkbox" name="newsIds[]" value="<?php echo $newsList[$i]['newsId']; ?>" />
			</td>
          </tr>
		<?php } // END OF for LOOP ?>
		<?php
		  } else {
		  	echo "<tr><td align=center><b>No news Exist.</b></td></tr>";
		  }
		?>
		<?php if($data['total']>$config['item_per_page']){ ?>
		<tr>
           	<td colspan="6" align="right">
			<?php
				echo $data['paging'];
			?> 
			</td>
        </tr>
 		<?php } // END OF PAGING ?>
         <tr>
		 	<td colspan="6" align="right"><a href="#" onclick="return getFormValue('addnews','','<?php echo $data['lstart']; ?>');" alt="Add news" ><img src="images/add.gif" border="0" /></a> <?php if($newsList[0]['newsId']!='') {?><input name="deletenews" value="Delete news" src="images/delete-button.gif" alt="" type="image"  border="0" onClick="return CheckAll1(this.form,'news');"/><?php } ?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    <input name="lstart" id="lstart" type="hidden" value="<?php echo $data['lstart'];?>"  />
    <input name="newsId" id="newsId" type="hidden" value=""  />
    <input type="hidden" id="token" name="token" value="" />
    <input type="hidden" id="act" name="act" value="<?php echo $attributes['act'];?>" />
</form>