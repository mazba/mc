<?php
/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 1/9/2016
 * Time: 3:39 PM
 */
?>

<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
$user=User_helper::get_user();
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
                     অপেক্ষাকৃত কম মাল্টিমিডিয়া ক্লাসরুম ব্যবহারকারী
                    </div>
                    <div class="clearfix"></div>
                </div>
			<div class="constant">

    <form id="graphclass" action="<?php echo $CI->get_encoded_url('report/institute/lowdistrictgraph'); ?>" method="post">
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
    $month_ini = new DateTime("first day of last month");
    $month_end = new DateTime("last day of last month");

    if($this->input->post('from_date')){
        $from_date=$this->input->post('from_date');
    }
    else{
        //  $from_date='';
        $from_date=$month_ini->format('Y-m-d');
    }

    if($this->input->post('to_date')){
        $to_date=$this->input->post('to_date');
    }
    else{
        //  $to_date='';
        $to_date=$month_end->format('Y-m-d');
    }
    $high_chart_infozilla=Dashboard_helper::get_approved_institute_listzillalow($from_date, $to_date);
  //  $high_chart_infozillalow=Dashboard_helper::get_approved_institute_listzillalow();
    $report_element_caption=$CI->lang->line('ZILLA');
    // $to_date=$this->input->post('to_date');
    $CI->db->select('institute.name institute_name, institute_class_summary.institude_id element_name, institute_class_summary.upazillaid, COUNT(institute_class_summary.institude_id) total');
    $CI->db->where('institute_class_summary.divid='.$user->division);
    $CI->db->where('institute_class_summary.zillaid='.$user->zilla);
    $CI->db->where('institute_class_summary.upazillaid='.$user->upazila);
    $CI->db->group_by('institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
    $CI->db->order_by("total", "ASC");
    $CI->db->limit(10);

    $CI->db->from($CI->config->item('table_class_summary').' institute_class_summary');
    $CI->db->join($CI->config->item('table_institute').' institute', 'institute_class_summary.institude_id=institute.id', 'left');
    $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
    $resultinstitute = $CI->db->get()->result_array();
    date("F j, Y", strtotime($from_date))
    ?>
    <div id="containerzilla"></div>
</div>
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
                text: '<?php //echo $report_caption;?>  অপেক্ষাকৃত কম মাল্টিমিডিয়া ক্লাসরুম ব্যবহারকারী । <?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($from_date)));?> থেকে  <?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($to_date)));?>'
            },

            xAxis: {
                categories: [<?php
                if($resultinstitute):
             $index=0;
             $total_value=0;
             foreach($resultinstitute as $resultinstitutename)
             {

                if($index==0)
                {
                    echo "'".$resultinstitutename['institute_name']."'";
                }
                else
                {
                    echo ",'".$resultinstitutename['institute_name']."'";
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
                min : 0
            },
            plotOptions: {
                series: {
                    pointWidth: 35//width of the column bars irrespective of the chart size
                }
            },
            tooltip: {
                formatter: function() {
                    return this.x +' '+ this.series.name+ '  এর মোট এম এম সি ব্যবহৃত শিক্ষা প্রতিষ্ঠান ' + this.y;
                }
            },
            series:
                [
                    {
                        name : ' মাল্টিমিডিয়া ক্লাসরুমের মাধ্যমে পাঠদান <?php //echo $report_element_caption ?>',
                        //    color: '#542f6c',
                        data: [<?php

                   if($resultinstitute):
                    $index=0;
                    foreach($resultinstitute as $resultinstitutecount)
                    {
                    if($index==0)
                    {
                    echo ($resultinstitutecount['total'] ? $resultinstitutecount['total'] : 0);
                    }
                    else
                    {
                    echo ",".($resultinstitutecount['total'] ? $resultinstitutecount['total'] : 0);
                    }
                    $index++;
                }
                else:
                echo '0';
            endif;
            ?>]
                    },


                ]
        });


    });
</script>
			
		</div>		
</div>
	

