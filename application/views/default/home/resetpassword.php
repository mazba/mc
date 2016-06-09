<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();

?>
<div id="system_content" class="system_content_margin">

    <div class='login_form'>

        <div class='login'>
            <h2>পাসওয়ার্ড ভুলে গেছেন<?php //echo $this->lang->line('LOGIN_TITLE');?></h2>

            <form class="form-inline" id="resetpassword_form"
                  action="<?php echo $CI->get_encoded_url('home/resetpassword'); ?>" method="post">

                <div class="form-group">

                    <input class="form-control" placeholder="ইমেইল" type="text" id="email" name="email"/>
                </div>
                <br/><br/>

                <div class="form-group">
                    <label for="captcha"><?php echo $captcha['image']; ?></label>
                </div><br/>
                <div class="form-group">

                    <input class="form-control" placeholder="উপরের কোড লিখুন" type="text" id="userCaptcha" name="userCaptcha"/>
                </div><br/><br/>

                <input type="submit" class="btn btn-primary trtr loginuser" value="পাঠিয়ে দিন "/>
            </form>

        </div>

    </div>
    <!--
    <form id="resetpassword_form" action="<?php echo $CI->get_encoded_url('home/resetpassword'); ?>" method="post">
        
<table width="40%" border="0">
  <tr>
     <td width="5%"><label for="email"> Email</label></td>
     <td width="30%"><div><input class="form-control col-md-9" type="text" id="email" name="email" /></div></td>
    <td width="5%"><input type="submit" class="btn btn-primary trtr" value="Reset" /></td>
  </tr>
</table>
        
	         
			
				
				
					
				
				
				
			
		</form>
  -->
</div> 