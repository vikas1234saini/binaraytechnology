<?php 
include ("include/header.php");
//print_r($attributes);
//echo $attributes['service'];
?>
        
        <div id="contact-middle-main">
        <div id="contact-middle">
        	<div id="contact-top">
            <div id="contact-topleft">
            	<div id="contact-topleft-title">
            	  <h1><?php echo $attributes['service']; ?>
                  </h1>
           	  </div>
            
            </div><!--end contact-top -->
        <div id="contact-bottom">
        	<div id="contact-bottomleft">
            	<div id="contactform">
                <div id="contactform-left">
                </div>
                <div id="contactform-mid">
                
                <div id="ctform_box">
            	<form name="frmcontactus" id="frmcontactus" action=""  method="post" onsubmit="return validate_form(this);" >
                	<label>Your Name :</label>
                    	<div class="ctfield1">
                    	  <input type="text" name="txtYourName" id="txtYourName" title="Your Name::Please Enter your name."/>
                    	</div><!--field1 -->
                     <label>Your Email :</label>
                    	<div class="ctfield1">
                    	  <input type="text" name="txtEmail" id="txtEmail" title="Email::Please enter Email."/>
                    	</div><!--field1 -->
                        <label>Subject :</label>
                    	<div class="ctfield1">
                    	  <input type="text" name="txtSubject" id="txtSubject" title="Subject::Please enter subject."/>
                    	</div><!--field1 -->
                       
                        <label>Your message :</label>
               	  <div>
                    	  <textarea name="txtMessge" id="txtMessge" class="ctarea"></textarea>
                    	 
                    </div><!--area -->
                    <input type="image" src="<?php echo $config['siteurl']; ?>images/contact/send-now.jpg" style="width:102px; height:38px; margin:10px 0 0 0px;" name="btncontact" />
                   <input name="contactFor" value="<?php echo $attributes['service']; ?>" id="contactFor" type="hidden" />
                   <input name="addcontact" value="addcontact" id="addcontact" type="hidden" /> 
                    	
                </form>
            </div><!--form_box -->	
                
                
                </div>
                <div id="contactform-right">
                </div>
                </div>
                
            </div><!--end contact-bottomleft -->  
            <div id="contact-bottomright">
            	<div id="contact-bottomright-title">Follow Us On
                </div>
                <div class="contact-bottomright-img"><a href="#"><img style="padding:10px 0 0 30px;"  src="<?php echo $config['siteurl']; ?>images/contact/facebook.jpg" border="0" /></a></div>
                <div class="contact-bottomright-img">
                <a href="#"><img style="padding-left:40px;" src="<?php echo $config['siteurl']; ?>images/contact/twitter.jpg " border="0" /></a>
                </div>
                <div class="contact-bottomright-img">
                <a href="#"><img style="padding-left:20px;" src="<?php echo $config['siteurl']; ?>images/contact/skype.jpg" border="0" /></a>
                </div>
                <div class="contact-bottomright-img">
                <a href="#"><img style="padding-left:20px;" src="<?php echo $config['siteurl']; ?>images/contact/gtalk.jpg" border="0" /></a>
                </div>
            </div>   <!--end contact-bottomleft -->     
        </div><!--end contact-bottom -->          
         
        </div><!--end contact-middle -->
        </div><!--end contact-middle-main -->
        

  <?php 
include ("include/footer.php"); 
?>