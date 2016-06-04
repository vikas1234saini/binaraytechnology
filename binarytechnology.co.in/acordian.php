<?php 
$alltestimonial 	= $mainObj->getTestimonial();
$allnews 	= $mainObj->getNews();
//print_r($allnews);
?>
<div class="right-middlediv-index">
        <div class="arrowlistmenu">
        
          <div class="menuheader expandable">Call Back Request</div>
          <ul class="categoryitems">
            <li><table width="225" border="0" style="padding-top:20px;">
            <form name="frmcontactus" id="frmcontactus" action=""  method="post" onsubmit="return validate_form(this);" >
  <tr>
    <td>Name</td>
    <td>
      <input type="text" name="txtYourName" id="txtYourName" title="Your Name::Please Enter your name." />
   </td>
  </tr>
  <tr>
    <td>Email </td>
    <td><input type="text" name="txtEmail" id="txtEmail" title="Email::Please enter Email." /></td>
  </tr>
  <tr>
    <td>Subject</td>
    <td><input type="text" name="txtSubject" id="txtSubject" title="Subject::Please enter subject." /></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input type="text" name="txtPhone" id="txtPhone" title="Subject::Please enter Phone Number." /></td>
  </tr>
  <tr>
    <td style="vertical-align:top">Message</td>
    <td>
      <textarea name="txtMessge" id="txtMessge" cols="17" rows="5"></textarea>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input type="submit" value="Call Me" name="btncontact" /><input name="addcontact" value="addcontact" id="addcontact" type="hidden" /> </td>
  </tr>
  </form>
</table>          
            </li>
          </ul>
          <div class="menuheader expandable">Testimonial</div>
          <ul class="categoryitems">
            <li>
            <p style="font:bold 14px Arial, Helvetica, sans-serif; padding:10px 0 0px 0; color:#4b4b4b; width:200px; margin:0 auto 0 auto;"><?php echo $alltestimonial[0]['testimonialName']; ?></p>
            <p style="font: 14px Arial, Helvetica, sans-serif; padding:0px 0 10px 0; color:#4b4b4b; width:200px; margin:0 auto 0 auto;"><?php echo $alltestimonial[0]['testimonialDesc']; ?><a href="testimonial.php">View All</a></p>
            
            </li>
          </ul>
          <div class="menuheader expandable">Get in touch with Us</div>
          <ul class="categoryitems">
            <li>
               <div class="contact_right">
                    <a href="#" target="_blank" ><img src="images/accordiancontact/orkut.jpg" border="0" /></a><div><a href="#" target="_blank">Orkut</a></div>
                </div>
                <div class="contact_right">
                    <a href="http://www.facebook.com/home.php?sk=group_149825311756303&ap=1" target="_blank" ><img src="images/accordiancontact/facebook.jpg" border="0" /></a><div><a href="http://www.facebook.com/home.php?sk=group_149825311756303&ap=1" target="_blank">Facebook</a></div>
                </div>
                  <div class="contact_right">
                    <a href="http://twitter.com/#!/PHP_zone" target="_blank" ><img src="images/accordiancontact/twitter.jpg" border="0" /></a><div><a href="http://twitter.com/#!/PHP_zone" target="_blank">Twitter</a></div>
                </div>
                <div class="contact_right">
                    <a href="#" target="_blank" ><img src="images/accordiancontact/linkedin.jpg" border="0" /></a><div><a href="#" target="_blank">Linkedin</a></div>
                </div> 
                
            </li>
            <li>
            	
             
             
      
                
            </li>
          </ul>
         
      </div>