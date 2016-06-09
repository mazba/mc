<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Institute Controller
 *
 * @author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * copyright SoftBD Ltd
 */
class Institute_location_update extends Root_Controller
{
    //put your code here


    //  public $permissions;
    public $message;
    public $controller_url;
    public $current_action;

    function __construct()
    {
        parent::__construct();
        $this->message = '';
        //    $this->permissions=Menu_helper::get_permission('institute/Institute');
        //    $this->controller_url='nstitute_location_update/Institute_location_update';
        $this->load->model("institute/Institute_location_update_model");
        //     $this->permissions['view']='';
        //     $this->permissions['add']='';
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index($action = 'update', $id = 0)
    {
        //   echo 'sdfdfdf';

        $this->current_action = $action;

        if ($action == 'update') {
            $this->system_listupdate();
        } elseif ($action == 'updateinfo') {
            $this->system_listupdateinfo($id);
        } else {

        }
    }


    public function get_users()
    {
        $session_data = $this->session->userdata('userInfo');
        $passwords = array();

        $division = isset($session_data['division']) ? $session_data['division'] : 0;
        $zilla = isset($session_data['zilla']) ? $session_data['zilla'] : 0;
        $upazilla = isset($session_data['upazilla']) ? $session_data['upazilla'] : 0;
        $upazilla = isset($session_data['upazilla']) ? $session_data['upazilla'] : 0;
        $email = isset($session_data['email']) ? $session_data['email'] : 0;
        $status = 2;
        $passwords = $this->Institute_model->get_listdatainstitute($division, $zilla, $upazilla, $email, $status);
        $this->session->unset_userdata('userInfo');
        $this->jsonReturn($passwords);
    }

    public function get_list()
    {
        //   $this->load->model("institute/Institute_model");
        $institutes = array();
        //   if($this->permissions['list'])
        //    {
        $institutes = $this->Institute_model->get_listdata();
        //   }
        $this->jsonReturn($institutes);
    }

    public function get_listinactive()
    {
        //   $this->load->model("institute/Institute_model");
        $institutes = array();
        //   if($this->permissions['list'])
        //    {
        $institutes = $this->Institute_model->get_listinactive();
        //   }
        $this->jsonReturn($institutes);
    }


    private function check_validationEIIN()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('eiin', $this->lang->line('SCHOOL_EM'), 'trim|required|callback_isEIIMExist', array('required' => $this->lang->line('SCHOOL_EM') . ' লিখুন '));

        if ($this->form_validation->run() == FALSE) {
            $this->message = validation_errors();
            return false;
        }

        return true;

    }


    public function check_validationpassword()
    {

        $this->form_validation->set_rules('oldpassword', $this->lang->line('OLD_PASSWORD'), 'required', array('required' => $this->lang->line('OLD_PASSWORD') . ' লিখুন '));
        $this->form_validation->set_rules('newpassword', $this->lang->line('NEW_PASSWORD'), 'required', array('required' => $this->lang->line('NEW_PASSWORD') . ' লিখুন '));
        $this->form_validation->set_rules('newrepassword', $this->lang->line('RE_NEW_PASSWORD'), 'required', array('required' => $this->lang->line('RE_NEW_PASSWORD') . ' লিখুন '));
        $this->form_validation->set_rules('newrepassword', $this->lang->line('RE_NEW_PASSWORD'), 'required|matches[newpassword]', array('required' => $this->lang->line('RE_NEW_PASSWORD') . ' লিখুন ।'));
        $this->form_validation->set_message('matches', 'প্রদত্ত  দুই পাসওয়ার্ড একই হয়নি।  ');

        if ($this->form_validation->run() == FALSE) {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }


    private function system_listupdate()
    {
        if ($this->message) {
            $ajax['system_message'] = $this->message;

        }
        //$this->current_action='list';
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/update_location/update_location", "", true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute_location_update/institute_location_update/index/update');
        $this->jsonReturn($ajax);
    }

    public function get_listupdate()
    {

        $institutes = array();
        $institutes = $this->Institute_model->get_listupdate();
        $this->jsonReturn($institutes);
    }


    private function system_listupdateinfo($id)
    {
        $CI =& get_instance();

        $user = User_helper::get_user();
        $user_id = $user->id;

        $data['divisions'] = Query_helper::get_info($this->config->item('table_divisions'), array('divid value', 'divname text'), array());
        $data['display_divisions'] = true;
        $data['default_divisions'] = true;


        $data['institute'] = $this->Institute_location_update_model->get_institute_data($id);
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));


        if ($this->input->post()) {

            if (!$this->check_validation()) {
                $ajax['status'] = false;
                $ajax['system_message'] = $this->message;
                $this->jsonReturn($ajax);
            } else {
                $data = array(
                    'divid' => $this->input->post('division'),
                    'zillaid' => $this->input->post('zilla'),
                    'upozillaid' => $this->input->post('upazilla'),

                );
                $u_data = array(
                    'division' => $this->input->post('division'),
                    'zilla' => $this->input->post('zilla'),
                    'upazila' => $this->input->post('upazilla'),

                );

                $c_data = array(
                    'divid' => $this->input->post('division'),
                    'zillaid' => $this->input->post('zilla'),
                    'upazillaid' => $this->input->post('upazilla'),

                );


                if ($id > 0) {

                    $user_id = Query_helper::get_info($this->config->item('table_institute'), array('user_id'), array('id=' . $id), 1);


                    $this->db->trans_start();

                    Query_helper::update($CI->config->item('table_institute'), $data, array("id = " . $id));
                    Query_helper::update($CI->config->item('table_users'), $u_data, array("id = " . $user_id['user_id']));
                    Query_helper::update($CI->config->item('table_class_summary'), $c_data, array("institude_id = " . $id));

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === TRUE) {
                        $this->message = $this->lang->line("MSG_UPDATE_SUCCESS");
                        $this->system_listupdate();
                    } else {
                        $this->message = $this->lang->line("MSG_NOT_UPDATED_SUCCESS");
                    }


                }

            }

        }
        $this->current_action = 'edit';


        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/update_location/update", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute_location_update/institute_location_update/index/updateinfo/' . $id);
        $this->jsonReturn($ajax);
        //      }

    }

    private function check_validation()
    {

        $this->load->library('form_validation');


        $this->form_validation->set_rules('division', $this->lang->line('SELECT_DIVISION'), 'required', array('required' => $this->lang->line('SELECT_DIVISION')));
        $this->form_validation->set_rules('zilla', $this->lang->line('SELECT_DISTRICT'), 'required', array('required' => $this->lang->line('SELECT_DISTRICT')));
        $this->form_validation->set_rules('upazilla', $this->lang->line('SELECT_UPAZILLA'), 'required', array('required' => $this->lang->line('SELECT_UPAZILLA')));
        $this->form_validation->set_rules('name_bn', $this->lang->line('SCHOOL_NAME_BN'), 'required', array('required' => $this->lang->line('ERROR_SCHOOL_NAME_BN')));
        $this->form_validation->set_rules('name_en', $this->lang->line('SCHOOL_NAME_EN'), 'required', array('required' => $this->lang->line('ERROR_SCHOOL_NAME_EN')));


        if ($this->form_validation->run() == FALSE) {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }

    public function profile_update()
    {
        $CI =& get_instance();
        $this->load->library('form_validation');
        $ajax['status'] = true;
        $data = array();
        $data['title'] = $this->lang->line("LOCATION_CHANGE");
        $user = User_helper::get_user();


        $data['page'] = "inner_page";

        if ($this->input->post()) {
            $id=$user->id;

            if (!$this->check_validation()) {
                $ajax['status'] = false;
                $ajax['system_message'] = $this->message;
                $this->jsonReturn($ajax);
            }
            else {
                $institute_data = array(
                    'name'=>$this->input->post('name_bn'),
                    'divid' => $this->input->post('division'),
                    'zillaid' => $this->input->post('zilla'),
                    'upozillaid' => $this->input->post('upazilla'),

                );
                $user_data = array(
                    'name_bn'=>$this->input->post('name_bn'),
                    'name_en'=>$this->input->post('name_en'),
                    'division' => $this->input->post('division'),
                    'zilla' => $this->input->post('zilla'),
                    'upazila' => $this->input->post('upazilla'),

                );

                $class_data = array(
                    'divid' => $this->input->post('division'),
                    'zillaid' => $this->input->post('zilla'),
                    'upazillaid' => $this->input->post('upazilla'),

                );

                $institute_cancel_data = array(
                    'divid' => $this->input->post('division'),
                    'zillaid' => $this->input->post('zilla'),
                    'upozillaid' => $this->input->post('upazilla'),

                );

                $institute_id = Query_helper::get_info($this->config->item('table_institute'), array('id'), array('user_id=' . $id), 1);

                $this->db->trans_start();

                Query_helper::update($CI->config->item('table_institute'), $institute_data, array("id = " .$institute_id['id']));
                Query_helper::update($CI->config->item('table_users'), $user_data, array("id = " .$id));
                Query_helper::update($CI->config->item('table_class_summary'), $class_data, array("institude_id = " .$institute_id['id']));
                Query_helper::update($CI->config->item('table_institute_calcel'), $institute_cancel_data, array("institute_id = " .$institute_id['id']));

                $this->db->trans_complete();

                if ($this->db->trans_status() === TRUE) {
                    $this->message = $this->lang->line("MSG_UPDATE_SUCCESS");
                    redirect('home/dashboard');

                } else {
                    $this->message = $this->lang->line("MSG_NOT_UPDATED_SUCCESS");
                }


                }
            }

       // $data['institute_name']=Query_helper::get_info($this->config->item('table_users'), array('name_bn', 'name_en'), array());
        $data['userInfo'] = Query_helper::get_info($this->config->item('table_users'), array('name_bn', 'name_en'), array('id =' . $user->id), 1);

        $data['divisions'] = array();
        $data['display_divisions'] = false;
        $data['default_divisions'] = true;

        $data['zillas'] = array();
        $data['display_zillas'] = false;
        $data['default_zillas'] = true;

        $data['upazilas'] = array();
        $data['display_upazilas'] = false;
        $data['default_upazilas'] = true;

        if (($user->user_group_id == $this->config->item('SUPER_ADMIN_GROUP_ID')) || ($user->user_group_id == $this->config->item('A_TO_I_GROUP_ID')) || ($user->user_group_id == $this->config->item('USER_GROUP_MINISTRY_1')) || ($user->user_group_id == $this->config->item('USER_GROUP_MINISTRY_2')) || ($user->user_group_id == $this->config->item('USER_GROUP_MINISTRY_3')) || ($user->user_group_id == $this->config->item('USER_GROUP_MINISTRY_4')) || ($user->user_group_id == $this->config->item('USER_GROUP_DONNER_1')) || ($user->user_group_id == $this->config->item('USER_GROUP_DONNER_2')) || ($user->user_group_id == $this->config->item('USER_GROUP_DONNER_3'))) {
            $data['divisions'] = Query_helper::get_info($this->config->item('table_divisions'), array('divid value', 'divname text'), array());
            $data['display_divisions'] = true;
            $data['default_divisions'] = true;
        } else {
            $data['divisions'] = Query_helper::get_info($this->config->item('table_divisions'), array('divid value', 'divname text'), array('divid =' . $user->division));
            $data['display_divisions'] = true;
            $data['default_divisions'] = false;
            $data['display_zillas'] = true;
            if ($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_3')) {
                $data['zillas'] = Query_helper::get_info($this->config->item('table_zillas'), array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = ' . $user->division));
                $data['default_zillas'] = true;
                $data['display_upazilas'] = false;
            } else {
                $data['zillas'] = Query_helper::get_info($this->config->item('table_zillas'), array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = ' . $user->division, 'zillaid =' . $user->zilla));
                $data['default_zillas'] = false;
                $data['display_upazilas'] = true;
                if ($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_4')) {
                    $data['upazilas'] = Query_helper::get_info($this->config->item('table_upazilas'), array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = ' . $user->zilla));
                    $data['default_upazilas'] = true;
                    //$data['display_unions']=true;
                } else {
                    $data['upazilas'] = Query_helper::get_info($this->config->item('table_upazilas'), array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = ' . $user->zilla));
                    $data['usr_upazila'] = $user->upazila;
//                    print_r($data);die;
                    $data['default_upazilas'] = false;
                    $data['display_unions'] = true;
                    //                    $data['unions']=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid='.$user->upazila));
                    //                    $data['default_unions']=true;
                    //TODO
                    //increase report menu for union users
                }
            }
        }

        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/location_change", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute_location_update/institute_location_update/profile_update');
        $this->jsonReturn($ajax);
    }


}
