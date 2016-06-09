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
		 $CI =& get_instance();
        $user = User_helper::get_user();
		$CI->db->select('monthly_report.*');
        $CI->db->from($CI->config->item('table_monthly_report').' monthly_report');
        $CI->db->order_by("monthly_report.id", "desc");   
        $results = $CI->db->get()->result_array();
	}
}