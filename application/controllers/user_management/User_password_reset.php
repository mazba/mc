<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_password_reset extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('user_management/User_password_reset');
        $this->controller_url='user_management/User_password_reset';
        $this->load->model("user_management/User_password_reset_model");
    }

    public function index($action='add',$id=0)
    {
        $this->current_action=$action;

        if($action=='list')
        {
            $this->dcms_list();
        }
        elseif($action=='add')
        {
            $this->dcms_add();
        }
        elseif($action=='edit')
        {
            $this->dcms_edit($id);
        }
        elseif($action=='save')
        {
            $this->dcms_save();
        }
        else
        {
            $this->current_action='list';
            $this->dcms_list();
        }
    }

    private function dcms_list()
    {

        if($this->permissions['list'])
        {
            $this->current_action='list';
            $ajax['status']=true;

            $user = User_helper::get_user();

            $div_post = $this->input->post('division');
            $zilla_post = $this->input->post('zilla');
            $upazilla_post = $this->input->post('upazilla');

            if(($user->user_group_id==$this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$this->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$this->config->item('USER_GROUP_DIVISION_3')) && $div_post == '')
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("SELECT_DIVISION");
                $this->jsonReturn($ajax);
            }
    elseif(($user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_3')) && $zilla_post == "")
            {

                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("SELECT_DISTRICT");
                $this->jsonReturn($ajax);
            }
            elseif(($user->user_group_id==$this->config->item('USER_GROUP_UPOZILA_1') || $user->user_group_id==$this->config->item('USER_GROUP_UPOZILA_2') || $user->user_group_id==$this->config->item('USER_GROUP_UPOZILA_3')) && $upazilla_post == '')
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("SELECT_UPAZILLA");
                $this->jsonReturn($ajax);
            }
            else
            {
                $session_data['userInfo'] = $this->input->post();
                $this->session->set_userdata($session_data);

                $ajax['system_content'][]=array("id"=>"#load_list","html"=>$this->load_view("user_management/user_password_reset/dcms_list",'',true));

                if($this->message)
                {
                    $ajax['system_message']=$this->message;
                }

                $ajax['system_page_url']=$this->get_encoded_url('user_management/User_password_reset');
                $ajax['system_page_title']=$this->lang->line("USER_PASSWORD_RESET");
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_add()
    {
        if($this->permissions['add'])
        {
            $this->current_action='add';
            $ajax['status']=true;
            $data=array();

            $user=User_helper::get_user();
            $data['divisions']=array();
            $data['display_divisions']=false;
            $data['default_divisions']=true;

            $data['zillas']=array();
            $data['display_zillas']=false;
            $data['default_zillas']=true;
            $data['upazilas']=array();
            $data['display_upazilas']=false;
            $data['default_upazilas']=true;
            $data['unions']=array();
            $data['display_unions']=false;
            $data['default_unions']=true;
            if(($user->user_group_id==$this->config->item('SUPER_ADMIN_GROUP_ID'))||($user->user_group_id==$this->config->item('A_TO_I_GROUP_ID'))||($user->user_group_id==$this->config->item('USER_GROUP_MINISTRY_1')) || ($user->user_group_id==$this->config->item('USER_GROUP_MINISTRY_2')) || ($user->user_group_id==$this->config->item('USER_GROUP_MINISTRY_3')) || ($user->user_group_id==$this->config->item('USER_GROUP_MINISTRY_4')) || ($user->user_group_id==$this->config->item('USER_GROUP_DONNER_1')) || ($user->user_group_id==$this->config->item('USER_GROUP_DONNER_2')) || ($user->user_group_id==$this->config->item('USER_GROUP_DONNER_3')))
            {
                $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
                $data['display_divisions']=true;
                $data['default_divisions']=true;
            }
            else
            {
                $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array('divid ='.$user->division));
                $data['display_divisions']=true;
                $data['default_divisions']=false;
                $data['display_zillas']=true;
                if($user->user_group_id==$this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$this->config->item('USER_GROUP_DIVISION_1') || $user->user_group_id==$this->config->item('USER_GROUP_DIVISION_2') || $user->user_group_id==$this->config->item('USER_GROUP_DIVISION_3'))
                {
                    $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$user->division));
                    $data['default_zillas']=true;
                    $data['display_upazilas']=false;
                }
                else
                {
                    $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$user->division,'zillaid ='.$user->zilla));
                    $data['default_zillas']=false;
                    $data['display_upazilas']=true;
                    if($user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_1') || $user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_2') || $user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_3') || $user->user_group_id==$this->config->item('USER_GROUP_DISTRICT_4'))
                    {
                        $data['upazilas']=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$user->zilla));
                        $data['default_upazilas']=true;
                        //$data['display_unions']=true;
                    }
                    else
                    {
                        $data['upazilas']=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid = '.$user->upazila));
                        $data['default_upazilas']=false;
                        $data['display_unions']=true;
                        //                    $data['unions']=Query_helper::get_info($this->config->item('table_unions'),array('unionid value', 'unionname text'), array('visible = 1', 'zillaid = '.$user->zilla, 'upazilaid='.$user->upazila));
                        //                    $data['default_unions']=true;
                        //TODO
                        //increase report menu for union users
                    }
                }
            }
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("user_management/user_password_reset/dcms_search",$data,true));
            $ajax['system_page_url']=$this->get_encoded_url('user_management/user_password_reset');
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $this->jsonReturn($ajax);

        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_edit($id)
    {
        $data['password_detail'] = $this->User_password_reset_model->get_password_detail($id);
        //$data['questions'] = Query_helper::get_info($this->config->item('table_questions'),array('id value','question text'),array('status = 1'));

        if($this->permissions['edit'])
        {
            if($data['password_detail'])
            {
                $ajax['status']=true;
                $ajax['system_content'][]=array("id"=>"#modal_data","html"=>$this->load_view("user_management/user_password_reset/dcms_edit",$data,true));
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status']=true;
                $ajax['system_content'][]=array("id"=>"#modal_data","html"=>'',array(),true);
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function dcms_save()
    {
        $user=User_helper::get_user();
        $id = $this->input->post("id");
		$schoolemail = $this->input->post("emailaddress");

        if($id>0)
        {
            if(!$this->permissions['edit'])
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
                die();
            }
        }
        else
        {
            if(!$this->permissions['add'])
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
                die();
            }
        }

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
            die();
        }
        else
        {
            $userDetail = $this->input->post('user_detail');
            if($id>0)
            {
                if(!empty($userDetail['password']))
                {
					$freshpassword= $userDetail['password'];
                    $encryptPass = md5($userDetail['password']);
                    unset($userDetail['password']);
                    unset($userDetail['confirm_password']);
                    $userDetail['password'] = $encryptPass;
                }
                else
                {
                    unset($userDetail['password']);
                    unset($userDetail['confirm_password']);
                }
            }

            if($id>0)
            {
                $userDetail['update_by']=$user->id;
                $userDetail['update_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_users'),$userDetail,array("id = ".$id));
                // Mail Function
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
					 $this->load->library('email');       
				//	$config['protocol'] = 'sendmail';
				//	$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
        
        
				$this->email->initialize($config); 
				$this->email->from('noreply@mmc.gov.bd', 'MMC Reset New Password');
				$this->email->to($schoolemail);
			$html = "Dear $schoolemail,\r\n<br />";
            $html .= "Your New password:\r\n<br />";
            $html .= "-----------------------\r\n<br />";
            $html .= "Username: $schoolemail\r\n<br />";
			$html .= "Password: $freshpassword\r\n\r\n<br />";
          

            $html .= "Thanks,\r\n<br />";
            $html .= "-- MMC team";
					
			$this->email->subject('MMC Reset New Password ');
       // $html = $this->input->post('message');
            $this->email->message($html);
            $this->email->send();
			
                    $this->message=$this->lang->line("MSG_UPDATE_SUCCESS");
                    $save_and_new=$this->input->post('system_save_new_status');
                    if($save_and_new==1)
                    {
                        $this->dcms_add();
                    }
                    else
                    {
                        $this->dcms_add();
                    }
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_UPDATE_FAIL");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_UPDATE_FAIL");
                $this->jsonReturn($ajax);
            }
        }

    }

    public function get_users()
    {
        $session_data = $this->session->userdata('userInfo');
        $passwords = array();

        if($this->permissions['list'])
        {
            $uisc_type = isset($session_data['status'])?$session_data['status']:0;
            $division = isset($session_data['division'])?$session_data['division']:0;
            $zilla = isset($session_data['zilla'])?$session_data['zilla']:0;
            $upazilla = isset($session_data['upazilla'])?$session_data['upazilla']:0;
            $user_id = isset($session_data['user_id'])?$session_data['user_id']:0;
            $school_mobile_number = isset($session_data['school_mobile_number'])?$session_data['school_mobile_number']:0;

        }

        $passwords = $this->User_password_reset_model->get_users($division, $zilla, $upazilla, $user_id,$school_mobile_number);
        $this->session->unset_userdata('userInfo');
        $this->jsonReturn($passwords);
    }

    //    public function get_zilla()
    //    {
    //        $user = User_helper::get_user();
    //        $user_group_id = $user->user_group_id;
    //
    //        $division_id=$this->input->post('division_id');
    //
    //        if($user_group_id == $this->config->item('DISTRICT_GROUP_ID') || $user_group_id == $this->config->item('UPAZILLA_GROUP_ID') || $user_group_id == $this->config->item('UNION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_WORD_GROUP_ID') || $user_group_id == $this->config->item('UISC_GROUP_ID'))
    //        {
    //            $zillas = Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id, 'zillaid = '.$user->zilla));
    //        }
    //        else
    //        {
    //            $zillas = Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id));
    //        }
    //
    //        $ajax['status']=true;
    //        $ajax['system_content'][]=array("id"=>"#user_zilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$zillas),true));
    //        $this->jsonReturn($ajax);
    //    }
    //
    //    public function get_upazila()
    //    {
    //        $user = User_helper::get_user();
    //        $user_group_id = $user->user_group_id;
    //        $zilla_id=$this->input->post('zilla_id');
    //
    //        if($user_group_id == $this->config->item('UPAZILLA_GROUP_ID') || $user_group_id == $this->config->item('UNION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_GROUP_ID') || $user_group_id == $this->config->item('CITY_CORPORATION_WORD_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_GROUP_ID') || $user_group_id == $this->config->item('MUNICIPAL_WORD_GROUP_ID') || $user_group_id == $this->config->item('UISC_GROUP_ID'))
    //        {
    //            $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id, 'upazilaid = '.$user->upazila));
    //        }
    //        else
    //        {
    //            $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id));
    //        }
    //
    //        $ajax['status']=true;
    //        $ajax['system_content'][]=array("id"=>"#user_upazila_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$upazilas),true));
    //        $this->jsonReturn($ajax);
    //    }

    private function check_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_detail[password]',$this->lang->line('PASSWORD'),'required');
        $this->form_validation->set_rules('user_detail[confirm_password]',$this->lang->line('CONFIRM_PASSWORD'),'required');
        if($this->input->post("user_detail[password]") != $this->input->post("user_detail[confirm_password]"))
        {
            $this->message = $this->lang->line('CONFIRM_PASSWORD_NOT_MATCH');
            return false;
        }

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }


}
