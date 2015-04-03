<?php

class User extends CI_Controller {
    function __construct() {
        parent::__construct();
        
    }

    function index() {
        $this -> showLoginPage();
    }
    
    function logout(){
        $this->load->model('users');
        $this->load->model('activity_log');
        $name = $this->users->get_full_name($this -> session -> userdata('id'));
        $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
        
        
        $action =   "logged out"; 
        
        $log_info = array(
        "activity_type"=>43,
        "executor"=>$this->session->userdata('id'),
        "executed_to"=>'',
        "description"=>"$name($role_1) $action"
        ); 
       $this->activity_log->add_log($log_info);

        $sess_data = array('logged_in' => '', 'role' => '','id'=>'');
        $this->session->unset_userdata($sess_data);
        redirect("/user");        
    }

    function login() {
        if ($this -> session -> userdata('logged_in')) {
            redirect("/page/home");

        }
            
        $this -> form_validation -> set_rules('username', 'Username', 'trim|required|xss_clean');
        $this -> form_validation -> set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this -> form_validation -> run() == FALSE) {
            $this -> showLoginPage();
        } else {
            $this -> load -> model('users');
            $ret = $this -> users -> login();
            if ($ret) {
                $sess_data = array('logged_in' => TRUE, 'role' => $ret[0]['role_id'],'id'=>$ret[0]['id'],'registration_completed'=>$ret[0]['registration_completed']);
                $this -> session -> set_userdata($sess_data);
               
                $this->load->model('activity_log');
                $name = $this->users->get_full_name($this -> session -> userdata('id'));
                $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
                
                
                $action =   "logged in"; 
                
                $log_info = array(
                "activity_type"=>42,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) $action"
                ); 
               $this->activity_log->add_log($log_info);



                redirect("/page/home");
            } else {
                $this -> showLoginPage('User does not exists');
            }
        }

    }

    function password_check($str)
    {
        $this->load->model('users');
        $id = $this->session->userdata('id');
                
        if ($pass=$this->users->get_password($id) && md5($pass)==md5($str))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('password_check', 'The password doesn\'t match');
            return FALSE;
        }
    }


    function update_password($mode='',$error=''){
        if ($this -> session -> userdata('logged_in')==FALSE && $this -> session -> userdata('role')!=1) {
            redirect('/user','refresh');
        }
        $this->load->model('users');

        if($mode=='update'){
                $this -> form_validation -> set_rules('old_pass', 'Old password', 'trim|required|callback_username_check');
                $this -> form_validation -> set_rules('password', 'Password', 'trim|required|xss_clean');
            if ($this -> form_validation -> run() == FALSE) {
                $this -> update_password('','Correct the following');
            } else {
                $id = $this->session->userdata('id');
                $users_info = array(
                        'password'=>md5($this->input->post('password')),
                    );

                if($this->users->update_login_info($id,$users_info)){
                    $this->load->model('activity_log');
                $name = $this->users->get_full_name($this -> session -> userdata('id'));
                $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
                
                
                $action =   "changed password"; 
                
                $log_info = array(
                "activity_type"=>30,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) $action"
                ); 
               $this->activity_log->add_log($log_info);

                    $this->show_success_msg('Password changed successfully','success');
                }else{
                    $this->show_success_msg('Sorry, something went wrong','error');

                }
            }
        }else{
            
            $this->generate_page("User :: Complete registration",array(
                    'update_password'=>array()
                    )
            );
        }

    }

    function complete_registration($mode='',$error=''){
        if ($this -> session -> userdata('logged_in')==FALSE && $this -> session -> userdata('role')!=1) {
            redirect('/user','refresh');
        }
        $this->load->model('users');
        $this->load->model('department');

        if($mode=='complete'){
            $this -> form_validation -> set_rules('first_name', 'First name', 'trim|required|xss_clean');
            $this -> form_validation -> set_rules('last_name', 'Last name', 'trim|required|xss_clean');
            $this -> form_validation -> set_rules('user_name', 'Username', 'trim|required|xss_clean|is_unique[users.user_name]');
            $this -> form_validation -> set_rules('password', 'Password', 'trim|required|xss_clean');
            $this -> form_validation -> set_rules('contact_number', 'Contact number', 'trim|required|xss_clean');
    
        if ($this -> form_validation -> run() == FALSE) {
            $this -> complete_registration('','Correct the following');
        } else {
            $id = $this->session->userdata('id');
            $profile_info = array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'last_password_change_date'=>date('Y-m-d H:i:s'),
                'contact_number'=>$this->input->post('contact_number'),
                'department'=>$this->input->post('department')
                );
            $users_info = array(
                    'user_name'=>$this->input->post('user_name'),
                    'password'=>md5($this->input->post('password')),
                    'registration_completed'=>1
                );

            if($this->users->complete_registration($id,$profile_info) && $this->users->update_login_info($id,$users_info)){
                $this->session->set_userdata('registration_completed', 1);

                $this->load->model('activity_log');
                $name = $this->users->get_full_name($this -> session -> userdata('id'));
                $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
                
                
                $action =   "completed registration"; 
                
                $log_info = array(
                "activity_type"=>44,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) $action"
                ); 
               $this->activity_log->add_log($log_info);


                $this->show_success_msg('Information updated successfully','success');
            }else{
                $this->show_success_msg('Sorry, something went wrong','error');

            }

        }        


        }else{
            $options = $this -> users -> get_role_option();
            $department = $this->department->get_active_departments();

            $this->generate_page("User :: Complete registration",array(
                    'user_registration_form'=>array(
                                        'ferror'=>$error,
                                        'options'=>$options,
                                        'dept'=>$department,
                                        'role'=>$this->users->get_role_name($this->session->userdata('role'))
                                        )
                    )
            );
        }
    }

    public function show_success_msg($msg='',$type='success'){
        
        $this->generate_page('User :: '.$type, array('alerts'=>array('msg'=>$msg,'type'=>$type)));
        
        
    }

    function change_pass($mode='change'){
         
    }

    function showLoginPage($error = '') {
        $data['header'] = $this -> load -> view("templates/header", array('title' => 'Login'), TRUE);
        $data['nav_regular'] = $this -> load -> view("templates/nav_regular", '', TRUE);
        $data['login_form'] = $this -> load -> view("templates/login_form", array('ferror' => $error), TRUE);
        $data['footer'] = $this -> load -> view("templates/footer", '', TRUE);
        $this -> load -> view('pages/index', $data);
    }

   private function generate_page($title, $pdata, $page='purchase'){
        $this->load->library('pagebuilder');
        $this->pagebuilder->generate_page($title, $pdata, $page);    
    }

}
?>