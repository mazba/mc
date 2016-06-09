<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approved_institute_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // all load model
    }

    public function get_approved_institute_list($division, $zilla, $upazila, $union, $from_date, $to_date, $status, $education_type)
    {
        $CI =& get_instance();
        //$user=User_helper::get_user();

        if (!empty($division))
        {
            $this->db->where('divisions.divid',$division);
            if (!empty($zilla))
            {
                $this->db->where('zillas.zillaid',$zilla);
                if (!empty($upazila))
                {
                    $this->db->where('upa_zilas.upazilaid',$upazila);
                    if (!empty($union))
                    {
                        $this->db->where('unions.unionid',$union);
                    }
                }
            }
        }

        if($status==1)
        {
            $this->db->where('institute.is_primary',1);
        }
        elseif($status==2)
        {
            $this->db->where('institute.is_secondary',1);
        }
        elseif($status==3)
        {
            $this->db->where('institute.is_higher',1);
        }
        else
        {

        }

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
            upa_zilas.upazilaname
        ", false);
        $CI->db->from($CI->config->item('table_institute').' institute');

        $this->db->join($CI->config->item('table_divisions').' divisions','divisions.divid = institute.divid', 'LEFT');
        $this->db->join($CI->config->item('table_zillas').' zillas','zillas.divid = institute.divid AND zillas.zillaid = institute.zillaid', 'LEFT');
        $this->db->join($CI->config->item('table_upazilas').' upa_zilas','upa_zilas.zillaid = institute.zillaid AND upa_zilas.upazilaid = institute.upozillaid', 'LEFT');

        $this->db->where('institute.education_type_ids',$education_type);
        $this->db->where('institute.status', $this->config->item('STATUS_ACTIVE'));
        $this->db->where("institute.applied_date between '$from_date' AND '$to_date' ");

        //$this->db->group_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid');
        $this->db->order_by('divisions.divid, zillas.zillaid, upa_zilas.upazilaid','ASC');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }


}