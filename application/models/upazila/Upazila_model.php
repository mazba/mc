<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upazila_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all()
    {
        $CI =& get_instance();

        $this->db->from($CI->config->item('table_upazilas').' upazil');
        $this->db->select('upazil.*');
        $this->db->select('zilla.zillaname');
        $this->db->select('division.divname ');
        $CI->db->join($CI->config->item('table_zillas').' zilla','zilla.zillaid = upazil.zillaid', 'LEFT');
        $CI->db->join($CI->config->item('table_divisions').' division','division.divid = zilla.divid', 'LEFT');

        $this->db->where('upazil.visible != 99');
        $this->db->order_by("upazil.id", "desc");
        $groups=$this->db->get()->result_array();
        foreach($groups as &$group)
        {
            $group['edit_link']=$CI->get_encoded_url('upazila/upazila/index/edit/'.$group['id']);
            if($group['visible']==1)
            {
                $group['status_text']=$CI->lang->line('ACTIVE');
            }
            else if($group['visible']==0)
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

        $this->db->from($CI->config->item('table_upazilas') . ' upazila');
        $this->db->select('upazila.*');
        // $this->db->where_in('id',$data[]);class_id
        $this->db->where('id  !=', $id);
        $this->db->where('upazilaid  =', $data['upazilaid']);
        $this->db->where('zillaid  =', $data['zillaid']);

        $this->db->where('visible =',$data['visible']);

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