<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institute_class_list extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('report/user_class/institute_class_list');
        //$this->controller_url='report/upload_report_model';
        $this->lang->load("report", $this->get_language());
        //$this->load->model("basic_setup/mmc_user_general/user_use_mmc_list_model");
    }

    public function index()
    {
        $ajax['status']=true;
        $data['title']=$this->lang->line("REPORT_INSTITUTE_CLASS_LIST_TITLE");
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/user_class/institute_class_list",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('report/user_class/institute_class_list');
        $this->jsonReturn($ajax);
    }
}
