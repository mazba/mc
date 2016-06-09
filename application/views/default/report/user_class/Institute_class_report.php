<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$pdf_link="http://".$_SERVER['HTTP_HOST'].str_replace("/list","/pdf",$_SERVER['REQUEST_URI']);
//echo "<pre>";
//print_r($reports);
//echo "</pre>";
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
                    <span class="pull-right"><?php echo $this->lang->line('REPORT_CURRENT_DATE_VIEW');?> <br />প্রতিবেদন রিপোট&nbsp;<?php echo System_helper::Get_Eng_to_Bng($_GET["from_date"]).'&nbsp;থেকে &nbsp;'.System_helper::Get_Eng_to_Bng($_GET["to_date"]); ?>&nbsp; পর্যন্ত </span>
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-12 text-center">
                    <h4><?php echo $this->lang->line('REPORT_HEADER_TITLE');?></h4>
                    <h5><?php echo $this->lang->line('REPORT_INSTITUTE_CLASS_LIST_TITLE');?></h5>
                    <hr />
                </div>

                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
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
                        foreach($reports as $row)
                        {
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    if ($class_date == '')
                                    {
                                        echo Dashboard_helper::bn2enNumber($row['class_date']);
                                        $class_date = $row['class_date'];
                                        //$class_date = $preDate;
                                    }
                                    else if ($class_date == $row['class_date'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo Dashboard_helper::bn2enNumber($row['class_date']);
                                        $class_date = $row['class_date'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($class_name == '')
                                    {
                                        echo $row['class_name'];
                                        $class_name = $row['class_name'];
                                        //$class_date = $preDate;
                                    }
                                    else if ($class_name == $row['class_name'])
                                    {
                                        //exit;
                                        echo "&nbsp;";
                                    }
                                    else
                                    {
                                        echo $row['class_name'];
                                        $class_name = $row['class_name'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['subject_name'];?></td>
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