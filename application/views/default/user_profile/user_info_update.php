<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
?>

<div id="system_content" class="system_content_margin">


    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('user_profile/user_info_update/index/save'); ?>"
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



            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NAME_BN'); ?><span
                            style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[name_bn]" class="form-control"
                           value="<?php echo $userInfo['name_bn']; ?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('USER_NAME'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <label class="control-label"> <?php echo $userInfo['username']; ?></label>

                </div>
            </div>


            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('EMAIL'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                   <label class="control-label"><?php echo $userInfo['email']; ?></label>
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('PHONE_NUMBER'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[phone]" class="form-control"
                           value="<?php echo $userInfo['phone']; ?>">
                </div>
            </div>
            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('OFFICE_PHONE_NUMBER'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[office_phone]" class="form-control"
                           value="<?php echo $userInfo['office_phone']; ?>">
                </div>
            </div>
            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MOBILE_NUMBER'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[mobile]" class="form-control"
                           value="<?php echo $userInfo['mobile']; ?>">
                </div>
            </div>



            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('PRESENT_ADDRESS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[present_address]" class="form-control"
                           value="<?php echo $userInfo['present_address']; ?>">
                </div>
            </div>

            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('PERMANENT_ADDRESS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[permanent_address]" class="form-control"
                           value="<?php echo $userInfo['permanent_address']; ?>">
                </div>
            </div>
            <div style="" class="row show-grid " id="">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('NATIONAL_ID'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="user_detail[national_id_no]" class="form-control"
                           value="<?php echo $userInfo['national_id_no']; ?>">
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
                <div class="col-xs-1">

                    <button id="excel_download"class=" myButton "><?php echo $this->lang->line('Excel'); ?> </button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(document).off("click", "#excel_download");
        //  $( "#excel_download" ).off( "click");
        $(document).on('click', '#excel_download', function() {
            window.open("<?php echo $CI->get_encoded_url('Independent/get_student_excel_file') ?>");
        });
    })

</script>