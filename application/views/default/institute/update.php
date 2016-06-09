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
    <div id="system_action_button_container" class="system_action_button_container">

    </div>
    <div class="clearfix"></div>

    <form id="system_save_form"
          action="<?php echo $CI->get_encoded_url('institute/institute/index/updateinfo/' . $institute['id'] . ''); ?>"
          method="post">
        <?php //echo $institute['id']?>

        <table width="100%" border="0" class="table">
            <tr>
                <td width="25%"><strong><?php echo $CI->lang->line('SCHOOL_NAME'); ?><strong></td>
                <td width="25%"> <?php echo $institute['name'] ?></td>
                <td width="25%"><strong><?php echo $CI->lang->line('SCHOOL_EM'); ?><strong></td>
                <td width="25%"><input type="text" id="code" name="code" value="<?php echo $institute['code'] ?>"></td>
            </tr>

            <tr>
                <td><strong><?php echo $CI->lang->line('SCHOOL_EMAIL'); ?><strong></td>
                <td><?php echo $institute['email'] ?></td>
                <td><strong><?php echo $CI->lang->line('SCHOOL_MOBILE'); ?> <strong></td>
                <td><?php echo $institute['mobile'] ?></td>
            </tr>

            <tr>
                <td><strong><?php echo $CI->lang->line('EDUCATION_TYPE'); ?><strong></td>
                <td><?php if ($institute['education_type_ids'] == 1) {
                        echo 'সাধারণ শিক্ষা';
                    } else
                        echo 'মাদ্রাসা শিক্ষা';
                    ?></td>
                <td><strong><?php echo $CI->lang->line('INSTITUTE_LEVEL'); ?> <strong></td>
                <td>
                    <?php
                    if ($institute['is_primary'] == 1) {
                        $dataa = array(
                            'name' => 'is_primary',
                            'id' => 'is_primary',
                            'value' => '1',
                            'checked' => TRUE,
                            'style' => '',
                        );

                        echo form_checkbox($dataa);
                    } else {

                        $dataa = array(
                            'name' => 'is_primary',
                            'id' => 'is_primary',
                            'value' => '1',
                            'checked' => false,
                            'style' => '',
                        );

                        echo form_checkbox($dataa);
                    }

                    echo $CI->lang->line('PRIMARY');

                    if ($institute['is_secondary'] == 1) {
                        $dataa = array(
                            'name' => 'is_secondary',
                            'id' => 'is_secondary',
                            'value' => '1',
                            'checked' => TRUE,
                            'style' => '',
                        );

                        echo form_checkbox($dataa);
                    } else {
                        $dataa = array(
                            'name' => 'is_secondary',
                            'id' => 'is_secondary',
                            'value' => '1',
                            'checked' => false,
                            'style' => '',
                        );

                        echo form_checkbox($dataa);

                    }

                    echo $CI->lang->line('SECONDARY');

                    if ($institute['is_higher'] == 1) {
                        $dataa = array(
                            'name' => 'is_higher',
                            'id' => 'is_higher',
                            'value' => '1',
                            'checked' => TRUE,
                            'style' => '',
                        );
                    } else {
                        $dataa = array(
                            'name' => 'is_higher',
                            'id' => 'is_higher',
                            'value' => '1',
                            'checked' => FALSE,
                            'style' => '',
                        );
                    }


                    echo form_checkbox($dataa);
                    echo $CI->lang->line('HIGHER');
                    ?>
                    <?php
                    /*
                    if ($institute['is_primary'] == 1) {
                        echo 'প্রাথমিক';
                    }


                    if ($institute['is_secondary'] == 1) {
                        echo 'মাধ্যমিক';
                    }


                    if ($institute['is_higher'] == 1) {
                        echo ' উচ্চমাধ্যমিক ';
                    }
                    */
                    ?>

                </td>
            </tr>

            <tr>
                <td></td>
                <td>

                </td>
                <td>
                    <input type="hidden" value="<?php echo $institute['id']; ?>" name="instituteid"/>
                    <input type="submit" style="cursor:pointer; margin-right: 37px !important;" class="myButton"
                           id="saveRegistration" name="saveRegistration"
                           value="<?php echo $this->lang->line('UPDATE'); ?>"/>
                    <a href="<?php echo base_url() ?>/institute/institute/index/update"
                       class="myButton"><?php echo $this->lang->line('DISCARD'); ?> </a>
                </td>

                <td></td>
            </tr>
        </table>
    </form>
</div>
