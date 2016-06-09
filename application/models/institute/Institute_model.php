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
class Institute_model extends CI_Model
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }
//    
//  public function EM_exists($key)
//{
//     $CI =& get_instance();
//    $this->db->where('code',$key);
//    $this->db->from($CI->config->item('table_institute').' institute');
//   // $query = $this->db->get('roles');
//     $users = $this->db->get()->result_array();
//    if ($query->num_rows() > 0){
//        return true;
//    }
//    else{
//        return false;
//    }
//}

    function form_insert($data)
    {
        // Inserting in Table(students) of Database(college)
        $CI =& get_instance();
        $this->db->insert($CI->config->item('table_institute'), $data);
    }

    function form_insertclass($data)
    {
        // Inserting in Table(students) of Database(college)
        $CI =& get_instance();
        $this->db->insert($CI->config->item('table_class_details'), $data);
    }

    function form_insertclasssumm($data)
    {
        // Inserting in Table(students) of Database(college)
        $CI =& get_instance();
        $this->db->insert($CI->config->item('table_class_summary'), $data);
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

    public function get_listdata()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        //    $user_division = $user->division.'dfdfd';
        //echo $user->user_group_id;
        // $config['USER_GROUP_DIVISION_1'] = 10;
        if ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1')) {
            $user_division = $user->division;
            //      $user_uiscs = $this->get_div_user_uiscs($user_division);
            //         $CI->db->where("institute.uisc_id IN(".$user_uiscs.")");
            $CI->db->where('institute.divid', $user->division);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_2')) {
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user->division);
            $CI->db->where('institute.status', 2);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_3')) {
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user->division);
            $CI->db->where('institute.status', 2);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_1')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 2);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_2')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 2);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_3')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 2);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_4')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 2);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_1')) {
            $user_division = $user->division;
            $user_district = $user->zilla;
            $user_upazilla = $user->upazila;
            $CI->db->where('institute.status', 2);

            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user_district);
            $CI->db->where('institute.upozillaid', $user_upazilla);
        }


        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.status', 2);
        $CI->db->order_by("institute.id", "desc");
        //       $CI->db->join($CI->config->item('table_user_group').' groups', 'groups.id = institute.user_group_id', 'LEFT');
        $results = $CI->db->get()->result_array();

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

    }


    public function get_listinactive()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        //   echo $user->user_group_id;
        //    $user_division = $user->division.'dfdfd';
        //  echo $user->user_group_id;
        // $config['USER_GROUP_DIVISION_1'] = 10;
        //echo $this->config->item('USER_GROUP_UPOZILA_1');
        //     echo $user->division.'div';
        //      echo $user->zilla.'dis';
        //       echo $user->upazila.'upo';
        if ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1')) {
            $user_division = $user->division;
            //      $user_uiscs = $this->get_div_user_uiscs($user_division);
            //         $CI->db->where("institute.uisc_id IN(".$user_uiscs.")");
            $CI->db->where('institute.divid', $user->division);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_2')) {
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user->division);
            $CI->db->where('institute.status', 1);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_3')) {
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user->division);
            $CI->db->where('institute.status', 1);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_1')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 1);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_2')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 1);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_3')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 1);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_4')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);
            $CI->db->where('institute.status', 1);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_1')) {
            //    echo 'fgfg';
            $user_division = $user->division;
            $user_district = $user->zilla;
            $user_upazilla = $user->upazila;
            $CI->db->where('institute.status', 1);

            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user_district);
            $CI->db->where('institute.upozillaid', $user_upazilla);

        }


        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.status', 1);
        $CI->db->order_by("institute.id", "desc");
        //       $CI->db->join($CI->config->item('table_user_group').' groups', 'groups.id = institute.user_group_id', 'LEFT');
        $results = $CI->db->get()->result_array();

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

    }

    public function get_institute_data($id)
    {

        $CI =& get_instance();

        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.id', $id);
        $result = $this->db->get()->row_array();
        return $result;

    }


    public function get_institute_information($id)
    {

        $CI =& get_instance();

        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.user_id', $id);
        $result = $this->db->get()->row_array();
        // echo $CI->db->last_query();
        return $result;

    }


    public function get_user_information($id)
    {

        $CI =& get_instance();

        $CI->db->select('users.*');
        $CI->db->from($CI->config->item('table_users') . ' users');
        $CI->db->where('users.id', $id);
        $result = $this->db->get()->row_array();
        return $result;

    }


    public function get_user_informationbymail($email)
    {

        $CI =& get_instance();

        $CI->db->select('users.*');
        $CI->db->from($CI->config->item('table_users') . ' users');
        $CI->db->where('users.email', $email);
        $result = $this->db->get()->row_array();
        return $result;

    }

    public function get_user_informationbylink($link)
    {

        $CI =& get_instance();

        $CI->db->select('users.*');
        $CI->db->from($CI->config->item('table_users') . ' users');
        $CI->db->where('users.reset_link', $link);
        $result = $this->db->get()->row_array();
        return $result;

    }


    public function zilausers($zilaid, $groupid)
    {
        $CI =& get_instance();
        $CI->db->select('users.*');
        $CI->db->from($CI->config->item('table_users') . ' users');
        $CI->db->where(array('users.zilla' => $zilaid, 'users.user_group_id' => $groupid, 'users.status' => 2));
        $result = $this->db->get()->row_array();
        return $result;

    }

    public function get_message_sendlistdata()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $this->db->select('communication.*, users.name_en');
        $this->db->from($CI->config->item('table_communication') . ' communication');
        $this->db->join($CI->config->item('table_users') . ' users', 'users.id=communication.receiver_id', 'left');
        $this->db->where('communication.sender_id', $user->id);
        $this->db->order_by('communication.id', 'DESC');
        $results = $CI->db->get()->result_array();

        return $results;
    }


    public function get_message_inbox()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $this->db->select('communication.*, users.name_en');
        $this->db->from($CI->config->item('table_communication') . ' communication');
        $this->db->join($CI->config->item('table_users') . ' users', 'users.id=communication.sender_id', 'left');
        $this->db->where('communication.receiver_id', $user->id);
        $this->db->order_by('communication.id', 'DESC');
        $results = $CI->db->get()->result_array();

        return $results;
    }

    public function check_division($division_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_divisions'));
        $CI->db->where('divid', $division_id);
        $results = $CI->db->get()->result_array();
        if (!$results) {
            return false;
        } else {
            return true;
        }
    }

    public function check_zilla($division_id, $zilla_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_zillas'));
        $CI->db->where('divid', $division_id);
        $CI->db->where('zillaid', $zilla_id);
        $results = $CI->db->get()->result_array();
        if (!$results) {
            return false;
        } else {
            return true;
        }
    }

    public function check_upazilla($zilla_id, $upazilla_id)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_upazilas'));
        $CI->db->where('zillaid', $zilla_id);
        $CI->db->where('upazilaid', $upazilla_id);
        $results = $CI->db->get()->result_array();

        if (!$results) {
            return false;
        } else {
            return true;
        }
    }

    public function get_listupdate()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();

        if ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1')) {
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user->division);
        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_2')) {
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user->division);

        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_3')) {
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user->division);

        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_1')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);

        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_2')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);

        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_3')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);

        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_4')) {
            $user_district = $user->zilla;
            $user_division = $user->division;
            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user->zilla);

        } elseif ($user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_1')) {
            $user_division = $user->division;
            $user_district = $user->zilla;
            $user_upazilla = $user->upazila;


            $CI->db->where('institute.divid', $user_division);
            $CI->db->where('institute.zillaid', $user_district);
            $CI->db->where('institute.upozillaid', $user_upazilla);

        } else {

        }

        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.status', 2);
        $CI->db->order_by("institute.id", "desc");
        $results = $CI->db->get()->result_array();

        foreach ($results as &$result) {
            $result['edit_link'] = $CI->get_encoded_url('institute/institute/index/updateinfo/' . $result['id']);

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

    }

    public function checkIDisAvailable($code, $id)
    {
        $CI =& get_instance();
        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');
        $CI->db->where('institute.code', $code);
        $CI->db->where('institute.id !=', $id);
        $CI->db->where('institute.status = 2');
        $results = $CI->db->get()->result_array();
        // echo $CI->db->last_query();
        return $results;
    }

    public function get_info_old_password($user_id, $old_pass)
    {
        $CI =& get_instance();
        $CI->db->select('users.*');
        $CI->db->from($CI->config->item('table_users') . ' users');

        $CI->db->where('users.id', $user_id);
        $CI->db->where('users.password', $old_pass);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_institute_info_in_class_summary_table($id){
        $CI =& get_instance();
        $CI->db->select('class.*');
        $CI->db->from($CI->config->item('table_class_summary') . ' class');

        $CI->db->where('class.institude_id', $id);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function check_register_information($data){
        $CI =& get_instance();
        $CI->db->select('institute.*');
        $CI->db->from($CI->config->item('table_institute') . ' institute');

        $CI->db->where('institute.code', $data['code']);
        $CI->db->where('institute.email', $data['email']);

        $CI->db->where('institute.status = 1');
        $CI->db->where('institute.status = 2');

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
