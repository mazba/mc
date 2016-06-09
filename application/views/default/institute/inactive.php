<?php
/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 2/16/2016
 * Time: 7:00 PM
 */
?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();
?>
<div id="system_content">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        //   $CI->load_view('system_action_buttons');
        ?>
    </div>
    <div id="system_dataTable">
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        function myFunction() {
            confirm("Press a button!");
        }
        var url = "<?php echo $CI->get_encoded_url('institute/Institute/get_users_inactive');?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'edit_link', type: 'string' },
                { name: 'name', type: 'string' },
                { name: 'email', type: 'string' },
                { name: 'education_type_ids', type: 'string' },
                { name: 'mobile', type: 'string' }

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
                pagesizeoptions: ['10', '20', '30', '50','100','150'],
                selectionmode: 'checkbox',
                altrows: true,
                autoheight: true,

                columns: [
                    { text: '<?php echo $CI->lang->line('SCHOOL_NAME'); ?>', dataField: 'name', width:'25%'},
                    { text: '<?php echo $CI->lang->line('SCHOOL_EMAIL'); ?>', dataField: 'email', width:'25%'},
                    { text: '<?php echo $CI->lang->line('EDUCATION_TYPE'); ?>', dataField: 'education_type_ids', width:'15%'},
                    { text: '<?php echo $CI->lang->line('SCHOOL_MOBILE'); ?>', dataField: 'mobile', width:'18%'},

                    { text: 'Action', datafield: 'id', cellsrenderer: function (h,v,z) {

                        return "<a onclick='myFunction()'><b><?php echo $CI->lang->line('APPROVED'); ?></b></a> | <a  onclick='myFunction()' href='<?php echo base_url("institute/institute/disable");?>/"+z+"'><b style='color: red'><?php echo $CI->lang->line('DISCARD'); ?></b></a>";
                    }
                    },
                ]
            });

        //for Double Click to edit
//            $('#system_dataTable').on('rowDoubleClick', function (event)
//            {
//    		//	alert(rowindex);
//                var edit_link=$('#system_dataTable').jqxGrid('getrows')[event.args.rowindex].edit_link;
//
//                $.ajax({
//                    url: edit_link,
//                    type: 'POST',
//                    dataType: "JSON",
//                    success: function (data, status)
//                    {
//
//                    },
//                    error: function (xhr, desc, err)
//                    {
//                        console.log("error");
//
//                    }
//                });
//            });
    });
</script>

