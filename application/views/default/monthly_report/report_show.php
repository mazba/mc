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
              <?php echo $this->lang->line('MONTHLY_REPORT_ANYLICIS');?>
                    </div>
                    <div class="clearfix"></div>
                </div>
	 <div id="system_dataTable"></div>			
</div>


</div>				
<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        var url = "<?php echo $CI->get_encoded_url('Monthly_report/monthlyreport');?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
           //     { name: 'id', type: 'int' },

                { name: 'zillaname', type: 'string' },
                { name: 'visited_list', type: 'string' },
                { name: 'in_house', type: 'string' },
                { name: 'sender', type: 'string' },
                { name: 'submit_date', type: 'string' }
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#system_dataTable").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                pageable: true,
                filterable: true,
                sortable: true,
                showfilterrow: true,
                columnsresize: true,
                pagesize:<?php echo $this->config->item('page_size');?>,
                pagesizeoptions: ['50','100','150'],
                selectionmode: 'checkbox',
                altrows: true,
                autoheight: true,

                columns: [

					{ text: '<?php echo $CI->lang->line('ZILLA_NAME'); ?>', dataField: 'zillaname',filtertype:'list', width:'18%'},
                    { text: '<?php echo $CI->lang->line('VISITED_LIST'); ?>', dataField: 'visited_list', width:'20%'},
                    { text: '<?php echo $CI->lang->line('VISITED_IN_HOUSE'); ?>', dataField: 'in_house', width:'20%'},
                    { text: '<?php echo $CI->lang->line('SENDER_NAME'); ?>', dataField: 'sender',filtertype:'list', width:'25%'},
                    { text: '<?php echo $CI->lang->line('DATE'); ?>', dataField: 'submit_date', width:'15%',searchtype: "date", datefmt: "Y/m/d h:i"}
                ]
            });
            
        
    });
</script>				