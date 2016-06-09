<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madrasha_institute_user_list extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('report/user/madrasha_institute_user_list');
        //$this->controller_url='report/upload_report_model';
        $this->lang->load("report", $this->get_language());
        //$this->load->model("basic_setup/user/madrasha_institute_user_list_model");
    }

    public function index()
    {
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
        $data['title']=$this->lang->line("REPORT_MADRASHA_INSTITUTE_USER_TITLE");
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/user/madrasha_institute_user_list",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('report/user/madrasha_institute_user_list');
        $this->jsonReturn($ajax);
    }
}
