<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upazila extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('upazila');
        $this->controller_url='upazila/upazila';
        $this->load->model("upazila/upazila_model");
        $this->permissions['view']=0;

    }
    public function index($action='list',$id=0)
    {

        $this->current_action=$action;

        if($action=='list')
        {
            $this->system_list();
        }
        elseif($action=='add')
        {
            $this->system_add();
        }
        elseif($action=='batch_edit')
        {
            $this->system_batch_edit();
        }
        elseif($action=='edit')
        {
            $this->system_edit($id);
        }
        elseif($action=='save')
        {
            $this->system_save();
        }
        elseif($action=='batch_details')
        {
            $this->system_batch_details();
        }
        elseif($action=='batch_delete')
        {
            $this->system_batch_delete();
        }
        else
        {
            $this->current_action='list';
            $this->system_list();
        }

    }
    private function system_list()
    {
        if($this->permissions['list'])
        {
            $this->current_action='list';
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",'',true));

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("upazila/system_list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('upazila/upazila');
            $ajax['system_page_title']=$this->lang->line("UPAZILLA");
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }

    }
    private function system_add()
    {
        if($this->permissions['add'])
        {

            $this->current_action='add';
            $ajax['status']=true;
            $user = User_helper::get_user();

            $data=array();
            $data['title']=$this->lang->line("CREATE_NEW_UPAZILLA/THANA");
            $data['record_info']['id']=0;
            $data['record_info']['name']='';
             $data['record_info']['upazilaname']='';
            $data['record_info']['upazilanameeng']='';

            $data['record_info']['upazilaid']='';

            $data['record_info']['zillaid']='';
            $data['record_info']['status']=1;



            $data['zillas'] = array();
            $data['display_zillas'] = false;
            $data['default_zillas'] = true;

                $data['divisions'] = Query_helper::get_info($this->config->item('table_divisions'), array('divid value', 'divname text'), array());
                $data['display_divisions'] = true;
                $data['default_divisions'] = true;


            $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",'',true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("upazila/system_add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('upazila/upazila/index/add');
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_edit($id)
    {

        if($this->permissions['edit'])
        {
            $user = User_helper::get_user();

            $this->current_action='edit';
            $ajax['status']=true;
            $data=array();


            $data['zillas'] = array();
            $data['display_zillas'] = true;
            $data['default_zillas'] = true;


            $data['title']=$this->lang->line("EDIT_UPAZILA/THANA");
            $data['record_info']=Query_helper::get_info($this->config->item('table_upazilas'),'*',array('id ='.$id),1);
            $data['zilla'] =Query_helper::get_info($this->config->item('table_zillas'),'*',array('zillaid ='. $data['record_info']['zillaid']),1);
            $data['division'] =Query_helper::get_info($this->config->item('table_divisions'),'*',array('divid ='.  $data['zilla']['divid']),1);

               // $data['divisions'] = Query_helper::get_info($this->config->item('table_divisions'), array('divid value', 'divname text'), array());
                $data['display_divisions'] = true;
                $data['default_divisions'] = true;


            $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",'',true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("upazila/system_add_edit",$data,true));
            //$ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("upazila/system_add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=$this->get_encoded_url('upazila/upazila/index/edit/'.$id);
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_batch_edit()
    {
        $selected_ids=$this->input->post('selected_ids');
        $this->system_edit($selected_ids[0]);
    }
    private function system_save()
    {
        $user=User_helper::get_user();
        $id = $this->input->post("id");
        if($id>0)
        {
            if(!$this->permissions['edit'])
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
                die();
            }
        }
        else
        {
            if(!$this->permissions['add'])
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
                die();

            }
        }
        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $data = Array(
                'zillaid'=>$this->input->post('zilla'),
                'upazilaid'=>$this->input->post('upazilaid'),
                'upazilaname'=>$this->input->post('name'),
                'upazilanameeng'=>$this->input->post('name_en'),
                'visible'=>$this->input->post('status')
            );

            if($this->upazila_model->check_duplicate($id,$data)){
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("DUPLICATE_DATA");
                $this->jsonReturn($ajax);
                die();
            }

            if($id>0)
            {

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_upazilas'),$data,array("id = ".$id));
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->message=$this->lang->line("MSG_UPDATE_SUCCESS");
                    $save_and_new=$this->input->post('system_save_new_status');
                    if($save_and_new==1)
                    {
                        $this->system_add();
                    }
                    else
                    {
                        $this->system_list();
                    }
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_UPDATE_FAIL");
                    $this->jsonReturn($ajax);

                }
            }
            else
            {

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_upazilas'),$data);
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
                    $save_and_new=$this->input->post('system_save_new_status');
                    if($save_and_new==1)
                    {
                        $this->system_add();
                    }
                    else
                    {
                        $this->system_list();
                    }
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_CREATE_FAIL");
                    $this->jsonReturn($ajax);
                }
            }


        }

    }
    private function system_batch_details()
    {
        if($this->permissions['view'])
        {
            $this->current_action='batch_details';
            $selected_ids=$this->input->post('selected_ids');
            $data['user_groups']=$this->upazila_model->get_user_group_details($selected_ids);
            $ajax['status']=true;

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("upazila/system_details",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_batch_delete()
    {
        if($this->permissions['delete'])
        {
            $user=User_helper::get_user();
            $selected_ids=$this->input->post('selected_ids');
            $this->db->trans_start();  //DB Transaction Handle START
            foreach($selected_ids as $id)
            {
                Query_helper::update($this->config->item('table_upazilas'),array('visible'=>99),array("id = ".$id));
            }
            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_DELETE_SUCCESS");
                $this->system_list();
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_DELETE_FAIL");
                $this->jsonReturn($ajax);
            }
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    //validation for add/edit
    private function check_validation()
    {
        $this->load->library('form_validation');


        $this->form_validation->set_rules('zilla',$this->lang->line('ZILLA'),'required',array('required' => $this->lang->line('SELECT_UPAZILLA')));
        $this->form_validation->set_rules('name',$this->lang->line('NAME'),'required',array('required' => $this->lang->line('UPAZILA/THANA_REQUIRED')));
        $this->form_validation->set_rules('upazilaid',$this->lang->line('GO_CODE'),'required',array('required' => $this->lang->line('UPAZILAID_ID_REQUIRE')));



        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
    //public function to returning all groups for jq-grid
    public function get_all()
    {
        $groups=array();
        if($this->permissions['list'])
        {
            $groups= $this->upazila_model->get_all();

        }
        $this->jsonReturn($groups);


    }

}
