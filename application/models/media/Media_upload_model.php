<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media_upload_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_record_list()
    {
        $user=User_helper::get_user();
        $CI =& get_instance();
        $this->db->select('media.*');
        $this->db->from($CI->config->item('table_media')." media");
        $media_list = $this->db->get()->result_array();
        foreach($media_list as &$media)
        {
            $media['edit_link']=$CI->get_encoded_url('media/media_upload/index/edit/'.$media['id']);
            if($media['status']==$this->config->item('STATUS_ACTIVE'))
            {
                $media['status_text']=$CI->lang->line('PUBLISHED');
            }
            else if($media['status']==$this->config->item('STATUS_INACTIVE'))
            {
                $media['status_text']=$CI->lang->line('UN_PUBLISHED');
            }
            else
            {
                $media['status_text']=$media['status'];
            }

            if($media['media_type']==1)
            {
                $media['media_type_text']=$CI->lang->line('PHOTO');
            }
            else if($media['media_type']==2)
            {
                $media['media_type_text']=$CI->lang->line('VIDEO');
            }
            else if($media['media_type']==3)
            {
                $media['media_type_text']=$CI->lang->line('PRINT_MEDIA');
            }
            else if($media['media_type']==4)
            {
                $media['media_type_text']=$CI->lang->line('PUBLICATIONS');
            }
            else
            {
                $media['media_type_text']='';
            }
        }
        return $media_list;
    }

}