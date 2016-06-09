    <?php
    /**
     * Copyright (C) Softbd Ltd.
     * URL: http://softbdltd.com
     * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
     * Created by PhpStorm.
     * User: HP-14
     * Date: 1/21/2016
     * Time: 1:13 PM
     */
    $CI=& get_instance();
    $month_ini = new DateTime("first day of last month");
    $month_end = new DateTime("last day of last month");
    $user=User_helper::get_user();
    if($this->input->post('from_date')){
        $from_date=$this->input->post('from_date');
    }
    else{

      //  $from_date=$month_ini->format('Y-m-d');
        $date=date('Y-m-d');
        $from_date = date('Y-m-d', strtotime($date .' -1 day'));
    }

    if($this->input->post('to_date')){
        $to_date=$this->input->post('to_date');
    }
    else{

      //  $to_date=$month_end->format('Y-m-d');
         $to_date= date('Y-m-d');

    }

    $high_chart_infozilla=Dashboard_helper::get_approved_institute_report_school_college('INTERMEDIATE', $from_date, $to_date, 'DESC');
    //
    //if($chart_infozilla):
    //    $index=0;
    //    $total_value=0;
    //    foreach($chart_infozilla as $elementzilla)
    //    {
    //        $total_value+=$elementzilla['element_value'];
    //        $element_name = Dashboard_helper::get_div_zilla_zillagraphn($elementzilla['element_name']);
    //        if($index==0)
    //        {
    //            echo "'".$element_name."'";
    //        }
    //        else
    //        {
    //            echo ",'".$element_name."'";
    //        }
    //        $index++;
    //    }
    //else:
    //    echo "0";
    //endif;


    //
    //                   if($high_chart_infozilla):
    //                       $index=0;
    //                       foreach($high_chart_infozilla as $elementzillas)
    //                       {
    //
    //
    //                               echo $elementzillas['element_value'] .'--';
    //
    //                       }
    //
    //                   endif;
    //

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
                        <?php
                        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID') || $user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
                        {
                            $report_caption= $CI->lang->line('HIGH_SSC_HSC_MMC_DISTRICT_INSTITUTE');
                        }
                        elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
                        {
                        $report_caption= $CI->lang->line('HIGH_SSC_HSC_MMC_UPOZILLA_INSTITUTE');
                        }
                        else{
                        $report_caption= $CI->lang->line('HIGH_SSC_HSC_MMC_INSTITUTE_INSTITUTE');
                        }
                        ?>
                        <?php echo $report_caption; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>

    <div class="constant">

    <form id="graphclass" action="<?php echo $CI->get_encoded_url('report/institute/mmcedu_level/school_college_high_mmc'); ?>" method="post">
        <div class="row show-grid ">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('FROM_DATE'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" required="" name="from_date" class="selectbox-1 form-control report_date" value="<?php if($this->input->post('from_date')) { echo $this->input->post('from_date'); }?>" />
            </div>
        </div>
        <div class="row show-grid ">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('TO_DATE'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="to_date" required="" class="selectbox-1 form-control report_date" value="<?php if($this->input->post('to_date')) { echo $this->input->post('to_date'); }?>" />
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

    </div>
    <div id="containerzilla"></div>
    <script>
        $(function () {
            $( ".report_date" ).datepicker({dateFormat : display_date_format});

            $('#containerzilla').highcharts({
                chart: {
                    type: 'column',
                    backgroundColor: '#fef4e5',

                },

                credits: {
                    enabled: false
                },
                title: {
                    text: '<?php //echo $report_caption;?> <?php echo $report_caption; ?><?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($from_date)));?> থেকে  <?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($to_date)));?>'
                },

                xAxis: {
                    categories: [<?php
                    if($high_chart_infozilla):
                 $index=0;
                 $total_value=0;
                 foreach($high_chart_infozilla as $elementzilla)
                 {
                    $total_value+=$elementzilla['element_value'];
                    $element_name = Dashboard_helper::get_div_zilla_zillagraphn($elementzilla['element_name']);
                    if($index==0)
                    {
                        echo "'".$element_name."'";
                    }
                    else
                    {
                        echo ",'".$element_name."'";
                    }
                    $index++;
                 }
                 else:
                   echo "0";
             endif;
                ?>]

                },


                yAxis : {
                    title : {
                        text : '<?php echo $CI->lang->line('NUMBER');?>'
                    },
                    min : 0,
                    allowDecimals: false
                },
                plotOptions: {
                    series: {
                        pointWidth: 35//width of the column bars irrespective of the chart size
                    }
                },
    //            tooltip: {
    //                formatter: function() {
    //                    return this.x +' '+ this.series.name+ '  এর মোট এম এম সি ব্যবহৃত শিক্ষা প্রতিষ্ঠান ' + this.y;
    //                }
    //            },
                series:
                    [
                        {
                            name : ' মাল্টিমিডিয়া ক্লাসরুমের মাধ্যমে পাঠদান <?php //echo $report_element_caption ?>',
                            //    color: '#542f6c',
                            data: [<?php

                       if($high_chart_infozilla):
                        $index=0;
                        foreach($high_chart_infozilla as $elementzillast)
                        {
                        if($index==0)
                        {
                        echo ($elementzillast['element_value'] ? $elementzillast['element_value'] : 0);
                        }
                        else
                        {
                        echo ",".($elementzillast['element_value'] ? $elementzillast['element_value'] : 0);
                        }
                        $index++;
                    }
                    else:
                    echo '0';
                endif;
                ?>],
                            tooltip: {
                                formatter: function() {
                                    return '<b>' + this.x + '</b> is <b>' + this.y + '</b>, in series '+ this.series.name;
                                }
                            }
                        },
                        {
                            name : 'মাল্টিমিডিয়া ক্লাসরুম প্রাপ্ত শিক্ষা প্রতিষ্ঠানের সংখ্যা <?php //echo $report_element_caption ?>',
                            //    color: '#542f6c',
                            data: [<?php
                       if($high_chart_infozilla):
                        $indexx=0;
                        foreach($high_chart_infozilla as $elementzillass)
                       {
                       if($indexx==0)
                       {
                       echo $element_name3 = Dashboard_helper::get_district_count_school_college($elementzillass['element_name']);
                    //   echo ($elementzillas['element_value'] ? $elementzillas['element_value'] : 0);
                       }
                      else
                      {
                      echo ",".(Dashboard_helper::get_district_count_school_college($elementzillass['element_name']) ? Dashboard_helper::get_district_count_school_college($elementzillass['element_name']) : 0);
                       }
                       $indexx++;
                   }
                   else:
                    echo '0';
                endif;
              ?>],
                            tooltip: {
                                valueSuffix: ' mm'
                            }
                        }

                    ]
            });


        });
    </script>

    </div>


