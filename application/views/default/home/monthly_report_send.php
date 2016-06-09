<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$user=User_helper::get_user();

/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 1/18/2016
 * Time: 12:52 PM
 */
?>
<div class="constant">
    <div class="row"  style="margin-top: 30px;">
	<div class="col-md-4">
	<?php
        $CI->load_view("report/report_menus");
        ?>
	</div>
	<div class="col-md-8">
	<div class="widget">
	 <div class="widget-header">
                    <div class="title">
              <?php echo $this->lang->line('MONTHLY_REPORT_NAME');?>
                    </div>
                    <div class="clearfix"></div>
                </div>
				
       
        <?php
    //   print_r($user);
	//echo $user->username;
        echo form_open('home/monthly_report_send');
        ?>

            <table width="100%" border="0">
                <tr>
                    <td width="50%"><label class="control-label pull-left registrationwidth" style="text-align: left;"><?php echo $CI->lang->line('VISITED_LIST'); ?><span style="color:#FF0000">*</span></label></td>
                    <td width="1%">:</td>
                    <td width="49%" style="text-align: left">
                        <?php
                        $data = array(
                            'name'        => 'visited_list',
                            'id'          => 'visited_list',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('VISITES_NUMBER'),
                            'size'        => '50',
                        );

                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label class="control-label pull-left registrationwidth" style="text-align: left;"><?php echo $CI->lang->line('VISITED_IN_HOUSE'); ?><span style="color:#FF0000">*</span></label></td>
                    <td>:</td>
                    <td>
                        <?php
                        $data = array(
                            'name'        => 'visited_in_house',
                            'id'          => 'visited_in_house',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('VISITES_IN_HOUSE'),
                            'size'        => '50',
                        );

                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label class="control-label pull-left registrationwidth" style="text-align: left;"><?php echo $CI->lang->line('SENDER_NAME'); ?><span style="color:#FF0000">*</span></label></td>
                    <td>:</td>
                    <td  style="text-align: left">
                        <?php
                        $options = array(
                            'district_commisioner'  => 'জেলা প্রশাসক',
                            'district_edication_officer'    => 'জেলা শিক্ষা কর্মকর্তা',
                        );
                        echo form_dropdown('sender_name', $options, 'district_commisioner');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td  style="text-align: left">

                        <?php
						echo form_hidden('username', $user->username);
                        echo form_hidden('zilla', $user->zilla);
                        echo form_submit('mysubmit', $this->lang->line('SEND_REPORT'),"class='myButton'");
                        ?>
                    </td>
                </tr>
            </table>
        </form>
		 </div>
  </div>
  </div>
   </div>