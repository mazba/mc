<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_password_reset_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users($division, $zilla, $upazilla, $user_id,$school_mobile_number)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->select('users.*');

        if($division>0)
        {
            $CI->db->where('users.division', $division);
        }
        if($zilla>0)
        {
            $CI->db->where('users.zilla', $zilla);
        }
        if($upazilla>0)
        {
            $CI->db->where('users.upazila', $upazilla);
        }

        if(!empty($user_id))
        {
            $CI->db->where("users.username like '%$user_id%'");
        }
        if(!empty($school_mobile_number))
        {
            $CI->db->where('users.mobile like', $school_mobile_number);
        }

        $CI->db->where('users.user_group_id', $CI->config->item('USER_GROUP_INSTITUTE'));

        $results = $this->db->get()->result_array();

        foreach($results as &$result)
        {
            $result['edit_link']=$CI->get_encoded_url('user_management/user_password_reset/index/edit/'.$result['id']);
        }

        $CI->jsonReturn($results);
    }

    public function get_password_detail($id)
    {
        $CI =& get_instance();

        $CI->db->from($CI->config->item('table_users').' users');
        $CI->db->select('users.id, users.username, users.password, users.ques_id, users.ques_ans');

        $CI->db->where('users.id', $id);
        $results = $CI->db->get()->row_array();
        return $results;
    }

    public static function get_divisions_by_user()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $user_group_id = $user->user_group_id;

        $CI->db->from($CI->config->item('table_divisions'));
        $CI->db->select('*');
        if($user_group_id > $CI->config->item('MINISTRY_GROUP_ID'))
        {
            $CI->db->where('divid', $user->division);
        }

        $results = $CI->db->get()->result_array();
        return $results;
    }


}