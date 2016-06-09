<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_use_mmc_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_user_use_mmc_list($division, $zilla, $upazila, $union, $from_date, $to_date, $status = null, $education_type = null, $channel = 1, $class_number = null)
    {
        $CI =& get_instance();
        //$user=User_helper::get_user();


        if ($status == 1) {
            $this->db->where('institute.is_primary', 1);
        } elseif ($status == 2) {
            $this->db->where('institute.is_secondary', 1);
        } elseif ($status == 3) {
            $this->db->where('institute.is_higher', 1);
        } else {

        }


        if ($channel == 1) {

            $this->db->where("institute.id not in (select institute_class_summary.institude_id from institute_class_summary where institute_class_summary.date between '$from_date' AND '$to_date' )");
            $this->db->order_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, institute.id', 'ASC');
            $this->db->group_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, institute.id');
        } elseif ($channel == 2) {
            $this->db->select('
			institute.id as institute_id,
            institute_class_details.class_name,
            institute_class_details.subject_name,
            institute_class_details.class_date
            ', false);
            $this->db->join($CI->config->item('table_class_details') . ' institute_class_details', 'institute_class_details.institude_id = institute.id', 'INNER');
            $this->db->where("institute_class_details.class_date between '$from_date' AND '$to_date' ");
            $this->db->order_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid, institute.id, institute_class_details.class_date', 'ASC');

            if (!empty($class_number)) {
                $this->db->where("institute.id IN (select institute_class_summary.institude_id from institute_class_summary where institute_class_summary.date between '$from_date' AND '$to_date' GROUP BY institude_id HAVING COUNT(institute_class_summary.institude_id)>$class_number)");
            }
        } else {
            return false;
        }

        //temp of for optmize query by antu
//        $this->db->select
//        ("
//            institute.id,
//            institute.`name`,
//            institute.`code`,
//            institute.education_type_ids,
//            institute.divid,
//            institute.zillaid,
//            institute.upozillaid,
//            institute.applied_date,
//            institute.is_primary,
//            institute.is_secondary,
//            institute.is_higher,
//            institute.`status`,
//            divisions.divname,
//            zillas.zillaname,
//            upa_zilas.upazilaname
//        ", false);

        $this->db->select
        ("
            institute.id,
            institute.`name`,

            institute.education_type_ids,
            institute.divid,
            institute.zillaid,
            institute.upozillaid,


            divisions.divname,
            zillas.zillaname,
            upa_zilas.upazilaname
        ", false);
        $CI->db->from($CI->config->item('table_institute') . ' institute');

        $this->db->join($CI->config->item('table_divisions') . ' divisions', 'divisions.divid = institute.divid', 'LEFT');
        $this->db->join($CI->config->item('table_zillas') . ' zillas', 'zillas.divid = institute.divid AND zillas.zillaid = institute.zillaid', 'LEFT');
        $this->db->join($CI->config->item('table_upazilas') . ' upa_zilas', 'upa_zilas.zillaid = institute.zillaid AND upa_zilas.upazilaid = institute.upozillaid', 'LEFT');

        $this->db->where('institute.education_type_ids', $education_type);
        $this->db->where('institute.status', $this->config->item('STATUS_ACTIVE'));
        //$this->db->group_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid');
        if (!empty($division)) {
            $this->db->where('divisions.divid', $division);
            if (!empty($zilla)) {
                $this->db->where('zillas.zillaid', $zilla);
                if (!empty($upazila)) {
                    $this->db->where('upa_zilas.upazilaid', $upazila);
                    if (!empty($union)) {
                        $this->db->where('unions.unionid', $union);
                    }
                }
            }
        }
        $result = $this->db->get()->result_array();


     //   echo $this->db->last_query();
        $result_array = array();
        for ($i = 0; $i < count($result); $i++) {
            // echo $result[$i]['class_date']."--".$result[$i]['class_name'].'--'.$result[$i]['subject_name'].'<br />';
            if (!isset($result[$i]['class_date'])) {
                $result[$i]['class_date'] = '--';
                $result[$i]['class_name'] = '--';
                $result[$i]['subject_name'] = '--';
            }
            $result_array[$result[$i]['divid']]['division_id'] = $result[$i]['divid'];
            $result_array[$result[$i]['divid']]['division_name'] = $result[$i]['divname'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['zilla_id'] = $result[$i]['zillaid'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['zilla_name'] = $result[$i]['zillaname'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['upazilla'][$result[$i]['upozillaid']]['upazlla_id'] = $result[$i]['upozillaid'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['upazilla'][$result[$i]['upozillaid']]['upazlla_name'] = $result[$i]['upazilaname'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['upazilla'][$result[$i]['upozillaid']]['institute'][$result[$i]['id']]['institute_id'] = $result[$i]['id'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['upazilla'][$result[$i]['upozillaid']]['institute'][$result[$i]['id']]['institute_name'] = $result[$i]['name'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['upazilla'][$result[$i]['upozillaid']]['institute'][$result[$i]['id']]['date'][$result[$i]['class_date']]['class_date'] = $result[$i]['class_date'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['upazilla'][$result[$i]['upozillaid']]['institute'][$result[$i]['id']]['date'][$result[$i]['class_date']]['class'][$result[$i]['class_name']]['class_name'] = $result[$i]['class_name'];
            $result_array[$result[$i]['divid']]['zilla'][$result[$i]['zillaid']]['upazilla'][$result[$i]['upozillaid']]['institute'][$result[$i]['id']]['date'][$result[$i]['class_date']]['class'][$result[$i]['class_name']]['subject_name'][] = $result[$i]['subject_name'];


        }
        //echo $this->db->last_query();
        return $result_array;
    }

    public function get_total_user_use_mmc($division, $zilla, $upazila, $union = null, $from_date, $to_date, $status, $education_type)
    {
        $CI =& get_instance();
        //$user=User_helper::get_user();

        if (!empty($division)) {
            $this->db->where('institute.divid', $division);
            if (!empty($zilla)) {
                $this->db->where('institute.zillaid', $zilla);
                if (!empty($upazila)) {
                    $this->db->where('institute.upozillaid', $upazila);
                    //                    if (!empty($union))
                    //                    {
                    //                        $this->db->where('unions.unionid',$union);
                    //                    }
                }
            }
        }

        if ($status == 1) {
            $this->db->where('institute.is_primary', 1);
        } elseif ($status == 2) {
            $this->db->where('institute.is_secondary', 1);
        } elseif ($status == 3) {
            $this->db->where('institute.is_higher', 1);
        } else {

        }

        $this->db->select
        ("
            institute.id
        ", false);
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $this->db->join($CI->config->item('table_class_details') . ' institute_class_details', 'institute_class_details.institude_id = institute.id', 'INNER');

        $this->db->where('institute.education_type_ids', $education_type);
        $this->db->where('institute.status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where("institute_class_details.class_date between '$from_date' AND '$to_date' ");

        $this->db->group_by('institute.id', 'ASC');
        $result = $this->db->get()->result_array();
        //  echo $this->db->last_query();
        return $result;
    }

    public function get_total_institute($division, $zilla, $upazila, $union = null, $status, $education_type)
    {
        $CI =& get_instance();
        //$user=User_helper::get_user();

        if (!empty($division)) {
            $this->db->where('institute.divid', $division);
            if (!empty($zilla)) {
                $this->db->where('institute.zillaid', $zilla);
                if (!empty($upazila)) {
                    $this->db->where('institute.upozillaid', $upazila);
                    //                    if (!empty($union))
                    //                    {
                    //                        $this->db->where('unions.unionid',$union);
                    //                    }
                }
            }
        }

        if ($status == 1) {
            $this->db->where('institute.is_primary', 1);
        } elseif ($status == 2) {
            $this->db->where('institute.is_secondary', 1);
        } elseif ($status == 3) {
            $this->db->where('institute.is_higher', 1);
        } else {

        }

        $this->db->select
        ("
            institute.id
        ", false);
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $this->db->where('institute.education_type_ids', $education_type);
        $this->db->where('institute.status', $this->config->item('STATUS_ACTIVE'));
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }


}