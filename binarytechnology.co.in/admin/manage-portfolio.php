<?php
	$flag = 0;
	
	$data = $adminFunction->managePortfolio("frmmanageportfolio");
	$portfolioList = $data['dataList'];
	
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
	function getFormValue(action,portfolioId,lstart){
		document.getElementById('portfolioId').value = portfolioId;
		document.getElementById('lstart').value = lstart;
		
		if(action=='editportfolio' || action=='addportfolio'){
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
		document.frmmanageportfolio.submit();
	}
</script>

<form method="post" name="frmmanageportfolio" id="frmmanageportfolio" action="" >
	<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
      <tr>
        <th>Manage Portfolio</th>
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
          		 
        <?php if($portfolioList[0]['portfolioId']!='') {?>
          <tr>
            <td width="5%" class="bg" align="center">S. No.</td>
           	<td width="15%" class="bg" align="center">Portfolio</td>
            <td width="35%" class="bg" align="center">Portfolio Desecription</td>
            <td width="20%" class="bg" align="center">Date</td>
            <td width="20%" class="bg" align="center">Action</td>
            
			<td width="10%" class="bg" align="center"><input name="chkall" type="checkbox"  value="1" onclick="javascript:CheckAll(this.form);" /></td>
          </tr>
	  	<?php for($i=0;$i<sizeof($portfolioList);$i++) {?>
          <tr>
            <td align="center"><?php echo $i+1+$data['lstart']; ?></td>	
            <td align="left">
				<?php 
					echo $adminFunction->outputData($portfolioList[$i]['portfolioName']);
				?>
			</td>
            <td align="left">
				<?php 
					echo $adminFunction->outputData($portfolioList[$i]['portfolioDesc']);
				?>
			</td>
           
            <td align="left">
				<?php
					
					echo $adminFunction->outputData($portfolioList[$i]['Date']);
					
				?>
			</td>
            
            <td align="center">
            	<a href="#" onclick="return getFormValue('editportfolio',<?php echo $portfolioList[$i]['portfolioId']; ?>,'<?php echo $data['lstart']; ?>');" title="Edit portfolio"><img src="images/edit.gif" border="0" alt="Edit" /></a>&nbsp;&nbsp;<a href="#" onclick="return getFormValue('delete',<?php echo $portfolioList[$i]['portfolioId']; ?>);" title="Delete portfolio" ><img src="images/delete.gif" border="0" alt="Delete" /></a>
            </td>
		    <td align="center">
				<input type="checkbox" name="portfolioIds[]" value="<?php echo $portfolioList[$i]['portfolioId']; ?>" />
			</td>
          </tr>
		<?php } // END OF for LOOP ?>
		<?php
		  } else {
		  	echo "<tr><td align=center><b>No portfolio Exist.</b></td></tr>";
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
		 	<td colspan="6" align="right"><a href="#" onclick="return getFormValue('addportfolio','','<?php echo $data['lstart']; ?>');" alt="Add portfolio" ><img src="images/add.gif" border="0" /></a> <?php if($portfolioList[0]['portfolioId']!='') {?><input name="deleteportfolio" value="Delete portfolio" src="images/delete-button.gif" alt="" type="image"  border="0" onClick="return CheckAll1(this.form,'portfolio');"/><?php } ?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    <input name="lstart" id="lstart" type="hidden" value="<?php echo $data['lstart'];?>"  />
    <input name="portfolioId" id="portfolioId" type="hidden" value=""  />
    <input type="hidden" id="token" name="token" value="" />
    <input type="hidden" id="act" name="act" value="<?php echo $attributes['act'];?>" />
</form>