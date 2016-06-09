<?php
$CI =& get_instance();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/css/bootstrap-wysihtml5.css"></link>
<script src="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/js/bootstrap-wysihtml5.js"></script> 
<div id="system_content" class="system_content_margin">
    <div class="borderradius">
    <form id="registration_save_form" action="<?php echo $CI->get_encoded_url('home/communicationsave'); ?>" method="post">
        <div class="division">
           <h3>মন্ত্রণালয়</h3> 
           <input type="checkbox" name="" value="MOE"> <label for="মন্ত্রণালয়">শিক্ষা মন্ত্রণালয়</label>
           
            <input type="checkbox" name="" value="MOPME"> <label for="মন্ত্রণালয়">প্রাথমিক ও গণশিক্ষা মন্ত্রণালয়</label>
            
        </div>
      <div class="divisiondiv col-md-12">
        <h3>সংশ্লিষ্ট কর্মকর্তা - বিভাগীয় পর্যায়ে বার্তা পাঠাতে চাচ্ছেন  <input type="checkbox" id="bivagh" name="bivagh" value="bivagh"></h3>
        <div class="division divisionhideshow">

    <?php
	$this->db->select('division.divid AS divid, division.divname AS divname,
                   core_01_users.id AS receiverid, core_01_users.id AS userid, core_01_users.email AS email, core_01_users.division AS divisionname');
    $this->db->from('division');
    $this->db->join('core_01_users', 'core_01_users.division = division.divid','left');
    $this->db->where('core_01_users.user_group_id', 10);
    $queryresults = $this->db->get()->result_array();
	if(isset($queryresults)):
        foreach ($queryresults as $queryrerslt):
 echo '<input name="division[]" type="checkbox" value="'.$queryrerslt['userid'].'-'.$queryrerslt['email'].'" /><label for='.$queryrerslt['divname'].'>'.$queryrerslt['divname'].'</label>';
        endforeach;
        
    endif;
	/*
    if(isset($divisions)):
        foreach ($divisions as $divisions):
 echo '<input name="division[]" type="checkbox" value="'.$divisions['divid'].'" /><label for='.$divisions['divname'].'>'.$divisions['divname'].'</label>';
        endforeach;
        
    endif;
	*/
    ?>
    </div>
    </div>
        <div class="zillasdiv col-md-12">

        <h3>সংশ্লিষ্ট কর্মকর্তা - জেলা <input type="checkbox" id="zillaofficer" name="zillaofficer" value="zillaofficer"></h3>
     <div class="zilla zillahideshow">

    <?php
	$this->db->select('zillas.zillaid AS zillaidid, zillas.zillaname AS zillaname,
                   core_01_users.email AS email, core_01_users.id AS userid');
    $this->db->from('zillas');
    $this->db->join('core_01_users', 'core_01_users.zilla = zillas.zillaid','left');
    $this->db->where('core_01_users.user_group_id', 13);
    //$query = $this->db->get();
    $queryresultszillas = $this->db->get()->result_array();
//print_r($queryresults);
    if(isset($queryresultszillas)):
        foreach ($queryresultszillas as $queryzillas):
            echo '<div class="zillalist">';
 echo '<input name="zilla[]" type="checkbox" value="'.$queryzillas['userid'].'-'.$queryzillas['email'].'" /><label for='.$queryzillas['zillaname'].'>'.$queryzillas['zillaname'].'</label>';
       echo '</div>';
        endforeach;
        
    endif;

//    if(isset($zillas)):
//        foreach ($zillas as $zillas):
//            echo '<div class="zillalist">';
// echo '<input name="zilla[]" type="checkbox" value="'.$zillas['zillaid'].'" /><label for='.$zillas['zillaname'].'>'.$zillas['zillaname'].'</label>';
//       echo '</div>';
//        endforeach;
//
//    endif;
	
    ?>
    </div>
    </div>
        <div class="clearfix"></div>
        <div class="upozillasdiv col-md-12">
        <h3>সংশ্লিষ্ট কর্মকর্তা - উপজেলা <input type="checkbox" id="upozillaofficer" name="upozillaofficer" value="upozillaofficer"></h3>
    <div class="zilla upozillahideshow">

       <div class="col-md-3">
    <select name="zilaname" class="form-control" id="zila_id">
      <?php
      $CI->load_view('dropdown',array('drop_down_options'=>$zillasdp,'drop_down_selected'=>''));
      ?>
    </select>
     </div>
         
         <div class="col-md-9">
             <div id="upozilaname"></div> 
             
         </div>
    </div>
    </div>

    <div class="clearfix"></div>
        <div class="instituteemaildiv col-md-12">
        <h3>প্রতিষ্ঠান সমূহ <input type="checkbox" id="instituteemail" name="instituteemail" value="instituteemail"></h3>
     <div class="perticularinstitute">
         <h3>জেলা নির্বাচন করুন</h3>
     <div class="col-md-2">
    <select name="zilaname" class="form-control" id="zillaid">
      <?php
      $CI->load_view('dropdown',array('drop_down_options'=>$zillasdp,'drop_down_selected'=>''));
      ?>
    </select>
     </div>
         <div class="col-md-2">
   <select name="upozilla" id="upozilla_id" class="form-control  zilla validate[required]">
          <option value=""><?php echo $this->lang->line('SELECT');?></option>
    </select>      
     </div>
         <div class="col-md-8">
             <div id="schools" class="schools"></div>     
             
         </div>    
         
     </div>     
     </div>
    <div class="clearfix"></div>
        <div class="communicationmesage">
    <textarea name="message" class="textarea" placeholder="ম্যাসেজ লিখুন ..." style="width: 810px; height: 200px"></textarea>
        </div>
<div class="clearfix"></div>

<input type="submit" class="btn btn-primary" name="informationsend" value="প্রেরন করুন" id="informationsend">
    </form>    
  </div>
</div>
<style>
    .schools label, .zilla label, .division label{ display: inline !important}
    .schools{ margin-left: 10px;}
  .perticularinstitute, .upozillahideshow, .zillahideshow, .divisionhideshow{ display: none}
</style>

<script>
    $(document).on("change","#zila_id",function()
        {
            var zilla_id=$(this).val();

            if(zilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getUpazilacheckbox'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zilla_id:zilla_id},
                    success: function (data, status)
                    {
                    $('#upozilaname').html(data); 
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {
                $("#upozilaname").val('');
            }
        });
   
   
   $(document).on("change","#zillaid",function()
        {
            var zilla_id=$(this).val();

            if(zilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getUpazila'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zilla_id:zilla_id,},
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
                $("#upozilla_id").val('');
            }
        });
  
   $(document).on("change","#upozilla_id",function()
        {
            var upozilla_id=$(this).val();
            var zillaid = $("#zillaid").val();
            if(upozilla_id>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/getUpazilaschoolcheckbox'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{zillaid:zillaid, upozilla_id: upozilla_id},
                    success: function (data, status)
                    {
                    $('#schools').html(data); 
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            else
            {
                $("#upozilaname").val('');
            }
        });

    $('#bivagh').click(function(){
        if(this.checked){
            $('.divisionhideshow').show(1000);
            $('.instituteemaildiv').hide(1000);
            $('.upozillasdiv').hide(1000);
            $('.zillasdiv').hide(1000);
        }
        else{
            $('.divisionhideshow').hide(1000);
            $('.instituteemaildiv').show(1000);
            $('.upozillasdiv').show(1000);
            $('.zillasdiv').show(1000);
          //  $('.divisionhideshow').show(1000);

        }

    });

    $('#zillaofficer').click(function(){
        if(this.checked){
            $('.zillahideshow').show(1000);
            $('.divisiondiv').hide(1000);
            $('.upozillasdiv').hide(1000);
            $('.instituteemaildiv').hide(1000);
        }
        else{
          //  $('.divisionhideshow').hide(1000);
            $('.zillahideshow').hide(1000);
            $('.instituteemaildiv').show(1000);
            $('.upozillasdiv').show(1000);
            $('.zillasdiv').show(1000);
            $('.divisiondiv').show(1000);
            //  $('.divisionhideshow').show(1000);

        }
    });
    $('#upozillaofficer').click(function(){


        if(this.checked){
            $('.upozillasdiv').show(1000);
            $('.upozillahideshow').show(1000);
            $('.divisiondiv').hide(1000);
            $('.zillasdiv').hide(1000);
            $('.instituteemaildiv').hide(1000);
        }
        else{
            $('.upozillasdiv').hide(1000);
            $('.instituteemaildiv').show(1000);
            $('.upozillasdiv').show(1000);
            $('.zillasdiv').show(1000);
            $('.divisiondiv').show(1000);
            $('.upozillahideshow').hide(1000);
            //  $('.divisionhideshow').show(1000);

        }
    });
    $('#instituteemail').click(function(){
        if(this.checked){
            $('.perticularinstitute').show(1000);
            $('.zillasdiv').hide(1000);
            $('.divisiondiv').hide(1000);
            $('.upozillahideshow').hide(1000);
            $('.upozillasdiv').hide(1000);
        }
        else{
            $('.perticularinstitute').hide(1000);
            $('.zillahideshow').hide(1000);
            $('.instituteemaildiv').show(1000);
            $('.upozillasdiv').show(1000);
            $('.zillasdiv').show(1000);
            $('.divisiondiv').show(1000);
            //  $('.divisionhideshow').show(1000);

        }
    });
   //  $('.textarea').wysihtml5();
   $( document ).ready(function() {
    $('.textarea').wysihtml5();
    });
 </script>