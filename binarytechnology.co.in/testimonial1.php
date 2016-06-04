<?php 
include ("include/header.php"); 
$alltestimonial 	= $mainObj->getTestimonial();
?>
       
       <div id="testi-middle-main">
       		<div id="testi-middle">
            	<div id="testi-middletitle">What they said about us
                </div>
                <div id="testi-middleleft">
                
                
				<?php for($i=0;$i<sizeof($alltestimonial); $i++) { ?>
                	<div class="testimonial">
                    	<div class="testi-topsection">
                        	<div class="testi-topdiv">
                            	<div class="testitop-left">
                                </div>
                                <div class="testitop-mid">
                                	<div class="testitop-content">
                                    	<div class="testi-toptext">
                                        <p style="font-size:22px; padding-top:5px;"><?php echo $alltestimonial[$i]['testimonialName']; ?></p>
                                        <p style=" font-style:italic;"><?php echo $alltestimonial[$i]['personDesignation']; ?></p>
                                  </div>
                                        <div class="testitopimg">
                                        <img src="clients/<?php if($alltestimonial[$i]['testimonialImage']=="")
												{
													echo "noimage.jpg"; 
												}
												else 
												{
													echo $alltestimonial[$i]['testimonialImage'];
												}
												?>" height="43px" width="37px" />
                                        </div> 
                                    </div><!--end class testitop-content-->
                                </div>
                                <div class="testitop-right">
                                </div>
                            </div><!--end class testi-topdiv-->
                        </div><!--end class testi-topsection-->
                        <div class="testi-bottomsection">
                        	<div class="testi">
                            	<div class="testi-top">
                                </div>
                                <div class="testi-mid">
                                <div class="testimid-img">
                                
                                <img src="images/testi-comment.jpg" />
                                </div>
                                <div class="testimid-text">
                                
                                
                                
                                
                                e 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div>
                          </div>
                                <div class="testi-bottom">
                                </div>
                            </div><!--end class testi-->
                       
                        
                        </div><!--end class testi-bottomsection-->
                    
                    </div><!--end class testimonial-->
                    
                <?php } ?>   
                
                
                
                </div>  <!--end testi-miidleleft-->
                <?php include ("include/acordian.php");  ?>
      
      <!--end right-middlediv -->
      
      <div class="ourclient" style="padding-top:50px;">
          <div class="ourclienttitle"><img src="images/ourclients.jpg" border="0" /></div>
          <div class="ourclientbox"> adahdhdhddd </div>
          <div class="ourclientshadow"></div>
        </div>
        <!--end ourclient -->
      
      
      
                </div><!--end testimiddle-right-->
              
            </div> <!--end testi-middle-main-->
       </div> <!--end testi-middle-main-->
       
       
  <?php 
include ("include/footer.php"); 
?>