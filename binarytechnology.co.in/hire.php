<?php 
include ("include/header.php"); 
?>
        
      <div class="hire-middle-main">
       	  <div class="hire-middle">
            	<div class="hire-middletitle">
            	  <h1>Hire
                  </h1>
       	    </div>
                <div class=" hire-middletext" align="justify"> <?php echo $mainObj->outputData(str_replace("images/",$config['siteurl']."images/",$allpages[4]['pageDesc']));  ?>
                  <!--end class hire-middle -->
                </div><!--end class middletext -->
                
                <?php for($i = 0; $i<sizeof($allhire); $i++) { ?>
                
                <div class="hire-category">
                	<div class="hire-category-title">
                  	<?php if($urlwriting==0){ ?>
                      <h1><a href="subhire.php?hire=<?php echo $allhire[$i]['categoryId']; ?>"><?php echo $allhire[$i]['categoryName']; ?></a></h1>
                    <?php } else { ?>
                    <h1><a href="<?php echo $config['siteurl']; ?>hires/<?php echo $allhire[$i]['categoryId']; ?>"><?php echo $allhire[$i]['categoryName']; ?></a></h1>
                    <?php } ?>
   	    </div>
                    	<div class="hirecategorycontent">
                        <div  class="hirecategorylist">
                        <ul>
                            <?php 
						$allsubhire = $mainObj->getHire( $allhire[$i][categoryId]);
						for($j = 0; $j<sizeof($allsubhire); $j++ ) { ?>
                        <?php if($urlwriting==0){ ?>
                            <li><a href="subhire.php?hire=<?php echo $allhire[$i]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a></li> 
                            <?php } else { ?>
                            <li><a href="<?php echo $config['siteurl']; ?>hires/<?php echo $allhire[$i]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a></li> 
                            <?php  } ?>
                            
                        <?php } ?>  
                        </ul>
                        </div>
                        <div class="hirecategoryltext" align="justify">
                       <?php echo $allhire[$i][categoryDescription]; ?>
                        </div>
                        <div class="psdcon-get">
                        	<DIV class="psdcon-getleft">
                            </DIV>
                            <div class="psdcon-getmid">
                            	<?php if($urlwriting==0){ ?>
                            	<div class="hire-psdcon-text"><a href="subhire.php?hire=<?php echo $allhire[$i]['categoryId']; ?>"><span style="font-size:18px">Take a Tour</span><br/>
                                <?php } else { ?>
                                <div class="hire-psdcon-text"><a href="<?php echo $config['siteurl']; ?>hires/<?php echo $allhire[$i]['categoryId']; ?>"><span style="font-size:18px">Take a Tour</span><br/>
                                <?php } ?>
                               <span style="font-size:22px;"> Click Here</span></a>
                                </div>
                            </div>
                            
                            <div class="psdcon-getright">
                            </div>
                        </div><!--end class psdcon-get-->
                        </div><!--end class hirecategorycontent -->
            </div><!--end class hire-category -->
                
                
                <?php } ?> 
                
                
                
            </div>
        </div><!--end class hire-middle-main -->

  <?php 
include ("include/footer.php"); 
?>