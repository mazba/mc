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
          action="<?php echo $CI->get_encoded_url('institute_location_update/institute_location_update/index/updateinfo/' . $institute['id'] . ''); ?>"
          method="post">
        <?php //echo $institute['id']?>

        <table width="100%" border="0" class="table">

            <tbody>
            <tr>
                <td width="" colspan="2"><strong><?php echo $CI->lang->line('SCHOOL_NAME'); ?><strong>: &nbsp;<?php echo $institute['name'] ?></td>

            <tr>
                <td width="%" colspan="2"><strong><?php echo $CI->lang->line('SCHOOL_EM'); ?>:&nbsp;<?php echo $institute['code'] ?><strong></td>
            </tr>


            <tr>
                <td colspan="2"><strong><?php echo $CI->lang->line('SCHOOL_EMAIL'); ?><strong>: &nbsp;<?php echo $institute['email'] ?></td>
            </tr>
            <tr>
                <td colspan="2"><strong><?php echo $CI->lang->line('SCHOOL_MOBILE'); ?></strong>: &nbsp;<?php echo $institute['mobile'] ?> <strong></td>
            </tr>

            <tr>
                <td width="50%"><strong><?php echo $CI->lang->line('DIVISION_NAME'); ?></strong>: &nbsp;<?php echo " " . $institute['divname'] ?></td>
                <td width="50%">
                    <strong><?php echo $CI->lang->line('DIVISION_NAME'); ?></strong>:<span style="color:#FF0000">*</span>
                    <select name="division" id="user_division_id" class="">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$divisions,'drop_down_default_option'=>$default_divisions));
                        ?>
                    </select>
                </td>

            </tr>
            <tr>
                <td><strong><?php echo $CI->lang->line('ZILLA_NAME'); ?></strong>: &nbsp; <?php echo " " . $institute['zillaname'] ?> </td>
                <td>
                   <strong><?php echo $CI->lang->line('ZILLA_NAME'); ?></strong>:<span style="color:#FF0000">*</span>
                    <select name="zilla" id="user_zilla_id" >
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$zillas,'drop_down_default_option'=>$default_zillas));
                        ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td><strong><?php echo $CI->lang->line('UPAZILA/THANA'); ?></strong>: &nbsp; <?php echo " " . $institute['upazilaname'] ?></td>
                <td>
                    <strong><?php echo $CI->lang->line('UPAZILA/THANA'); ?></strong>:<span style="color:#FF0000">*</span>
                    <select name="upazilla" id="user_upazila_id" class="">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_options'=>$upazilas,'drop_down_default_option'=>$default_upazilas));
                        ?>
                    </select>
                </td>
            </tr>




            <tr>

                <td colspan="2" style="text-align: center">
                    <input type="hidden" value="<?php echo $institute['id']; ?>" name="instituteid"/>
                    <input type="submit" style="cursor:pointer; margin-right: 37px !important;" class="myButton"
                           id="saveRegistration" name="saveRegistration"
                           value="<?php echo $this->lang->line('UPDATE'); ?>"/>
                    <a href="<?php echo base_url() ?>/institute_location_update/institute_location_update/index/update"
                       class="myButton"><?php echo $this->lang->line('DISCARD'); ?> </a>
                </td>

            </tr>
            </tbody>
        </table>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        $(document).on("change","#user_division_id",function()
        {
            $("#union_option").hide();
            $("#upazila_option").hide();
            $("#zilla_option").show();

            //$("#user_unioun_id").val("");
            $("#user_upazila_id").val("");
            $("#user_zilla_id").val("");
            var division_id=$(this).val();
            if(division_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id:division_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {
                $("#zilla_option").hide();

            }
        });
        $(document).on("change","#user_zilla_id",function()
        {
            $("#union_option").hide();
            $("#upazila_option").show();


            //$("#user_unioun_id").val("");
            $("#user_upazila_id").val("");

            var zilla_id=$(this).val();
            if(zilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('common/get_upazila'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zilla_id:zilla_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {

                $("#upazila_option").hide();
            }
        });

    });
</script>

<script type="text/javascript">
    var select_option="<option value=''><?php echo $this->lang->line('SELECT');?></option>";
    function reset_all_element(division, zilla, upazila, union, city_corporation, city_corporation_word, municipal, municipal_word)
    {
        if(division==1)
        {
            $("#user_division_id").val('');
        }
        else
        {

        }
        if(zilla==1)
        {
            $("#user_zilla_id").html('');
            $("#user_zilla_id").html(select_option);
        }
        else
        {

        }
        if(upazila==1)
        {
            $("#user_upazila_id").html('');
            $("#user_upazila_id").html(select_option);
        }
        else
        {

        }
        if(union==1)
        {
            $("#user_unioun_id").html('');
            $("#user_unioun_id").html(select_option);
        }
        else
        {

        }

        if(city_corporation==1)
        {
            $("#user_citycorporation_id").html('');
            $("#user_citycorporation_id").html(select_option);
        }
        else
        {

        }

        if(city_corporation_word==1)
        {
            $("#user_city_corporation_ward_id").html('');
            $("#user_city_corporation_ward_id").html(select_option);
        }
        else
        {

        }

        if(municipal==1)
        {
            $("#user_municipal_id").html('');
            $("#user_municipal_id").html(select_option);
        }
        else
        {

        }
        if(municipal_word==1)
        {
            $("#user_municipal_ward_id").html('');
            $("#user_municipal_ward_id").html(select_option);
        }
        else
        {

        }

        $("#uisc_name_load").html('');
    }

</script>