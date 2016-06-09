<?php
/**
 * Copyright (C) Softbd Ltd.
 * URL: http://softbdltd.com
 * Author Jibon Bikash Roy <jibon.bikash@gmail.com>
 * Created by PhpStorm.
 * User: HP-14
 * Date: 1/9/2016
 * Time: 4:56 PM
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowdistrictgraph extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;

    function __construct()
    {
        parent::__construct();
        $this->message = '';
        $this->permissions = Menu_helper::get_permission('report/institute/lowdistrictgraph');
        //$this->controller_url='report/upload_report_model';
        $this->lang->load("report", $this->get_language());
        //$this->load->model("basic_setup/institute/approved_institute_list_model");
    }
	

    public function index()
    {
        $user = User_helper::get_user();
		
		       $ajax['status']=true;
        $data['page']="inner_page";
    //    $data['from_date']=$this->input->post('from_date');
     //   $data['to_date']=$this->input->post('to_date');
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/lowdistrictgraph","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/lowdistrictgraph');
        $this->jsonReturn($ajax);
		
		/*
		   $ajax['status']=true;
        $data['title']=$this->lang->line("REPORT_APPROVED_INSTITUTE_TITLE");
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/approved_institute_list",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('report/institute/approved_institute_list');
        $this->jsonReturn($ajax);

        */
		
    }
}



