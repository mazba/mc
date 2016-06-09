<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all()
    {
        $CI =& get_instance();

        $this->db->from($CI->config->item('table_classes').' classes');
        $this->db->select('classes.*');
        $this->db->select('education_type.name  as et_name');
        $this->db->select('education_level.name  as el_name');
        $CI->db->join($CI->config->item('table_education_type').' education_type','education_type.id = classes.education_type', 'LEFT');
        $CI->db->join($CI->config->item('table_education_level').' education_level','education_level.id = classes.education_level_id', 'LEFT');

        $this->db->where('classes.status != 99');
        $groups=$this->db->get()->result_array();
        foreach($groups as &$group)
        {
            $group['edit_link']=$CI->get_encoded_url('classes/classes/index/edit/'.$group['id']);
            if($group['status']==1)
            {
                $group['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($group['status']==0)
            {
                $group['status_text']=$CI->lang->line('INACTIVE');
            }
            else
            {
                $group['status_text']=$group['status'];
            }
        }
        return $groups;
    }

    public function check_duplicate($id,$data)
    {

        $CI =& get_instance();

        $this->db->from($CI->config->item('table_classes') . ' subject');
        $this->db->select('subject.*');
        // $this->db->where_in('id',$data[]);class_id
        $this->db->where('id  !=', $id);
        $this->db->where('name  =', $data['name']);
     //   $this->db->where('class_id =', $data['class_id']);
        $this->db->where('education_type  =', $data['education_type']);
        $this->db->where('education_level_id  =', $data['education_level_id']);
        $this->db->where('status =',$data['status']);

        // $this->db->where('status != 99');
        //$this->db->order_by('group.ordering ASC');
        $groups = $this->db->get()->result_array();

        return $groups;


    }

//    public function get_user_group_details($ids)
//    {
//        if($ids)
//        {
//            $CI =& get_instance();
//
//            $this->db->from($CI->config->item('table_user_group').' group');
//            $this->db->select('group.id,group.ordering,group.name_en,group.name_bn,group.status');
//            $this->db->where_in('id',$ids);
//            $this->db->where('status != 99');
//            $this->db->order_by('group.ordering ASC');
//            $groups=$this->db->get()->result_array();
//
//            return $groups;
//        }
//        else
//        {
//            return null;
//        }
//
//    }

}