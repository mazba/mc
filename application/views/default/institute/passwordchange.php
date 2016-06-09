<?php
/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 1/4/2016
 * Time: 1:14 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
?>


<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <div class="grid_10" style="margin-bottom: 20px;">


            <div class="row widget">
                <div class="widget-header">
                    <div class="title">পাসওয়ার্ড পরিবর্তন
                    </div>

                    <div class="clearfix"></div>

                </div>
                <form id="registration_save_form"
                      action="<?php echo $CI->get_encoded_url('institute/institute/passwordchange'); ?>" method="post">

                    <div style="" class="row show-grid " id="">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('OLD_PASSWORD'); ?><span
                                    style="color:#FF0000">*</span></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <?php
                            $data = array(
                                'name' => 'oldpassword',
                                'id' => 'oldpassword',
                                'class' => 'form-control',
                                'placeholder' => $CI->lang->line('OLD_PASSWORD'),
                                'size' => '60',
                            );

                            echo form_password($data);
                            ?>
                        </div>

                    </div>

                    <div style="" class="row show-grid " id="">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('NEW_PASSWORD'); ?><span
                                    style="color:#FF0000">*</span></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <?php
                            $data = array(
                                'name' => 'newpassword',
                                'id' => 'newpassword',
                                'class' => 'form-control',
                                'placeholder' => $CI->lang->line('NEW_PASSWORD'),
                                'size' => '60',
                            );

                            echo form_password($data);
                            ?>
                        </div>

                    </div>
                    <div style="" class="row show-grid " id="">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('RE_NEW_PASSWORD'); ?>
                                <span style="color:#FF0000">*</span></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <?php
                            $data = array(
                                'name' => 'newrepassword',
                                'id' => 'newrepassword',
                                'class' => 'form-control',
                                'placeholder' => $CI->lang->line('RE_NEW_PASSWORD'),
                                'size' => '60',
                            );

                            echo form_password($data);
                            ?>
                        </div>
                    </div>


                    <div class="row show-grid">
                        <div class="col-xs-1 col-xs-offset-4">

                            <input type="submit" style="cursor:pointer; "
                                   class="myButton" id="submitRegistration" name="submitRegistration"
                                   value="<?php echo $this->lang->line('UPDATE'); ?>"/>
                        </div>

                    </div>

                </form>
            </div>


        </div>
    </div>
</div>
