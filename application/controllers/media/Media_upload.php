<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_upload extends Root_Controller
{
    public $permissions;
    public $message;
    public $controller_url;
    public $current_action;
    function __construct()
    {
        //
        parent::__construct();
        $this->message='';
        $this->permissions=Menu_helper::get_permission('media/media_upload');
        $this->controller_url='media/media_upload';
        $this->load->model("media/media_upload_model");
        //$this->lang->load("notice_management", $this->get_language());
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
        elseif($action=='edit')
        {
            $this->system_edit($id);
        }
        elseif($action=='batch_edit')
        {
            $this->system_batch_edit();
        }
        elseif($action=='save')
        {
            $this->system_save();
        }
        else
        {
            $this->system_list();
        }
    }

    private function system_list()
    {
        if($this->permissions['list'])
        {
            $this->current_action='list';
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("media/media_upload/list","",true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('media/media_upload');
            $ajax['system_page_title']=$this->lang->line("TITLE");
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
            $data=array();

            $data['title']=$this->lang->line("MEDIA_UPLOAD_TITLE");

            $data['MediaInfo'] = array
            (
                'id'=>'',
                'media_type'=>'',
                'media_title'=>'',
                'media_detail'=>'',
                'file_name'=>'',
                'video_link'=>'',
                'print_year'=>'',
                'status'=>$this->config->item('STATUS_ACTIVE'),
            );

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("media/media_upload/add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('media/media_upload/index/add');
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function system_edit($id)
    {
        if($this->permissions['edit'])
        {
            $this->current_action='edit';
            $ajax['status']=true;
            $data=array();

            $data['title']=$this->lang->line("MEDIA_UPLOAD_TITLE");
            $data['MediaInfo']=Query_helper::get_info($this->config->item('table_media'),'*',array('id ='.$id),1);

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("media/media_upload/add_edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }

            $ajax['system_page_url']=$this->get_encoded_url('media/media_upload/index/edit/'.$id);
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=true;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
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
            $media_info = $this->input->post('media');
            $dir = $this->config->item("dcms_upload");

            if($media_info['media_type']==1)
            {
                $directory = $dir['notice'];
                unset($media_info['video_link']);
                unset($media_info['print_year']);
            }
            elseif($media_info['media_type']==2)
            {
                $directory = $dir['media_photo'];
                unset($media_info['print_year']);
            }
            elseif($media_info['media_type']==3)
            {
                $directory = $dir['media_print'];
                unset($media_info['video_link']);
            }
            elseif($media_info['media_type']==4)
            {
                $directory = $dir['media_publication'];
                unset($media_info['video_link']);
                unset($media_info['print_year']);
            }

            $uploaded = System_helper::upload_file($directory,5120,'gif|jpg|png|pdf|doc|docx');

            if(array_key_exists('file_name',$uploaded))
            {
                if($uploaded['file_name']['status'])
                {
                    $media_info['file_name'] = $uploaded['file_name']['info']['file_name'];
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['desk_message']=$this->message.=$uploaded['file_name']['message'].'<br>';
                    $this->jsonReturn($ajax);
                }
            }

            if($id>0)
            {
                unset($media_info['id']);
                $media_info['update_by']=$user->id;
                $media_info['update_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_media'),$media_info,array("id = ".$id));

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
                $media_info['create_by']=$user->id;
                $media_info['create_date']=time();

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::add($this->config->item('table_media'),$media_info);

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

    private function system_batch_edit()
    {
        $selected_ids=$this->input->post('selected_ids');
        $this->system_edit($selected_ids[0]);
    }

    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('media[media_type]',$this->lang->line('MEDIA_TYPE'),'required');
        $this->form_validation->set_rules('media[media_title]',$this->lang->line('MEDIA_TITLE'),'required');
        $this->form_validation->set_rules('media[status]',$this->lang->line('STATUS'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

    public function get_list()
    {
        $media_list = array();
        if($this->permissions['list'])
        {
            $media_list = $this->media_upload_model->get_record_list();
        }
        $this->jsonReturn($media_list);
    }
}
