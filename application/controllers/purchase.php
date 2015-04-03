<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    private $fields_for_attachment = array("file_name", "no_of_quotation", "comperetive_statement", "quotation_justification", "recommended_supplier");

    private $replace_item_fields = array("present_status", "recommendation", "inspector_name", "inspector_designation", "inspection_date");
    private $fields_for_cat_3 = array();

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
            $this->generate_page("Purchase :: Home", array('current_process_list'=>''));
        
    }

    public function category($cat = 1, $type = '') {
        $this -> load -> model('purchase_model');
		$this -> load -> model('department');
        $ret = $this -> purchase_model -> getDept($this -> session -> userdata('id'));
        $form_data = array(
        	"purchase_cat" => $this -> purchase_model -> getPurchaseInfo($cat), 
        	"recommendations" => $this -> purchase_model -> getRecommendations(), 
        	"item_cats" => $this -> purchase_model -> getStockCategories(), 
        	"p_types" => $this -> purchase_model -> getPurchaseTypes(), 
        	"deptList" => $this->department->get_active_departments()
		);
        $this->generate_page('Purchase :: ' . $form_data['purchase_cat']['name'], array('purchase_form'=>$form_data));
    }

    public function pop_array(array &$array, $key) {
        if (array_key_exists($key, $array)) {
            $b = $array[$key];
            unset($array[$key]);
            return $b;
        }

        return null;
    }
    
    
    public function notifications(){
        $this -> load -> model('purchase_model');
        $ret = $this->purchase_model->getNotifications();
        $this->generate_page("Purchase :: Notifications", array('notification_list'=>array('listItems'=>$this->purchase_model->getNotifications())));
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
    
    
    
    public function quotation_details($id){
       $this -> load -> model('purchase_model');
       $this->generate_page("Purchase :: Quatation details", array('quotation_details'=>$this->purchase_model->get_quotation_details($id))); 
    }

    public function get_purchase($id){
        $this -> load -> model('purchase_model');
        $this->generate_page("Purchase :: Details", array('purchase_details'=>$this->purchase_model->get_purchase_info($id)));
    }
    
    public function process_notification(){
        
        //print_r($this->input->post()); 
        $id = $this->input->post('id');   
        $this -> load -> model('purchase_model');
        
        $this->purchase_model->process_notification($id);
        
                $this->load->model('activity_log');
                $this->load->model('department');

                $name_1 = $this->users->get_full_name($this -> session -> userdata('id'));
                $role_1= $this->users->get_role_name($this -> session -> userdata('role'));



                
                $action =   ""; 
                $activity_type = "";
                $t_id = "";


                if($this->input->post('status')==5){
                    $action =   "forwarded "; 
                    $activity_type = 2;
                    $t_id = $this->input->post('forward_id');
                }else if($this->input->post('status')==6){
                    $action =   "backward "; 
                    $activity_type = 3;
                    $t_id = $this->input->post('return_id');
                }else if($this->input->post('status')==3){
                    $action =   "completed "; 
                    $activity_type = 4;

                }

                $purchase_name = $this->purchase_model->get_purcase_name($this->input->post('purchase_id'));

                if(!empty($t_id)){
                    $name_2 = $this->users->get_full_name($t_id);
                    $role_2= $this->users->get_role_name($this->users->get_role_by_id($t_id));
                    $log_info = array(
                        "activity_type"=>$activity_type,
                        "executor"=>$this->session->userdata('id'),
                        "executed_to"=>$t_id,
                        "description"=>"$name_1($role_1) $action a purchase($purchase_name) to $name_2($role_2)"
                    );
                }else{
                    $log_info = array(
                        "activity_type"=>$activity_type,
                        "executor"=>$this->session->userdata('id'),
                        "executed_to"=>'',
                        "description"=>"$name_1($role_1) $action a purchase($purchase_name)"
                    );

                }

                

                 
               $this->activity_log->add_log($log_info);
                

        $this->generate_page("Purchase :: Status", array('alerts'=> array('type'=>'success','msg'=>'Your action is successfully completed')));
        
    }

    public function purchase_list($purchase_status = 0){
        $user = $this -> session -> userdata('id');
        $this -> load -> model('purchase_flow_model');
        $this -> load -> model('purchase_model');
        
        $processed_purchase = $this->purchase_flow_model->get_purchase_list($user);
        $processList = array();
        foreach($processed_purchase as $a){
                $temp_1 = $this->purchase_model->get_purchase_details($a['purchase_id']);
                $processList[]=$temp_1;
        }

        //$this->print_a($processList);

        $this->generate_page("Purchase :: Status log",array('process_list'=>array('process'=>$processList)));
    }

     function initiate_purchase(){
        if(!isset($_POST['submit'])){
            $this->category();
            return;
        }
		
		
		$this -> load -> model('purchase_model');
        $this->load->model('users');
        //$this->purchase_model->insert_purchase_data();
        $this->load->model('activity_log');
        $this->load->model('notification_model');
        $this->load->model('purchase_flow_model');
        $purchase_info = array(
                "advance_amount"=>$this->input->post('advance_amount'),
                "advance_in_favour_of"=>$this->input->post('advance_in_favour_of'),
                "justification"=>$this->input->post('justification'),
                "budget_head"=>$this->input->post('budget_head'),
                "provision_amount"=>$this->input->post('provision_amount'),
                "adjusted_budget_if_not"=>$this->input->post('adjusted_budget_if_not'),
                "required_advance_date"=>date("Y-m-d", strtotime($this->input->post('required_advance_date')) ),
                "advance_settle_date"=>date("Y-m-d", strtotime($this->input->post('advance_settle_date')) ),
                "specification"=>$this->input->post('specification'),
                "payment_mode"=>$this->input->post('payment_method'),
                "created_date"=>date("Y-m-d", strtotime('today')),
                "ds_id"=>$this->input->post('ds_id'),
                "created_by"=>$this->session->userdata('id')
            );

        $purchase_id = $this->purchase_model->insert_to_purchasing($purchase_info);
        if($purchase_id){
            $flow_info =  array(
                    "purchase_id"=>$purchase_id,
                    "from"=>$this->session->userdata('id'),
                    "to"=>$this->session->userdata('id'),
                    "subject"=>"Purchase initiated",
                    "message"=>$this->input->post('justification'),
                    "status_type"=>1
                );

            $flow_id = $this->purchase_model->insert_to_log($flow_info);

            $attachment_quotation = $this->upload_files('attachment-quotation');
            $attachment_comparative_statement = $this->upload_files('attachment-comparative-statement');

            for($i=0; $i<count($attachment_quotation);$i++){
                $this->purchase_model->insert_to_purchase_attachment(array(
                    "purchase_id"=>$purchase_id,
                    "file_name"=>$attachment_quotation[$i],
                    "type"=>"quotation"
                    ));
            }

            for($i=0; $i<count($attachment_comparative_statement);$i++){
                $this->purchase_model->insert_to_purchase_attachment(array(
                    "purchase_id"=>$purchase_id,
                    "file_name"=>$attachment_comparative_statement[$i],
                    "type"=>"cs"
                    ));
            }
            
            $items = $this->input->post('item');
           // print_r($items);
            foreach ($items as $item) {
                $item["purchase_id"]=$purchase_id;
                $item["date-purchase-non-functional"]=date("Y-m-d",strtotime($item["date-purchase-non-functional"] | "today"));
                $item["date-last-purchase"]=date("Y-m-d",strtotime($item["date-last-purchase"] | "today"));
                $this->purchase_model->insert_to_purchase_item_info($item);                
            }

        }


        $notification_info = array(
                "from"=>$this -> session -> userdata('id'),
                "to"=>$this -> session -> userdata('id'),
                "origin_module"=>"purchase",
                "relation"=>"purchasing",
                "action"=>1,
                "entity_id"=>$purchase_id,
                "date"=>strtotime("now")
            );

        $this->notification_model->add_notification($notification_info);

        $name = $this->users->get_full_name($this -> session -> userdata('id'));
        $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
        

        $action =   "initiated purchase"; 
        
        $log_info = array(
        "activity_type"=>1,
        "executor"=>$this->session->userdata('id'),
        "executed_to"=>'',
        "description"=>"$name($role_1) $action. Id #".$purchase_id
        ); 
       $this->activity_log->add_log($log_info);
        

        $this->generate_page("Purchase :: Initialized", array('alerts'=>array('type'=>'success','msg'=>'Purchase initialized')));
    }


    public function view_report($purchase_id=''){
        $this -> load -> model('purchase_model');
        $this -> load -> model('purchase_flow_model');

        
        if(empty($purchase_id) || count($temp_1 = $this->purchase_model->get_purchase_details($purchase_id))==0){
        $this->generate_page("Purchase :: Status", array('alerts'=> array('type'=>'error','msg'=>'Invalid Id')));
        return;    
        }

        $log_list = $this->purchase_flow_model->purchase_log($purchase_id);
        $log = array();
        foreach($log_list as $a){
            $x['time'] = $a['date'];
            $x['assigned_by'] = $this->purchase_model->get_user_name($a['from'])." (".$this->purchase_model->get_role_name_by_user_id($a['from']).")";
            $x['assigned_to'] = $this->purchase_model->get_user_name($a['to'])." (".$this->purchase_model->get_role_name_by_user_id($a['to']).")";
            $x['comments'] = $a['message'];
            $x['action'] = $this->purchase_flow_model->get_status_details($a['status_type']);
            $log[]=$x;
        }
        

        $this->generate_page("Purchase :: Purchase status",array('purchase_log_list'=>array('purchase_log_list'=>$log,'title'=>"Purchase Id #".$purchase_id, )));           
    }


    public function current_process($mode,$id){
        if($mode=='process'){
            $this->process_current_process($id);
        }else{
            $this->show_details($id);
        }
    }

    public function process_current_process($id){
        $this->load->model('purchase_flow_model');
        $this->load->model('notification_model');
        $this->load->model('purchase_model');
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

        $purchase_record = $this->purchase_model->get_purchase_details($purchase_id);

        $purchase_info = array(
                "id"=>$purchase_record['id'],
                "advance_amount"=>$purchase_record['advance_amount'],
                "advance_in_favour_of"=>$purchase_record['advance_in_favour_of'],
                "justification"=>$purchase_record['justification'],
                "budget_head"=>$purchase_record['budget_head'],
                "provision_amount"=>$purchase_record['provision_amount'],
                "adjusted_budget_if_not"=>$purchase_record['adjusted_budget_if_not'],
                "required_advance_date"=>$purchase_record['required_advance_date'],
                "advance_settle_date"=>$purchase_record['advance_settle_date'],
                "specification"=>$purchase_record['specification'],
                "payment_mode"=>$purchase_record['payment_mode'] ? "Cheque":"Cash",
                "created_date"=>$purchase_record['created_date'],
                "ds_id"=>$this->department->get_dept_name($purchase_record['ds_id']),
                "is_final_step"=>$this->purchase_flow_model->get_final_destination() == $this->session->userdata('id') ? true : false,
                "purchase_status"=>$purchase_record['purchase_status']
            );

        //$this->print_a($purchase_info);

        $temp = $this->purchase_model->get_purchase_item_list($purchase_id);
        $item_list = array();
        $item_type = array("New","Replacement");
        foreach ($temp as $item) {
            $item['item_cat'] = $this->stock_category->get_category_name($item['item_cat']);
            $item['item_type']=$item_type[$item['item_type']-1]; 
            $item_list[]=$item;
        }


        $attachment_list = $this->purchase_model->get_attachment_list($purchase_id);
		$flow_list = $this->purchase_flow_model->get_purchase_flow($purchase_id);
		
		for ($i=0; $i < count($flow_list); $i++) {
			 
			$flow_id = $flow_list[$i]['id'];
			
			$flow_list[$i]['from'] = $this->users->get_full_name($flow_list[$i]['from'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['from'])).")";
        	$flow_list[$i]['to'] = $this->users->get_full_name($flow_list[$i]['to'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['to'])).")";
			$flow_list[$i]['attachments'] = $this->purchase_flow_model->get_purchase_attachments($flow_id);
			$flow_list[$i]['status_type'] = $this->purchase_flow_model->get_flow_type_name($flow_list[$i]['status_type']);
			
		}
			
			$is_readonly = $this->notification_model->is_readonly($id);
		  
            $page_data = array(
            "purchase_info"=>$purchase_info,
            "items"=>$item_list,
            "attachments"=>$attachment_list,
            "current_flow"=>$id,
            "step"=>'',
            "is_readonly"=>$is_readonly,
            "actions"=>$flow_list,
            "mode"=>"process",
            "flow_list"=>$this->purchase_flow_model->get_purchase_flow_structure(),
            "can_approve"=>$this->can_user_approve(),
            "forward_list"=>array(),
            "back_list"=>array(),
            "current_action"=>$this->notification_model->get_current_action($id),
            "forward_id"=>$this->purchase_flow_model->get_initiator($purchase_id)
            );

           ////$this->print_a($this->purchase_flow_model->get_initiator($purchase_id)); 
		
		if($is_readonly){
			$this->notification_model->mark_processed($id);
		}	
			

        $this->generate_page("Purchase :: process purchase",
                array('purchase_details_2'=>$page_data));
    }

	public function can_user_approve(){
		$this->load->model('users');
		$this->load->model('purchase_flow_model');
			
		$user_id = $this->session->userdata('id');
		$role_id = $this->users->get_role_by_id($user_id);
		
		return $this->purchase_flow_model->can_role_approve($role_id);
		
		
	}
	
	
	

    public function next_proecss(){
        $this->load->model('purchase_flow_model');
        $this->load->model('notification_model');
        $this->load->model('purchase_model');
        $this->load->model('role');
        $this->load->model('users');
        $this->load->model('department');
        $this->load->model('stock_category');
        $this->load->model('activity_log');

		
		     
		$data= $this->input->post();
		$process_action = $this->input->post('process_action');
		
        if($process_action=='issue_work_order'){
               $data['forward_id'] =  $this->purchase_flow_model->get_appo1();
        }
		
		$flow_data = array(
			"purchase_id"=>$data['purchase_id'],
			"from"=>$this->session->userdata('id'),
			"to"=>$data['forward_id'],
			"subject"=>" ",
			"message"=>$data['comments'],
			"status_type"=>5,
			
		);


		
		$notification_info = array(
                "from"=>$this->session->userdata('id'),
                "to"=>$data['forward_id'],
                "origin_module"=>"purchase",
                "relation"=>"purchasing",
                "action"=>5,
                "entity_id"=>$data['purchase_id'],
                "date"=>strtotime("now")
            );


			
		$action =   "forwarded"; 
        $purchase_id = $data['purchase_id'];
		$name = $this->users->get_full_name($this -> session -> userdata('id'));
        $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
		
		$name_2 = $this->users->get_full_name($data['forward_id']);
        $role_2= $this->users->get_role_name($this->users->get_role_by_id($data['forward_id']));
		
        $log_info = array(
	        "activity_type"=>2,
	        "executor"=>$this->session->userdata('id'),
	        "executed_to"=>$data['forward_id'],
	        "description"=>"$name($role_1) $action. purchase Id#$purchase_id to $name_2($role_2)"
	    );
		
		
		
		
		
		if($process_action=='reject'){
			$to = $this->purchase_flow_model->get_initiator($purchase_id);
			$flow_data["status_type"]=2;
			$flow_data['to']=$to;
			
			$notification_info['action']=2;
			$notification_info['to']=$to;
			$notification_info['is_readonly']=1;
			
			$name_2 = $this->users->get_full_name($to);
        	$role_2= $this->users->get_role_name($this->users->get_role_by_id($to));
			
			$log_info['activity_type']=5;
			$log_info['executed_to']='';
			$log_info['description']="$name($role_1) rejected purchase Id#$purchase_id";
		}

		if($process_action=='approve'){
			$to = $this->purchase_flow_model->get_final_destination();
			$flow_data["status_type"]=7;
			$flow_data['to']=$to;
			
			$notification_info['action']=7;
			$notification_info['to']=$to;
			$notification_info['is_readonly']=0;
			
			$name_2 = $this->users->get_full_name($to);
        	$role_2= $this->users->get_role_name($this->users->get_role_by_id($to));
			
			$log_info['activity_type']=4;
			$log_info['executed_to']=$to;
			$log_info['description']="$name($role_1) approved purchase Id#$purchase_id and sent to $role_2 to issue work order";
		}

        if($process_action=='issue_work_order'){
            $to = $this->purchase_flow_model->get_appo1();
            $flow_data["status_type"]=8;
            $flow_data['to']=$to;
            
            $notification_info['action']=8;
            $notification_info['to']=$to;
            $notification_info['is_readonly']=0;
            
            $name_2 = $this->users->get_full_name($to);
            $role_2= $this->users->get_role_name($this->users->get_role_by_id($to));
            
            $log_info['activity_type']=45;
            $log_info['executed_to']=$to;
            $log_info['description']="$name($role_1) forwarded purchase Id#$purchase_id to $role_2 to issue work order";
        }

        if($process_action=='work_order_issued'){
            $to = $this->purchase_flow_model->get_initiator($purchase_id);
            $flow_data["status_type"]=9;
            $flow_data['to']=$to;
            
            $notification_info['action']=9;
            $notification_info['to']=$to;
            $notification_info['is_readonly']=1;
            
            $name_2 = $this->users->get_full_name($to);
            $role_2= $this->users->get_role_name($this->users->get_role_by_id($to));
            
            $log_info['activity_type']=45;
            $log_info['executed_to']=$to;
            $log_info['description']="Work order for purchase Id#$purchase_id is issued by $name($role_1)";
        }

        $files = $this->upload_files('attachments');
        
		$flow_id = $this->purchase_flow_model->insert_flow($flow_data);
		
	   
        for($i=0; $i<count($files);$i++){
            $this->purchase_flow_model->insert_attachment(array(
                "flow_id"=>$flow_id,
                "file_name"=>$files[$i]
                ));
        }
		
		$this->notification_model->add_notification($notification_info);
		
		if($process_action=='approve'){
			$notification_info['action']=7;
			$notification_info['to']=$this->purchase_flow_model->get_initiator($purchase_id);
			$notification_info['is_readonly']=1;
			$this->notification_model->add_notification($notification_info);
		}
	
        
		
		$this->notification_model->mark_processed($this->input->post('current_flow'));

        
        

         
       $this->activity_log->add_log($log_info);
        
		
		if($process_action=='reject'){
			$this->purchase_model->change_purchase_status($purchase_id, 2);
			$this->generate_page("Purchase :: Success", array('alerts'=>array('type'=>'success','msg'=>"Purchase rejected. Notification sent to $name_2($role_2)")));
		}if($process_action=='approve'){
			$this->purchase_model->change_purchase_status($purchase_id, 3);
			$this->generate_page("Purchase :: Success", array('alerts'=>array('type'=>'success','msg'=>"Purchase approved. Notification sent to $name_2($role_2)")));
		}if($process_action=='work_order_issued'){
            $this->purchase_model->change_purchase_status($purchase_id, 9);
            $this->generate_page("Purchase :: Success", array('alerts'=>array('type'=>'success','msg'=>"Purchase status changed to work order issued")));
        }else{
			$this->generate_page("Purchase :: Success", array('alerts'=>array('type'=>'success','msg'=>"Purchase forwarded to $name_2($role_2)")));	
		}
        
    }

    public function show_details($id){
        $this->load->model('purchase_flow_model');
        $this->load->model('notification_model');
        $this->load->model('purchase_model');
        $this->load->model('role');
        $this->load->model('users');
        $this->load->model('department');
        $this->load->model('stock_category');


        $purchase_id = $id;

        $purchase_record = $this->purchase_model->get_purchase_details($purchase_id);

        $purchase_info = array(
                "id"=>$purchase_record['id'],
                "advance_amount"=>$purchase_record['advance_amount'],
                "advance_in_favour_of"=>$purchase_record['advance_in_favour_of'],
                "justification"=>$purchase_record['justification'],
                "budget_head"=>$purchase_record['budget_head'],
                "provision_amount"=>$purchase_record['provision_amount'],
                "adjusted_budget_if_not"=>$purchase_record['adjusted_budget_if_not'],
                "required_advance_date"=>$purchase_record['required_advance_date'],
                "advance_settle_date"=>$purchase_record['advance_settle_date'],
                "specification"=>$purchase_record['specification'],
                "payment_mode"=>$purchase_record['payment_mode'] ? "Cheque":"Cash",
                "created_date"=>$purchase_record['created_date'],
                "ds_id"=>$this->department->get_dept_name($purchase_record['ds_id']),
                "is_final_step"=>$this->purchase_flow_model->get_final_destination() == $this->session->userdata('id') ? true : false,
                "purchase_status"=>$purchase_record['purchase_status']
            );

        //$this->print_a($purchase_info);

        $temp = $this->purchase_model->get_purchase_item_list($purchase_id);
        $item_list = array();
        $item_type = array("New","Replacement");
        foreach ($temp as $item) {
            $item['item_cat'] = $this->stock_category->get_category_name($item['item_cat']);
            $item['item_type']=$item_type[$item['item_type']-1]; 
            $item_list[]=$item;
        }


        $attachment_list = $this->purchase_model->get_attachment_list($purchase_id);
        $flow_list = $this->purchase_flow_model->get_purchase_flow($purchase_id);
        
        for ($i=0; $i < count($flow_list); $i++) {
             
            $flow_id = $flow_list[$i]['id'];
            
            $flow_list[$i]['from'] = $this->users->get_full_name($flow_list[$i]['from'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['from'])).")";
            $flow_list[$i]['to'] = $this->users->get_full_name($flow_list[$i]['to'])."(".$this->users->get_role_name($this->users->get_role_by_id($flow_list[$i]['to'])).")";
            $flow_list[$i]['attachments'] = $this->purchase_flow_model->get_purchase_attachments($flow_id);
            $flow_list[$i]['status_type'] = $this->purchase_flow_model->get_flow_type_name($flow_list[$i]['status_type']);
            
        }
            
            
            $page_data = array(
            "purchase_info"=>$purchase_info,
            "items"=>$item_list,
            "attachments"=>$attachment_list,
            "current_flow"=>$id,
            "step"=>'',
            "is_readonly"=>true,
            "actions"=>$flow_list,
            "mode"=>"process",
            "flow_list"=>$this->purchase_flow_model->get_purchase_flow_structure(),
            "can_approve"=>$this->can_user_approve(),
            "forward_list"=>array(),
            "back_list"=>array(),
            "current_action"=>$this->notification_model->get_current_action($id),
            "forward_id"=>$this->purchase_flow_model->get_initiator($purchase_id)
            );


        $this->generate_page("Purchase :: process purchase",
                array('purchase_details_2'=>$page_data));
    }

    private function print_a($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        
    }

    private function generate_page($title, $pdata, $page='purchase'){
        $this->load->library('pagebuilder');
        $this->pagebuilder->generate_page($title, $pdata, $page);    
    }

}
