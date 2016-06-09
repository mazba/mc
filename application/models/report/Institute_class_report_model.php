<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Institute_class_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_institute_class_list($from_date, $to_date)
    {
        $CI =& get_instance();
        $user=User_helper::get_user();

        $this->db->select
        ("
            institute.id,
            institute.`name`,
            institute.`code`,
            institute.education_type_ids,
            institute.divid,
            institute.zillaid,
            institute.upozillaid,
            institute.applied_date,
            institute.is_primary,
            institute.is_secondary,
            institute.is_higher,
            institute.`status`,
            divisions.divname,
            zillas.zillaname,
            upa_zilas.upazilaname,
            institute_class_details.class_name,
            institute_class_details.subject_name,
            institute_class_details.class_date
        ", false);
        $CI->db->from($CI->config->item('table_institute').' institute');

        $this->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = institute.divid', 'LEFT');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = institute.divid AND zillas.zillaid = institute.zillaid', 'LEFT');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas','upa_zilas.zillaid = institute.zillaid AND upa_zilas.upazilaid = institute.upozillaid', 'LEFT');
        $this->db->join($CI->config->item('table_class_details').' institute_class_details','institute_class_details.institude_id = institute.id', 'INNER');

        $this->db->where('institute.user_id', $user->id);
        $this->db->where('institute.status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where("institute_class_details.class_date between '$from_date' AND '$to_date' ");

        //$this->db->group_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid');
        $this->db->order_by('institute_class_details.class_date, divisions.divid, zillas.zillaid, upa_zilas.upazilaid, institute.id, institute_class_details.class_id','DESC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }




}