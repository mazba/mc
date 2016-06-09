<?php

/**
 * Created by PhpStorm.
 * User: Antu Rozario
 * Date: 4/2/2016
 * Time: 5:30 PM
 */
class Report_home_model extends CI_Model
{
    public function get_all($from_date, $to_date)
    {

        $user = User_helper::get_user();
        $CI =& get_instance();

        if ($user->user_group_id == $CI->config->item('SUPER_ADMIN_GROUP_ID') || $user->user_group_id == $CI->config->item('A_TO_I_GROUP_ID') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_1') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_2') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_3') || $user->user_group_id == $CI->config->item('USER_GROUP_MINISTRY_4') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DONNER_2') || $user->user_group_id == $CI->config->item
            ('USER_GROUP_DONNER_3')
        ) {

            $this->db->from($CI->config->item('table_zillas') . ' zillas');
            $this->db->select("Count(institute.id) AS nub_of_institute,
            zillas.zillaid,
            zillas.zillaname,
            (
             SELECT COUNT(DISTINCT institute_class_summary.institude_id) FROM institute_class_summary WHERE  institute_class_summary.zillaid=zillas.zillaid  AND date  BETWEEN  '".$from_date."'  AND '".$to_date."'

            ) number_per_class
            ", false);
            $CI->db->join($CI->config->item('table_institute') . ' institute', ' institute.zillaid= zillas.zillaid ', 'LEFT');
            $CI->db->group_by('institute.zillaid');
            $CI->db->where('institute.status= 2');
            $results = $CI->db->get()->result_array();
            return $results;

        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_2') ||
            $user->user_group_id == $CI->config->item('USER_GROUP_DIVISION_3')
        ) {
            $this->db->from($CI->config->item('table_zillas') . ' zillas');
            $this->db->select("Count(institute.id) AS nub_of_institute,
            zillas.zillaid,
            zillas.zillaname,
            (
             SELECT COUNT(DISTINCT institute_class_summary.institude_id) FROM institute_class_summary WHERE  institute_class_summary.zillaid=zillas.zillaid   AND date  BETWEEN  '" . $from_date . "'  AND '" . $to_date . "'

            ) number_per_class");
            $CI->db->join($CI->config->item('table_institute') . ' institute', ' institute.zillaid= zillas.zillaid ', 'LEFT');
            $CI->db->group_by('institute.zillaid');
            $CI->db->where('institute.status= 2');
            $CI->db->where('zillas.divid=', $user->division);
            $results = $CI->db->get()->result_array();
            return $results;


        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $CI->config->item('USER_GROUP_DISTRICT_4')) {

            $this->db->from($CI->config->item('table_upazilas') . ' upazillas');
            $this->db->select("Count(institute.id) AS nub_of_institute,
            upazillas.upazilaid,
            upazillas.upazilaname,
            upazillas.upazilaname,
            (
                SELECT COUNT(DISTINCT institute_class_summary.institude_id) FROM institute_class_summary WHERE  institute_class_summary.zillaid =upazillas.zillaid  AND  institute_class_summary.upazillaid =upazillas.upazilaid  AND date  BETWEEN  '" . $from_date . "'  AND '" . $to_date . "'
            ) number_per_class");
            $CI->db->join($CI->config->item('table_institute') . ' institute', 'institute.upozillaid = upazillas.upazilaid AND institute.zillaid=upazillas.zillaid ', 'LEFT');

            $CI->db->group_by('institute.upozillaid');
            $CI->db->where('institute.status= 2');
            $CI->db->where('upazillas.zillaid=', $user->zilla);

            $results = $CI->db->get()->result_array();
       //    echo $CI->db-> last_query();
            return $results;


            $query_str = "SELECT * FROM " . $CI->config->item('table_upazilas') . " WHERE zillaid=" . $user->zilla . "";
            $query = $this->db->query($query_str);

        } elseif ($user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_2') ||
            $user->user_group_id == $CI->config->item('USER_GROUP_UPOZILA_3')
        ) {
            $CI->db->select('institute_class_summary.institude_id institudeid, institute_class_summary.zillaid, institute_class_summary.divid, institute_class_summary.upazillaid, institute_class_summary.no_of_subjects,  institute_class_summary.date, institute.name institutename, COUNT(institute_class_summary.no_of_subjects) noiftotal');
            $CI->db->from($CI->config->item('table_class_summary') . ' institute_class_summary');
            $CI->db->join($CI->config->item('table_institute') . ' institute', 'institute_class_summary.institude_id=institute.id', 'left');
            $CI->db->where('institute_class_summary.zillaid', $user->zilla);
            $CI->db->where('institute_class_summary.divid', $user->division);
            $CI->db->where('institute_class_summary.upazillaid', $user->upazila);
            $CI->db->where("institute_class_summary.date between '$from_date' AND '$to_date'");
            $CI->db->group_by('institute_class_summary.institude_id');
            $CI->db->order_by("noiftotal", "DESC");
            $results = $CI->db->get()->result_array();
            return $results;
        }
    }


}