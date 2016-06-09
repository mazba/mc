<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();
//print_r($user);
//$institutee=$this->Institute_model->get_institute_information($user->id);
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/templates/'.$CI->get_template(); ?>/css/dashboard.css">

<style>
@import url(http://fonts.googleapis.com/css?family=Lato:300);



.profile-img {
  display: block;
  height: 7em;
  margin-right: auto;
  margin-left: auto;
  border: .5em solid #f2f2f2;
  border-radius: 100%;
  box-shadow:  0 1px 0 0 rgba(0,0,0,.1);
}

.profile-text {
  margin-top: -3.5em;
  padding: 5em 1.5em 1.5em 1.5em; 
  background: white;
  border-radius: 3px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.1)
}

.profile-name{
  margin-right: -1em;
  margin-bottom: .75em;
  margin-left: -1em;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  padding-bottom: .75em;
  font-size: 1.5em;
  text-transform: uppercase;
}

.profile-title {
  color: #ccc;
  margin-right: -1em;
  margin-bottom: .75em;
  margin-left: -1em;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  padding-bottom: .75em;
}
.modal {
    background: none !important;
    box-shadow: 0 0px 0px rgba(0, 0, 0, 0.0)!important;
}
.modal-dialog{ width: auto !important;}
</style>
<div id="system_content" class="system_content col-sm-12 text-center" style="margin-top: 5px;">

<!--<div class="col-sm-1 text-center" style="margin-top: 5px;">
&nbsp;
</div>-->

<div class="col-sm-3 text-center" style="margin-top: 5px;">

  <img src="<?php echo base_url().'images/teaching-128.png'; ?>" class="profile-img">
  <div class="profile-text">
    <h1 class="profile-name"><?php echo $this->lang->line('NAME');?> : <?php echo $user->name_bn ?></h1>
    
  
    <h4 class="profile-title"><?php echo $this->lang->line('EMAIL');?> : <?php echo $user->email ?></h4>
      <h4 class="profile-title"><?php echo $this->lang->line('SCHOOL_EM');?> : <?php
          $institute_info= Dashboard_helper::get_institute_information($user->id);
          echo $institute_info['code']; ?></h4>

    
  </div>
    
</div>    

<div class="col-sm-7 text-center" style="margin-top: 5px;">
    <div class="system_content text-center" style="margin-top: 5px;">
        <div id="container" style="height: 400px">
            <?php //echo $user->name_bn
//echo $user->id;
            //$institute_info= Dashboard_helper::get_institute_information($user->id);
            $last_submit_date=Dashboard_helper::get_last_MMC_submission($institute_info['id']);
            $totalmmc= Dashboard_helper::get_last_MMC_COUNT($institute_info['id']);
        //    print_r($last_submit_date);
      //      print_r($institute_info);
          //  echo $institute_info['id'];
            if(empty($institute_info['code']))
            {
                echo  '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">'.$this->lang->line('PUT_EIIN_NO').' </button>';
            }
            if($this->session->userdata('eiin_message')):
           echo '<strong>'.$this->session->userdata('eiin_message').'</strong>';
           $this->session->unset_userdata('eiin_message');
            endif;
            ?>



            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"> <?php echo $this->lang->line('PUT_EIIN_NO'); ?></h4>
                        </div>
                        <div class="modal-body">
                            <div style="margin-bottom: 50px; overflow: hidden">
                                <form id="registration_save_form" action="<?php echo $CI->get_encoded_url('institute/institute/eiin'); ?>" method="post">
                                    <div class="col-md-6" align="left">
                                        <strong>  <?php echo $this->lang->line('INSTITUTE_NAME');?></strong>
                                    </div>
                                    <div class="col-md-5" align="left">
                                        <?php echo $institute_info['name'];?>
                                    </div>


                                    <div class="col-md-6" align="left">
                                        <strong><?php echo $this->lang->line('INSTITUTE_EMAIL');?></strong>
                                    </div>
                                    <div class="col-md-5" align="left">
                                        <?php echo $institute_info['email'];?>
                                    </div>


                                    <div class="col-md-6" align="left">
                                        <strong><?php echo $this->lang->line('SCHOOL_MOBILE');?></strong>
                                    </div>
                                    <div class="col-md-5" align="left">
                                        <?php echo $institute_info['mobile'];?>
                                    </div>


                                    <div class="col-md-6" align="left">
                                        <strong><?php echo $this->lang->line('SCHOOL_EM');?></strong>
                                    </div>
                                    <div class="col-md-5" align="left">
                                        <?php //echo form_input('username', 'johndoe');
                                        $data = array(
                                            'name'        => 'eiin',
                                            'id'          => 'eiin',
                                            'size'        => '50',
                                        //    'style'       => 'width:25%',
                                            'class'        =>'form-control'
                                        );

                                        echo form_input($data);
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php //echo $institute['id']; ?>

                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" style="cursor:pointer; float: left" class="myButton" id="saveEIIN" name="saveEIIN" value="<?php echo $this->lang->line('SAVE'); ?>" />


                                    </div>
                                    <input type="hidden" value="<?php echo $institute_info['id']; ?>" name="instituteid" id="instituteid"/>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="system_content col-sm-2 text-center" style="margin-top: 5px;">

        <ul id="dashboard">

			<li colore="emerald">
                <div class="contenuto">
                    <span class="titolo">সর্বশেষ  প্রতিবেদন দাখিল </span>
                    <span class="descrizione"><?php
                        if(isset($last_submit_date['date'])){
                            echo Dashboard_helper::bn2enNumber($last_submit_date['date']);
                        }
                        else
                        {
                            echo $this->lang->line("NO_MMC_SYBMIT");
                        }
                        //echo sprintf($CI->lang->line('TAKA_WITH_DATA'),Dashboard_helper::get_max_income_uisc($user->zilla,$user->upazila,$user->unioun)); ?></span>
                    <!-- <span class="valore"></span>	 -->
                </div>
            </li>

            <li colore="red">
                <div class="contenuto">
                    <span class="titolo">মোট  প্রতিবেদন দাখিল  </span>
                    <span class="descrizione"><?php
                        echo Dashboard_helper::bn2enNumber($totalmmc). $CI->lang->line('TII')." "."শ্রেণীর";
                        //echo sprintf($CI->lang->line('TAKA_WITH_DATA'),Dashboard_helper::get_min_income_uisc($user->zilla,$user->upazila,$user->unioun)); ?></span>
                </div>
            </li>


<!--
            <li colore="lime">
                <div class="contenuto">
                    <span class="titolo">সেন্টারের ধরন</span>
                    <span class="descrizione">
                        <?php
                            $center_location ='';//  Dashboard_helper::get_loacation_info_uisc($user->uisc_id,$user->id);
                            $config = $this->config->item('center_location_info');
                            if(isset($center_location['center_type']))
                            {
                                echo $config[$center_location['center_type']];
                            }
                        ?>
                    </span>
                </div>
            </li>
            <li colore="orange">
                <div class="contenuto">
                    <span class="titolo">বিদ্যুৎ</span>
                    <span class="descrizione">
                        <?php
                            $data ='';// Dashboard_helper::get_electricity_info_uisc($user->uisc_id,$user->id);
                            if(isset($data['electricity']) && $data['electricity'] == 1)
                            {
                                echo $CI->lang->line('YES');
                            }
                            else
                            {
                                echo $CI->lang->line('NO');
                            }
                        ?>
                    </span>
                </div>
            </li>
->
            
        </ul>

    </div>
    


</div>

<div class="clearfix"></div>
<br/>
<br/>
<br/>
<?php
$week = '';//Dashboard_helper::get_uisc_weekly_income($user);
?>
