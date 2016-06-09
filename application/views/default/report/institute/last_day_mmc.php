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
				গতদিনের প্রতিবেদন
                    </div>
                    <div class="clearfix"></div>
                </div>
			<div class="constant">

    <form id="graphclass" action="<?php echo $CI->get_encoded_url('report/institute/mmcclass/last_day_mmc'); ?>" method="post">
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

	$date=date('Y-m-d');
	$from_date = date('Y-m-d', strtotime($date .' -1 day'));
    }

    if($this->input->post('to_date')){
        $to_date=$this->input->post('to_date');
    }
    else{

		$date=date('Y-m-d');
		$to_date = date('Y-m-d', strtotime($date .' -1 day'));
    }

    ?>
	<!---  মাল্টিমিডিয়া ক্লাসরুমের কার্যক্রমের বিস্তারিত রিপোর্ট  থেকে  -->
    <div class="table-responsive"><center>
<h4>	<?php //echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($from_date)));?>
    <?php
   if($this->input->post('from_date')){
    echo Dashboard_helper::bn2enNumbermonth(date("j F, Y", strtotime($this->input->post('from_date')))).' থেকে ';
   }
    echo Dashboard_helper::bn2enNumbermonth(date("j F, Y", strtotime($to_date)));?></h4></center>
            <?php

		$CI = & get_instance();
        $user=User_helper::get_user();
	if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID') || $user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
        {					
         
		 ?>
            
			<table class="table table-bordered table-hover table-striped"> <thead>
                <tr>
                    <th>ক্রমিক নং </th>
                    <th>জেলার নাম</th>
                    <th>মাল্টিমিডিয়া ক্লাসরুম প্রাপ্ত শিক্ষা প্রতিষ্ঠানের সংখ্যা </th>
                    <th>মাল্টিমিডিয়া ক্লাসরুমের মাধ্যমে দৈনিক পাঠদান </th>
                </tr>
                </thead>
                <tbody>
<?php
$query_str="SELECT * FROM ".$CI->config->item('table_zillas')."";
$query=$this->db->query($query_str);
$ii=1;
foreach ($query->result_array() as $row)
{



?>
                <tr>
                    <td scope="row"><?php  echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                    <td><?php  echo $row['zillaname']; ?></td>
                    <td style="text-align: center"><?php echo Dashboard_helper::bn2enNumbermonth(Dashboard_helper::get_district_count($row['zillaid']))?></td>
                    <td style="text-align: center"><?php echo Dashboard_helper::bn2enNumbermonth(Dashboard_helper::get_district_mmc_counttwo($row['zillaid'], $from_date, $to_date))?></td>
                </tr>
<?php
    $ii++;
}
?>

                </tbody>
            </table>
			
			<?php 
			
		}
		else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
        {
			
		?>
		<table class="table table-bordered table-hover table-striped"> <thead>
                <tr>
                    <th>ক্রমিক নং </th>
                    <th>জেলার নাম</th>
                    <th>মাল্টিমিডিয়া ক্লাসরুম প্রাপ্ত শিক্ষা প্রতিষ্ঠানের সংখ্যা </th>
                    <th>মাল্টিমিডিয়া ক্লাসরুমের মাধ্যমে পাঠদান</th>
                </tr>
                </thead>
                <tbody>
<?php
$query_str="SELECT * FROM ".$CI->config->item('table_zillas')." WHERE divid=".$user->division."";
$query=$this->db->query($query_str);
$ii=1;
foreach ($query->result_array() as $row)
{



?>
                <tr>
                    <th scope="row"><?php  echo Dashboard_helper::bn2enNumbermonth($ii); ?></th>
                    <td><?php  echo $row['zillaname']; ?></td>
                    <td style="text-align: center"><?php echo Dashboard_helper::bn2enNumbermonth(Dashboard_helper::get_district_count($row['zillaid']))?></td>
                    <td style="text-align: center"><?php echo Dashboard_helper::bn2enNumbermonth(Dashboard_helper::get_district_mmc_counttwo($row['zillaid'], $from_date, $to_date))?></td>
                </tr>
<?php
    $ii++;
}
?>

                </tbody>
            </table>
		<?php
		}
	elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
        {	
		?>
		<table class="table table-bordered table-hover table-striped"> <thead>
                <tr>
                    <th>ক্রমিক নং </th>
                    <th>উপজেলা  নাম</th>
                    <th>মাল্টিমিডিয়া ক্লাসরুম প্রাপ্ত শিক্ষা প্রতিষ্ঠানের সংখ্যা </th>
                    <th>মাল্টিমিডিয়া ক্লাসরুমের মাধ্যমে পাঠদান</th>
                </tr>
                </thead>
                <tbody>
<?php
$query_str="SELECT * FROM ".$CI->config->item('table_upazilas')." WHERE zillaid=".$user->zilla."";
$query=$this->db->query($query_str);
$ii=1;
foreach ($query->result_array() as $row)
{



?>
                <tr>
                    <td scope="row"><?php  echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                    <td><?php  echo $row['upazilaname']; ?></td>
                    <td style="text-align: center"><?php echo Dashboard_helper::bn2enNumbermonth(Dashboard_helper::get_district_count($row['upazilaid']))?></td>
                    <td style="text-align: center"><?php echo Dashboard_helper::bn2enNumbermonth(Dashboard_helper::get_district_mmc_counttwo($row['upazilaid'], $from_date, $to_date,$user->zilla))?></td>
                </tr>
<?php
    $ii++;
}
?>

                </tbody>
            </table>
	<?php
		}
        elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3')){
?>
        <table class="table table-bordered table-hover table-striped"> <thead>
            <tr>
                <th>ক্রমিক নং </th>
                <th>প্রতিষ্ঠানের নাম </th>
                <th>মাল্টিমিডিয়া ক্লাসরুম সংখ্যা </th>
<!--                <th>তারিখ  </th>-->

            </tr>
            </thead>
            <tbody>
            <?php

    $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid, institute_class_summary.divid, institute_class_summary.upazillaid, institute_class_summary.no_of_subjects,  institute_class_summary.date, institute.name institutename, COUNT(institute_class_summary.no_of_subjects) noiftotal');
    $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
    $CI->db->join($CI->config->item('table_institute') . ' institute', 'institute_class_summary.institude_id=institute.id', 'left');
    $CI->db->where('institute_class_summary.zillaid', $user->zilla);
    $CI->db->where('institute_class_summary.divid', $user->division);
    $CI->db->where('institute_class_summary.upazillaid', $user->upazila);
    $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
    $CI->db->group_by('institute_class_summary.date');
    $CI->db->order_by("noiftotal, institute_class_summary.date", "DESC");
    $results = $CI->db->get()->result_array();
//$query=$this->db->query($query_str1);
    $ii = 1;
    foreach ($results as $row) {
            ?>
            <tr>
                <td scope="row"><?php  echo Dashboard_helper::bn2enNumbermonth($ii); ?></td>
                <td><?php  echo $row['institutename']; ?></td>
                <td style="text-align: center"><?php  //echo $row['no_of_subjects']; ?>

                    <?php  echo Dashboard_helper::bn2enNumbermonth($row['noiftotal']); ?></td>
<!--                <td>--><?php //echo Dashboard_helper::bn2enNumbermonth(date("j F, Y", strtotime($row['date'])));
//                    //echo $row['date']; ?><!--</td>-->
		<?php $ii++;
        } ?>
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
        $( ".report_date" ).datepicker({dateFormat : display_date_format});
	});	
		</script>

