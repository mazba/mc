<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<style>
    #classesname label{ display: inline !important;}
</style>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
      //  print_r($institute);
        //print_r($institute);
//       $data = unserialize('a:2:{i:2;a:2:{i:0;i:10;i:1;i:11;}i:8;a:8:{i:0;i:10;i:1;i:11;i:2;i:110;i:3;i:111;i:4;i:112;i:5;i:113;i:6;i:114;i:7;i:115;}}');
//       print_r($data);
//       foreach($data as $key => $value){
//          foreach($value as $k => $v){
//              echo $v.'-'; 
//          }
//       }
       
//         
     //   $CI->load_view('system_action_buttons');
/*        
$temp_array = array();
$temp_array['uid'] = "a new value";
$temp_array['pid'] = "another new value";

$temp_array['akey'] = "some value";
echo $store_database = serialize($temp_array);

$data = unserialize('a:3:{s:3:"uid";s:11:"a new value";s:3:"pid";s:17:"another new value";s:4:"akey";s:10:"some value";}');
*/
//
////echo $itemcount = count($data);
//
//
//print_r($data);
//foreach($data as $key => $value){
//            echo $value;
//                 foreach($value as $k => $v){
//                     echo $v.'-';
//                     
//                 }
             

//         }
//         
        ?>
    </div>
    <form id="registration_save_form" action="<?php echo $CI->get_encoded_url('institute/institute/classsave'); ?>" method="post">
    <?php 
    
    ?>
        
        <table width="75%" border="0" class="table" id="customFields">
<tr>
    <th  width="25%">স্তর </th>
    <th  width="25%">শ্রেণী </th>
    <th  width="25%">তারিখ </th>
  </tr>
  <tr>
    <td>
        <select class="selectbox-1" name="education_level[]" id="education_level">
	<option value="">বাছাই করুন ...</option>
        <?php
        if($institute['is_primary']==1){
            echo '<option value="5">প্রাথমিক/ ইবতেদায়ী</option>';
        }
         if($institute['is_secondary']==1){
            echo '<option value="6">মাধ্যমিক/ দাখিল</option>';
        }
        
         if($institute['is_higher']==1){
            echo '<option value="7">উচ্চ মাধ্যমিক/ আলীম</option>';
        }
        ?>
        </select>
    </td>
    <td> <select name="classesid[]" id="classes" class="selectbox-1 zilla validate[required]">
         <option value=""><?php echo $this->lang->line('SELECT');?></option>
         </select></td>
         <td><input type="text" name="cladddate[]" class="datepicker" value="<?php echo date("Y-m-d"); ?>"/>&nbsp;&nbsp;<a href="javascript:void(0);" class="addCF external btn btn-primary">যোগ করুন </a></td>
  </tr>
  <tr>
    <td colspan="3"><div class="classesname" id="classesname"></div></td>
  </tr>
</table>
    

    
    
    <input type="hidden" id="education_type_ids" name="education_type_ids" value="<?php echo $institute['education_type_ids'];?>" />
    <input type="hidden" id="institute" name="institute" value="<?php echo $institute['id'];?>" />
        <input type="hidden" id="divid" name="divid" value="<?php echo $institute['divid'];?>" />
        <input type="hidden" id="zillaid" name="zillaid" value="<?php echo $institute['zillaid'];?>" />
        <input type="hidden" id="upazillaid" name="upazillaid" value="<?php echo $institute['upozillaid'];?>" />
    <?php
    if($institute['is_primary']==1){
        echo '<input type="hidden" name="is_primary" value="'.$institute['is_primary'].'"/>';
        echo '<input type="hidden" name="education_level_id" value="5"/>';
    }
    else{
      echo '<input type="hidden" name="is_primary" value="0"/>';  
    }
    ?>
    
        <?php
    if($institute['is_higher']==1){
        echo '<input type="hidden" name="is_higher" value="'.$institute['is_higher'].'"/>';
        echo '<input type="hidden" name="education_level_id" value="7"/>';
    }
    else{
      echo '<input type="hidden" name="is_primary" value="0"/>';  
    }
    ?>
    
    
        <?php
    if($institute['is_secondary']==1){
        echo '<input type="hidden" name="is_secondary" value="'.$institute['is_secondary'].'"/>';
        echo '<input type="hidden" name="education_level_id" value="6"/>';
    }
    else{
      echo '<input type="hidden" name="is_secondary" value="0"/>';  
    }
    ?>
    <input type="submit" name="classsave" value="নিবেদন  দাখিল" class="btn btn-primary">
</form>
     <?php //echo 'education_type_ids'.$institute['education_type_ids']?>
     <?php //echo 'is_primary'.$institute['is_primary']?>
     <?php //echo 'is_secondary'.$institute['is_secondary']?>
    <?php //echo 'is_higher'.$institute['is_higher']?>
</div>
<script>
 $(document).on("change","#education_level",function()
        {
            var education_level=$(this).val();

            if(education_level>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/education_level'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{education_level:education_level},
                    success: function (data, status)
                    {
                   
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            
        });
     
     
        
        $(document).on("change","#classes",function()
        {
            var classes=$(this).val();
         //   var education_level=$(this).val();
            var education_level = $("#education_level").val();
            var education_type_ids = $("#education_type_ids").val();

            if(education_level>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/education_classes'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{education_level: education_level, classes: classes,education_type_ids: education_type_ids},
                    success: function (data, status)
                    {
                       $('#classesname').html(data); 
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            
        });


</script>
<script>

 $(document).ready(function(){

     $('form#registration_save_form').submit(function(){
         $(this).find('input[type=submit]').prop('disabled', true);
     });

     var num = 1;
$(".addCF").click(function(){
    
    $("#customFields").append('<tr valign="top"><td><select class="selectbox-1" name="education_level[]" id="education_level'+ num +'" onchange="getclasselist('+ num +');"><option value="">বাছাই করুন ...</option> <?php
        if($institute['is_primary']==1){
            echo '<option value="5">প্রাথমিক/ ইবতেদায়ী</option>';
        }
         if($institute['is_secondary']==1){
            echo '<option value="6">মাধ্যমিক/ দাখিল</option>';
        }
        
         if($institute['is_higher']==1){
            echo '<option value="7">উচ্চ মাধ্যমিক/ আলীম</option>';
        }
        ?></select></td><td><select onchange="getclassesubject('+ num +');" name="classesid[]" id="classesid'+ num +'" class="selectbox-1 zilla validate[required]"> <option value=""><?php echo $this->lang->line('SELECT');?></option></select></td><td><input type="text" name="cladddate[]" class="datepicker" value="<?php echo date("Y-m-d"); ?>"/>&nbsp;&nbsp;<a href="javascript:void(0);" class="remCF external btn btn-danger">বাতিল করুন </a></td></tr><tr class="removeclas'+ num +'"><td colspan="3"><div class="classesname" id="classesname'+ num +'"></div></td></tr>');
    num = num + 1;
    $('.datepicker').Zebra_DatePicker();
	});
        
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });

      $('.datepicker').Zebra_DatePicker();
});

 function getclasselist(num) {
  //     alert(num);
   //  var education_level=$(this).val();
  //   alert(education_level);
   var education_level = $("#education_level"+ num +"").val();
   // alert(education_level);
    
    
    if(education_level>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/education_levelnew'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{education_level:education_level, num: num},
                    success: function (data, status)
                    {
                   
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
    }
    
    
    function getclassesubject(num){
    
          //  var classes=$(this).val();
            var classes = $("#classesid"+ num +"").val();
         //   var education_level=$(this).val();
            var education_level = $("#education_level"+ num +"").val();
            var education_type_ids = $("#education_type_ids").val();
            
  //  alert(classes);
  //  alert(education_level);
  //  alert(education_type_ids);
  
  if(education_level>0)
            {
                $.ajax({
                    url: '<?php echo $CI->get_encoded_url('home/education_classes'); ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data:{education_level: education_level, classes: classes,education_type_ids: education_type_ids},
                    success: function (data, status)
                    {
                       $('#classesname'+ num +'').html(data); 
                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");

                    }
                });
            }
            
    }
 </script>
 <style>
    .classesname label {
    display: inline !important;
}
 </style>