<?php
/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 1/9/2016
 * Time: 1:25 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
$user=User_helper::get_user();
//print_r($data);
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
      ক্লাস অনুযায়ী মাল্টিমিডিয়া ক্লাসরুম ব্যবহারকারী
                    </div>
                    <div class="clearfix"></div>
                </div>
	
<div class="constant">

<form id="graphclass" action="<?php echo $CI->get_encoded_url('report/institute/graphclasses'); ?>" method="post">
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
    <?php
    if($this->input->post('from_date')){
        $from_date=$this->input->post('from_date');
    }
    else{
        $from_date='';
    }

    if($this->input->post('to_date')){
        $to_date=$this->input->post('to_date');
    }
    else{
        $to_date='';
    }

   // $to_date=$this->input->post('to_date');
    ?>

    <div id="containerpie"></div>
</div>
<script>
    $(function () {
        $( ".report_date" ).datepicker({dateFormat : display_date_format});
        $('#containerpie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'ক্লাস অনুযায়ী মাল্টিমিডিয়া ক্লাসরুম ব্যবহারকারী'
            },
            credits: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: "ক্লাস ",
                colorByPoint: true,
                data: [

                    {
                        name: "প্রথম শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(1,$from_date,$to_date); ?>
                    }, {
                        name: "দ্বিতীয় শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(2,$from_date,$to_date); ?>,
                        sliced: true,
                        selected: true
                    }, {
                        name: "তৃতীয় শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(3,$from_date,$to_date); ?>
                    }, {
                        name: "চুতুর্থ শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(4,$from_date,$to_date); ?>
                    }, {
                        name: "পঞ্চম শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(5,$from_date,$to_date); ?>
                    }, {
                        name: "ষষ্ঠ শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(6,$from_date,$to_date); ?>
                    },
                    {
                        name: "সপ্তম শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(7,$from_date,$to_date); ?>
                    },
                    {
                        name: "অষ্টম শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(8,$from_date,$to_date); ?>
                    },
                    {
                        name: "নবম শ্রেণী",
                        y: <?php echo Dashboard_helper::get_classname_count(9,$from_date,$to_date); ?>
                    },
                    {
                        name: "দশম শ্রেণী",
                        y:<?php echo Dashboard_helper::get_classname_count(10,$from_date,$to_date); ?>
                    },
                    {
                        name: "১ম বর্ষ ",
                        y: <?php echo Dashboard_helper::get_classname_count(11,$from_date,$to_date); ?>
                    },
                    {
                        name: "২য় বর্ষ",
                        y: <?php echo Dashboard_helper::get_classname_count(12,$from_date,$to_date); ?>
                    },
                ]
            }]
        });
    });
</script>
	
</div>
				


