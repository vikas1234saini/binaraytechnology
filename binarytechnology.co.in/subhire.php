<?php 
include ("include/header.php"); 
//print_r($attributes);
//echo $attributes['hire'];
$hire = $mainObj->getHireById($attributes['hire']);
//print_r($hire);
?>
        
        <div class="hire-middle-main">
        	<div class="hire-middle">
            	<div class="hire-middletitle">
            	  <h1><?php echo  $hire[0]['categoryName']; ?>
                  </h1>
           	  </div>
                <div class=" hire-middletext"><?php echo  $mainObj->outputData($hire[0]['categoryDescription']); ?></div><!--end class middletext -->
                
                  <?php 
			   $subhire = $mainObj->getHire($attributes['hire']);
			   for($i = 0; $i<sizeof($subhire); $i++)	{ 	   ?>
               
               <a name="<?php echo  str_replace(" ","-",$subhire[$i]['categoryTag']); ?>"> </a>
                
                <div class="hire-category">
                	<div class="hire-category-title">
                      <h1><?php echo  $subhire[$i]['categoryName']; ?></h1>
   	    </div>
                    	<div class="hirecategorycontent">
                        <div class="hirecategorytext">
                        <?php echo  $mainObj->outputData($subhire[$i]['categoryDescription']); ?>
                        </div>
                        <div class="psdcon-get">
                        	<DIV class="psdcon-getleft">
                            </DIV>
                            <div class="psdcon-getmid">
                            	<div class="psdcon-getmidtxt">
                            		<div id='content'>
                                        <div id='contact-form'>
                                            <a href="#" class="contact" title="<?php echo  $subhire[$i]['categoryName']; ?>" >Get Started</a>
                                        </div>
                                        <!-- preload the images -->
                                        <div style='display:none'>
                                            <img src='images/loading.gif' alt='' />
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
