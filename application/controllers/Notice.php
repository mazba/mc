<?php
/**
 * Created by jibon.
 * User: jibon
 * Date: 11/24/2015
 * Time: 8:40 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends Root_Controller
{
    function __construct()
    {
        //
        parent::__construct();
        $this->load->model("notice/Notice_model");


    }

    public function create(){
        $CI =& get_instance();
        $this->load->library('form_validation');
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("notice/create",'',true));
        $this->jsonReturn($ajax);

    }

}
?>