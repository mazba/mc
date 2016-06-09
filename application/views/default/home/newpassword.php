<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

?>
<?php
//print_r($userinfo);
?>
<div id="system_content" class="system_content_margin">
 
    <form id="resetpassword_form" action="<?php echo $CI->get_encoded_url('home/recoversave'); ?>" method="post">
    <div class="control-group">
<label for="email"> New Password:</label>
<input  type="text" id="password" name="password" />
    </div>
        
        <div class="control-group">
	<label for="email"> Re Type New Password:</label>
        <input type="password" id="repassword" name="repassword" />
	</div>
        <input type="hidden" name="userid" value="<?php echo $userinfo['id'];?>"> 
        <input type="submit" class="btn btn-primary" value="Save" />
    </form>
</div>