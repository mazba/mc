<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
//echo "<pre>";
//print_r($reports);
//echo "</pre>";
$user=User_helper::get_user();
$CI= get_instance();
if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DIVISIONS');
    $report_element_caption=$CI->lang->line('DIVISION');
}
else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_DISTRICTS');
    $report_element_caption=$CI->lang->line('ZILLA');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_UPAZILLA');
    $report_element_caption=$CI->lang->line('UPAZILLA');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
{
    $report_caption=$CI->lang->line('REPORT_TITLE_UPAZILLA');
    $report_element_caption=$CI->lang->line('UPAZILLA');
}
elseif($user->user_group_id==$CI->config->item('USER_GROUP_INSTITUTE'))
{
    $report_caption='';
    $report_element_caption='';
}
else
{
    $report_caption='';
    $report_element_caption='';
}


?>
<html lang="en">
    <head>
        <title>send title from language file</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templates/default/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="main_container">
                <div class="row show-grid hidden-print">
                    <a class="btn btn-primary btn-rect pull-right" href="<?php echo $pdf_link;?>"><?php echo $this->lang->line("BUTTON_PDF"); ?></a>
                    <a class="btn btn-primary btn-rect pull-right" style="margin-right: 10px;" href="javascript:window.print();"><?php echo $this->lang->line("BUTTON_PRINT"); ?></a>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-12 text-center">
                    <h4><?php echo $report_caption;?></h4>
                    <h4>
                        <?php
                        $date =strtotime($from_date);
                        echo Dashboard_helper::bn2enNumbermonth(date('F, Y', $date));
                        ?>
                    </h4>

                </div>
                <table class="table table-responsive table-bordered">

                    <?php
                    if(!empty($reports))
                    {
                        $level_name='';

                        foreach($reports as $level)
                        {
                            if($level['level_name']==5)
                            {
                                $level_name=$this->lang->line('PRIMARY');
                            }
                            elseif($level['level_name']==6)
                            {
                                $level_name=$this->lang->line('SECONDARY');
                            }
                            elseif($level['level_name']==7)
                            {
                                $level_name=$this->lang->line('HIGHER');
                            }
                            else
                            {
                                $level_name='';
                            }
                            $registered_school='';
                            ?>

                            <thead>
                            <tr style="background: #D4D4D4">
                                <th colspan="12"><h4>শিক্ষার স্তরঃ <?php echo $level_name;?></h4></th>
                            </tr>
                            <tr>
                                <th><?php echo $report_element_caption;?></th>
                                <th><?php echo $this->lang->line('TOTAL_SCHOOL');?></th>
                                <th><?php echo $this->lang->line('TOTAL_MMC_USE');?></th>
                            </tr>
                            </thead>

                            <tr
                            <?php
                            foreach($level['level'] as $element)
                            {
                                $registered_school = Dashboard_helper::get_registered_school($level['level_name'],$element['element_name']);
                                $element_name = Dashboard_helper::get_div_zilla_upazilla($element['element_name']);
                                ?>
                                <tr>
                                    <td><?php echo $element_name;?></td>
                                    <td><?php echo Dashboard_helper::bn2enNumbermonth($registered_school);?></td>
                                    <td><?php echo Dashboard_helper::bn2enNumbermonth($element['element_value']);?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr >
                                <th colspan="12"><h4>&nbsp;</h4></th>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                       ?>
                        <tr>
                            <th colspan="21" style="text-align: center; color: red"><?php echo $this->lang->line('DO_DATA_FOUND');?></th>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </body>
</html>