<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$CI =& get_instance();
    $high_chart_infozilla=Dashboard_helper::get_approved_institute_listzilla();

	 $high_chart_infozillalow=Dashboard_helper::get_approved_institute_listzillalow();
    $report_element_caption=$CI->lang->line('ZILLA');
	
?>
<div id="system_content" class="system_content_margin">
<?php
    
?>
<div id="containerzilla"></div>
<div id="containerzillalow"></div>
<div id="containerpie"></div>

		</div>
		 <script>
            $(function ()
            {
                $('#containerzilla').highcharts({
                    chart: {
                        type: 'column',
                        backgroundColor: '#fef4e5',

                    },

                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'অপেক্ষাকৃত অধিক মাল্টিমিডিয়া ক্লাসরুম ব্যবহারকারী ১০ জেলা <?php //echo $report_caption;?>  বিশ্লেষণ'
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

                   if($high_chart_infozilla):
                    $index=0;
                    foreach($high_chart_infozilla as $elementzillas)
                    {
                    if($index==0)
                    {
                    echo ($elementzillas['element_value'] ? $elementzillas['element_value'] : 0);
                    }
                    else
                    {
                    echo ",".($elementzillas['element_value'] ? $elementzillas['element_value'] : 0);
                    }
                    $index++;
                }
                else:
                echo '0';
            endif;
            ?>]
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
                    echo $element_name3 = Dashboard_helper::get_district_count($elementzillass['element_name']);
                 //   echo ($elementzillas['element_value'] ? $elementzillas['element_value'] : 0);
                    }
                    else
                    {
                    echo ",".(Dashboard_helper::get_district_count($elementzilla['element_name']) ? Dashboard_helper::get_district_count($elementzilla['element_name']) : 0);
                    }
                    $indexx++;
                }
                else:
                echo '0';
            endif;
            ?>]
                            }

                        ]
                });
				
				
				$('#containerzillalow').highcharts({
                    chart: {
                        type: 'column',
                  //      backgroundColor: '#fef4e5',

                    },

                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'অপেক্ষাকৃত কম মাল্টিমিডিয়া ক্লাসরুম ব্যবহারকারী ১০ জেলা<?php //echo $report_caption;?>  বিশ্লেষণ'
                    },

                    xAxis: {
                        categories: [<?php
                if($high_chart_infozillalow):
             $index=0;
             $total_value=0;
             foreach($high_chart_infozillalow as $elementzillalow)
             {
                $total_value+=$elementzillalow['element_value'];
                $element_name = Dashboard_helper::get_div_zilla_zillagraphn($elementzillalow['element_name']);
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
                                    color: '#d53b2a',
                                data: [<?php

                   if($high_chart_infozillalow):
                    $index=0;
                    foreach($high_chart_infozillalow as $elementzillaslow)
                    {
                    if($index==0)
                    {
                    echo ($elementzillaslow['element_value'] ? $elementzillaslow['element_value'] : 0);
                    }
                    else
                    {
                    echo ",".($elementzillaslow['element_value'] ? $elementzillaslow['element_value'] : 0);
                    }
                    $index++;
                }
                else:
                echo '0';
            endif;
            ?>]
                            },
                            {
                                name : 'মাল্টিমিডিয়া ক্লাসরুম প্রাপ্ত শিক্ষা প্রতিষ্ঠানের সংখ্যা <?php //echo $report_element_caption ?>',
                                //    color: '#542f6c',
                                data: [<?php
                   if($high_chart_infozillalow):
                    $indexx=0;
                    foreach($high_chart_infozillalow as $elementzillaslow)
                    {
                    if($indexx==0)
                    {
                    echo $element_name3 = Dashboard_helper::get_district_count($elementzillaslow['element_name']);
                 //   echo ($elementzillas['element_value'] ? $elementzillas['element_value'] : 0);
                    }
                    else
                    {
                    echo ",".(Dashboard_helper::get_district_count($elementzillaslow['element_name']) ? Dashboard_helper::get_district_count($elementzillaslow['element_name']) : 0);
                    }
                    $indexx++;
                }
                else:
                echo '0';
            endif;
            ?>]
                            }

                        ]
                });
            });

$(function () {
    $('#containerpie').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'ক্লাস '
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
                y: <?php echo Dashboard_helper::get_classname_count(1,'',''); ?>
            }, {
                name: "দ্বিতীয় শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(2); ?>,
                sliced: true,
                selected: true
            }, {
                name: "তৃতীয় শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(3); ?>
            }, {
                name: "চুতুর্থ শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(4); ?>
            }, {
                name: "পঞ্চম শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(5); ?>
            }, {
                name: "ষষ্ঠ শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(6); ?>
            },
			{
                name: "সপ্তম শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(7); ?>
            },
			{
                name: "অষ্টম শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(8); ?>
            },
			{
                name: "নবম শ্রেণী",
                y: <?php echo Dashboard_helper::get_classname_count(9); ?>
            },
			{
                name: "দশম শ্রেণী",
                y:<?php echo Dashboard_helper::get_classname_count(10); ?>
            },
			{
                name: "১ম বর্ষ ",
                y: <?php echo Dashboard_helper::get_classname_count(11); ?>
            },
			{
                name: "২য় বর্ষ",
                y: <?php echo Dashboard_helper::get_classname_count(12); ?>
            },
			]
        }]
    });
});

        </script>
	<?php 
	/*
		$month_ini = new DateTime("first day of last month");
        $month_end = new DateTime("last day of last month");
        $month_ini=$month_ini->format('Y-m-d');
        $to_date=$month_end->format('Y-m-d');
		
		$this->db->where('institute_class_summary.class_ids', 10);
		$CI->db->where("institute_class_summary.date between '$month_ini' AND '$to_date'");
		 $CI->db->from($CI->config->item('table_class_summary').' institute_class_summary');
		echo $cnt = $this->db->count_all_results().'--';


			$CI->db->select('*');
			 $CI->db->from($CI->config->item('table_classes').' classesd');
			 $results = $CI->db->get()->result_array();
			 foreach($results as $resultsclas){
				 echo '{';
				echo 'name:'.$resultsclas['name'].',';
				 echo ' y: 200';
				 echo '},';
			 }
			 
			 
			 
			 /////////////
			 
			 $CI->db->select('*');
			 $CI->db->from($CI->config->item('table_classes').' classesd');
			 $results = $CI->db->get()->result_array();
			 foreach($results as $resultsclas){
				echo $resultsclas['name'];
				 
			 }
			 
			 */
			?>
		
		<?php 
			
			?>
		