<?php
	$flag = 0;
	$data = $adminFunction->manageContactUs("frmmanagecontactus","");
	$contactusList = $data['dataList'];
	
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
	function getFormValue(action,contactId,lstart){
		document.getElementById('contactId').value = contactId;
		document.getElementById('lstart').value = lstart;
		
		if(action=='viewinbox'){
			document.getElementById('act').value = action;
		}else{
				return false;
		}
		document.frmmanagecontactus.submit();
	}
</script>

<form method="post" name="frmmanagecontactus" id="frmmanagecontactus" action="" >
	<table width="95%" border="0" cellpadding="0" cellspacing="1" id="inner1">
      <tr>
        <th>Manage Contact Us</th>
        </tr>
      <tr>
        <td align="center">
            <table width="90%" border="0" cellpadding="0" cellspacing="1" id="rightnav">
          		 
        <?php if($contactusList[0]['contactId']!='') {?>
          <tr>
            <td width="10%" class="bg" align="center">S. No.</td>
           	<td width="20%" class="bg" align="center">Name</td>
           	<td width="10%" class="bg" align="center">Phone</td>
            <td width="15%" class="bg" align="center">Email</td>
            <td width="25%" class="bg" align="center">Subject</td>
            <td width="10%" class="bg" align="center">Date</td>
		    <td width="10%" class="bg" align="center">Action</td>
          </tr>
	  	<?php for($i=0;$i<sizeof($contactusList);$i++) {?>
          <tr>
            <td align="center"><?php echo $i+1+$data['lstart']; ?></td>	
            <td align="left">
				<?php 
					echo $adminFunction->outputData($contactusList[$i]['contactYourName']);
				?>
			</td>
            <td align="center">
				<?php 	
					echo $adminFunction->outputData($contactusList[$i]['contactPhone']);
				?>	
			</td>
            <td align="center">
				<?php 	
					echo $adminFunction->outputData($contactusList[$i]['contactEmail']);
				?>	
			</td>
            <td align="center">
				<?php 	
					echo $adminFunction->outputData($contactusList[$i]['contactSubject']);
				?>	
			</td>
            
            <td align="center">
				<?php 	
					echo $adminFunction->outputData($contactusList[$i]['contactDate']);
				?>	
			</td>
            <td align="center">
            	<a href="#" onclick="return getFormValue('viewinbox',<?php echo $contactusList[$i]['contactId']; ?>,'<?php echo $data['lstart']; ?>');" title="View inbox"><img src="images/view.gif" border="0" alt="View" /></a>
            </td>
            
          </tr>
		<?php } // END OF for LOOP ?>
		<?php
		  } else {
		  	echo "<tr><td align=center><b>No Contact Us Exist.</b></td></tr>";
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
         
        </table></td>
      </tr>
    </table>
    <input name="lstart" id="lstart" type="hidden" value="<?php echo $data['lstart'];?>"  />
    <input name="contactId" id="contactId" type="hidden" value=""  />
    <input type="hidden" id="token" name="token" value="" />
    <input type="hidden" id="act" name="act" value="<?php echo $attributes['act'];?>" />
</form>