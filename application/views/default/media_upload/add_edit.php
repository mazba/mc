<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();
//echo "<pre>";
//print_r($notice_viewers);
//echo "</pre>";
?>
<div id="system_content" class="system_content_margin">
    <div id="system_action_button_container" class="system_action_button_container">
        <?php
        $CI->load_view('system_action_buttons');
        ?>
    </div>

    <?php
    //print_r($MediaInfo);
    ?>

    <div class="clearfix"></div>
    <form id="system_save_form" action="<?php echo $CI->get_encoded_url('media/media_upload/index/save'); ?>" method="post" class="signup form_valid" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php if(isset($MediaInfo['id'])){echo $MediaInfo['id'];}else{echo 0;}?>"/>
        <input type="hidden" name="system_save_new_status"  id="system_save_new_status" value="0"/>
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $title; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div style="" class="row show-grid " >
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MEDIA_TYPE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="media[media_type]" class="selectbox-1 form-control validate[required] media_type">
                        <option value=""><?php echo $CI->lang->line('SELECT');?></option>
                        <?php
                        $types = $CI->config->item('media_type');
                        foreach($types as $val=>$name)
                        {
                            ?>
                            <option value="<?php echo $val;?>" <?php if($val==$MediaInfo['media_type']){echo 'selected';}?>><?php echo $name;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MEDIA_TITLE'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="media[media_title]" class="form-control validate[required]" value="<?php echo $MediaInfo['media_title'];?>" />
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('MEDIA_DETAILS'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <textarea name="media[media_detail]" class="form-control "><?php echo $MediaInfo['media_detail'];?></textarea>
                </div>
            </div>

            <div style="display: none;" class="row show-grid link">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('VIDEO_LINK'); ?></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="text" name="media[video_link]" class="form-control validate[required]" value="<?php echo $MediaInfo['video_link'];?>" />
                </div>
            </div>

            <div style="display: <?php if($MediaInfo['media_type']==3){echo 'show';}else{echo 'none';}?>;" class="row show-grid print_year">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('PRINT_YEAR'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="media[print_year]" class="selectbox-1 form-control validate[required]">
                        <option value=""><?php echo $CI->lang->line('SELECT');?></option>
                        <?php
                        $types = $CI->config->item('media_type');
                        $current_year = date('Y');
                        $last_year = $current_year-10;
                        for($i=$current_year; $i>$last_year; $i--)
                        {
                            ?>
                            <option value="<?php echo $i;?>" <?php if($i==$MediaInfo['print_year']){echo 'selected';}?>><?php echo $i;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('FILE_UPLOAD'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <input type="file" name="file_name" class="validate[required]" value="" />
                </div>
            </div>

            <div style="" class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $CI->lang->line('STATUS'); ?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="media[status]" class="form-control selectbox-1 validate[required]" id="module_options">
                        <?php
                        $CI->load_view('dropdown',array('drop_down_default_option'=>false,'drop_down_options'=>array(array('text'=>$CI->lang->line('PUBLISHED'),'value'=>$this->config->item('STATUS_ACTIVE')),array('text'=>$CI->lang->line('UN_PUBLISHED'),'value'=>$this->config->item('STATUS_INACTIVE'))),'drop_down_selected'=>$MediaInfo['status']));
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function ()
    {
        //$(".form_valid").validationEngine();
        $(document).on("change",".media_type",function()
        {
            if($(this).val()==2)
            {
                $(".link").show();
            }
            else
            {
                $(".link").hide();
            }

            if($(this).val()==3)
            {
                $(".print_year").show();
            }
            else
            {
                $(".print_year").hide();
            }
        });
    });
</script>
