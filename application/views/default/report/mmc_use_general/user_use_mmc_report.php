<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
echo "<pre>";
//print_r($reports);
echo "</pre>";
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
            <span class="pull-right"><?php echo $this->lang->line('REPORT_CURRENT_DATE_VIEW');?></span>
        </div>
        <div class="col-lg-12">
            <div class="col-lg-12 text-center">
                <h4><?php echo $this->lang->line('REPORT_HEADER_TITLE');?></h4>
                <h5>
                    <?php echo $title;?>
                    (
                    <?php
                    $type ='';
                    if($report_status==1)
                    {
                        $type = $this->lang->line('LEVEL_PRIMARY');
                    }
                    elseif($report_status==2)
                    {
                        $type = $this->lang->line('LEVEL_SECONDARY');
                    }
                    elseif($report_status==3)
                    {
                        $type = $this->lang->line('LEVEL_HIGHER');
                    }
                    else
                    {
                        $type = $this->lang->line('ALL');
                    }

                    echo $type;
                    ?>
                    )
                </h5>
                <hr />
<!--                <div class="col-lg-4 text-center text-danger">-->
<!--                    --><?php //echo $this->lang->line('TOTAL_REGISTERED_INSTITUTE').": ".System_helper::Get_Eng_to_Bng(count($number_of_institute));?>
<!--                </div>-->
<!--                <div class="col-lg-4 text-center text-danger">-->
<!--                    --><?php //echo $this->lang->line('TOTAL_USING_USER').": ". System_helper::Get_Eng_to_Bng(count($number_of_user));?>
<!--                </div>-->
<!--                <div class="col-lg-4 text-center text-danger">-->
<!--                    --><?php
//                    if($number_of_institute > 0)
//                    {
//                        $percent=count($number_of_user)/count($number_of_institute);
//                    }
//                    else{
//                        $percent=0;
//                    }
//
//                    echo $this->lang->line('TOTAL_PARENTED').": ". System_helper::Get_Eng_to_Bng(number_format($percent*100, 2)).'%';
//                    ?>
<!--                </div>-->

            </div>

            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('DIVISION');?></th>
                    <th><?php echo $this->lang->line('ZILLA');?></th>
                    <th><?php echo $this->lang->line('UPAZILLA');?></th>
                    <th><?php echo $this->lang->line('INSTITUTE');?></th>
                    <!--                            --><?php
                    //                            if(empty($report_status))
                    //                            {
                    //                                ?>
                    <!--                                <th>--><?php //echo $this->lang->line('TYPE');?><!--</th>-->
                    <!--                            --><?php
                    //                            }
                    //                            ?>
                    <th><?php echo $this->lang->line('DATE');?></th>
                    <th><?php echo $this->lang->line('CLASS_NAME');?></th>
                    <th><?php echo $this->lang->line('SUBJECT');?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($reports))
                {

                    $division_name='';
                    $zilla_name='';
                    $upazilla_name='';
                    $institute_name='';
                    $class_name='';
                    $class_date='';
                    foreach($reports as $division)
                    {
                        foreach($division['zilla'] as $zilla)
                        {
                            foreach($zilla['upazilla'] as $upazilla)
                            {
                                foreach($upazilla['institute'] as $institute)
                                {
                                    foreach($institute['date'] as $institite_class_date)
                                    {
                                        //echo $class_date['class_date'];
                                        foreach($institite_class_date['class'] as $class)
                                        {
                                            ?>
                                            <tr>
                                                <td width="7%">
                                                    <?php
                                                    if ($division_name == '')
                                                    {
                                                        echo $division['division_name'];
                                                        $division_name = $division['division_name'];
                                                        //$currentDate = $preDate;
                                                    }
                                                    else if ($division_name == $division['division_name'])
                                                    {
                                                        //exit;
                                                        echo "&nbsp;";
                                                    }
                                                    else
                                                    {
                                                        echo $division['division_name'];
                                                        $division_name = $division['division_name'];
                                                    }
                                                    ?>
                                                </td>
                                                <td width="9%">
                                                    <?php
                                                    if ($zilla_name == '')
                                                    {
                                                        echo $zilla['zilla_name'];
                                                        $zilla_name = $zilla['zilla_name'];
                                                        //$currentDate = $preDate;
                                                    }
                                                    else if ($zilla_name == $zilla['zilla_name'])
                                                    {
                                                        //exit;
                                                        echo "&nbsp;";
                                                    }
                                                    else
                                                    {
                                                        echo $zilla['zilla_name'];
                                                        $zilla_name = $zilla['zilla_name'];
                                                    }
                                                    ?>
                                                </td>
                                                <td width="9%">
                                                    <?php
                                                    if ($upazilla_name == '')
                                                    {
                                                        echo $upazilla['upazlla_name'];
                                                        $upazilla_name = $upazilla['upazlla_name'];
                                                        //$currentDate = $preDate;
                                                    }
                                                    else if ($upazilla_name == $upazilla['upazlla_name'])
                                                    {
                                                        //exit;
                                                        echo "&nbsp;";
                                                    }
                                                    else
                                                    {
                                                        echo $upazilla['upazlla_name'];
                                                        $upazilla_name = $upazilla['upazlla_name'];
                                                    }
                                                    ?>
                                                </td>
                                                <td width="25%">
                                                    <?php
                                                    if ($institute_name == '')
                                                    {
                                                        echo $institute['institute_name'];
                                                        $institute_name = $institute['institute_name'];
                                                        //$currentDate = $preDate;
                                                    }
                                                    else if ($institute_name == $institute['institute_name'])
                                                    {
                                                        //exit;
                                                        echo "&nbsp;";
                                                    }
                                                    else
                                                    {
                                                        echo $institute['institute_name'];
                                                        $institute_name = $institute['institute_name'];
                                                    }
                                                    ?>
                                                </td>
                                                <td width="10%">
                                                    <?php
                                                    echo $institite_class_date['class_date'];
                                                    ?>
                                                </td>
                                                <td width="10%">
                                                    <?php
                                                    echo $class['class_name'];
                                                    ?>
                                                </td>
                                                <td width="30%">
                                                    <?php
                                                    $count_row=0;
                                                    for($i=0; $i<count($class['subject_name']); $i++)
                                                    {

                                                        if(!empty($class['subject_name'][$i]))
                                                        {

                                                            if((count($class['subject_name'])-1)==$i)
                                                            {
                                                                echo $class['subject_name'][$i];
                                                            }
                                                            else
                                                            {

                                                                if ($count_row==3){
                                                                    echo"<br/>";
                                                                    $count_row=0;
                                                                }else {
                                                                    echo $class['subject_name'][$i] . ', ';
                                                                    $count_row++;
                                                                }
                                                            }
                                                            /*if(count($class['subject_name'])<2)
                                                            {
                                                                echo $class['subject_name'][$i];
                                                            }
                                                            else
                                                            {
                                                                echo $class['subject_name'][$i].', ';
                                                            }*/
                                                        }
                                                        else
                                                        {
                                                            echo "--";
                                                        }

                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                else
                {
                    print_r($reports);die();
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