<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_report extends Root_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("monthly_report/Monthly_report_model");
		$this->load->helper('form');
		$this->load->library('form_validation');		
	}
	
	public function report_show(){
		
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("monthly_report/report_show","",true));
        $ajax['system_page_url']=$this->get_encoded_url('monthly_report/report_show');
        $this->jsonReturn($ajax);
	}
	
	 public function monthlyreport()
    {
        $report = array();

        $report = $this->Monthly_report_model->get_monthly_report();
        $this->jsonReturn($report);
    }
}