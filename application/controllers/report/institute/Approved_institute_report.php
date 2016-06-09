<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approved_institute_report extends CI_Controller
{
    public $permissions;
    function __construct()
    {
        parent::__construct();
        //TODO
        //check security and loged user
        $this->lang->load("report", $this->config->item('GET_LANGUAGE'));
        $this->lang->load("my", $this->config->item('GET_LANGUAGE'));
        $this->load->model("report/approved_institute_report_model");
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
            $division=$this->input->get('division');
            $zilla=$this->input->get('zilla');
            $upazila=$this->input->get('upazila');
            $union=$this->input->get('union');
            $data['report_type']=$this->input->get('report_type');
            $status=$this->input->get('status');
            $from_date=$this->input->get('from_date');
            $to_date=$this->input->get('to_date');
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;
            $data['report_status']=$status;

            $data['title']=$this->lang->line("REPORT_APPROVED_INSTITUTE_TITLE");

            $data['reports']=$this->approved_institute_report_model->get_approved_institute_list($division, $zilla, $upazila, $union, $from_date, $to_date, $status, $this->config->item('INSTITUTE_GENERAL'));
            $this->load->view('default/report/institute/approved_institute_report',$data);
        }
        else
        {

            $this->load->model("report/approved_institute_report_model");
            $data['title']=$this->lang->line("REPORT_APPROVED_INSTITUTE_TITLE");

            $division=$this->input->get('division');
            $zilla=$this->input->get('zilla');
            $upazila=$this->input->get('upazila');
            $union=$this->input->get('union');
            $data['report_type']=$this->input->get('report_type');
            $status=$this->input->get('status');
            $from_date=$this->input->get('from_date');
            $to_date=$this->input->get('to_date');
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;
            $data['report_status']=$status;

            $data['reports']=$this->approved_institute_report_model->get_approved_institute_list($division, $zilla, $upazila, $union, $from_date, $to_date, $status, $this->config->item('INSTITUTE_GENERAL'));
            $html=$this->load->view('default/report/institute/approved_institute_report',$data,true);
            //echo $html;
            System_helper::get_pdf($html);
        }
    }

}