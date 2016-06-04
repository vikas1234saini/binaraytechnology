<?php 
	include ("include/header.php"); 
	$service = $mainObj->getServicesById($attributes['service']);
?>
        
        <div class="hire-middle-main">
        	<div class="hire-middle">
            	<div class="hire-middletitle">
            	  <h1><?php echo  $service[0]['categoryName']; ?>
                  </h1>
           	  </div>
                <div align="justify" class=" hire-middletext"><?php echo  $mainObj->outputData($service[0]['categoryDescription']); ?> </div><!--end class middletext -->
               
               
               <?php 
			   $subservice = $mainObj->getServices($attributes['service']);
			   for($i = 0; $i<sizeof($subservice); $i++)	{ 	   ?>
               
               <a name="<?php echo  str_replace(" ","-",$subservice[$i]['categoryTag']); ?>"> </a>
               
                <div class="hire-category">
                	<div class="hire-category-title">
                      <h1><?php echo  $subservice[$i]['categoryName']; ?> </h1>
   	    </div>
                    	<div class="hirecategorycontent">
                        <div class="hirecategorytext" align="justify">
                      <?php echo  $mainObj->outputData($subservice[$i]['categoryDescription']); ?>
                        </div>
                        <div class="psdcon-get">
                        	<DIV class="psdcon-getleft">
                            </DIV>
                            <div class="psdcon-getmid">
                            	<div class="psdcon-getmidtxt">
                                    <div id='content'>
                                        <div id='contact-form'>
                                            <a href="#" class="contact" title="<?php echo  $subservice[$i]['categoryName']; ?>" >Get Started</a>
                                        </div>
                                        <!-- preload the images -->
                                        <div style='display:none'>
                                            <img src='<?php echo $config['siteurl']; ?>images/loading.gif' alt='' />
                                        </div>
                                    </div>
                            	
                            	</div>
                            	
                            </div>
                            
                            <div class="psdcon-getright">
                            </div>
                        </div><!--end class psdcon-get-->
                        </div><!--end class hirecategorycontent -->
                    </div><!--end class hire-category -->
                
                
                <?php  } ?>
                
                
                
                
                
                
          </div><!--end class hire-middle -->
        </div><!--end class hire-middle-main -->

 <?php 
include ("include/footer.php"); 
?>