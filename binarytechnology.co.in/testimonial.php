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
                                
                                <img src="<?php echo $config['siteurl']; ?>images/testi-comment.jpg" />
                                </div>
                                <div class="testimid-text">
                                
                                
                                
                                
                                <?php echo $alltestimonial[$i]['testimonialDesc']; ?> </div>
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
      
     <div class="ourclient">
        <div class="ourclienttitle"><img src="<?php echo $config['siteurl']; ?>images/recent-work.png" onload="fixPNG(this)" border="0" /></div>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js?ver=2.2'></script>
        <div class="ourclientbox">  
        <!--[if !IE]> -->
<object type="application/x-shockwave-flash"
  data="<?php echo $config['siteurl']; ?>images/recent-work.swf" width="252" height="145">
<!-- <![endif]-->

<!--[if IE]>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
  width="252" height="145">
  <param name="movie" value="<?php echo $config['siteurl']; ?>images/recent-work.swf" />
<!--><!--dgx-->
  <param name="loop" value="true" />
  <param name="menu" value="false" />

  <p>This is <b>alternative</b> content.</p>
</object>
<!-- <![endif]-->
        
        
        </div>
        <div class="ourclientshadow"><img src="<?php echo $config['siteurl']; ?>images/shadow.png" onload="fixPNG(this)" border="0" /></div>
      </div>
      <!--end ourclient -->
        <!--end ourclient -->
      
      
      
                </div><!--end testimiddle-right-->
              
            </div> <!--end testi-middle-main-->
       </div> <!--end testi-middle-main-->
       
       
  <?php 
include ("include/footer.php"); 
?>