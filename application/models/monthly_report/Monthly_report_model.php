<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Monthly_report_model extends CI_Model{
    //put your code here
  public function __construct()
    {
        parent::__construct();
    } 
	
	public function get_monthly_report(){
        // SELECT zillas.zillaname, monthly_report.* FROM monthly_report, users,zillas
        // WHERE monthly_report.submit_date>='2016-01-01'
        // and monthly_report.username = users.name
        // and users.zillaid = zillas.zillaid order by zillas.zillaname,
        // monthly_report. submit_date
        //  $CI->db->from($CI->config->item('table_users').' core_01_users');
     //   $month_ini = new DateTime("first day of last month");
    //    $month_end = new DateTime("last day of last month");
     //   $from_date=$month_ini->format('Y-m-d');
    //    $to_date=$month_end->format('Y-m-d');
		 $CI =& get_instance();
        $user = User_helper::get_user();
		$CI->db->select('monthly_report.username username , monthly_report.zilla zilla, monthly_report.visited_list visited_list, monthly_report.in_house in_house, monthly_report.sender sender, monthly_report.submit_date submit_date,  zillas.zillaname zillaname');
        $CI->db->from($CI->config->item('table_monthly_report').' monthly_report');
        $CI->db->join($CI->config->item('table_users').' users', 'monthly_report.username=users.username', 'left');
        $CI->db->join($CI->config->item('table_zillas').' zillas', 'users.zilla=zillas.zillaid', 'left');
     //   $CI->db->where("monthly_report.submit_date between '$from_date' AND '$to_date'");
        $CI->db->order_by("zillas.zillaid, monthly_report.submit_date", "desc");
         $results = $CI->db->get()->result_array();
     //   echo $CI->db->last_query();
		foreach($results as &$result)
        {
            $date=explode('-',$result['submit_date']);
            $result['submit_date']=$date[0].'-'.$date[2].'-'.$date[1];
		if($result['sender']=="district_edication_officer")
            {
                $result['sender']='জেলা শিক্ষা কর্মকর্তা';
            }
		elseif($result['sender']=="district_commisioner")
            {
                $result['sender']='জেলা প্রশাসক';
            }
		else{
				 $result['sender']='জেলা শিক্ষা কর্মকর্তা';
			}
         //   $result['submit_date']=date("Ymd",strtotime("'.$result['submit_date'].'"));
            $result['visited_list']=Dashboard_helper::bn2enNumbermonth($result['visited_list']);
            $result['in_house']=Dashboard_helper::bn2enNumbermonth($result['in_house']);

            //$result['submit_date']=Dashboard_helper::bn2enNumbermonth(date("F j, Y", strtotime($result['submit_date'])));


		}
     //  echo "<pre>";print_r($results);die();
	 return $results;		
	}
}