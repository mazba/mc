<?php
/**
 * Created by PhpStorm.
 * User: HP-14
 * Date: 11/25/2015
 * Time: 12:36 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
<?php
//print_r($MediaInfo);

echo '<h3 class="notice_title">'.$MediaInfo['media_title'].'</h3>';
?>
        <br />

 <div class="col-md-12">
     <p class="notice_details">
     <?php
     if($MediaInfo['file_name']){

   echo '<img style="float: left" width="400" src="'.base_url().'/images/notice/'.$MediaInfo['file_name'].'" alt="'.$MediaInfo['media_title'].'" title="'.$MediaInfo['media_title'].'">';
     }
     echo $MediaInfo['media_detail'];
     ?>
     </p>
 </div>
     </div>

    </div>
