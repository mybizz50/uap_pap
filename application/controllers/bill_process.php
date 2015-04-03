<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bill_process extends CI_Controller {

  
     function __construct() {
        parent::__construct();
        if ($this -> session -> userdata('logged_in') == FALSE) {
            redirect('/user','refresh');
        }

        $this -> load -> model('users');
        $access = $this->users->get_role_defination($this -> session -> userdata('role'));
        if(empty($access['purchase_mod_access'])){
            redirect('/page/page_not_found', 'refresh');    
        }

        if($this -> session -> userdata('registration_completed')==0){
         redirect('/user/complete_registration', 'refresh');   
        }
    }

    public function index() {
        $this->generate_page("Bill Process :: home", array('bill_process_home'=>''));
    }
    
    public function submit_new_bill(){
        $this -> load -> model('purchase_model');
        $this -> load -> model('bill_process_model');
        $user_id = $this->session->userdata('id');
        $page_data = array(
                "purchase_list"=>$this->purchase_model->get_purchase_list(array('purchase_status'=>9, 'bill_status'=>0, 'created_by'=>$user_id)),
                "flow_list"=>$this->bill_process_model->get_bill_process_flow_structure(),
                "initial_step"=>true
            );
        $this->generate_page("Bill Process :: New Bill", array('new_bill'=>$page_data));
    }

    public function bill_process_list($id = -1){
        if($id>-1){
            $this->bill_details($id);
            return;
        }
        $this -> load -> model('purchase_model');
        $this -> load -> model('bill_process_model');
        $this -> load -> model('users');
        
        $uid = $this -> session -> userdata('id');
        $dept = $this->users->get_user_dept($uid);

        $processes = $this->purchase_model->get_bill_processes($dept);

        $page_data = array(
                "purchase_list"=>$processes
            );
        $this->generate_page("Bill Process :: Billing processes", array('billing_list'=>$page_data));
        
    }

    public function bill_details($purchase_id){
        $this->load->model('purchase_flow_model');
        $this->load->model('purchase_model');
        $this -> load -> model('bill_process_model');
        $this->load->model('role');
        $this->load->model('users');
        $this->load->model('department');
        $this->load->model('stock_category');
        

        $flow_list = $this->purchase_flow_model->get_purchase_flow($purchase_id);
        
        for ($i=0; $i < count($flow_list); $i++) {
             
            $flow_id = $flow_list[$i]['id'];
            
            $flow_list[$i]['from'] = $this->users->get_full_name($flow_list[$i]['from'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['from'])).")";
            $flow_list[$i]['to'] = $this->users->get_full_name($flow_list[$i]['to'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['to'])).")";
            $flow_list[$i]['attachments'] = $this->purchase_flow_model->get_purchase_attachments($flow_id);
            $flow_list[$i]['status_type'] = $this->purchase_flow_model->get_flow_type_name($flow_list[$i]['status_type']);
            
        }
            
            $is_readonly = true;
            $user_id = $this->session->userdata('id');
            $role_id = $this->users->get_role_by_id($user_id);

            $page_data = array(
            "purchase_id"=>$purchase_id,    
            "current_flow"=>0,
            "is_readonly"=>$is_readonly,
            "flow_history"=>$flow_list,
            "mode"=>"process",
            "flow_list"=>$this->purchase_flow_model->get_purchase_flow_structure(),
            "can_approve"=>$this->can_user_approve(),
            "purchase_list"=>$this->purchase_model->get_purchase_list(array('purchase_status'=>9)),
            "flow_list"=>$this->bill_process_model->get_bill_process_flow_structure(),
            "initial_step"=>false,
            "final_stage"=>$this->bill_process_model->get_final_destination(),
            "check_issued"=>$this->purchase_flow_model->check_issued($purchase_id),
            "check_issuer"=>$this->bill_process_model->is_check_issuer($role_id)

            );

           ////$this->print_a($this->purchase_flow_model->get_initiator($purchase_id)); 
        

        $this->generate_page("Bill Process :: Bill info",
                array('bill_process'=>$page_data));    

        
    }

    public function next(){
        $this->load->model('purchase_flow_model');
        $this->load->model('bill_process_model');
        $this->load->model('stock_model');
        $this->load->model('notification_model');
        $this->load->model('purchase_model');
        $this->load->model('role');
        $this->load->model('users');
        $this->load->model('department');
        $this->load->model('stock_category');
        $this->load->model('activity_log');
        

        $data= $this->input->post();
        $process_action = $this->input->post('process_action');
        $initial_step = $data['initial_step'];
        $purchase_id = $data['purchase_id'];

        $name = $this->users->get_full_name($this -> session -> userdata('id'));
        $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
        
        $name_2 = $this->users->get_full_name($data['forward_id']);
        $role_2= $this->users->get_role_name($this->users->get_role_by_id($data['forward_id']));


        $flow_data = array(
            "purchase_id"=>$purchase_id,
            "from"=>$this->session->userdata('id'),
            "to"=>$data['forward_id'],
            "subject"=>" ",
            "message"=>$data['comments'],
            "status_type"=>10,
        );



        
        $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$data['forward_id'],
                "origin_module"=>"bill_process",
                "relation"=>"bills",
                "action"=>10,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now")
            );


        $log_info = array(
            "activity_type"=>47,
            "executor"=>$this->session->userdata('id'),
            "executed_to"=>$data['forward_id'],
            "description"=>"$name($role_1) forwarded bill (purchase Id#$purchase_id) to $name_2($role_2)"
        );
        
        
        
        if(!$initial_step){
            $this->notification_model->mark_processed($this->input->post('current_flow'));    
        }
        

        if($process_action=='issue_check'){
            $flow_data = array(
                "purchase_id"=>$purchase_id,
                "from"=>$this->session->userdata('id'),
                "to"=>$this->session->userdata('id'),
                "subject"=>"Check issued",
                "message"=>$data['comments'],
                "status_type"=>11,
            );



            
            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$this->session->userdata('id'),
                "origin_module"=>"bill_process",
                "relation"=>"bills",
                "action"=>11,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now")
            );

            $log_info = array(
                "activity_type"=>48,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) issued check for purchase Id#$purchase_id"
            );

        }

        if($process_action=='check_singed_and_forwarded'){
            $flow_data = array(
                "purchase_id"=>$purchase_id,
                "from"=>$this->session->userdata('id'),
                "to"=>$data['forward_id'],
                "subject"=>"Check forward",
                "message"=>$data['comments'],
                "status_type"=>12,
            );
            
            
            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$data['forward_id'],
                "origin_module"=>"bill_process",
                "relation"=>"bills",
                "action"=>12,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now")
            );

            $log_info = array(
                "activity_type"=>49,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) signed a check and forwarded the check (purchase Id#$purchase_id) to $name_2($role_2)"
            );

        }

        if($process_action=='check_singed_and_approved'){
            $flow_data = array(
                "purchase_id"=>$purchase_id,
                "from"=>$this->session->userdata('id'),
                "to"=>$this->bill_process_model->get_final_destination(),
                "subject"=>"Check approved",
                "message"=>$data['comments'],
                "status_type"=>13,
            );
            
            
            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$this->bill_process_model->get_final_destination(),
                "origin_module"=>"bill_process",
                "relation"=>"bills",
                "action"=>13,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now")
            );

            $log_info = array(
                "activity_type"=>50,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) signed a check and approved the bill (purchase Id#$purchase_id)"
            );

        }

        if($process_action=='bill_paid'){
            $flow_data = array(
                "purchase_id"=>$purchase_id,
                "from"=>$this->session->userdata('id'),
                "to"=>$this->bill_process_model->get_final_destination(),
                "subject"=>"Bill paid",
                "message"=>$data['comments'],
                "status_type"=>14,
            );
            
            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$this->purchase_flow_model->get_appo1(),
                "origin_module"=>"bill_process",
                "relation"=>"bills",
                "action"=>14,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now"),
                "is_readonly"=>1
            );

            $log_info = array(
                "activity_type"=>51,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) paid the bill (purchase Id#$purchase_id)"
            );

            $this->purchase_model->change_bill_status($purchase_id, 14);

        }

        if($process_action=='reject_bill'){
            $flow_data = array(
                "purchase_id"=>$purchase_id,
                "from"=>$this->session->userdata('id'),
                "to"=>$this->bill_process_model->get_final_destination(),
                "subject"=>"Bill rejected",
                "message"=>$data['comments'],
                "status_type"=>15,
            );
            
            
            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$this->purchase_flow_model->get_appo1(),
                "origin_module"=>"bill_process",
                "relation"=>"bills",
                "action"=>15,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now"),
                "is_readonly"=>1
            );

            $log_info = array(
                "activity_type"=>52,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) rejected a bill (purchase Id#$purchase_id)"
            );

            $this->purchase_model->change_bill_status($purchase_id, 15);
            $this->purchase_model->change_stock_status($purchase_id, 0);

        }

        $files = $this->upload_files('attachments');
        
        $flow_id = $this->purchase_flow_model->insert_flow($flow_data);
        
       
        for($i=0; $i<count($files);$i++){
            $this->purchase_flow_model->insert_attachment(array(
                "flow_id"=>$flow_id,
                "file_name"=>$files[$i]
                ));
        }

         
       $this->activity_log->add_log($log_info);
       $this->notification_model->add_notification($notification_info);


        if($initial_step){
            $this->stock_model->enter_stock($purchase_id);
            $this->purchase_model->change_stock_status($purchase_id, 16);

            $log_info = array(
                "activity_type"=>53,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"$name($role_1) received the stock for purchase Id#$purchase_id"
            );

            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$this->session->userdata('id'),
                "origin_module"=>"stock_management",
                "relation"=>"stock_details",
                "action"=>16,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now"),
                "is_readonly"=>1
            );


            $this->activity_log->add_log($log_info);
            $this->notification_model->add_notification($notification_info);
        }

        if($process_action=='reject_bill'){
            
            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$this->purchase_model->get_purchase_initiator_id($purchase_id),
                "origin_module"=>"bill_process",
                "relation"=>"bills",
                "action"=>15,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now"),
                "is_readonly"=>1
            );

            $this->notification_model->add_notification($notification_info);

            $notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$this->purchase_model->get_purchase_initiator_id($purchase_id),
                "origin_module"=>"stock_management",
                "relation"=>"stock_details",
                "action"=>17,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now"),
                "is_readonly"=>1
            );

            $this->notification_model->add_notification($notification_info);


            $this->stock_model->delete_stock($purchase_id);

            $log_info = array(
                "activity_type"=>54,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) rejected a bill and stock adjusted for purchase Id#$purchase_id"
            );

        }




        $this->generate_page("Bill process :: Success", array('alerts'=>array('type'=>'success','msg'=>"Action successfully done")));
        

                
    }

    public function bills($id){
        $this->load->model('purchase_flow_model');
        $this->load->model('notification_model');
        $this->load->model('purchase_model');
        $this -> load -> model('bill_process_model');
        $this->load->model('role');
        $this->load->model('users');
        $this->load->model('department');
        $this->load->model('stock_category');
        $record = $this->notification_model->get_notification($id,$this->session->userdata('id'));
        if(!$record){
            $this->generate_page("404 :: Not found", array('alerts'=>array('type'=>'error','msg'=>'404 ! Not found')));
            return;
        }

        $purchase_id = $record['entity_id'];

        

        $flow_list = $this->purchase_flow_model->get_purchase_flow($purchase_id);
        
        for ($i=0; $i < count($flow_list); $i++) {
             
            $flow_id = $flow_list[$i]['id'];
            
            $flow_list[$i]['from'] = $this->users->get_full_name($flow_list[$i]['from'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['from'])).")";
            $flow_list[$i]['to'] = $this->users->get_full_name($flow_list[$i]['to'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['to'])).")";
            $flow_list[$i]['attachments'] = $this->purchase_flow_model->get_purchase_attachments($flow_id);
            $flow_list[$i]['status_type'] = $this->purchase_flow_model->get_flow_type_name($flow_list[$i]['status_type']);
            
        }
            
            $is_readonly = $this->notification_model->is_readonly($id);
            $user_id = $this->session->userdata('id');
            $role_id = $this->users->get_role_by_id($user_id);

            $page_data = array(
            "purchase_id"=>$purchase_id,    
            "current_flow"=>$id,
            "is_readonly"=>$is_readonly,
            "flow_history"=>$flow_list,
            "mode"=>"process",
            "flow_list"=>$this->purchase_flow_model->get_purchase_flow_structure(),
            "can_approve"=>$this->can_user_approve(),
            "purchase_list"=>$this->purchase_model->get_purchase_list(array('purchase_status'=>9)),
            "flow_list"=>$this->bill_process_model->get_bill_process_flow_structure(),
            "initial_step"=>false,
            "final_stage"=>$this->bill_process_model->get_final_destination(),
            "check_issued"=>$this->purchase_flow_model->check_issued($purchase_id),
            "check_issuer"=>$this->bill_process_model->is_check_issuer($role_id)

            );

           ////$this->print_a($this->purchase_flow_model->get_initiator($purchase_id)); 
        
        if($is_readonly){
            $this->notification_model->mark_processed($id);
        }   
        

        $this->generate_page("Bill Process :: Bill info",
                array('bill_process'=>$page_data));    

        
    }

    public function can_user_approve(){
        $this->load->model('users');
        $this -> load -> model('bill_process_model');
            
        $user_id = $this->session->userdata('id');
        $role_id = $this->users->get_role_by_id($user_id);
        
        return $this->bill_process_model->can_role_approve($role_id);
        
        
    }
    
    private function upload_files($field_name) {
        $list = array();
        $this->load->library('upload');
        $files = $_FILES;
        if(!isset($_FILES[$field_name])){
            return $list;
        }
        $cpt = count($_FILES[$field_name]['name']);
        for($i=0; $i<$cpt; $i++)
        {

            $_FILES[$field_name]['name']= $files[$field_name]['name'][$i];
            $_FILES[$field_name]['type']= $files[$field_name]['type'][$i];
            $_FILES[$field_name]['tmp_name']= $files[$field_name]['tmp_name'][$i];
            $_FILES[$field_name]['error']= $files[$field_name]['error'][$i];
            $_FILES[$field_name]['size']= $files[$field_name]['size'][$i];    



        $this->upload->initialize($this->set_upload_options());
        if (!$this->upload->do_upload($field_name))
        {
            //$errors = $this->upload->display_errors();
            //flashMsg($errors);
            //print_r($errors);
        }
        else
        {
            $data = $this->upload->data();
            $list[] = $data['file_name'];
        }
        }

        $_FILES = $files;

        return $list;

    }

    private function set_upload_options()
    {   
    //  upload an image options
        $config = array();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf';
        $config['max_size'] = '2048';
        $config['overwrite']     = FALSE;
        return $config;
    }

    private function generate_page($title, $pdata, $page='purchase'){
        $this->load->library('pagebuilder');
        $this->pagebuilder->generate_page($title, $pdata, $page);    
    }
    
}
