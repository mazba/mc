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
                    <div class="title">  প্রোফাইল আপডেট
                    </div>

                    <div class="clearfix"></div>

                </div>
                <form id="registration_save_form"
                      action="<?php echo $CI->get_encoded_url('institute_location_update/institute_location_update/profile_update'); ?>" method="post">

                    <div class="row show-grid " id="">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('SCHOOL_NAME_BN'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" class="form-control" name="name_bn" value="<?=$userInfo['name_bn']?>">
                        </div>
                    </div>

                    <div class="row show-grid " id="">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('SCHOOL_NAME_EN'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" class="form-control" name="name_en" value="<?=$userInfo['name_en']?>">
                        </div>
                    </div>

                    <div class="row show-grid " id="division_option">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('DIVISION_NAME'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <select name="division" id="user_division_id" class="form-control">
                                <?php
                                $CI->load_view('dropdown',array('drop_down_options'=>$divisions,'drop_down_default_option'=>$default_divisions));
                                ?>
                            </select>
                        </div>
                    </div>
                    <div style="display: <?php echo $display_zillas?'block':'none'; ?>" class="row show-grid " id="zilla_option">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('DISTRICT_NAME'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <select name="zilla" id="user_zilla_id" class="form-control">
                                <?php
                                $CI->load_view('dropdown',array('drop_down_options'=>$zillas,'drop_down_default_option'=>$default_zillas));
                                ?>
                            </select>
                        </div>
                    </div>
                    <div style="display: <?php echo $display_upazilas?'block':'none'; ?>" class="row show-grid " id="upazila_option">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('UPAZILLA_NAME'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <select name="upazilla" id="user_upazila_id" class="form-control">
                                <?php
                                $CI->load_view('dropdown',array('drop_down_options'=>$upazilas,'drop_down_selected'=>$usr_upazila));
                                ?>
                            </select>
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