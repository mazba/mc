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

class Mmcclass extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;

    function __construct()
    {
        parent::__construct();
        $this->message = '';
        $this->permissions = Menu_helper::get_permission('report/institute/mmcclass');
        //$this->controller_url='report/upload_report_model';
        $this->lang->load("report", $this->get_language());
        $this->load->model("report/report_home_model");

        //$this->load->model("basic_setup/institute/approved_institute_list_model");
    }
	
	

    public function index()
    {

        $month_ini = new DateTime("first day of last month");
        $month_end = new DateTime("last day of last month");

        if ($this->input->post('from_date')) {
            $from_date = $this->input->post('from_date');
        } else {
            //  $from_date='';
            $from_date = $month_ini->format('Y-m-d');
        }

        if ($this->input->post('to_date')) {
            $to_date = $this->input->post('to_date');
        } else {
            //  $to_date='';
            $to_date = $month_end->format('Y-m-d');
        }


        $ajax['status'] = true;
        $data['page'] = "inner_page";
        $report['from_date']=$from_date;
        $report['to_date']=$to_date;
        $report['report'] = $this->report_home_model->get_all($from_date,$to_date);
        $ajax['system_content'][] = array("id" => "#top_header", "html" => $this->load_view("header", $data, true));
        $ajax['system_content'][] = array("id" => "#system_wrapper_top_menu", "html" => $this->load_view("top_menu", "", true));
        $ajax['system_content'][] = array("id" => "#system_wrapper", "html" => $this->load_view("report/institute/mmcclass", $report, true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcclass/');
        $this->jsonReturn($ajax);

    }



	
	
	public function last_day_mmc()
    {
        $user = User_helper::get_user();
		
		       $ajax['status']=true;
        $data['page']="inner_page";
    //    $data['from_date']=$this->input->post('from_date');
     //   $data['to_date']=$this->input->post('to_date');
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("report/institute/last_day_mmc","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('report/institute/mmcclass/last_day_mmc');
        $this->jsonReturn($ajax);
		
		
    }
}



