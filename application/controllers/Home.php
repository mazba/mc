<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Root_Controller
{
    function __construct()
    {
        //
        parent::__construct();
        //     $this->load->model("nstitute/Institute");
        $this->load->model("institute/Institute_model");
        //$this->load->helper('url');
$this->load->helper('form');
    }

    public function index()
    {
        $ajax['status']=true;
        $data['page']="home_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));

        $ajax['system_page_url']=base_url();
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $this->jsonReturn($ajax);
    }

    public function notice()
    {
        $ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/notice","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));

        $ajax['system_page_url'] = $this->get_encoded_url('home/notice');
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $this->jsonReturn($ajax);
    }
    public function dashboard()
    {
        $this->load->library('form_validation');
        $user=User_helper::get_user();
        if($user)
        {
         //   $this->output->cache(1);
            $this->dashboard_page();
        }
        else
        {
            $this->login_page();
        }

        //        $CI =& get_instance();
        //        $user=User_helper::get_user();
        //        if($user)
        //        {
        //        //    $this->dashboard_page();
        //          $data['userinfo']=$this->Institute_model->get_user_information($user->id);
        //        //     $instituteinfo=$this->Institute_model->get_user_information($user->id);
        //         // print_r($instituteinfo);
        //            $ajax['status']=true;
        //            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        //            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/dashboard",$data,true));
        //            $this->jsonReturn($ajax);
        //        }
        //        else
        //        {
        //            $this->login_page();
        //        }
    }
    public function login()
    {
        $user=User_helper::get_user();
        if($user)
        {
            $this->dashboard_page();
        }
        else
        {
            if($this->input->post())
            {
                if(User_helper::login($this->input->post("username"),$this->input->post("password")))
                {
                    $user=User_helper::get_user();
                    $user_info['user_id']=$user->id;
                    $user_info['login_time']=time();
                    $user_info['ip_address']=$this->input->ip_address();
                    $user_info['request_headers']=json_encode($this->input->request_headers());
                    Query_helper::add($this->config->item('table_user_login_history'),$user_info);
                    $this->dashboard_page($this->lang->line("MSG_LOGIN_SUCCESS"));
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_USERNAME_PASSWORD_INVALID");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $this->login_page();//login page view
            }

        }

    }
    public function logout()
    {
        $this->session->sess_destroy();
        //$this->login_page($this->lang->line("MSG_LOGOUT_SUCCESS"));
        //$this->logout_page();//logout
        //$this->website();
        redirect(base_url());
    }
    public function resetpassword(){

      $CI =& get_instance();
      $this->load->library('form_validation');
        $this->load->helper('captcha');


        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
        // setting up captcha config
        $vals = array(
            'word' => $random_number,
            'img_path' => './captcha/',
            'img_url' => base_url().'captcha/',
            'img_width' => 170,
            'img_height' => 32,
            'expiration' => 7200
        );
        $data['captcha'] = create_captcha($vals);






        if($this->input->post())
        {
     //$this->form_validation->set_rules('registration[email]',$this->lang->line('SCHOOL_EMAIL'),'trim|required|valid_email|callback_isemailExist');
     $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_checkreset');
            $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha');
     if ($this->form_validation->run() == FALSE)
             {
                $this->message=validation_errors();
               $ajax['system_message']=$this->message;
               // $this->jsonReturn($ajax);

                 $this->login_page(validation_errors());
            }

                else{
                    $passwordLink=md5(uniqid());
                $data =array(
                'reset_link'=>$passwordLink);

        $this->db->where('email', $this->input->post('email'));
        $this->db->update($CI->config->item('table_users'), $data);

        $this->load->model("institute/Institute_model");
        $userinfo=$this->Institute_model->get_user_informationbymail($this->input->post('email'));
        $uname=$userinfo['name_en'];
        // Email  library with setting 
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
    //    $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';


        $this->email->initialize($config);


        $this->email->from('noreply@mmc.gov.bd', 'MMC Reset Password');
        $this->email->to($this->input->post('email'));

            $passwordrecoverLink = "<a href=\"".$CI->get_encoded_url('home/recover?lnk='.$passwordLink.'')."\">".$CI->get_encoded_url('home/recover?lnk='.$passwordLink.'')."</a>";
            $html = "Dear $uname,\r\n";
            $html .= "Please visit the following link to reset your password:\r\n";
            $html .= "-----------------------\r\n";
            $html .= "$passwordrecoverLink\r\n";
            $html .= "-----------------------\r\n";
            $html .= "Please be sure to copy the entire link into your browser. The link will expire after 3 days for security reasons.\r\n\r\n";
            $html .= "If you did not request this forgotten password email, no action is needed, your password will not be reset as long as the link above is not visited. However, you may want to log into your account and change your security password and answer, as someone may have guessed it.\r\n\r\n";
            $html .= "Thanks,\r\n";
            $html .= "-- MMC team";

            $this->email->subject('MMC Reset Password ');
       // $html = $this->input->post('message');
            $this->email->message($html);
            $this->email->send();

       $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_RESET");
       $this->jsonReturn($ajax);

                }
        }
        else
        $this->session->set_userdata('captchaWord',$data['captcha']['word']);
      $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
      $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/resetpassword",$data,true));
      $this->jsonReturn($ajax);


    }

    public function check_captcha($str){
        $word = $this->session->userdata('captchaWord');

        if($str==$word){
            return true;
        }
        else{
            $this->form_validation->set_message('check_captcha', 'Please enter correct words!');

            return false;
        }
    }

       public function email_checkreset($str)
      {
           $CI =& get_instance();
           $query = $this->db->get_where($CI->config->item('table_users'), array('email' => $str), 1);

            if ($query->num_rows()== 1)
            {

                return true;

            }
            else
            {
             $this->form_validation->set_message('email_checkreset', 'This Email does not exist.');
             return false;
      }

   }

   public function recover(){
     //  $this->input->get('lnk');

           $CI =& get_instance();
           $query = $this->db->get_where($CI->config->item('table_users'), array('reset_link' => $this->input->get('lnk')), 1);

            if ($query->num_rows()== 1)
            {
            $data['userinfo']=$this->Institute_model->get_user_informationbylink($this->input->get('lnk'));

            $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
            $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/newpassword",$data,true));
            $this->jsonReturn($ajax);

            }
            else
            {
         $ajax['system_message']=$this->lang->line("INVALIED_LINK");
         $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
         $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/invalied",'',true));

         $this->jsonReturn($ajax);

      }

   }

   public function recoversave(){
       $CI=& get_instance();
       $this->load->library('form_validation');
       if($this->input->post())
        {
     //     $this->input->post('password');
       //   $this->input->post('repassword');

         $this->form_validation->set_rules('password', 'New Password', 'required');
         $this->form_validation->set_rules('repassword', 'Re Type New Password', 'required');
          if ($this->form_validation->run() == FALSE)
             {
                $this->message=validation_errors();
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
          }

          if($this->input->post('password')==$this->input->post('repassword')){
             $datap =array(
                'password'=>  md5($this->input->post('repassword')));

        $this->db->where('id', $this->input->post('userid'));
        $this->db->update($CI->config->item('table_users'), $datap);
         $ajax['system_message']=$this->lang->line("PASSWORD_UPDATED");
         $this->jsonReturn($ajax);

          }
          else{
            $ajax['system_message']=$this->lang->line("PASSWORD_NOT_SAME");
            $this->jsonReturn($ajax);

          }


       }

   }

   public function registration()
    {
        //    $this->load->library('form');
        $this->load->library('form_validation');
        $this->load->helper('captcha');


        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
        // setting up captcha config
        $vals = array(
            'word' => $random_number,
            'img_path' => './captcha/',
            'img_url' => base_url().'captcha/',
            'img_width' => 170,
            'img_height' => 32,
            'expiration' => 7200
        );



        $ajax['status']=true;
        $data=array();
        $data['captcha'] = create_captcha($vals);
        $data['title']=$this->lang->line("REGISTRATION_TITLE");

        if($this->input->post())
        {
            if(!$this->check_validation())
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
            }
            else
            {
                //       echo $this->input->post('registration[institute]');
                //    $this->load->model("institute/Institute");
                $data = array
                (
                    'name' => $this->input->post('registration[institute]'),
                    'code' => $this->input->post('registration[em]'),
                    'inipassword' => $this->input->post('registration[password]'),
                    'email' => $this->input->post('registration[email]'),
                    'education_type_ids' => $this->input->post('registration[education_type]'),
                    'divid' => $this->input->post('registration[divid]'),
                    'zillaid' => $this->input->post('registration[zilla]'),
                    'upozillaid' => $this->input->post('registration[upozilla]'),
                    'applied_date' => date('Y-m-d'),
                    'is_primary' => $this->input->post('registration[primary]'),
                    'is_secondary' => $this->input->post('registration[secondary]'),
                    'is_higher' => $this->input->post('registration[higher]'),
                    'user_id' => 999999,
                    'mobile' => $this->input->post('registration[mobile]'),
                    'status' => 1,
                    'approved_by' => NULL,
                    'approved_date' => NULL,
                    'comment' => NULL
                );

                //print_r($data);
                $result=$this->Institute_model->check_register_information($data);
                if($result){
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line('');
                    $this->jsonReturn($ajax);
                    exit();
                }
                $this->Institute_model->form_insert($data);
                // $data['message'] = 'Data Inserted Successfully';
                $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE");



                $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
                // setting up captcha config
                $vals = array(
                    'word' => $random_number,
                    'img_path' => './captcha/',
                    'img_url' => base_url().'captcha/',
                    'img_width' => 170,
                    'img_height' => 32,
                    'expiration' => 7200
                );

                $data['captcha'] = create_captcha($vals);

                $this->session->set_userdata('captchaWord',$data['captcha']['word']);

                //   $this->jsonReturn($ajax);
                //  redirect("/home/registration","refresh");
                $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
                $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'),array('status=1'),array());
                $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
                $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));
                $this->jsonReturn($ajax);
            }
        }
        $this->session->set_userdata('captchaWord',$data['captcha']['word']);
        $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
        $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'), array('status=1'),array());

        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('home/registration');
        $this->jsonReturn($ajax);
    }


    public function getZilla()
    {
        $division_id=$this->input->post('division_id');
        $zillas=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array('visible = 1', 'divid = '.$division_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#zilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$zillas),true));
        $this->jsonReturn($ajax);
    }

     public function getUpazila()
    {
        $zilla_id=$this->input->post('zilla_id');
        $upazilas=Query_helper::get_info($this->config->item('table_upazilas'),array('upazilaid value', 'upazilaname text'), array('visible = 1', 'zillaid = '.$zilla_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#upozilla_id","html"=>$this->load_view("dropdown",array('drop_down_options'=>$upazilas),true));
        $this->jsonReturn($ajax);
    }

   public function education_level(){

    $education_level=$this->input->post('education_level');
    $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$education_level));
    $ajax['status']=true;
    $ajax['system_content'][]=array("id"=>"#classes","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
    $this->jsonReturn($ajax);

    }

    public function education_levelnew()
    {

        $education_level=$this->input->post('education_level');
        $num=$this->input->post('num');
        $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$education_level));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#classesid".$num."","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
        $this->jsonReturn($ajax);

    }

     public function education_classes(){

    $education_level=$this->input->post('education_level');
    $classes=$this->input->post('classes');
    $education_type_ids=$this->input->post('education_type_ids');

    if ($classes) {
             if ($classes < 6) {
                 $education_level = 5;
             }elseif( 5< $classes && $classes< 11){
                 $education_level = 6;
             }elseif( $classes > 10){
                 $education_level = 7 ;
             }
         }

        $this->db->where(array('class_id' => $classes, 'education_level_id' => $education_level, 'education_type_id' => $education_type_ids));
        $query = $this->db->get($this->config->item('table_subject'));
        $subjects = array();
        $subjectname = '';
        if($query->result()){
            foreach ($query->result() as $subject) {
            $subjects[$subject->id] = $subject->name;

            $subjectname .= '<div class="zillalist"><input name="subject['.$education_level.']['.$classes.'][]" type="checkbox" value="'.$subject->id.'" /><label for='.$subject->name.'>'.$subject->name.'</label></div>';
         //   $subjectname .= '<input name="subject['.$education_level.']['.$classes.']['.$subject->id.']" type="checkbox" value="'.$subject->id.'" /><label for='.$subject->name.'>'.$subject->name.'</label>';
            }
        //    return $subjects;

            $this->jsonReturn($subjectname);
        }

    }


    public function education_classesnew()
    {

        $education_level=$this->input->post('education_level');
        $classes=$this->input->post('classes');
        $education_type_ids=$this->input->post('education_type_ids');

        if ($classes)
        {
             if ($classes < 6)
             {
                 $education_level = 5;
             }elseif( 5< $classes && $classes< 11)
             {
                 $education_level = 6;
             }
             elseif( $classes > 10)
             {
                 $education_level = 7 ;
             }
        }

        $this->db->where(array('class_id' => $classes, 'education_level_id' => $education_level, 'education_type_id' => $education_type_ids));
        $query = $this->db->get($this->config->item('table_subject'));
        $subjects = array();
        $subjectname = '';
        if($query->result())
        {
            foreach ($query->result() as $subject)
            {
                $subjects[$subject->id] = $subject->name;
                $subjectname .= '<input name="subject['.$subject->id.']['.$subject->name.']" type="checkbox" value="'.$subject->id.'" /><label for='.$subject->name.'>'.$subject->name.'</label>';
            }
            //    return $subjects;
            $this->jsonReturn($subjectname);
        }

    }


    public function education_classescollege()
    {

        $classes=$this->input->post('classes');
        $educationlevel=Query_helper::get_info($this->config->item('table_classes'),array('id value', 'name text'), array('education_level_id = '.$classes));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#classes","html"=>$this->load_view("dropdown",array('drop_down_options'=>$educationlevel),true));
        $this->jsonReturn($ajax);

    }

    private function check_validation()
    {
        $location=$this->input->post("registration");
        //$division_id = $this->input->post("registration[divid]");
        //$zilla_id=$this->input->post("zilla");
        //$upazilla_id=$this->input->post("upazilla");
        if(!$this->Institute_model->check_division($location['divid']))
        {
            $this->message=$this->lang->line('DIVISION_NOT_MATCH');
            return false;
        }
        if(!$this->Institute_model->check_zilla($location['divid'], $location['zilla']))
        {
            $this->message=$this->lang->line('DISTRICT_NOT_MATCH');
            return false;
        }
        if(!$this->Institute_model->check_upazilla($location['zilla'],$location['upozilla']))
        {
            $this->message=$this->lang->line('UPAZILLA_NOT_MATCH');
            return false;
        }

        $this->load->library('form_validation');


        $this->form_validation->set_rules('registration[divid]',$this->lang->line('DIVISION_NAME_SELECT'),'required',array('required' => $this->lang->line('DIVISION_NAME_SELECT')));
        $this->form_validation->set_rules('registration[zilla]',$this->lang->line('ZILLA_NAME_SELECT_BN'),'required',array('required' => $this->lang->line('ZILLA_NAME_SELECT_BN')));
        $this->form_validation->set_rules('registration[upozilla]',$this->lang->line('UPOZILLA_SELECT'),'required',array('required' => $this->lang->line('UPOZILLA_SELECT')));
        $this->form_validation->set_rules('registration[education_type]',$this->lang->line('EDUCATION_TYPE'),'required', array('required' => $this->lang->line('EDUCATION_TYPE').' নির্বাচন করুন।'));
        $this->form_validation->set_rules('registration[institute]',$this->lang->line('SCHOOL_NAME'),'required', array('required' => $this->lang->line('SCHOOL_NAME').' লিখুন '));
        $this->form_validation->set_rules('registration[email]',$this->lang->line('SCHOOL_EMAIL'),'trim|required|valid_email|callback_isemailExist', array('required' => $this->lang->line('SCHOOL_EMAIL').' লিখুন ।'));
     //   $this->form_validation->set_rules('registration[mobile]',$this->lang->line('SCHOOL_MOBILE'),'required');
        $this->form_validation->set_rules('registration[mobile]', $this->lang->line('SCHOOL_MOBILE'), 'required|min_length[4]|regex_match[/^0[0-9]{10}$/]', array('required' => $this->lang->line('SCHOOL_MOBILE').' লিখুন ।'));//{11} for 11 digits number
        //
       // $this->form_validation->set_rules('registration[em]',$this->lang->line('SCHOOL_EM'),'required');
       $this->form_validation->set_rules('registration[em]',$this->lang->line('SCHOOL_EM'),'trim|required|callback_isNUMBER|callback_isEMExist', array('required' => $this->lang->line('SCHOOL_EM').' লিখুন ।'));
        $this->form_validation->set_rules('registration[password]',$this->lang->line('SCHOOL_PASSWORD'),'required', array('required' => $this->lang->line('SCHOOL_PASSWORD').' লিখুন ।'));
        //$this->form_validation->set_rules('registration[repassword]',$this->lang->line('SCHOOL_RE_PASSWORD'),'required', array('required' => $this->lang->line('SCHOOL_RE_PASSWORD').' লিখুন '));
        $this->form_validation->set_rules('registration[repassword]',$this->lang->line('SCHOOL_RE_PASSWORD'),'required|matches[registration[password]]',array('required' => $this->lang->line('SCHOOL_RE_PASSWORD').' লিখুন ।'));
        $this->form_validation->set_message('matches', 'প্রদত্ত  দুই পাসওয়ার্ড একই হয়নি।  ');
        $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha',array('required' => 'ক্যাপচা কোড  লিখুন ।'));

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

    public function isNUMBER($key){
        if(preg_match('/^[0-9,]+$/', $key)){
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('isNUMBER', 'এই %s শুধু নাম্বার হবে। ');
            return FALSE;
        }

    }
    public function isEMExist($key)
    {
        //$this->Institute->EM_exists($key);
      //  return preg_match('/^[0-9,]+$/', $key);

        $CI =& get_instance();
        $this->db->where('code', $key);
        $this->db->where('institute.status !=99');
	    $query = $this->db->get($CI->config->item('table_institute'));


        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message('isEMExist', 'এই %s ইতিপূর্বে  নিবন্ধিত হয়েছে।');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }


	 public function isemailExist($key) {
  //$this->Institute->EM_exists($key);

        $CI =& get_instance();
        $this->db->where('email', $key);
         $this->db->where('institute.status !=99');


         $query = $this->db->get($CI->config->item('table_institute'));


    if ($query->num_rows() > 0){
        $this->form_validation->set_message('isemailExist', 'এই ইমেইলটি  ইতিপূর্বে  নিবন্ধিত হয়েছে।');
        return FALSE;
    }
    else{
        return TRUE;
    }
}

public function communication(){

    $data['page']='dashboard_page';
    $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array(),array());
    $data['zillas']=Query_helper::get_info($this->config->item('table_zillas'),array(),array());
    $data['zillasdp']=Query_helper::get_info($this->config->item('table_zillas'),array('zillaid value', 'zillaname text'), array());
    //$ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
    $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
    $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website","",true));
    $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
    $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/communication",$data,true));
    $ajax['system_page_url'] = $this->get_encoded_url('home/communication');
    $this->jsonReturn($ajax);


}

 private function check_validationcommunication()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('message',$this->lang->line('COMMINICATION_MESSAGE'),'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }

public function communicationsave(){
 //   $divisions=$this->input->post('division');
  //  print_r($division);
//  if(isset($this->input->post('division'))){
//      
//      echo '';
//  }


     if($this->input->post())
        {
            if(!$this->check_validationcommunication())
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
            }

            else{
         $CI =& get_instance();
         $this->load->library('email');
        $config['protocol'] = 'sendmail';
     //   $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
       $user = User_helper::get_user();
      if($this->input->post('bivagh')):
          $divisions=$this->input->post('division');
           foreach ($divisions as $key => $value){
               $divisionvalue = explode("-", $value);
               $datasave = array(
                   'sender_id'=>$user->id,
                   'receiver_id'=>$divisionvalue[0],
                   'message'=>$this->input->post('message'),
                   'message_date'=>date("Y-m-d"),
                   'is_read'=>0,
               );
               Query_helper::add($this->config->item('table_communication'),$datasave);

        //       $this->db->insert($CI->config->item('table_communication'),$datasave);

        $this->load->model("institute/Institute_model");
        $user=User_helper::get_user();
        $userinfo=$this->Institute_model->get_user_information($user->id);
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($divisionvalue[1]);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();

           }
       endif;

       if($this->input->post('zillaofficer')):
            $CI =& get_instance();
          $zillas=$this->input->post('zilla');
          foreach ($zillas as $key => $value){
              $zillaemail = explode("-", $value);
            //  echo $zillaemail[0];
              $datasave = array(
                  'sender_id'=>$user->id,
                  'receiver_id'=>$zillaemail[0],
                  'message'=>$this->input->post('message'),
                  'message_date'=>date("Y-m-d"),
                  'is_read'=>0,
              );
              Query_helper::add($this->config->item('table_communication'),$datasave);
            //  $this->db->insert($CI->config->item('table_communication'),$datasave);

        $this->load->model("institute/Institute_model");
     //   $userinfozila=$this->Institute_model->zilausers($value, $CI->config->item('USER_GROUP_DISTRICT_1'));
        $user=User_helper::get_user();
        $userinfo=$this->Institute_model->get_user_information($user->id);
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($zillaemail[1]);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();

           }
   //     $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_ZILLA");
   //     $this->jsonReturn($ajax);
       endif;



        if($this->input->post('upozillaofficer')):
            $CI =& get_instance();
          $upozilas=$this->input->post('upozzillaid');
          foreach ($upozilas as $key => $value){
              $upozilaemail = explode("-", $value);
             // echo $upozilaemail[0];
              $datasave = array(
                  'sender_id'=>$user->id,
                  'receiver_id'=>$upozilaemail[0],
                  'message'=>$this->input->post('message'),
                  'message_date'=>date("Y-m-d"),
                  'is_read'=>0,
              );
              Query_helper::add($this->config->item('table_communication'),$datasave);
           //   $this->db->insert($CI->config->item('table_communication'),$datasave);

        $this->load->model("institute/Institute_model");
    //    $userinfozila=$this->Institute_model->zilausers($value, $CI->config->item('USER_GROUP_UPOZILA_1'));
        $user=User_helper::get_user();
        $userinfo=$this->Institute_model->get_user_information($user->id);
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($upozilaemail[1]);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();

           }
    //    $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_UPOZILA");
   //     $this->jsonReturn($ajax);
       endif;


       if($this->input->post('instituteemail')):
            $CI =& get_instance();
          $institutes=$this->input->post('institute');
          foreach ($institutes as $key => $value){
              $instituteemail = explode("-", $value);
              $datasave = array(
                  'sender_id'=>$user->id,
                  'receiver_id'=>$instituteemail[0],
                  'message'=>$this->input->post('message'),
                  'message_date'=>date("Y-m-d"),
                  'is_read'=>0,
              );

           //   $this->db->insert($CI->config->item('table_communication'),$datasave);
              Query_helper::add($this->config->item('table_communication'),$datasave);
        $this->load->model("institute/Institute_model");

        $user=User_helper::get_user();
        $userinfo=$this->Institute_model->get_user_information($user->id);
        $this->email->from($userinfo['email'], $userinfo['name_en']);
        $this->email->to($instituteemail[1]);

        $this->email->subject('Message ');
        $html = $this->input->post('message');
        $this->email->message($html);
        $this->email->send();

           }
     //   $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_INSTITUTE");
   //     $this->jsonReturn($ajax);
       endif;
       $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE_MESSAGE");
       $this->jsonReturn($ajax);
            }
        }
}

    public function getzillalist()
    {
        $CI =& get_instance();
        $user=User_helper::get_user();


        $division=$this->input->post('division');
        $divisionvalue = explode("-", $division);
        $CI->db->select('zillas.zillaid AS zillaid, zillas.zillaname AS zillaname,
                   core_01_users.id AS receiverid, core_01_users.id AS userid, core_01_users.email AS email, core_01_users.zilla AS zilla');
        $CI->db->from($CI->config->item('table_zillas').' zillas');
        $CI->db->join('core_01_users', 'core_01_users.zilla = zillas.zillaid','left');
        $CI->db->where('core_01_users.user_group_id', 13);

        $CI->db->where(array('visible' => 1, 'divid' => $divisionvalue[2]));
        $queryresults = $CI->db->get();

        $upazilas = array();
        $zilslaname = '';
        if($queryresults->result())
        {
            foreach ($queryresults->result() as $zila)
            {

                $zilslaname .= '<div class="col-md-4"><input name="zillaid[]" type="checkbox" value="'.$zila->userid.'-'.$zila->zillaid.'-'.$zila->email.'" /><label for='.$zila->zillaname.'>'.$zila->zillaname.'</label></div>';
            }
            $this->jsonReturn($zilslaname);
        }


    }

    public function getzillalistdroupdown()
    {
        $CI =& get_instance();
        $user=User_helper::get_user();


        $division=$this->input->post('division');
        $divisionvalue = explode("-", $division);
        $CI->db->select('zillas.zillaid AS zillaid, zillas.zillaname AS zillaname,
                   core_01_users.id AS receiverid, core_01_users.id AS userid, core_01_users.email AS email, core_01_users.zilla AS zilla');
        $CI->db->from($CI->config->item('table_zillas').' zillas');
        $CI->db->join('core_01_users', 'core_01_users.zilla = zillas.zillaid','left');
        $CI->db->where('core_01_users.user_group_id', 13);

        $CI->db->where(array('visible' => 1, 'divid' => $divisionvalue[2]));
        $queryresults = $CI->db->get();

        $upazilas = array();
        $zilslaname = '';
        $zilslaname .='<select id="zillalist" class="form-control" name="zilaname"><option value=""></option>';
        if($queryresults->result())
        {
            foreach ($queryresults->result() as $zila)
            {

                $zilslaname .='<option value="'.$zila->zillaid.'">'.$zila->zillaname.'</option>';
            }

        }
        $zilslaname .='</select>';
        $this->jsonReturn($zilslaname);

    }

    public function getupozillalist()
    {
        $CI =& get_instance();
        $user=User_helper::get_user();


        $zilaname=$this->input->post('zilaname');

        $CI->db->select('upazilas.upazilaid AS upazilaid, upazilas.zillaid AS zillaid, upazilas.upazilaname AS upazilaname,
                   core_01_users.id AS receiverid, core_01_users.id AS userid, core_01_users.email AS email, core_01_users.upazila AS upazila');
        $CI->db->from($CI->config->item('table_upazilas').' upazilas');
        $CI->db->join('core_01_users', 'core_01_users.upazila = upazilas.upazilaid','left');
        $CI->db->where('core_01_users.user_group_id', 17);
        $CI->db->where('upazilas.visible', 1);
        $CI->db->where('upazilas.zillaid', $zilaname);

      //  $CI->db->where(array('upazilas.visible' => 1, 'upazilas.zillaid' => $zilaname, 'core_01_users.user_group_id'=> 17));
        $queryresults = $CI->db->get();
    //  echo $CI->db->last_query();
    //    $upazilas = array();
        $upozillaname = '';
        if($queryresults->result())
        {
            foreach ($queryresults->result() as $upozilla)
            {

                $upozillaname .= '<div class="col-md-4"><input name="upozzillaid[]" type="checkbox" value="'.$upozilla->userid.'-'.$upozilla->upazilaid.'-'.$upozilla->email.'" /><label for='.$upozilla->upazilaname.'>'.$upozilla->upazilaname.'</label></div>';
            }
            $this->jsonReturn($upozillaname);
        }


    }

    public function getUpazilacheckbox()
    {
        $CI =& get_instance();
        $user=User_helper::get_user();
        $zilaname=$this->input->post('zilla_id');

        $CI->db->select('upazilas.upazilaid AS upazilaid, upazilas.zillaid AS zillaid, upazilas.upazilaname AS upazilaname,
                   core_01_users.id AS receiverid, core_01_users.id AS userid, core_01_users.email AS email, core_01_users.upazila AS upazila');
        $CI->db->from($CI->config->item('table_upazilas').' upazilas');
        $CI->db->join('core_01_users', 'core_01_users.upazila = upazilas.upazilaid','left');
        $CI->db->where('core_01_users.user_group_id', 17);
        $CI->db->where('upazilas.visible', 1);
        $CI->db->where('upazilas.zillaid', $zilaname);
        $CI->db->group_by('core_01_users.upazila');
        $queryresults = $CI->db->get();

        $upozillaname = '';
        if($queryresults->result())
        {
            foreach ($queryresults->result() as $upozilla)
            {

                $upozillaname .= '<div class="col-md-4"><input name="upozzillaid[]" type="checkbox" value="'.$upozilla->userid.'-'.$upozilla->upazilaid.'-'.$upozilla->email.'" /><label for='.$upozilla->upazilaname.'>'.$upozilla->upazilaname.'</label></div>';
            }
            $this->jsonReturn($upozillaname);
        }



    }


     public function getUpazilaschoolcheckbox()
    {
        $zilla_id=$this->input->post('zillaid');
        $upozilla_id=$this->input->post('upozilla_id');

         $this->db->where(array('status' => 2, 'zillaid' => $zilla_id, 'upozillaid' => $upozilla_id));
        $this->db->group_by('institute.name');
        $query = $this->db->get($this->config->item('table_institute'));

        $institutes = array();
        $institutesname = '';
        if($query->result())
        {
            foreach ($query->result() as $institutes)
            {

                $institutesname .= '<div class="col-md-6"><input name="institute[]" type="checkbox" value="'.$institutes->id.'-'.$institutes->email.'" /><label for='.$institutes->name.'>'.$institutes->name.'</label></div>';
            }
            //    return $subjects;
            $this->jsonReturn($institutesname);
        }
        else{
            $institutesname="কোন প্রতিষ্ঠান পাওয়া যায়নি। ";
            $this->jsonReturn($institutesname);
        }


    }
  //  public function


    public function messagesend(){

        //     if($this->permissions['list'])
        //     {

        $data['page']='dashboard_page';
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",'',true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/messagesend",'',true));
        $ajax['system_page_url']=$this->get_encoded_url('home/messagesend');
        $this->jsonReturn($ajax);

        //      }

    }


    public function get_message_send()
    {
          $this->load->model("institute/Institute_model");
        $institutes = array();
        //   if($this->permissions['list'])
        //    {
        $institutes = $this->Institute_model->get_message_sendlistdata();
        //   }
        $this->jsonReturn($institutes);
    }

    public function myinbox(){

        $data['page']='dashboard_page';
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",'',true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("website","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/myinbox",'',true));
        $ajax['system_page_url']=$this->get_encoded_url('home/myinbox');
        $this->jsonReturn($ajax);
    }

    public function get_myinbox()
    {
        $this->load->model("institute/Institute_model");
        $institutes = array();
        //   if($this->permissions['list'])
        //    {
        $institutes = $this->Institute_model->get_message_inbox();
        //   }
        $this->jsonReturn($institutes);
    }
    public function contact(){

        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/contact",'',true));
        $ajax['system_page_url'] = $this->get_encoded_url('home/contact');
        $this->jsonReturn($ajax);
    }

    public function help(){
		$CI =& get_instance();
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->helper('captcha');


        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
        // setting up captcha config
        $vals = array(
            'word' => $random_number,
            'img_path' => './captcha/',
            'img_url' => base_url().'captcha/',
            'img_width' => 170,
            'img_height' => 32,
            'expiration' => 7200
        );
        $data= array();
        $data['page']="inner_page";
        $data['captcha'] = create_captcha($vals);
		if($this->input->post())
        {
			$this->form_validation->set_rules('school_name',$this->lang->line('SCHOOL_NAME'),'trim|required',array('required' => $this->lang->line('SCHOOL_NAME')));
            $this->form_validation->set_rules('school_email',$this->lang->line('SCHOOL_EMAIL'),'trim|valid_email|required',array('required' => $this->lang->line('SCHOOL_EMAIL')));
            $this->form_validation->set_rules('em',$this->lang->line('SCHOOL_EM'),'required',array('required' => $this->lang->line('SCHOOL_EM')));
			$this->form_validation->set_rules('school_mobile', $this->lang->line('SCHOOL_MOBILE'), 'required|min_length[4]|regex_match[/^0[0-9]{10}$/]', array('required' => $this->lang->line('SCHOOL_MOBILE')));//{11} for 11 digits number
			$this->form_validation->set_rules('details',$this->lang->line('DETAILS'),'trim|required',array('required' => $this->lang->line('DETAILS')));
            $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha',array('required' => 'ক্যাপচা কোড  লিখুন ।'));

            if ($this->form_validation->run() == FALSE)
            {
                $this->message=validation_errors();
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
            }
			else{
				$this->load->library('email');
			//	$config['protocol'] = 'sendmail';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				 $this->email->clear(TRUE);
				$this->email->from($this->input->post('school_email'), $this->input->post('school_name'));
				$this->email->to('mmc.bgd@gmail.com');
				$this->email->bcc('mmcsupport@soft-bd.com');
				$this->email->bcc('antu@softbdltd.com');
				$schoolname=$CI->lang->line('SCHOOL_NAME');
				$schoolemail=$CI->lang->line('SCHOOL_EMAIL');
				$schoolem=$CI->lang->line('SCHOOL_EM');
				$schoolmobile=$CI->lang->line('SCHOOL_MOBILE');
				$schooldetails=$CI->lang->line('DETAILS');
				//
				$school_name=$this->input->post('school_name');
				$school_email=$this->input->post('school_email');
				$school_em=$this->input->post('em');
				$school_mobile=$this->input->post('school_mobile');
				$details=$this->input->post('details');

				$html = "Dear MMC Team,\r\n <br />";
				$html .= "$schoolname: $school_name \r\n<br />";
				$html .= "$schoolemail: $school_email \r\n<br />";
                $html .= "$schoolem: $school_em \r\n<br />";
				$html .= "$schoolmobile: $school_mobile \r\n<br />";
				$html .= "$schooldetails: $details \r\n<br />";
				$html .= "-----------------------\r\n<br />";


            $html .= "Thanks,\r\n<br />";

			$this->email->subject('MMC Help Desk ');
            $this->email->message($html);
            $this->email->send();

                $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
                // setting up captcha config
                $vals = array(
                    'word' => $random_number,
                    'img_path' => './captcha/',
                    'img_url' => base_url().'captcha/',
                    'img_width' => 170,
                    'img_height' => 32,
                    'expiration' => 7200
                );

                $data['captcha'] = create_captcha($vals);

                $this->session->set_userdata('captchaWord',$data['captcha']['word']);

		//	 echo $this->email->print_debugger();
		$ajax['system_message']=$this->lang->line("SEND_REPORT_MESSAGE");
		$ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/help","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('home/help');
		$this->jsonReturn($ajax);

			}
		}
        $this->session->set_userdata('captchaWord',$data['captcha']['word']);

        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/help",'',true));
        $ajax['system_page_url'] = $this->get_encoded_url('home/help');
        $this->jsonReturn($ajax);
    }

    public function _____registration()
    {
        //    $this->load->library('form');
        $this->load->library('form_validation');
        $this->load->helper('captcha');


        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
        // setting up captcha config
        $vals = array(
            'word' => $random_number,
            'img_path' => './captcha/',
            'img_url' => base_url().'captcha/',
            'img_width' => 170,
            'img_height' => 32,
            'expiration' => 7200
        );



        $ajax['status']=true;
        $data=array();
        $data['captcha'] = create_captcha($vals);
        $data['title']=$this->lang->line("REGISTRATION_TITLE");

        if($this->input->post())
        {
            if(!$this->check_validation())
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
            }
            else
            {
                //       echo $this->input->post('registration[institute]');
                //    $this->load->model("institute/Institute");
                $data = array
                (
                    'name' => $this->input->post('registration[institute]'),
                    'code' => $this->input->post('registration[em]'),
                    'inipassword' => $this->input->post('registration[password]'),
                    'email' => $this->input->post('registration[email]'),
                    'education_type_ids' => $this->input->post('registration[education_type]'),
                    'divid' => $this->input->post('registration[divid]'),
                    'zillaid' => $this->input->post('registration[zilla]'),
                    'upozillaid' => $this->input->post('registration[upozilla]'),
                    'applied_date' => date('Y-m-d'),
                    'is_primary' => $this->input->post('registration[primary]'),
                    'is_secondary' => $this->input->post('registration[secondary]'),
                    'is_higher' => $this->input->post('registration[higher]'),
                    'user_id' => 999999,
                    'mobile' => $this->input->post('registration[mobile]'),
                    'status' => 1,
                    'approved_by' => NULL,
                    'approved_date' => NULL,
                    'comment' => NULL
                );

                //print_r($data);
                $result=$this->Institute_model->check_register_information($data);
                if($result){
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line('');
                    $this->jsonReturn($ajax);
                    exit();
                }
                $this->Institute_model->form_insert($data);
                // $data['message'] = 'Data Inserted Successfully';
                $ajax['system_message']=$this->lang->line("SUCESS_MESSAGE");



                $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
                // setting up captcha config
                $vals = array(
                    'word' => $random_number,
                    'img_path' => './captcha/',
                    'img_url' => base_url().'captcha/',
                    'img_width' => 170,
                    'img_height' => 32,
                    'expiration' => 7200
                );

                $data['captcha'] = create_captcha($vals);

                $this->session->set_userdata('captchaWord',$data['captcha']['word']);

                //   $this->jsonReturn($ajax);
                //  redirect("/home/registration","refresh");
                $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
                $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'),array('status=1'),array());
                $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
                $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));
                $this->jsonReturn($ajax);
            }
        }

        $this->session->set_userdata('captchaWord',$data['captcha']['word']);
        $data['divisions']=Query_helper::get_info($this->config->item('table_divisions'),array('divid value', 'divname text'), array());
        $data['education_type']=Query_helper::get_info($this->config->item('table_education_type'),array('id value', 'name text'), array('status=1'),array());

        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/registration",$data,true));
        $ajax['system_page_url']=$this->get_encoded_url('home/registration');
        $this->jsonReturn($ajax);
    }

    public function monthlyreport(){

        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/monthlyreport",'',true));
        $this->jsonReturn($ajax);

    }
    public function noticeview($id)
    {
        $CI =& get_instance();
     //   $this->input->get('id');
     //   $this->input->get('lnk');

     //   $id=3;
        $data['MediaInfo']=Query_helper::get_info($this->config->item('table_media'),'*',array('id ='.$id),1);

        $ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/noticeview","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('home/noticeview/'.$id);
        $this->jsonReturn($ajax);


    }
	public function admingraph(){
		$ajax['status']=true;
        $data['page']="inner_page";
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
		$ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
		$ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/admingraph","",true));
		$ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('home/admingraph');
        $this->jsonReturn($ajax);

	}

	public function testmail(){
		/*
$this->load->library('email');

$this->email->from('info@mmc.com', 'Your Name');
$this->email->to('jibon.bikash@gmail.com');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

$this->email->send();

echo $this->email->print_debugger();
*/

					$this->load->library('email');
				//	$config['protocol'] = 'sendmail';
				//	$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';

				$schoolemail='jibon.bikash@gmail.com';
				$freshpassword='123456';
				$this->email->initialize($config);
				$this->email->from('noreply@mmc.gov.bd', 'MMC Reset New Password');
				$this->email->to($schoolemail);
			$html = "Dear $schoolemail,\r\n <br />";
            $html .= "Your New password:\r\n<br />";
            $html .= "-----------------------\r\n<br />";
            $html .= "Username: $schoolemail\r\n<br />";
			$html .= "Password: $freshpassword\r\n\r\n<br />";


            $html .= "Thanks,\r\n<br />";
            $html .= "-- MMC team";

			$this->email->subject('MMC Reset New Password ');
            $this->email->message($html);
            $this->email->send();
			 echo $this->email->print_debugger();

	}


	public function monthly_report_send(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $ajax['status']=true;
        $data['page']="inner_page";

        if($this->input->post())
        {

            $this->form_validation->set_rules('visited_list',$this->lang->line('VISITES_NUMBER'),'trim|integer|required',array('required' => $this->lang->line('VISITES_NUMBER')));
            $this->form_validation->set_rules('visited_in_house',$this->lang->line('VISITES_IN_HOUSE'),'trim|integer|required',array('required' => $this->lang->line('VISITES_IN_HOUSE')));
            if ($this->form_validation->run() == FALSE)
            {
                $this->message=validation_errors();
                $ajax['system_message']=$this->message;
                $this->jsonReturn($ajax);
            }
            else{
                $data = array(
                    'username' => $this->input->post('username'),
                    'visited_list' => $this->input->post('visited_list'),
                    'zilla'=>$this->input->post('zilla'),
                    'in_house' => $this->input->post('visited_in_house'),
                    'sender' => $this->input->post('sender_name'),
                    'submit_date' => date("Y-d-m")
                );

                $this->db->insert($this->config->item('table_monthly_report'), $data);
		$ajax['system_message']=$this->lang->line("SEND_REPORT_MESSAGE");
		$ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/monthly_report_send","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('home/monthly_report_send');
		$this->jsonReturn($ajax);
            }
        }
        $ajax['system_content'][]=array("id"=>"#top_header","html"=>$this->load_view("header",$data,true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper_top_menu","html"=>$this->load_view("top_menu","",true));
        $ajax['system_content'][]=array("id"=>"#system_wrapper","html"=>$this->load_view("home/monthly_report_send","",true));
        $ajax['system_page_title']=$this->lang->line("WEBSITE_TITLE");
        $ajax['system_page_url'] = $this->get_encoded_url('home/monthly_report_send');
        $this->jsonReturn($ajax);

    }
}
