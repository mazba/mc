<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
//print_r($record_info);
//die();


?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('upazila/upazila/index/save') ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $record_info['id'];?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <?php if(($record_info['id'])>0){?>

                <div class="row show-grid " id="division_option">
                    <div class="col-xs-4">
                        <label
                            class="control-label pull-right"><?php echo $CI->lang->line('DIVISION_NAME'); ?></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <p><?=$division['divname']?></p>
                    </div>
                </div>

                <div  class="row show-grid " id="zilla_option">
                    <div class="col-xs-4">
                        <label
                            class="control-label pull-right"><?php echo $CI->lang->line('DISTRICT_NAME'); ?></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <p><?=$zilla['zillaname']?></p>
                        <input  type="hidden" name="zilla" value="<?php echo $zilla['zillaid']?>">
                    </div>
                </div>

            <?php }else{?>
            <div class="row show-grid " id="division_option">
                <div class="col-xs-4">
                    <label
                        class="control-label pull-right"><?php echo $CI->lang->line('DIVISION_NAME'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="division" id="user_division_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown', array('drop_down_options' => $divisions, 'drop_down_default_option' => $default_divisions));
                        ?>
                    </select>
                </div>
            </div>
            <div style="display: <?php echo $display_zillas ? 'block' : 'none'; ?>" class="row show-grid " id="zilla_option">
                <div class="col-xs-4">
                    <label
                        class="control-label pull-right"><?php echo $CI->lang->line('DISTRICT_NAME'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="zilla" id="user_zilla_id" class="form-control">
                        <?php
                        $CI->load_view('dropdown', array('drop_down_options' => $zillas, 'drop_down_default_option' => $default_zillas));
                        ?>
                    </select>
                </div>
            </div>
            <?php }?>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('UPAZILA/THANA'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="name" class="form-control" value="<?php echo $record_info['upazilaname'] ;?>">
                </div>
            </div>
            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('UPAZILA/THANA_ENG'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="name_en" class="form-control" value="<?php echo $record_info['upazilanameeng'] ;?>">
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('GO_CODE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="upazilaid" class="form-control" value="<?php echo $record_info['upazilaid'] ;?>">
                </div>
            </div>







            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?></label>
                </div>

                <div class="col-sm-4 col-xs-8">
                    <select name="status" class="form-control" id="module_options">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_default_option'=>false,'drop_down_options'=>array(array('text'=>$CI->lang->line('INACTIVE'),'value'=>0),array('text'=>$CI->lang->line('ACTIVE'),'value'=>1)),'drop_down_selected'=>$record_info['visible']));
                        ?>
                    </select>
                </div>
            </div>




        </div>

        <div class="clearfix"></div>
    </form>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        turn_off_triggers();


        $(document).on("change", "#user_division_id", function () {
            $("#union_option").hide();
            $("#upazila_option").hide();
            $("#zilla_option").show();

            //$("#user_unioun_id").val("");
            $("#user_upazila_id").val("");
            $("#user_zilla_id").val("");
            var division_id = $(this).val();
            if (division_id > 0) {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('common/get_zilla'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data: {division_id: division_id},
                    success: function (data, status) {

                    },
                    error: function (xhr, desc, err) {
                        console.log("error");

                    }
                });
            }
            else {
                $("#zilla_option").hide();

            }
        });
        $(document).on("change", "#user_zilla_id", function () {
            $("#union_option").hide();
            $("#upazila_option").show();


            //$("#user_unioun_id").val("");
            $("#user_upazila_id").val("");

            var zilla_id = $(this).val();
            if (zilla_id > 0) {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('common/get_upazila'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data: {zilla_id: zilla_id},
                    success: function (data, status) {

                    },
                    error: function (xhr, desc, err) {
                        console.log("error");

                    }
                });
            }
            else {

                $("#upazila_option").hide();
            }
        });
        <!--        $(document).on("change","#user_upazila_id",function()-->
        <!--        {-->
        <!--            $("#union_option").show();-->
        <!--            $("#user_union_id").val("");-->
        <!--            var zilla_id=$("#user_zilla_id").val();-->
        <!--            var upazila_id=$(this).val();-->
        <!--            if(upazila_id>0)-->
        <!--            {-->
        <!--                $.ajax({-->
        <!--                    url: '-->
        <?php //echo $CI->get_encoded_url('common/get_union'); ?><!--',-->
        <!--                    type: 'POST',-->
        <!--                    dataType: "JSON",-->
        <!--                    data:{zilla_id:zilla_id, upazila_id:upazila_id},-->
        <!--                    success: function (data, status)-->
        <!--                    {-->
        <!---->
        <!--                    },-->
        <!--                    error: function (xhr, desc, err)-->
        <!--                    {-->
        <!--                        console.log("error");-->
        <!---->
        <!--                    }-->
        <!--                });-->
        <!--            }-->
        <!--            else-->
        <!--            {-->
        <!--                $("#union_option").hide();-->
        <!--            }-->
        <!--        });-->
    });
</script>
