<?php
/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 2/16/2016
 * Time: 12:30 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
?>
<div id="system_sidebar_left" class="system_sidebar_left col-sm-1" style="padding-left:0;">&nbsp;</div>
<div id="system_content">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        //$CI->load_view('system_action_buttons');
        ?>
    </div>

    <div id="system_content" class="dashboard-wrapper">
        <div class="grid_10">

            <form action="<?php echo $CI->get_encoded_url('institute/institute/index/search'); ?>" class="signup"
                  method="post" accept-charset="utf-8" enctype="multipart/form-data" id="frm_user_approval">
                <div class="row widget">
                    <div class="widget-header">
                        <div class="title">
                            <?php echo $this->lang->line('INSTITUTE_REGISTRED_SEARCH'); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>

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
                    <div style="display: <?php echo $display_zillas ? 'block' : 'none'; ?>" class="row show-grid "
                         id="zilla_option">
                        <div class="col-xs-4">
                            <label
                                class="control-label pull-right"><?php echo $CI->lang->line('DISTRICT_NAME'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <select name="zilla" id="user_zilla_id" class="form-control">
                                <?php
                                $CI->load_view('dropdown', array('drop_down_options' => $zillas, 'drop_down_default_option' => $default_zillas));
                                ?>
                            </select>
                        </div>
                    </div>
                    <div style="display: <?php echo $display_upazilas ? 'block' : 'none'; ?>" class="row show-grid "
                         id="upazila_option">
                        <div class="col-xs-4">
                            <label
                                class="control-label pull-right"><?php echo $CI->lang->line('UPAZILLA_NAME'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <select name="upazilla" id="user_upazila_id" class="form-control">
                                <?php
                                $CI->load_view('dropdown', array('drop_down_options' => $upazilas, 'drop_down_default_option' => $default_upazilas));
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4">
                            <label
                                class="control-label pull-right"><?php echo $CI->lang->line('INSTITUTE_SEARCH'); ?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" name="email" class=" form-control" value=""/>
                        </div>
                    </div>
                    <!--                <div class="row show-grid ">-->
                    <!--                    <div class="col-xs-4">-->
                    <!--                        <label class="control-label pull-right">-->
                    <?php //echo $CI->lang->line('TYPE'); ?><!--</label>-->
                    <!--                    </div>-->
                    <!--                    <div class="col-sm-4 col-xs-8">-->
                    <!--                        <select name="status" id="status" class="form-control">-->
                    <!--                            --><?php
                    //                            $report_type=array
                    //                            (
                    //                                array("value"=>"", "text"=>$this->lang->line('ALL')),
                    //                                array("value"=>"1", "text"=>$this->lang->line('LEVEL_PRIMARY')),
                    //                                array("value"=>"2", "text"=>$this->lang->line('LEVEL_SECONDARY')),
                    //                                array("value"=>"3", "text"=>$this->lang->line('LEVEL_HIGHER')),
                    //                            );
                    //                            $CI->load_view('dropdown',array('drop_down_options'=>$report_type));
                    //                            ?>
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <!--                </div>-->


                    <div class="row show-grid">
                        <div class="col-xs-4">

                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="submit" id="search" name="1" class="btn btn-primary"
                                   value="<?php echo $CI->lang->line('SEARCH'); ?>">
                            <input type="button" style="cursor:pointer;" id="reset" class="btn btn-primary" name="1"
                                   value="<?php echo $this->lang->line('RESET'); ?>"/>
                        </div>
                    </div>

                </div>

                <div class="clearfix"></div>

            </form>


        <div class="row">
                <div class="col-md-12">


                    <?php
                    if ($this->input->post()):

                        $division = $this->input->post('division');
                        if ($division) {
                            $CI->db->where('institute.divid', $this->input->post('division'));
                        }
                        if ($this->input->post('zilla')) {
                            $CI->db->where('institute.zillaid', $this->input->post('zilla'));
                        }
                        if ($this->input->post('upazilla')) {
                            $CI->db->where('institute.upozillaid', $this->input->post('upazilla'));
                        }

                        if ($this->input->post('email')) {
                            $email = $this->input->post('email');
                            $CI->db->where("(`name` LIKE '%$email%' ESCAPE '!' OR  `email` LIKE '%$email%' ESCAPE '!' OR  `mobile` LIKE '%$email%' ESCAPE '!')");


//            $CI->db->like('name', $this->input->post('email'));
//            $CI->db->or_like('email', $this->input->post('email'));
//            $CI->db->or_like('mobile', $this->input->post('email'));
                        }

                        $CI->db->select('institute.*');
                        $CI->db->from($CI->config->item('table_institute') . ' institute');
                        $CI->db->where('institute.status', 2);
                        $CI->db->order_by("institute.id", "desc");
                        $results = $CI->db->get()->result_array();



                        ?>


                        <table class="table table-bordered table-hover table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="width: 5%" >#</th>
                                <th  style="text-align: center;width: 25%"><?php echo $CI->lang->line('SCHOOL_NAME'); ?></th>
                                <th  style="text-align: center; width: 20% !important"><?php echo $CI->lang->line('EMAIL'); ?></th>
                                <th  style="text-align: center; width: 20%"><?php echo $CI->lang->line('SCHOOL_MOBILE'); ?></th>
                                <th  style="text-align: center; width: 15% "><?php echo $CI->lang->line('EIIN_NUMBER'); ?></th>
                                <th  style="text-align: center; width: 15% "><?php echo $CI->lang->line('ACTION'); ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ii = 1;
                            foreach ($results as $result) {
                                ?>
                                <tr id="tr_<?php echo$result['id']; ?>">
                                    <td><?php echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                                    <td><?php echo $result['name']; ?></td>
                                    <td><?php echo $result['email']; ?></td>
                                    <td><?php echo Dashboard_helper::bn2enNumbermonth($result['mobile']); ?></td>
                                    <td><?php echo $result['code']; ?></td>
                                    <td>  <button class="btn btn-primary" onclick="disable('<?php echo$result['id']; ?>')"><?php echo $CI->lang->line('DISCARD'); ?></button></td>

                                </tr>
                                <?php
                                $ii++;
                            }
                            ?></tbody>
                        </table>
                        <?php
                    endif;
                    ?>
                </div>
            </div>

                <div class="row">
                    <div class="col-lg-12" id="load_list" style="border: 1px solid"></div>
                    <div class="clearfix"></div>
                </div>
        </div>


        <div class="row show-grid popContainer" id="show_data"
             style="height: 400px !important; display: none; overflow-y: auto;">
    <span class="crossSpan">
        <img src="<?php echo base_url() ?>images/xmark.png" style="cursor: pointer;" width="26px" height="26px"/>
    </span>

            <div id="modal_data"></div>
        </div>

        <div id="bgBlack"></div>
<script>
    function disable(id)
    {
        var r=confirm("Can you confirm cancel this?")
        if(r==true)
        {
            //   alert(article_id);
            $.ajax({
                type:"POST",
                url: '<?php echo $CI->get_encoded_url('institute/institute/disableActiveInstitute/'); ?>',
                data: 'id=' + id,
                success: function(result)
                {
                    if(result.delete_status=="DELETE")
                    {
                        $("#tr_"+id).hide();
                    }
                }
            });
        }
        /*else{
            window.location.href = '<?php echo $CI->get_encoded_url('institute/institute/index/search'); ?>';
        }*/
    }
</script>

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

        <script type="text/javascript">
            var select_option = "<option value=''><?php echo $this->lang->line('SELECT');?></option>";
            function reset_all_element(division, zilla, upazila, union, city_corporation, city_corporation_word, municipal, municipal_word) {
                if (division == 1) {
                    $("#user_division_id").val('');
                }
                else {

                }
                if (zilla == 1) {
                    $("#user_zilla_id").html('');
                    $("#user_zilla_id").html(select_option);
                }
                else {

                }
                if (upazila == 1) {
                    $("#user_upazila_id").html('');
                    $("#user_upazila_id").html(select_option);
                }
                else {

                }
                if (union == 1) {
                    $("#user_unioun_id").html('');
                    $("#user_unioun_id").html(select_option);
                }
                else {

                }

                if (city_corporation == 1) {
                    $("#user_citycorporation_id").html('');
                    $("#user_citycorporation_id").html(select_option);
                }
                else {

                }

                if (city_corporation_word == 1) {
                    $("#user_city_corporation_ward_id").html('');
                    $("#user_city_corporation_ward_id").html(select_option);
                }
                else {

                }

                if (municipal == 1) {
                    $("#user_municipal_id").html('');
                    $("#user_municipal_id").html(select_option);
                }
                else {

                }
                if (municipal_word == 1) {
                    $("#user_municipal_ward_id").html('');
                    $("#user_municipal_ward_id").html(select_option);
                }
                else {

                }

                $("#uisc_name_load").html('');
            }

        </script>
