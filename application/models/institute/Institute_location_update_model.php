<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Institute
 *
 * @author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * copyright SoftBD Ltd
 *
 */
class Institute_location_update_model extends CI_Model
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }




    public function get_listdatainstitute($division, $zilla, $upazilla, $email = '', $status)
    {
        $CI =& get_instance();

        //   $CI->db->from($CI->config->item('table_users').' users');
        //   $CI->db->select('users.*');

        if ($division) {
            $CI->db->where('institute.divid', $division);
        }
        if ($zilla) {
            $CI->db->where('institute.zillaid', $zilla);
        }
        if ($upazilla) {
            $CI->db->where('institute.upozillaid', $upazilla);
        }

        if ($email) {
            //  $CI->db->where("institute.email like '%$email%'");
            $CI->db->like('name', $email);
            $CI->db->or_like('email', $email);
            $CI->db->or_like('mobile', $email);
        }

        //  $CI->db->where('institute.user_group_id', $CI->config->item('USER_GROUP_INSTITUTE'));

        //    $results = $this->db->get()->result_array();
        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.status', $status);
        $CI->db->order_by("institute.id", "desc");
        $results = $CI->db->get()->result_array();
        //    echo $CI->db->last_query();
        foreach ($results as &$result) {
            $result['edit_link'] = $CI->get_encoded_url('institute/institute/index/edit/' . $result['id']);

            if ($result['status'] == 1) {
                $result['status'] = $CI->lang->line('WAITING');
            } else if ($result['status'] == 2) {
                $result['status'] = $CI->lang->line('ACTIVE');
            } else {
                $result['status'] = $result['status'];
            }

            if ($result['education_type_ids'] == 1) {
                $result['education_type_ids'] = $CI->lang->line('education_type_general');
            } elseif ($result['education_type_ids'] == 2) {
                $result['education_type_ids'] = $CI->lang->line('education_type_madrasha');
            } else {
                $result['education_type_ids'] = $result['education_type_ids'];
            }

        }

        return $results;


        $CI->jsonReturn($results);
    }





    public function get_institute_data($id)
    {

        $CI =& get_instance();

        $CI->db->select('institute.*');
        $CI->db->select('division.divname');
        $CI->db->select('zilla.zillaname');
        $CI->db->select('upazila.upazilaname');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->join($CI->config->item('table_divisions').' division','division.divid = institute.divid', 'LEFT');
        $CI->db->join($CI->config->item('table_zillas').' zilla','zilla.zillaid = institute.zillaid', 'LEFT');
        $CI->db->join($CI->config->item('table_upazilas').' upazila','upazila.upazilaid = institute.upozillaid AND upazila.zillaid = institute.zillaid', 'LEFT' );


        $CI->db->where('institute.id', $id);
        $result = $this->db->get()->row_array();
        return $result;

    }









}
