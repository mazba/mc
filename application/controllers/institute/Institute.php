<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Institute Controller
 *
 * @author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * copyright SoftBD Ltd
 */
class Institute extends Root_Controller
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
        //    $this->controller_url='institute/Institute';
        $this->load->model("institute/Institute_model");
        //     $this->permissions['view']='';
        //     $this->permissions['add']='';
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index($action = 'search', $id = 0)
    {
        //   echo 'sdfdfdf';

        $this->current_action = $action;

        if ($action == 'list') {
            $this->system_list();
        } elseif ($action == 'edit') {
            $this->system_edit($id);
        } elseif ($action == 'save') {
            $this->system_save();
        } elseif ($action == 'inactive') {
            //   $this->system_listinactive();
            $this->system_list_inactive();
        } elseif ($action == 'update') {
            $this->system_listupdate();
        } elseif ($action == 'updateinfo') {
            $this->system_listupdateinfo($id);
        } elseif ($action == 'search') {
            $this->system_search();
        } elseif ($action == 'searchinactive') {
            $this->system_searchinactive();
        } elseif ($action == 'delete_institute') {
            $this->system_delete();
        } else {


        }
    }

    private function system_search()
    {
        //    if($this->permissions['add'])
        //   {
        $this->current_action = 'add';
        $ajax['status'] = true;
        $data = array();


        $user = User_helper::get_user();
        $data['divisions'] = array();
        $data['display_divisions'] = false;
        $data['default_divisions'] = true;

        $data['zillas'] = array();
        $data['display_zillas'] = false;
        $data['default_zillas'] = true;
        $data['upazilas'] = array();
        $data['display_upazilas'] = false;
        $data['default_upazilas'] = true;
        $data['unions'] = array();
        $data['display_unions'] = false;
        $data['default_unions'] = true;
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
                    $data['upazilas'] = Query_helper::get_info($this->config->item('table_upazilas'), array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = ' . $user->zilla, 'upazilaid = ' . $user->upazila));
                    $data['default_upazilas'] = false;
                    $data['display_unions'] = true;
                    //                    $data['unions']=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid='.$user->upazila));
                    //                    $data['default_unions']=true;
                    //TODO
                    //increase report menu for union users
                }
            }
        }
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/institute_search", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/search');
        if ($this->message) {
            $ajax['system_message'] = $this->message;
        }
        $this->jsonReturn($ajax);

        //       }
//        else
//        {
//            $ajax['status']=false;
//            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
//            $this->jsonReturn($ajax);
//        }


    }

    private function system_list()
    {


        $this->current_action = 'list';
        $ajax['status'] = true;

        $user = User_helper::get_user();

        $div_post = $this->input->post('division');
        $zilla_post = $this->input->post('zilla');
        $upazilla_post = $this->input->post('upazilla');

        if (($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_3')) && $div_post == '') {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("SELECT_DIVISION");
            $this->jsonReturn($ajax);
        } elseif (($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_3')) && $zilla_post == "") {

            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("SELECT_DISTRICT");
            $this->jsonReturn($ajax);
        } elseif (($user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_3')) && $upazilla_post == '') {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("SELECT_UPAZILLA");
            $this->jsonReturn($ajax);
        } else {
            $session_data['userInfo'] = $this->input->post();
            $this->session->set_userdata($session_data);

            $ajax['system_content'][] = array("id" => "#load_list", "html" => $this->load_view("institute/list", '', true));

            if ($this->message) {
                $ajax['system_message'] = $this->message;
            }

            $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/search');
            $ajax['system_page_title'] = $this->lang->line("USER_PASSWORD_RESET");
            $this->jsonReturn($ajax);
        }

    }
//
//    private function system_list()
//    {
//
//        //     if($this->permissions['list'])
//        //     {
//        if ($this->message) {
//            $ajax['system_message'] = $this->message;
//
//        }
//        $this->current_action = 'list';
//        $ajax['status'] = true;
//        $data['page']="inner_page";
//        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
//        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
//        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/list", "", true));
//
//        $this->jsonReturn($ajax);
//
//        //      }
//
//    }


    private function system_listinactive()
    {
        if ($this->message) {
            $ajax['system_message'] = $this->message;

        }
        //$this->current_action='list';
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/listinactive", "", true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/inactive');
        $this->jsonReturn($ajax);
    }


    private function system_edit($id)
    {

        /*       if(!$this->permissions['edit'])
              {
                  $ajax['status']=false;
                  $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                  $this->jsonReturn($ajax);
              }
       */
        //      else
        //       {
        $this->current_action = 'edit';

        //     $data['title'] = $this->lang->line('QUESTION_DETAIL');
        $data['institute'] = $this->Institute_model->get_institute_data($id);
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/edit", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/edit/' . $id);
        $this->jsonReturn($ajax);
        //      }

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


    private function system_save()
    {
        $CI =& get_instance();

        $user = User_helper::get_user();
        $user_id = $user->id;
        $id = $this->input->post("instituteid");
        if (!$this->check_validation_registration_approved()) {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->message;
            $this->jsonReturn($ajax);
        }
        if ($id > 0) {

            $data = array(
                'status' => $this->input->post('registration[status]'),
                'approved_by' => $user_id,
                'approved_date' => date("Y-m-d"),
                'comment' => "accepted"
            );

            $CI =& get_instance();
            $this->db->where('id', $id);
            $this->db->update($CI->config->item('table_institute'), $data);

            if ($this->input->post('registration[status]') == 2):
                $CI =& get_instance();
                $this->db->where('id', $id);
                //here we select every clolumn of the table
                $q = $this->db->get($CI->config->item('table_institute'));
                $datainstitute = $q->result_array();
                //print_r($datainstitute);
                //echo $datainstitute->name;
                //$datainstitute[0]['name'];
                $datauser = array(
                    'username' => $datainstitute[0]['email'],
                    'password' => md5($datainstitute[0]['inipassword']),
                    'name_bn' => $datainstitute[0]['name'],
                    'name_en' => $datainstitute[0]['name'],
                    'table_id' => '0',
                    'uisc_type' => '0',
                    'user_group_id' => 20,
                    'template_id' => '1',
                    'language_id' => '1',
                    'uisc_id' => '1',
                    'ques_id' => '1',
                    'ques_ans' => '1',
                    'division' => $datainstitute[0]['divid'],
                    'zilla' => $datainstitute[0]['zillaid'],
                    'upazila' => $datainstitute[0]['upozillaid'],
                    'unioun' => '0',
                    'citycorporation' => '0',
                    'citycorporationward' => '0',
                    'municipal' => '0',
                    'municipalward' => '0',
                    'designation' => '0',
                    'gender' => '1',
                    'phone' => $datainstitute[0]['mobile'],
                    'office_phone' => $datainstitute[0]['mobile'],
                    'mobile' => $datainstitute[0]['mobile'],
                    'email' => $datainstitute[0]['email'],
                    'national_id_no' => '0',
                    'present_address' => '0',
                    'permanent_address' => '0',
                    'picture_alt' => '0',
                    'picture_name' => '0',
                    'notifiacation' => '0',
                    'dob' => '0',
                    'first_login' => '',
                    'create_by' => $user_id,
                    'status' => 2,
                    'create_date' => strtotime($datainstitute[0]['applied_date']),
                    'approved_date' => time(),
                    'update_by' => $user_id,
                    'update_date' => strtotime($datainstitute[0]['applied_date'])


                );
                $this->db->insert($CI->config->item('table_users'), $datauser);

                $datalast = array(
                    'user_id' => $this->db->insert_id(),

                );
                $this->db->where('id', $id);
                $this->db->update($CI->config->item('table_institute'), $datalast);
            endif;

            //$ajax['system_message']=$this->lang->line("SUCESS_MESSAGE");
            //$this->message=$this->lang->line("SUCESS_MESSAGE");

            //$this->message=$this->lang->line("SUCESS_MESSAGE");
        }
        //$ajax['status']=false;
        $this->message = $this->lang->line("MSG_APPROVED_SUCCESS");
        //$this->jsonReturn($ajax);
        $this->system_listinactive();

    }

    public function classadd()
    {
        $user = User_helper::get_user();
        //print_r($user);
        $user_id = $user->id;

        $data['institute'] = $this->Institute_model->get_institute_information($user->id);

        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/classadd", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/classadd');
        $this->jsonReturn($ajax);


    }


    public function eiin()
    {
        $CI =& get_instance();
        $this->load->library('form_validation');
        $data['title'] = $this->lang->line("EIIN_NO_UPDATE");
        $user = User_helper::get_user();
        // $user_id = $user->id;

        if ($this->input->post()) {

            if (!$this->check_validationEIIN()) {
                $ajax['status'] = false;
                $ajax['system_message'] = $this->message;
                $this->jsonReturn($ajax);
            } else {
                $dataeiin = array(
                    'code' => $this->input->post('eiin')
                );
                $this->db->where('id', $this->input->post('instituteid'));
                $this->db->update('institute', $dataeiin);
                $this->session->userdata($this->lang->line("SUCESS_MESSAGE_EIIM"));
                $successmessageeiin = array(
                    'eiin_message' => $this->lang->line("SUCESS_MESSAGE_EIIM"),
                );
                $this->session->set_userdata($successmessageeiin);
                //    redirect(base_url().'home/dashboard/', 'refresh');
                $ajax['system_message'] = $this->lang->line("SUCESS_MESSAGE_EIIM");
                //    $ajax['system_page_url']=$this->get_encoded_url('home/dashboard');
                $this->jsonReturn($ajax);
            }
        }
        $data['institute'] = $this->Institute_model->get_institute_information($user->id);
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/eiin", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/eiin');
        $this->jsonReturn($ajax);

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

    public function isEIIMExist($key)
    {
        $CI =& get_instance();
        $this->db->where('code', $key);
        $query = $this->db->get($CI->config->item('table_institute'));


        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('isEIIMExist', 'এই %s ইতিপূর্বে  নিবন্ধিত হয়েছে');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function classsave()
    {
        $CI =& get_instance();

        $institute = $this->input->post('institute');
        $education_level = $this->input->post('education_level');
        $classes = $this->input->post('classesid');
        $classdate = $this->input->post('cladddate');
        $subject = $this->input->post('subject');

        $education_type_ids = $this->input->post('education_type_ids');

        $classname = array();
        $classes_date = array();
        $val_class = array();
        $subject_list = array();
        $subjects = array();
        //   print_r($education_level);
        //   echo count($education_level);
        //    echo key($education_level), PHP_EOL ;
        // echo current($education_level), PHP_EOL ;
        //    exit();
        //    if( $classes):
        // $thgjhj= current($education_level), PHP_EOL;

        //     if(current($education_level), PHP_EOL ):
        //   echo current($education_level);
        //   exit();
        if (current($education_level) > 0):
            $check_number = 0;
            for ($i = 0; $i < count($education_level); $i++) {

                if (isset($subject[$education_level[$i]][$classes[$i]]) && !empty($education_level[$i]) && !empty($classes[$i])) {

                    for ($s = 0; $s < count($subject[$education_level[$i]][$classes[$i]]); $s++) {
                        $subjects[] = (int)$subject[$education_level[$i]][$classes[$i]][$s];
                        if (isset($subject[$education_level[$i]][$classes[$i]][$s])) {
                            $this->db->where('id', $subject[$education_level[$i]][$classes[$i]][$s]);
                            $q = $this->db->get($CI->config->item('table_subject'))->row_array();

                            if ($classes[$i] == 1) {
                                $class_name = 'প্রথম শ্রেণী';
                            } elseif ($classes[$i] == 2) {
                                $class_name = 'দ্বিতীয় শ্রেণী';
                            } elseif ($classes[$i] == 3) {
                                $class_name = 'তৃতীয় শ্রেণী';
                            } elseif ($classes[$i] == 4) {
                                $class_name = 'চুতুর্থ শ্রেণী';
                            } elseif ($classes[$i] == 5) {
                                $class_name = 'পঞ্চম শ্রেণী';
                            } elseif ($classes[$i] == 6) {
                                $class_name = 'ষষ্ঠ শ্রেণী';
                            } elseif ($classes[$i] == 7) {
                                $class_name = 'সপ্তম শ্রেণী';
                            } elseif ($classes[$i] == 8) {
                                $class_name = 'অষ্টম শ্রেণী';
                            } elseif ($classes[$i] == 9) {
                                $class_name = 'নবম শ্রেণী';
                            } elseif ($classes[$i] == 10) {
                                $class_name = 'দশম শ্রেণী';
                            } elseif ($classes[$i] == 11) {
                                $class_name = '১ম বর্ষ';
                            } else {
                                $class_name = '২য় বর্ষ';
                            }

                            $datain = array
                            (
                                'institude_id' => $institute,
                                'class_name' => $class_name,
                                'class_id' => $classes[$i],
                                'subject_id' => $subject[$education_level[$i]][$classes[$i]][$s],
                                'subject_name' => $q['name'],
                                'education_type_id' => $education_type_ids,
                                'class_date' => $classdate[$i]
                            );
                            //print_r($datain);

                            $this->check_duplicate_data_in_class_details($datain, $check_number);
                            $this->Institute_model->form_insertclass($datain);
                            $check_number++;

                        }
                        //$subject_list[$classes[$i]] = $subject;

                    }
                    //    echo count($subject[$education_level[$i]][$classes[$i]]);
                    $subject_list[$classes[$i]] = $subjects;

                    $new_array = $subject_list;
                    $itemcount = count($subject[$education_level[$i]][$classes[$i]]);

                    $dataseri = array
                    (
                        'education_type_id' => $education_type_ids,
                        'class_ids' => $classes[$i],
                        'no_of_class' => $itemcount,
                        'subject_ids' => serialize($new_array),
                        'no_of_subjects' => $itemcount,
                        'date' => $classdate[$i],
                        'institude_id' => $institute,
                        'education_level_id' => $this->input->post('education_level_id'),
                        'divid' => $this->input->post('divid'),
                        'zillaid' => $this->input->post('zillaid'),
                        'upazillaid' => $this->input->post('upazillaid'),
                    );
                    $this->check_duplicate_data_in_class_summary($dataseri);
                    $this->Institute_model->form_insertclasssumm($dataseri);


                }


            }

            $ajax['system_message'] = $this->lang->line("SCHOOL_CLASS_INFORMATION_SUBMITED");
        else:
            // end count loop
            $ajax['system_message'] = $this->lang->line("SCHOOL_CLASS_INFORMATION_SUBMITED_NOT");

        endif;
        $user = User_helper::get_user();
        $user_id = $user->id;
        $data['institute'] = $this->Institute_model->get_institute_information($user->id);
        $ajax['status'] = true;

        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/classadd", $data, true));
        //       $this->jsonReturn($ajax);

        $this->jsonReturn($ajax);
        //  redirect('/institute/institute/classadd', 'refresh');

    }

    private function check_duplicate_data_in_class_details($datain, $check_number)
    {
        if ($check_number == 0) {
            $CI =& get_instance();
            $CI->db->select('class_details.*');
            $CI->db->from($CI->config->item('table_class_details') . ' class_details');
            $CI->db->where('class_details.institude_id', $datain['institude_id']);
            $CI->db->where('class_details.class_name', $datain['class_name']);
            $CI->db->where('class_details.class_id', $datain['class_id']);
            //  $CI->db->where('class_details.subject_id', $datain['subject_id']);
            $CI->db->where('class_details.education_type_id', $datain['education_type_id']);
            $CI->db->where('class_details.class_date', $datain['class_date']);

            $results = $CI->db->get();
            if ($results->num_rows() > 0) {
                foreach ($results->result_array() as $row) {

                    $CI->db->where('institude_id', $row['institude_id']);
                    $CI->db->where('class_name', $row['class_name']);
                    $CI->db->where('class_id', $row['class_id']);
                    //  $CI->db->where('subject_id', $datain['subject_id']);
//            $CI->db->where('education_type_id', $datain['education_type_id']);
                    $CI->db->where('class_date', $row['class_date']);
                    $CI->db->delete($CI->config->item('table_class_details'));
                    // echo $CI->db->last_query();
                }
            }
        }
    }

    private function check_duplicate_data_in_class_summary($dataseri)
    {
        $CI =& get_instance();
        $CI->db->select('class_summary.*');
        $CI->db->from($CI->config->item('table_class_summary') . ' class_summary');
        $CI->db->where('class_summary.education_type_id', $dataseri['education_type_id']);
        $CI->db->where('class_summary.class_ids', $dataseri['class_ids']);
        $CI->db->where('class_summary.date', $dataseri['date']);
        $CI->db->where('class_summary.institude_id', $dataseri['institude_id']);
        $CI->db->where('class_summary.education_level_id', $dataseri['education_level_id']);
        $CI->db->where('class_summary.divid', $dataseri['divid']);
        $CI->db->where('class_summary.zillaid', $dataseri['zillaid']);
        $CI->db->where('class_summary.upazillaid', $dataseri['upazillaid']);

        $results = $CI->db->get();
        if ($results->num_rows() > 0) {

            $CI->db->where('education_type_id', $dataseri['education_type_id']);
            $CI->db->where('class_ids', $dataseri['class_ids']);
            $CI->db->where('date', $dataseri['date']);
            $CI->db->where('institude_id', $dataseri['institude_id']);
            $CI->db->where('education_level_id', $dataseri['education_level_id']);
            $CI->db->where('divid', $dataseri['divid']);
            $CI->db->where('zillaid', $dataseri['zillaid']);
            $CI->db->where('upazillaid', $dataseri['upazillaid']);
            $CI->db->delete($CI->config->item('table_class_summary'));
            // echo $CI->db->last_query();
        }

    }

    private function check_validation_registration_approved()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('registration[status]', $this->lang->line('APPROVED'), 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }

    public function passwordchange()
    {
        /*      if(!$this->permissions['edit'])
              {
                  $ajax['status']=false;
                  $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                  $this->jsonReturn($ajax);
              }
      */
        $CI =& get_instance();
        $this->load->library('form_validation');
        $ajax['status'] = true;
        $data = array();
        $data['title'] = $this->lang->line("PASSWORD_CHANGE");

        $data['page'] = "inner_page";
        if ($this->input->post()) {
            if (!$this->check_validationpassword()) {
                $ajax['status'] = false;
                $ajax['system_message'] = $this->message;
                $this->jsonReturn($ajax);
            } else {
                $user = User_helper::get_user();
                $user_id = $user->id;
                $old_pass = md5($this->input->post('oldpassword'));

                if (!$this->Institute_model->get_info_old_password($user_id, $old_pass)) {

                    $ajax['status'] = false;
                    $ajax['system_message'] = "পুরনো পাসওয়ার্ড সঠিক না ";
                    $this->jsonReturn($ajax);
                    die();

                } else {


                    $data = array(
                        'password' => md5($this->input->post('newrepassword')),
                    );

                    $this->db->where('id', $user->id);
                    $this->db->update($CI->config->item('table_users'), $data);

                    $ajax['system_message'] = $this->lang->line('NEW_PASSWORD_CHANGE_MESSAGE');
                    $this->jsonReturn($ajax);
                }
            }
        }

        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/passwordchange", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/passwordchange');
        $this->jsonReturn($ajax);

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

    public function disable()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $user_id = $user->id;
        $id = $this->input->post('id');
        if (empty($user_id)) {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        } else {
            if ($id > 0) {
                $data = array(
                    'status' => 99,
                    'comment' => "Disable"
                );


                $this->db->where('id', $id);
                $this->db->update($CI->config->item('table_institute'), $data);
                //   $this->message = $this->lang->line("DISCARD_MESSAGE");
                $this->db->where('id', $id);
                $q = $this->db->get($CI->config->item('table_institute'));
                $datainstitutee = $q->result_array();

                $datadisable = array(
                    'institute_id' => $id,
                    'divid' => $datainstitutee[0]['divid'],
                    'zillaid' => $datainstitutee[0]['zillaid'],
                    'upozillaid' => $datainstitutee[0]['upozillaid'],
                    'user_id' => $user->id,
                    'calcel_date' => date("Y-m-d H:i:s"),
                    'is_primary' => $datainstitutee[0]['is_primary'],
                    'is_secondary' => $datainstitutee[0]['is_secondary'],
                    'is_higher' => $datainstitutee[0]['is_higher'],
                );
                Query_helper::add($CI->config->item('table_institute_calcel'), $datadisable);

                $ajax['status'] = false;
                $ajax['system_message'] = $this->lang->line("DISCARD_MESSAGE");
                $ajax['delete_status'] = "DELETE";
                $this->jsonReturn($ajax);
                //  $this->jsonReturn($ajax);
                //  $this->system_searchinactive();

            } else {
                $this->message = $this->lang->line("TRY_AGAIN");
                //$this->jsonReturn($ajax);
                $this->system_searchinactive();

            }

        }


    }

    public function disableActiveInstitute()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $user_id = $user->id;
        $id = $this->input->post('id');

        if (empty($user_id)) {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        } else {


            if ($id > 0) {

                $result = $this->Institute_model->get_institute_info_in_class_summary_table($id);
                if ($result) {

                    $ajax['status'] = false;
                    $ajax['system_message'] = $this->lang->line("DATA_FOUND_MESSAGE");
                    $this->jsonReturn($ajax);
                } else {

                    $data = array(
                        'status' => 99,
                        'comment' => "Disable"
                    );
                    $data2 = array(
                        'status' => 99
                    );


                    $this->db->where('id', $id);
                    $this->db->update($CI->config->item('table_institute'), $data);
                    //   $this->message = $this->lang->line("DISCARD_MESSAGE");
                    $this->db->where('id', $id);
                    $q = $this->db->get($CI->config->item('table_institute'));
                    $datainstitutee = $q->result_array();

                    $datadisable = array(
                        'institute_id' => $id,
                        'divid' => $datainstitutee[0]['divid'],
                        'zillaid' => $datainstitutee[0]['zillaid'],
                        'upozillaid' => $datainstitutee[0]['upozillaid'],
                        'user_id' => $user->id,
                        'calcel_date' => date("Y-m-d H:i:s"),
                        'is_primary' => $datainstitutee[0]['is_primary'],
                        'is_secondary' => $datainstitutee[0]['is_secondary'],
                        'is_higher' => $datainstitutee[0]['is_higher'],
                    );
                    Query_helper::add($CI->config->item('table_institute_calcel'), $datadisable);


                    $this->db->where('id', $datainstitutee[0]['user_id']);
                    $this->db->update($CI->config->item('table_users'), $data2);


//                    $ajax['system_message'] = $this->lang->line("DISCARD_MESSAGE");
//                    $this->jsonReturn($ajax);

                    $ajax['status'] = false;
                    $ajax['system_message'] = $this->lang->line("DISCARD_MESSAGE");

                    $ajax['delete_status'] = "DELETE";
                    $this->jsonReturn($ajax);

                }
            } else {
                $this->message = $this->lang->line("TRY_AGAIN");
                //$this->jsonReturn($ajax);
                $this->system_searchinactive();

            }

        }


    }

    //Delete institute
    public function system_delete()
    {

        $this->current_action = 'add';
        $ajax['status'] = true;
        $data = array();


        $user = User_helper::get_user();
        $data['divisions'] = array();
        $data['display_divisions'] = false;
        $data['default_divisions'] = true;

        $data['zillas'] = array();
        $data['display_zillas'] = false;
        $data['default_zillas'] = true;
        $data['upazilas'] = array();
        $data['display_upazilas'] = false;
        $data['default_upazilas'] = true;
        $data['unions'] = array();
        $data['display_unions'] = false;
        $data['default_unions'] = true;
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
                    $data['upazilas'] = Query_helper::get_info($this->config->item('table_upazilas'), array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = ' . $user->zilla, 'upazilaid = ' . $user->upazila));
                    $data['default_upazilas'] = false;
                    $data['display_unions'] = true;
                    //                    $data['unions']=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid='.$user->upazila));
                    //                    $data['default_unions']=true;
                    //TODO
                    //increase report menu for union users
                }
            }
        }
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/institute_delete", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/delete_institute');
        if ($this->message) {
            $ajax['system_message'] = $this->message;
        }
        $this->jsonReturn($ajax);

        //       }
//        else
//        {
//            $ajax['status']=false;
//            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
//            $this->jsonReturn($ajax);
//        }


    }

    public function deleteInstitute()
    {

        $CI =& get_instance();
        $user = User_helper::get_user();
        $user_id = $user->id;
        $id = $this->input->post('id');

        if (empty($user_id)) {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        } else {


            if ($id > 0) {


                    $data = array(
                        'status' => 99,
                        'comment' => "Disable"
                    );
                    $data2 = array(
                        'status' => 99
                    );


                    $this->db->where('id', $id);
                    $this->db->update($CI->config->item('table_institute'), $data);
                    //   $this->message = $this->lang->line("DISCARD_MESSAGE");
                    $this->db->where('id', $id);
                    $q = $this->db->get($CI->config->item('table_institute'));
                    $datainstitutee = $q->result_array();

                    $datadisable = array(
                        'institute_id' => $id,
                        'divid' => $datainstitutee[0]['divid'],
                        'zillaid' => $datainstitutee[0]['zillaid'],
                        'upozillaid' => $datainstitutee[0]['upozillaid'],
                        'user_id' => $user->id,
                        'calcel_date' => date("Y-m-d H:i:s"),
                        'is_primary' => $datainstitutee[0]['is_primary'],
                        'is_secondary' => $datainstitutee[0]['is_secondary'],
                        'is_higher' => $datainstitutee[0]['is_higher'],
                    );
                    Query_helper::add($CI->config->item('table_institute_calcel'), $datadisable);


                    $this->db->where('id', $datainstitutee[0]['user_id']);
                    $this->db->update($CI->config->item('table_users'), $data2);

                $class_details = Query_helper::get_info($this->config->item('table_class_details'), '*', array('institude_id = ' . $id));
                $deleted_ids = array();

                foreach ($class_details as $data) {
                    $deleted_ids[] = $data['id'];
                    unset($data['id']);
                    Query_helper::add($this->config->item('table_class_details_cancel'), $data);
                }

                $this->db->where_in('id', $deleted_ids);
                $this->db->delete($this->config->item('table_class_details'));



                $class_summary = Query_helper::get_info($this->config->item('table_class_summary'), '*', array('institude_id = ' . $id));
                $deleted_ids = array();

                foreach ($class_summary as $data) {
                    $deleted_ids[] = $data['id'];
                    unset($data['id']);
                    Query_helper::add($this->config->item('table_class_summary_cancel'), $data);
                }

                $this->db->where_in('id', $deleted_ids);
                $this->db->delete($this->config->item('table_class_summary'));



                $ajax['status'] = false;
                $ajax['system_message'] = $this->lang->line("DISCARD_MESSAGE");

                $ajax['delete_status'] = "DELETE";
                $this->jsonReturn($ajax);


            } else {
                $this->message = $this->lang->line("TRY_AGAIN");
                //$this->jsonReturn($ajax);
                $this->system_searchinactive();

            }

        }


    }

    public function sortsave($id)
    {

        if ($id > 0) {
            $user = User_helper::get_user();
            $user_id = $user->id;

            $data = array(
                'status' => 2,
                'approved_by' => $user_id,
                'approved_date' => date("Y-m-d"),
                'comment' => "accepted"
            );

            $CI =& get_instance();
            $this->db->where('id', $id);
            $this->db->update($CI->config->item('table_institute'), $data);


            $this->db->where('id', $id);
            $q = $this->db->get($CI->config->item('table_institute'));
            $datainstitute = $q->result_array();
            $datauser = array(
                'username' => $datainstitute[0]['email'],
                'password' => md5($datainstitute[0]['inipassword']),
                'name_bn' => $datainstitute[0]['name'],
                'name_en' => $datainstitute[0]['name'],
                'table_id' => '0',
                'uisc_type' => '0',
                'user_group_id' => 20,
                'template_id' => '1',
                'language_id' => '1',
                'uisc_id' => '1',
                'ques_id' => '1',
                'ques_ans' => '1',
                'division' => $datainstitute[0]['divid'],
                'zilla' => $datainstitute[0]['zillaid'],
                'upazila' => $datainstitute[0]['upozillaid'],
                'unioun' => '0',
                'citycorporation' => '0',
                'citycorporationward' => '0',
                'municipal' => '0',
                'municipalward' => '0',
                'designation' => '0',
                'gender' => '1',
                'phone' => $datainstitute[0]['mobile'],
                'office_phone' => $datainstitute[0]['mobile'],
                'mobile' => $datainstitute[0]['mobile'],
                'email' => $datainstitute[0]['email'],
                'national_id_no' => '0',
                'present_address' => '0',
                'permanent_address' => '0',
                'picture_alt' => '0',
                'picture_name' => '0',
                'notifiacation' => '0',
                'dob' => '0',
                'first_login' => '',
                'create_by' => $user_id,
                'status' => 2,
                'create_date' => strtotime($datainstitute[0]['applied_date']),
                'approved_date' => time(),
                'update_by' => $user_id,
                'update_date' => strtotime($datainstitute[0]['applied_date'])


            );
            $this->db->insert($CI->config->item('table_users'), $datauser);

            $datalast = array(
                'user_id' => $this->db->insert_id(),

            );
            $this->db->where('id', $id);
            $this->db->update($CI->config->item('table_institute'), $datalast);

            $this->message = $this->lang->line("MSG_APPROVED_SUCCESS");
            //$this->jsonReturn($ajax);
            $this->system_searchinactive();

        }
    }


    public function quicksave()
    {
        $CI =& get_instance();
        $user = User_helper::get_user();
        $id = $this->input->post('id');
        if ($id > 0) {
            $user = User_helper::get_user();
            $user_id = $user->id;

            $data = array(
                'status' => 2,
                'approved_by' => $user_id,
                'approved_date' => date("Y-m-d"),
                'comment' => "accepted"
            );


            $this->db->where('id', $id);
            $this->db->update($CI->config->item('table_institute'), $data);


            $this->db->where('id', $id);
            $q = $this->db->get($CI->config->item('table_institute'));
            $datainstitute = $q->result_array();
            $datauser = array(
                'username' => $datainstitute[0]['email'],
                'password' => md5($datainstitute[0]['inipassword']),
                'name_bn' => $datainstitute[0]['name'],
                'name_en' => $datainstitute[0]['name'],
                'table_id' => '0',
                'uisc_type' => '0',
                'user_group_id' => 20,
                'template_id' => '1',
                'language_id' => '1',
                'uisc_id' => '1',
                'ques_id' => '1',
                'ques_ans' => '1',
                'division' => $datainstitute[0]['divid'],
                'zilla' => $datainstitute[0]['zillaid'],
                'upazila' => $datainstitute[0]['upozillaid'],
                'unioun' => '0',
                'citycorporation' => '0',
                'citycorporationward' => '0',
                'municipal' => '0',
                'municipalward' => '0',
                'designation' => '0',
                'gender' => '1',
                'phone' => $datainstitute[0]['mobile'],
                'office_phone' => $datainstitute[0]['mobile'],
                'mobile' => $datainstitute[0]['mobile'],
                'email' => $datainstitute[0]['email'],
                'national_id_no' => '0',
                'present_address' => '0',
                'permanent_address' => '0',
                'picture_alt' => '0',
                'picture_name' => '0',
                'notifiacation' => '0',
                'dob' => '0',
                'first_login' => '',
                'create_by' => $user_id,
                'status' => 2,
                'create_date' => strtotime($datainstitute[0]['applied_date']),
                'approved_date' => time(),
                'update_by' => $user_id,
                'update_date' => strtotime($datainstitute[0]['applied_date'])


            );
            $this->db->insert($CI->config->item('table_users'), $datauser);

            $datalast = array(
                'user_id' => $this->db->insert_id(),

            );
            $this->db->where('id', $id);
            $this->db->update($CI->config->item('table_institute'), $datalast);

            //   $this->message = $this->lang->line("MSG_APPROVED_SUCCESS");
            //$this->jsonReturn($ajax);
            //    $this->system_searchinactive();

            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("MSG_APPROVED_SUCCESS");
            $ajax['delete_status'] = "DELETE";
            $this->jsonReturn($ajax);


        }
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
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/update_level", "", true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/update');
        $this->jsonReturn($ajax);
    }

    public function get_listupdate()
    {

        $institutes = array();
        $institutes = $this->Institute_model->get_listupdate();
        $this->jsonReturn($institutes);
    }

    public function isNUMBER($key)
    {
        if (preg_match('/^[0-9,]+$/', $key)) {
            return TRUE;
        } else {
            //$this->set_message('isNUMBER', 'এই %s শুধু নাম্বার হবে। ');
            return FALSE;
        }

    }


    private function system_listupdateinfo($id)
    {
        $CI =& get_instance();

        $user = User_helper::get_user();
        $user_id = $user->id;
        $data['institute'] = $this->Institute_model->get_institute_data($id);
        $institutedata = $this->Institute_model->get_institute_data($id);
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));

        if ($this->input->post()) {
            $id = $this->input->post("instituteid");

            if ($id > 0) {

                $code = $this->input->post('code');
                if ($code == null) {
                    $this->message = $this->lang->line('ID_IS_EMPTY');
                    $ajax['status'] = false;
                    $ajax['system_message'] = $this->message;
                    $this->jsonReturn($ajax);

                } elseif (!$this->isNUMBER($code)) {
                    // $this->message = $this->lang->line('ID_IS_EMPTY');
                    $ajax['status'] = false;
                    $ajax['system_message'] = "	শিক্ষা প্রতিষ্ঠানের EIIN নাম্বার শুধু নাম্বার হবে।";
                    $this->jsonReturn($ajax);
                } else {
                    $result = $this->Institute_model->checkIDisAvailable($code, $id);
                    if (empty($result)) {
                        $dataa['code'] = $code;
                    } else {
                        $this->message = $this->lang->line('ID_IS_NOT_UNIQUE');
                        $ajax['status'] = false;
                        $ajax['system_message'] = $this->message;
                        $this->jsonReturn($ajax);

                    }
                }

                $is_primary = $this->input->post('is_primary');
                $is_secondary = $this->input->post('is_secondary');

                $is_higher = $this->input->post('is_higher');

                if ($is_primary == null && $is_secondary == null && $is_higher == null) {
                    $this->message = $this->lang->line('SELECT_A_INSTITUTE_NAME');
                    $ajax['status'] = false;
                    $ajax['system_message'] = $this->message;
                    $this->jsonReturn($ajax);
                }
                $this->db->trans_start();

                $dataa['is_primary'] = $is_primary;
                $dataa['is_secondary'] = $is_secondary;
                $dataa['is_higher'] = $is_higher;

                Query_helper::update($CI->config->item('table_institute'), $dataa, array("id = " . $id));

                $insertupdate['previous_primary'] = $institutedata['is_primary'];
                $insertupdate['previous_secondary'] = $institutedata['is_secondary'];
                $insertupdate['previous_higher'] = $institutedata['is_higher'];

                $insertupdate['present_primary'] = $this->input->post("is_primary");
                $insertupdate['present_secondary'] = $this->input->post("is_secondary");
                $insertupdate['present_higher'] = $this->input->post("is_higher");
                $insertupdate['institute_id'] = $this->input->post("instituteid");
                $insertupdate['update_by'] = $user_id;
                $insertupdate['update_date'] = time();

                Query_helper::add($CI->config->item('table_institute_level_update'), $insertupdate);

                $this->db->trans_complete();
                if ($this->db->trans_status() === TRUE) {
                    $this->message = $this->lang->line("MSG_UPDATE_SUCCESS");
                    $this->system_listupdate();
                } else {
                    $this->message = $this->lang->line("MSG_NOT_UPDATED_SUCCESS");
                }


            }

        }

        $this->current_action = 'edit';


        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/update", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/updateinfo/' . $id);
        $this->jsonReturn($ajax);
        //      }

    }


    private function system_searchinactive()
    {
        //    if($this->permissions['add'])
        //   {
        $this->current_action = 'add';
        $ajax['status'] = true;
        $data = array();


        $user = User_helper::get_user();
        $data['divisions'] = array();
        $data['display_divisions'] = false;
        $data['default_divisions'] = true;

        $data['zillas'] = array();
        $data['display_zillas'] = false;
        $data['default_zillas'] = true;
        $data['upazilas'] = array();
        $data['display_upazilas'] = false;
        $data['default_upazilas'] = true;
        $data['unions'] = array();
        $data['display_unions'] = false;
        $data['default_unions'] = true;
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
                    $data['upazilas'] = Query_helper::get_info($this->config->item('table_upazilas'), array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = ' . $user->zilla, 'upazilaid = ' . $user->upazila));
                    $data['default_upazilas'] = false;
                    $data['display_unions'] = true;
                    //                    $data['unions']=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid='.$user->upazila));
                    //                    $data['default_unions']=true;
                    //TODO
                    //increase report menu for union users
                }
            }
        }
        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("institute/searchinactive", $data, true));
        $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/searchinactive');
        if ($this->message) {
            $ajax['system_message'] = $this->message;
        }
        $this->jsonReturn($ajax);

        //       }
//        else
//        {
//            $ajax['status']=false;
//            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
//            $this->jsonReturn($ajax);
//        }


    }


    private function system_list_inactive()
    {


        $this->current_action = 'list';
        $ajax['status'] = true;

        $user = User_helper::get_user();

        $div_post = $this->input->post('division');
        $zilla_post = $this->input->post('zilla');
        $upazilla_post = $this->input->post('upazilla');
        $email = $this->input->post('email');

        if (($user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id == $this->config->item('USER_GROUP_DIVISION_3')) && $div_post == '') {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("SELECT_DIVISION");
            $this->jsonReturn($ajax);
        } elseif (($user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id == $this->config->item('USER_GROUP_DISTRICT_3')) && $zilla_post == "") {

            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("SELECT_DISTRICT");
            $this->jsonReturn($ajax);
        } elseif (($user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id == $this->config->item('USER_GROUP_UPOZILA_3')) && $upazilla_post == '') {
            $ajax['status'] = false;
            $ajax['system_message'] = $this->lang->line("SELECT_UPAZILLA");
            $this->jsonReturn($ajax);
        } else {
            $session_data['userInfo'] = $this->input->post();
            $this->session->set_userdata($session_data);

            $ajax['system_content'][] = array("id" => "#load_list", "html" => $this->load_view("institute/inactive", '', true));

            if ($this->message) {
                $ajax['system_message'] = $this->message;
            }

            $ajax['system_page_url'] = $this->get_encoded_url('institute/institute/index/searchinactive');
            $ajax['system_page_title'] = $this->lang->line("INSTITUTE_INACTIVE_SEARCH");
            $this->jsonReturn($ajax);
        }

    }

    public function get_users_inactive()
    {
        $session_data = $this->session->userdata('userInfo');
        $passwords = array();

        $division = isset($session_data['division']) ? $session_data['division'] : 0;
        $zilla = isset($session_data['zilla']) ? $session_data['zilla'] : 0;
        $upazilla = isset($session_data['upazilla']) ? $session_data['upazilla'] : 0;
        $email = isset($session_data['email']) ? $session_data['email'] : 0;
        $status = 1;
        $passwords = $this->Institute_model->get_listdatainstitute($division, $zilla, $upazilla, $email, $status);
        $this->session->unset_userdata('userInfo');
        $this->jsonReturn($passwords);
    }
}
