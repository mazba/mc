<?php
/**
 * Created by PhpStorm.
 * User: HP-14
 * Date: 11/25/2015
 * Time: 1:33 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <h3 class="notice_title">বিজ্ঞপ্তি</h3>
        <?php
        $CI =& get_instance();
        $this->db->select('media.*');
        $this->db->from($CI->config->item('table_media')." media");
        $media_list = $this->db->get()->result_array();
        echo '<ul class="listnotice list-group">';
        foreach($media_list as $media) {

        //   }
        ?>
            <li class="list-group-item"><div class="col-md-6"> <a href="<?php echo base_url().'home/noticeview/'.$media['id']; ?>"><strong><?php echo  $media['media_title'];?></strong></a></div><div class="col-md-5"> <span><?php echo Dashboard_helper::bn2enNumbermonth(date("d F Y", $media['create_date'])); ?></span></div></li>
            <?php
        }
        echo '</ul>';
        ?>
        <?php


        ?>
    </div>
    </div>
