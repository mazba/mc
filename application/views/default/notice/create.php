<?php
/**
 * Created by PhpStorm.
 * User: HP-14
 * Date: 11/24/2015
 * Time: 8:46 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
<div class="col-md-2">

</div>
        <div class="col-md-10">
            <?php

            $data = array(
                'name'        => 'title',
                'id'          => 'title',

                'style'       => 'width:50%',
            );

            echo form_input($data);

            ?>
        </div>



        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            <?php

            $data = array(
                'name'        => 'content',
                'id'          => 'content',

                'style'       => 'width:50%',
            );

            echo form_textarea($data);

            ?>
        </div>


        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            <?php

            $data = array(
                'name'        => 'publish_date',
                'id'          => 'publish_date',
                'class'          => 'datepicker',

                'style'       => 'width:50%',
            );

            echo form_input($data);

            ?>
        </div>

        <input type="submit" style="cursor:pointer; margin-right: 37px !important; float: left; margin-left: 10px;" class="myButton" id="submitRegistration" name="submitRegistration" value="<?php echo $this->lang->line('SAVE');?>" />
        </div>
    </div>
<script>

    $(document).ready(function(){
        $('.datepicker').Zebra_DatePicker();
    });
</script>