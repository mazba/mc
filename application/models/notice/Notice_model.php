<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HP-14
 * Date: 11/24/2015
 * Time: 8:48 PM
 */
class Notice_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function form_insert($data){
        // Inserting in Table(students) of Database(college)
        $CI =& get_instance();
        $this->db->insert($CI->config->item('table_notice'), $data);
    }


}