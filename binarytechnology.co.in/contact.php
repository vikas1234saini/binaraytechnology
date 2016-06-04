<?php 
include ("include/header.php"); 
?>
        
        <div id="contact-middle-main">
        <div id="contact-middle">
        	<div id="contact-top">
            <?php echo $mainObj->outputData(str_replace("images/",$config['siteurl']."images/",$allpages[5]['pageDesc']));  ?>
            
            </div><!--end contact-top -->
        <div id="contact-bottom">
        	<div id="contact-bottomleft">
            	<div id="contactform">
                <div id="contactform-left">
                </div>
                <div id="contactform-mid">
                
                <div id="ctform_box">
            	<form name="frmcontactus" id="frmcontactus" action=""  method="post" onSubmit="return validate_form(this);" >
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
                <div class="contact-bottomright-img"><a href="http://www.facebook.com/home.php?sk=group_149825311756303&ap=1" target="_blank"><img style="padding:10px 0 0 30px;"  src="<?php echo $config['siteurl']; ?>images/contact/facebook.jpg" border="0" /></a></div>
                <div class="contact-bottomright-img">
                <a href="http://twitter.com/#!/PHP_zone" target="_blank"><img style="padding-left:40px;" src="<?php echo $config['siteurl']; ?>images/contact/twitter.jpg " border="0" /></a>
                </div>
                <div class="contact-bottomright-img">
                <a href="#" target="_blank"><img style="padding-left:20px;" src="<?php echo $config['siteurl']; ?>images/contact/skype.jpg" border="0" /></a>
                </div>
                <div class="contact-bottomright-img">
                <a href="onclick="window.open ('http://www.google.com/talk/service/badge/Start?tk=z01q6amlqh72ljjtb8js7dfbd02haeb46m1uf7oj90niv35uo15eopods2159ous6rg4der7j5oq7rmajb0lf2lu6th00ef6boelio7dnt6bbf4k24sf6fl3jmqspn5tlhm8tph4446fsoa0', 'mywindow','location=0,status=1,scrollbars=0, width=300,height=500'); return false;""><img style="padding-left:20px;" src="<?php echo $config['siteurl']; ?>images/contact/gtalk.jpg" border="0" /></a>
                </div>
            </div>   <!--end contact-bottomleft -->     
        </div><!--end contact-bottom -->          
         
        </div><!--end contact-middle -->
        </div><!--end contact-middle-main -->
        

  <?php 
include ("include/footer.php"); 
?>