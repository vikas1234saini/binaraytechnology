 <div id="footer-main">
      <div id="footer">
      	<div id="footer-content">
      		<div class="footerdiv">
            	<div class="footerdiv_title">Creative
                </div>
            	<ul>
                 <?php 
						$allsubservices = $mainObj->getServices(1);
						for($j = 0; $j<sizeof($allsubservices); $j++ ) { ?>
                        <?php if($urlwriting==0){ ?>
                            <li><a href="<?php echo $config['siteurl']; ?>subservices.php?service=<?php echo $allservices[0]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
                        <?php } else { ?>
                        	<li><a href="<?php echo $config['siteurl']; ?>service/<?php echo $allservices[0]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
                        <?php } ?>
                        <?php } ?>  
                </ul>
             </div><!--end class footerdiv -->
             
             
             <div class="footerdiv">
            	<div class="footerdiv_title">Hire Web Developer</div>
            	<ul>
                	<?php 
						$allsubhire = $mainObj->getHire(4);
						for($j = 0; $j<sizeof($allsubhire); $j++ ) { ?>
                        <?php if($urlwriting==0){ ?>
                            <li><a href="<?php echo $config['siteurl']; ?>subhire.php?hire=<?php echo $allhire[2]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a> </li> 
                        <?php } else { ?>
	                        <li><a href="<?php echo $config['siteurl']; ?>hires/<?php echo $allhire[2]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a> </li> 
                        <?php } ?>
                        <?php } ?>  
                </ul>
             </div><!--end class footerdiv -->
             
             <div class="footerdiv">
            	<div class="footerdiv_title">Hire Web Designer
                </div>
            	<ul>
 					 <?php 
						$allsubhire = $mainObj->getHire(3);
						for($j = 0; $j<sizeof($allsubhire); $j++ ) { ?>
                        <?php if($urlwriting==0){ ?>
                            <li><a href="<?php echo $config['siteurl']; ?>subhire.php?hire=<?php echo $allhire[1]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a> </li> 
						<?php }else{?>
                            <li><a href="<?php echo $config['siteurl']; ?>hires/<?php echo $allhire[1]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a> </li> 
                        <?php } ?>
                        <?php } ?>            
                        
                        </ul>
             </div><!--end class footerdiv -->
             <div class="footerdiv"><div class="footerdiv_title">Pages
               </div>
            	<ul>
                 <?php if($urlwriting==0){ ?>
                    <li> <a href="<?php echo $config['siteurl']; ?>">Home </a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>aboutus.php">Who we are?</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>services.php">What we do?</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>portfolio.php">Showcase</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>hire.php">Hire</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>contact.php">Say Hi !</a></li>
                <?php } else { ?>
                    <li> <a href="<?php echo $config['siteurl']; ?>">Home </a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>aboutus/">Who we are?</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>services/">What we do?</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>portfolio/">Showcase</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>hires">Hire</a></li>
                    <li> <a href="<?php echo $config['siteurl']; ?>contact/">Say Hi !</a></li>
                <?php } ?>
                 
                </ul>
            
              </div>
               <div class="footerdiv"><div class="footerdiv_title">Technology
                </div>
            	<ul>
                 <?php 
						$allsubservices = $mainObj->getServices(2);
						for($j = 0; $j<sizeof($allsubservices); $j++ ) { ?>
                        	<?php if($urlwriting==0){ ?>
                            <li><a href="<?php echo $config['siteurl']; ?>subservices.php?service=<?php echo $allservices[1]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
                                <?php  } else { ?>
                            <li><a href="<?php echo $config['siteurl']; ?>service/<?php echo $allservices[1]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
     
                                <?php  } ?>
                            
                        <?php } ?>  
                </ul>
            	</div>
             <div class="footerdiv">
            	<div class="footerdiv_title">Hire Open Source Developer
                </div>
            	<ul>
                  <?php 
						$allsubhire = $mainObj->getHire(1);
						for($j = 0; $j<sizeof($allsubhire); $j++ ) { ?>
                        <?php if($urlwriting==0){ ?>
                            <li><a href="<?php echo $config['siteurl']; ?>subhire.php?hire=<?php echo $allhire[0]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a> </li> 
                         <?php } else { ?>
                         <li><a href="<?php echo $config['siteurl']; ?>hires/<?php echo $allhire[0]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubhire[$j]['categoryTag']); ?>"> <?php echo $allsubhire[$j]['categoryName']; ?></a> </li> 
                         <?php } ?>   
                        <?php } ?> 
                </ul>
             
             </div><!--end class footerdiv -->
              
             
            <!--end class footerdiv -->
                 
             <div class="footerdiv">
            	<div class="footerdiv_title">PSD Conversion
                </div>
            	<ul>
                <?php 
						$allsubservices = $mainObj->getServices(3);
						for($j = 0; $j<sizeof($allsubservices); $j++ ) { ?>
                        <?php if($urlwriting==0){ ?>
                            <li><a href="<?php echo $config['siteurl']; ?>subservices.php?service=<?php echo $allservices[2]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
                        <?php } else { ?>
                        	<li><a href="<?php echo $config['siteurl']; ?>service/<?php echo $allservices[2]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
                        <?php } ?>
                        <?php } ?> 
                 
                </ul>
             </div>
              <div class="footerdiv"><div class="footerdiv_title">Support
                </div>
            	<ul>
                 <?php 
						$allsubservices = $mainObj->getServices(4);
						for($j = 0; $j<sizeof($allsubservices); $j++ ) { ?>
                        <?php if($urlwriting==0){ ?>
                            <li><a href="<?php echo $config['siteurl']; ?>subservices.php?service=<?php echo $allservices[3]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
                        <?php } else { ?>
                        	<li><a href="<?php echo $config['siteurl']; ?>service/<?php echo $allservices[3]['categoryId']; ?>#<?php echo str_replace(" ","-",$allsubservices[$j]['categoryTag']); ?>"> <?php echo $allsubservices[$j]['categoryName']; ?></a> </li> 
                        <?php } ?>
                        <?php } ?>     	
              
                </ul>
            	</div><!--end class footerdiv -->
             
             </div><!--end footer-content -->
      </div><!--end footer -->
  </div>
<!--endmiddlemaine -->

</body>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23734716-1']);
  _gaq.push(['_setDomainName', '.co.in']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>