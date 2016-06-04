<?php 
include ("include/header.php"); 
?>
        
        <div id="about-middle-main">
        	<?php echo $mainObj->outputData(str_replace("images/",$config['siteurl']."images/",$allpages[1]['pageDesc']));  ?>
        </div><!--end class about-middle-main -->

  <div id="footer-main">
  <?php include ("include/footer.php");  ?>