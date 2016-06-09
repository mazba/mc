<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monthly_mmc_use_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_monthly_mmc_use_list($from_date, $to_date)
    {
        $CI = & get_instance();
        $user=User_helper::get_user();
        if($user->user_group_id==$CI->config->item('SUPER_ADMIN_GROUP_ID'))
        {
            $CI->db->select('institute_class_summary.education_level_id,institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.education_level_id, institute_class_summary.institude_id, institute_class_summary.divid');
        }
        else if($user->user_group_id==$CI->config->item('A_TO_I_GROUP_ID'))
        {
            $CI->db->select('institute_class_summary.education_level_id,institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.education_level_id, institute_class_summary.institude_id, institute_class_summary.divid');
        }
        else if($user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id==$CI->config->item('USER_GROUP_MINISTRY_4'))
        {
            $CI->db->select('institute_class_summary.education_level_id,institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.education_level_id, institute_class_summary.institude_id, institute_class_summary.divid');
        }
        else if($user->user_group_id==$CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DONNER_3'))
        {
            $CI->db->select('institute_class_summary.education_level_id,institute_class_summary.divid element_name,COUNT(institute_class_summary.divid) element_value');
            $CI->db->group_by('institute_class_summary.education_level_id, institute_class_summary.institude_id, institute_class_summary.divid');
        }
        else if($user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DIVISION_3'))
        {
            $CI->db->select('institute_class_summary.education_level_id,institute_class_summary.zillaid element_name,COUNT(institute_class_summary.zillaid) element_value');
            $CI->db->group_by('institute_class_summary.education_level_id, institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid');
            $CI->db->where('institute_class_summary.divid='.$user->division);

        }
        elseif($user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$CI->config->item('USER_GROUP_DISTRICT_4'))
        {
            $CI->db->select('institute_class_summary.education_level_id,institute_class_summary.upazillaid element_name,COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->group_by('institute_class_summary.education_level_id, institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
            $CI->db->where('institute_class_summary.divid='.$user->division);
            $CI->db->where('institute_class_summary.zillaid='.$user->zilla);
        }
        elseif($user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$CI->config->item('USER_GROUP_UPOZILA_3'))
        {
            $CI->db->select('institute_class_summary.education_level_id,institute_class_summary.upazillaid element_name,COUNT(institute_class_summary.upazillaid) element_value');
            $CI->db->group_by('institute_class_summary.education_level_id, institute_class_summary.institude_id, institute_class_summary.divid, institute_class_summary.zillaid, institute_class_summary.upazillaid');
            $CI->db->where('institute_class_summary.divid='.$user->division);
            $CI->db->where('institute_class_summary.zillaid='.$user->zilla);
            $CI->db->where('institute_class_summary.upazillaid='.$user->upazila);
        }
        else
        {
            //$CI->db->where('','');
        }

        $CI->db->from($CI->config->item('table_class_summary').' institute_class_summary');
        $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
        $result = $CI->db->get()->result_array();
        //echo $CI->db->last_query();
        $result_array=array();
        foreach($result as $row)
        {
            if(!empty($row['element_name']) && !empty($row['education_level_id']))
            {
                $result_array[$row['education_level_id']]['level_name']=$row['education_level_id'];
                $result_array[$row['education_level_id']]['level'][$row['element_name']]['element_name']=$row['element_name'];
                if(isset($result_array[$row['education_level_id']]['level'][$row['element_name']]['element_value']))
                {
                    $result_array[$row['education_level_id']]['level'][$row['element_name']]['element_value']++;
                }
                else
                {
                    $result_array[$row['education_level_id']]['level'][$row['element_name']]['element_value']=1;
                }
            }

        }
        return $result_array;
    }


}