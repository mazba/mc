<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

?>

<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user = User_helper::get_user();

?>
<div id="system_content" class="system_content_margin">
    <div class="col-lg-4">
        <?php
        $CI->load_view("report/report_menus");
        ?>

    </div>
        <div class="col-lg-8">
            <div class="widget-header">
                <div class="title">
                    মাসিক প্রতিবেদনঃ
                    <?php

                    if($user->user_group_id == $CI->config->item('USER_GROUP_INSTITUTE')){

                    } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') ||
                        $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')
                    ) {echo  System_helper::get_user_division_district_upozila_name()." উপজেলার মাল্টিমিডিয়া ক্লাসরুমের চিত্র";
                    }elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')){
                        echo   System_helper::get_user_division_district_upozila_name()." জেলার মাল্টিমিডিয়া ক্লাসরুমের চিত্র";
                    }elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') ||
                        $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3') ){
                        echo   System_helper::get_user_division_district_upozila_name()." বিভাগএর সকল জেলার মাল্টিমিডিয়া ক্লাসরুমের চিত্র";
                    }else{
                        echo "সকল জেলার মাল্টিমিডিয়া ক্লাসরুমের চিত্র";
                    }
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="constant">

                <form id="graphclass" action="<?php echo $CI->get_encoded_url('report/report_home'); ?>" method="post">
                    <div class="row show-grid ">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('FROM_DATE'); ?><span
                                    style="color:#FF0000">*</span></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" required="" name="from_date" class="selectbox-1 form-control report_date"
                                   value="<?php if ($this->input->post('from_date')) {
                                       echo $this->input->post('from_date');
                                   } ?>"/>
                        </div>
                    </div>
                    <div class="row show-grid ">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('TO_DATE'); ?><span
                                    style="color:#FF0000">*</span></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" name="to_date" required="" class="selectbox-1 form-control report_date"
                                   value="<?php if ($this->input->post('to_date')) {
                                       echo $this->input->post('to_date');
                                   } ?>"/>
                        </div>
                    </div>
                    <div class="row show-grid">
                        <div class="col-xs-4">

                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="submit" class="btn btn-primary" value="<?php echo $CI->lang->line('SEARCH'); ?>">
                        </div>
                    </div>
                </form>

                <!-- মাল্টিমিডিয়া ক্লাসরুমের কার্যক্রমের বিস্তারিত রিপোর্ট -->
                <div class="table-responsive">
                    <center>
                        <h4>      <?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($from_date))); ?>
                            থেকে <?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($to_date))); ?></h4>
                    </center>
                    <?php



                    if($user->user_group_id == $CI->config->item('USER_GROUP_INSTITUTE')){

                    }
                    elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') ||
                        $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')
                    ) {
                        ?>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ক্রমিক নং</th>
                                <th>প্রতিষ্ঠানের নাম</th>
                                <th>মাল্টিমিডিয়া ক্লাসরুম সংখ্যা</th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ii = 1;
                            foreach ($report as $row) {
                            ?>
                            <tr>
                                <td scope="row"><?php echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                                <td><?php echo $row['institutename']; ?></td>
                                <td style="text-align: center"><?php //echo $row['no_of_subjects']; ?><?php echo Dashboard_helper::bn2enNumbermonth($row['noiftotal']); ?></td>

                                <?php $ii++;
                                } ?>
                            </tbody>
                        </table>
                        <?php

                    }
                    elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4'))
                    {?>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ক্রমিক নং</th>
                                <th>উপজেলার নাম</th>
                                <th style="text-align: center">মাল্টিমিডিয়া ক্লাসরুম প্রাপ্ত <br/>শিক্ষা প্রতিষ্ঠানের সংখ্যা
                                </th>
                                <th style="text-align: center">মাল্টিমিডিয়া ক্লাসরুমের মাধ্যমে পাঠদান <br/>(মাসিক/শতকরা গড়)
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ii = 1;
                            foreach ($report as $row) {

                                ?>
                                <tr>
                                    <td scope="row"><?php echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                                    <td><?php echo $row['upazilaname']; ?></td>
                                    <td style="text-align: center">
                                        <?php echo Dashboard_helper::bn2enNumbermonth($row['nub_of_institute']); ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        $number_of_institute = $row['nub_of_institute'];
                                        $total_class = $row['number_per_class'];

                                        if ($total_class > 0):
                                            echo Dashboard_helper::bn2enNumbermonth(number_format((($total_class * 100) / $number_of_institute), 2)) . '%';
                                        else:
                                            echo Dashboard_helper::bn2enNumbermonth($total_class) . '%';
                                        endif;

                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $ii++;
                            }
                            ?>

                            </tbody>
                        </table>
                        <?php
                    }
                    else {
                        ?>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ক্রমিক নং</th>
                                <th>জেলার নাম</th>
                                <th style="text-align: center">মাল্টিমিডিয়া ক্লাসরুম প্রাপ্ত <br/>শিক্ষা প্রতিষ্ঠানের সংখ্যা
                                </th>
                                <th style="text-align: center">মাল্টিমিডিয়া ক্লাসরুমের মাধ্যমে পাঠদান <br/>(মাসিক/শতকরা গড়)
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ii = 1;
                            foreach ($report as $row) {

                                ?>
                                <tr>
                                    <td scope="row"><?php echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                                    <td><?php echo $row['zillaname']; ?></td>
                                    <td style="text-align: center">
                                        <?php echo Dashboard_helper::bn2enNumbermonth($row['nub_of_institute']); ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        $number_of_institute = $row['nub_of_institute'];
                                        $total_class = $row['number_per_class'];
                                        //echo  $total_class;

                                        if ($total_class > 0):
                                            echo Dashboard_helper::bn2enNumbermonth(number_format((($total_class * 100) / $number_of_institute), 2)) . '%';
                                        else:
                                            echo Dashboard_helper::bn2enNumbermonth($total_class) . '%';
                                        endif;
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $ii++;
                            }
                            ?>

                            </tbody>
                        </table>
                        <?php

                    }
                    ?>
                </div>
            </div>


        </div>
</div>
<script>
    $(function () {
        $(".report_date").datepicker({dateFormat: display_date_format});
    });
    //    $( document ).ready(function() {
    //        $.ajax({
    //            url: '<?php //echo $CI->base_url('report/report_home/get_all'); ?>//',
    //            type: 'POST',
    //            dataType: "JSON",
    //            data:{assign_id:assignId},
    //            success: function (data, status)
    //            {
    //                console.log(data);
    //            },
    //            error: function (xhr, desc, err)
    //            {
    //                console.log("error");
    //
    //            }
    //        });
    //    });
</script>

