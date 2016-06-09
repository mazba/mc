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

    //$to_date=$month_end->format('Y-m-d');
	// $to_date= date('Y-m-d');
	 $date=date('Y-m-d');
	$to_date = date('Y-m-d', strtotime($date .' -1 day'));
}


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
                        সেরা শিক্ষা প্রতিষ্ঠান
     
                    </div>
                    <div class="clearfix"></div>
                </div>
	
<div class="constant">
<style>
    .schoollist{ padding-bottom: 10px; text-transform: capitalize}
</style>
<form id="graphclass" action="<?php echo $CI->get_encoded_url('report/institute/mmcedu_level/high_mmc_institute'); ?>" method="post">
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
   
  <!-- থেকে  -->


			<h3>প্রতিবেদন: <?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($from_date)));?> থেকে  <?php echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($to_date)));?></h4><?php //echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($from_date)));?>  <?php //echo Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($to_date)));?>  </h3>
    <table class="table table-bordered table-hover table-striped"> <thead>
        <tr>

            <th><span>জেলা</span></th>
            <th><span>উপজেলা</span></th>
            <th><span>প্রতিষ্ঠানের নাম</span></th>
            <th style="text-align: center"><span>ক্লাস সংখ্যা</span></th>

        </tr>
        </thead>
        <tbody>
<?php
$user=User_helper::get_user();
 if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
        {
          $query_str="SELECT divid, zillaid, upazillaid, SUM(no_of_subjects) Total FROM institute_class_summary WHERE date BETWEEN '".$from_date."' AND '".$to_date."' GROUP BY zillaid, institude_id ORDER BY Total DESC LIMIT 1";
		 
        }
        else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
        {
      $query_str="SELECT divid, zillaid, upazillaid, SUM(no_of_subjects) Total FROM institute_class_summary WHERE date BETWEEN '".$from_date."' AND '".$to_date."' GROUP BY zillaid ORDER BY Total DESC LIMIT 1";
        }
		
	 else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
        {
            $divisions= $user->division;
			 $query_str="SELECT divid, zillaid, upazillaid, SUM(no_of_subjects) Total FROM institute_class_summary WHERE divid='".$divisions."' AND date BETWEEN '".$from_date."' AND '".$to_date."' GROUP BY divid, institude_id ORDER BY Total DESC LIMIT 1";
        }

elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
        {
            $divisions= $user->division;
			$zillaidd= $user->zilla;
			
			$query_str="SELECT divid, zillaid, upazillaid, SUM(no_of_subjects) Total FROM institute_class_summary WHERE divid='".$divisions."' AND zillaid='".$zillaidd."' AND date BETWEEN '".$from_date."' AND '".$to_date."' GROUP BY zillaid, institude_id ORDER BY Total DESC LIMIT 1";
			
            
        }

 elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
        {
            $divisions= $user->division;
           $zillaidd= $user->zilla;
		   $upazilaa= $user->upazila;
		   
		   $query_str="SELECT divid, zillaid, upazillaid, SUM(no_of_subjects) Total FROM institute_class_summary WHERE divid='".$divisions."' AND zillaid='".$zillaidd."' AND upazillaid='".$upazilaa."' AND date BETWEEN '".$from_date."' AND '".$to_date."' GROUP BY zillaid, institude_id ORDER BY Total DESC LIMIT 1";
		   
           
        }
		
	else{

    }
		$query=$this->db->query($query_str);
//echo $this->db->last_query();
foreach ($query->result_array() as $row)
{



		?>




				   <?php 
				   //echo $row['zillaid'];
				   $returnnvalue= Dashboard_helper::mmc_institute_institute_name($row['zillaid'], $from_date, $to_date);
                //   print_r($returnnvalue);
				   $ii=1;
				   foreach($returnnvalue as $result){
		 //  $institutename= Dashboard_helper::get_institute_data($result['institude_id']);
		//  echo $result['institudeid'];
		 //  print_r($result);
                       echo '<tr>';
                       echo '<td>'.$result['zillanames'].'</td>';
                       echo '<td>'.$result['upazilaname'].'</td>';
                       echo '<td>'.$result['institutename'].'</td>';
                       echo '<td style="text-align: center">'.Dashboard_helper::bn2enNumbermonth($result['Totalclass']).'</td>';

		//   echo Dashboard_helper::bn2enNumbermonth($ii). '. <strong>জেলা: </strong>'. $result['zillanames'].',<strong> উপজেলা: </strong>'.$result['upazilaname'].', <strong>প্রতিষ্ঠানের নাম: </strong> '.$result['institutename'].'<br />';
                 //      echo $result['institudeid'].'--'.$result['Totalclass'];
                       echo '</tr>';
		//    echo '</div>';
		    $ii++;
	   }
			//	   print_r($returnnvalue);
				   ?>
                           </tbody>
                       </table>

	<?php
    
}
?>
			
</div>

	
</div>
			
			
<script>
    $(function () {
        $( ".report_date" ).datepicker({dateFormat : display_date_format});
		
    });
</script>		