<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Institute_class_report extends CI_Controller
{
    public $permissions;
    function __construct()
    {
        parent::__construct();
        //TODO
        //check security and loged user
        $this->lang->load("report", $this->config->item('GET_LANGUAGE'));
        $this->lang->load("my", $this->config->item('GET_LANGUAGE'));
        $this->load->model("report/Institute_class_report_model");
    }

    public function index($task="search",$id=0)
    {
        if($task=="list")
        {
            $this->report_list();
        }
        else if($task=="pdf")
        {
            $this->report_list("pdf");
        }
        else
        {
            $this->search();
        }
    }

    private function report_list($format="")
    {
        if($format!="pdf")
        {
            $from_date=$this->input->get('from_date');
            $to_date=$this->input->get('to_date');
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;

            $data['title']=$this->lang->line("REPORT_INSTITUTE_CLASS_LIST_TITLE");

            $data['reports']=$this->Institute_class_report_model->get_institute_class_list($from_date, $to_date);
            $this->load->view('default/report/user_class/Institute_class_report',$data);
        }
        else
        {
            $this->load->model("report/Institute_class_report_model");
            $data['title']=$this->lang->line("REPORT_INSTITUTE_CLASS_LIST_TITLE");

            $from_date=$this->input->get('from_date');
            $to_date=$this->input->get('to_date');
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;

            $data['reports']=$this->Institute_class_report_model->get_institute_class_list($from_date, $to_date);
            $html=$this->load->view('default/report/user_class/Institute_class_report',$data,true);
            //echo $html;
            System_helper::get_pdf($html);
        }
    }

}