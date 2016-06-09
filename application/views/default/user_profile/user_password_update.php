<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
?>
<div id="system_content" class="system_content_margin">


    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('user_profile/user_info_update/index/savePassword'); ?>"
          method="post">
        <input type="hidden" name="id" value="<?php if (isset($userInfo['id'])) {
            echo $userInfo['id'];
        } else {
            echo 0;
        } ?>"/>
        <input type="hidden" name="system_save_new_status" id="system_save_new_status" value="0"/>

        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

<!---->
<!--            <div style="" class="row show-grid " id="">-->
<!--                <div class="col-xs-4">-->
<!--                    <label class="control-label pull-right">--><?php //echo $CI->lang->line('CURRENT_PASSWORD'); ?><!--<span-->
<!--                            style="color:#FF0000">*</span></label>-->
<!--                </div>-->
<!--                <div class="col-sm-4 col-xs-8">-->
<!--                    <input type="password" name="user_detail[CURRENT_password]" id="" class="form-control" value="">-->
<!--                </div>-->
<!--            </div>-->

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('PASSWORD'); ?><span
                            style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="password" name="user_detail[password]" id="" class="form-control" value="">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('CONFIRM_PASSWORD'); ?><span
                            style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="password" name="user_detail[confirm_password]" id="" class="form-control" value="">
                </div>
            </div>




            <div class="row show-grid">
                <div class="col-xs-1 col-xs-offset-4">
                    <input type="submit" class="myButton" id="saveRegistration" name="saveRegistration"
                           value="<?php echo $this->lang->line('UPDATE'); ?>"/>
                </div>
                <div class="col-xs-1">

                    <a href="<?php echo base_url() ?>/home/dashboard/"
                       class="myButton"><?php echo $this->lang->line('DISCARD'); ?> </a>
                </div>
            </div>
        </div>
    </form>
</div>
