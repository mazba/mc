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

class Mmcedu_level extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;

    function __construct()
    {
        parent::__construct();
        $this->message = '';
        $this->permissions = Menu_helper::get_permission('report/institute/promary_school_high_mmc');
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
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/promary_school_high_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level');
        $this->jsonReturn($ajax);
		
		
    }
	
	
	  public function primary_less_mmc()
    {
        $user = User_helper::get_user();
		
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/primary_less_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/primary_less_mmc');
        $this->jsonReturn($ajax);
		
		
    }
	
	  public function school_less_mmc()
    {
        $user = User_helper::get_user();
		
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/school_less_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/school_less_mmc');
        $this->jsonReturn($ajax);
		
		
    }
	
	 public function school_high_mmc()
    {
        $user = User_helper::get_user();
		
		       $ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/school_high_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/school_high_mmc');
        $this->jsonReturn($ajax);
		
		
    }
	
	
	 public function college_high_mmc()
    {
        $user = User_helper::get_user();
		
		       $ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/college_high_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/college_high_mmc');
        $this->jsonReturn($ajax);
		
		
    }
	
	
	 public function college_less_mmc()
    {
        $user = User_helper::get_user();
		
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/college_less_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/college_less_mmc');
        $this->jsonReturn($ajax);
		
		
    }
	
	
	public function school_college_less_mmc()
    {
        $user = User_helper::get_user();
		
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/school_college_less_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/school_college_less_mmc');
        $this->jsonReturn($ajax);
		
		
    }
	
	
		public function school_college_high_mmc()
    {
        $user = User_helper::get_user();
		
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/school_college_high_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/school_college_high_mmc');
        $this->jsonReturn($ajax);
		
		
    }
	
	
	
	public function high_mmc_institute()
    {
        $user = User_helper::get_user();
		
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/high_mmc_institute","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcedu_level/high_mmc_institute');
        $this->jsonReturn($ajax);
		
		
    }
}



