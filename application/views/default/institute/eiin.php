<?php
/**
 * Created by jibon.
 * User: jibon
 * Date: 11/24/2015
 * Time: 4:08 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
//print_r($institute);
$user = User_helper::get_user();
// $user_id = $user->id;
//echo $user->id;
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <div style="margin-bottom: 50px; overflow: hidden">
        <form id="registration_save_form" action="<?php echo $CI->get_encoded_url('institute/institute/eiin'); ?>" method="post">
        <div class="col-md-4">
            <strong>  <?php echo $this->lang->line('INSTITUTE_NAME');?></strong>
        </div>
        <div class="col-md-8">
           <?php echo $institute['name'];?>
        </div>


        <div class="col-md-4">
          <strong><?php echo $this->lang->line('INSTITUTE_EMAIL');?></strong>
        </div>
        <div class="col-md-8">
            <?php echo $institute['email'];?>
        </div>


        <div class="col-md-4">
          <strong><?php echo $this->lang->line('SCHOOL_MOBILE');?></strong>
        </div>
        <div class="col-md-8">
            <?php echo $institute['mobile'];?>
        </div>


        <div class="col-md-4">
           <strong><?php echo $this->lang->line('SCHOOL_EM');?></strong>
        </div>
        <div class="col-md-8">
            <?php //echo form_input('username', 'johndoe');
            $data = array(
                'name'        => 'eiin',
                'id'          => 'eiin',
                'size'        => '50',
                'style'       => 'width:25%',
            );

            echo form_input($data);
            ?>
        </div>
            <div class="col-md-4">
                <?php //echo $institute['id']; ?>
            </div>
            <div class="col-md-8">
                <input type="submit" style="cursor:pointer; margin-right: 37px !important;" class="myButton" id="saveEIIN" name="saveEIIN" value="<?php echo $this->lang->line('SAVE'); ?>" />
            </div>
            <input type="hidden" value="<?php echo $institute['id']; ?>" name="instituteid" id="instituteid"/>

        </form>
        </div>
    </div>
    </div>