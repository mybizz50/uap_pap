<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribution extends CI_Controller {

  
     function __construct() {
        parent::__construct();
        if ($this -> session -> userdata('logged_in') == FALSE) {
            redirect('/user','refresh');
        }

        $this -> load -> model('users');
        $access = $this->users->get_role_defination($this -> session -> userdata('role'));
        if(empty($access['stock_mod_access'])){
            redirect('/page/page_not_found', 'refresh');    
        }

        if($this -> session -> userdata('registration_completed')==0){
         redirect('/user/complete_registration', 'refresh');   
        }
    }

    public function index() {
        
		$this->generate_page("Distribution :: home", array('purchase_widgets'=>''));
    }
    
    public function get_stock_list(){
        $this -> load -> model('stock_model');
        return $this->stock_model->get_stock_list();
    }
    
    public function get_dept(){
        $this -> load -> model('department');
        return $this->department->get_departments();
    }
    
    public function get_supplier(){
        $this -> load -> model('supplier');
        return $this->supplier->get_supplier();
    }
    
    public function get_category(){
        $this -> load -> model('stock_category');
        return $this->stock_category->get_stock_category();
    }
    
    
    public function entry($mode='automated'){
        if($mode!='insert'){
            $form_data = array(
                'input_type'=>$mode=='manual' ? 2:1,
                'stocks'=>$this->get_stock_list(),
                'depts'=>$this->get_dept()
            );
        $this->generate_page("Distribution :: entry", array('distribution_entry_form'=>$form_data));
        }else{
            $this -> load -> model('stock_model');
            $this -> load -> model('distribution_model');
            $this->load->model('stock_category');
            $this->load->model('department');
             
            if($this->stock_model->deduct_stock($this->input->post('stock_id'),$this->input->post('distributed_quantity')) && $this->distribution_model->add_distribution()){
                $this->load->model('activity_log');

                $name = $this->users->get_full_name($this -> session -> userdata('id'));
                $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
                $dept = $this->department->get_dept_name($this->input->post('distributed_to'));
                
                $action =   "distributed"; 
                $item_name = $this->stock_model->get_stock_name($this->input->post('stock_id'));
                //echo "item name ".$this->input->post('stock_id');
                $item_n = $this->input->post('distributed_quantity');

                $log_info = array(
                "activity_type"=>36,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) $action $item_n $item_name (s) to $dept)"
                ); 
               $this->activity_log->add_log($log_info);
                
                $this->show_notification('success', 'Stock distributed successfully');
            }else{
                $this->show_notification('danger', 'Something went wrong ! Stock not distributed');
            }
        }
    }

    public function stock_details(){
        $this->output->set_header( 'Access-Control-Allow-Origin: *' );
        $this->output->set_header( "Access-Control-Allow-Methods: POST" );
        $this->output->set_header( 'Access-Control-Allow-Headers: content-type' );
        $this->output->set_content_type( 'application/json' );
        if(!isset($_POST['stock_id'])){
            $json = array('status'=>0,'msg'=>'Invalid id');
        }else{
            $this -> load -> model('stock_model');
            $data = $this->stock_model->get_stock_details($_POST['stock_id']);
            $json = array('status'=>1,'data'=>$data);
        }
        echo json_encode($json);
    }

    public function show_notification($type,$msg){
    
        $this->generate_page("Distribution :: ".$type, array('alerts'=>array('type'=>$type,'msg'=>$msg)));
    }
    
    public function distribution_log($id=null){
        
        $this -> load -> model('purchase_model');
        $this -> load -> model('distribution_model');
        $list = $this->distribution_model->get_distribution_list($id);
        $newlist = array();
        foreach($list as $elem){
            $arr['stock_name']=$this->get_stock_name($elem['stock_id']);
            $arr['distributed_to'] = $this->get_dept_name($elem['distributed_to']);
            $arr['distributed_quantity'] = $elem['distributed_quantity'];
            $arr['date_distributed'] = $elem['date_distributed'];
            
           $newlist[]=$arr; 
        }
        
        
		
		$this->generate_page("Distribution :: log", array('distribution_log'=>array('list'=>$newlist)));
     
    }
    
    
    public function get_cat_name($id){
        $this -> load -> model('stock_category');
        $cat = $this->stock_category->get_category_details($id);
        return $cat ? $cat['name']:'Undefined';
    }

    public function get_dept_name($id){
        $this -> load -> model('department');
        $dept = $this->department->get_dept_details($id);
        return $dept ? $dept['ds_name']:'Undefined';
    }

    public function get_stock_name($id){
        
        $this -> load -> model('stock_model');
        $item = $this->stock_model->get_stock_details($id);
        return $item['stock_title'];
    }
    
    private function generate_page($title, $pdata, $page='purchase'){
        $this->load->library('pagebuilder');
        $this->pagebuilder->generate_page($title, $pdata, $page);    
    }

    
 
}
