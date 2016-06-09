<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monthly_mmc_use_report extends CI_Controller
{
    public $permissions;
    function __construct()
    {
        parent::__construct();
        //TODO
        //check security and loged user
        $this->lang->load("report", $this->config->item('GET_LANGUAGE'));
        $this->lang->load("my", $this->config->item('GET_LANGUAGE'));
        $this->load->model("report/monthly_mmc_use_report_model");
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
            $month_ini = new DateTime("first day of last month");
            $month_end = new DateTime("last day of last month");
            $from_date=$month_ini->format('Y-m-d');
            $to_date=$month_end->format('Y-m-d');
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;
            $data['title']=$this->lang->line("REPORT_MONTHLY_MMC_USER_TITLE");
            $data['reports']=$this->monthly_mmc_use_report_model->get_monthly_mmc_use_list($from_date, $to_date);
            $this->load->view('default/report/monthly/monthly_mmc_use_report',$data);
        }
        else
        {
            $month_ini = new DateTime("first day of last month");
            $month_end = new DateTime("last day of last month");
            $from_date=$month_ini->format('Y-m-d');
            $to_date=$month_end->format('Y-m-d');
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;
            $data['title']=$this->lang->line("REPORT_MONTHLY_MMC_USER_TITLE");
            $data['reports']=$this->monthly_mmc_use_report_model->get_monthly_mmc_use_list($from_date, $to_date);
            $html=$this->load->view('default/report/monthly/monthly_mmc_use_report',$data,true);
            //echo $html;
            System_helper::get_pdf($html);
        }
    }

}