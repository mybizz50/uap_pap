<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct() {
		parent::__construct();
		if ($this -> session -> userdata('logged_in') == FALSE) {
			redirect('/user', 'refresh');
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
		$this->generate_page("Stock :: Home", array('current_process_list'=>''));
	}

	public function get_purchase_list() {
		$this -> load -> model('purchase_model');
		return $this -> purchase_model -> get_completed_purchase_list();
	}

	public function get_dept() {
		$this -> load -> model('department');
		return $this -> department -> get_departments();
	}

	public function get_supplier() {
		$this -> load -> model('supplier');
		return $this -> supplier -> get_supplier();
	}

	public function get_category() {
		$this -> load -> model('stock_category');
		return $this -> stock_category -> get_stock_category();
	}

	public function entry($mode = 'automated') {
		if ($mode != 'insert') {
			
			$form_data = array('input_type' => $mode == 'manual' ? 2 : 1, 'categories' => $this -> get_category(), 'purchases' => $this -> get_purchase_list(), 'departments' => $this -> get_dept(), 'suppliers' => $this -> get_supplier());

			$this->generate_page("Stock :: entry", array('stock_entry_form'=>$form_data));
			
		} else {
			$this -> load -> model('stock_model');
			if ($this -> stock_model -> add_stock()) {
				
				$this->load->model('activity_log');
				$this->load->model('purchase_model');


                $name = $this->users->get_full_name($this -> session -> userdata('id'));
                $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
                
                $stock = $this->purchase_model->get_purcase_name($this->input->post('purchase_id'));
                
                $action =   "entered"; 
                //$item_name = $this->stock_model->get_stock_name($this->input->post('stock_id'));
                //echo "item name ".$this->input->post('stock_id');
                $item_n = $this->input->post('available_quantity');

                $log_info = array(
                "activity_type"=>6,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) $action $item_n items ($stock) in stock"
                ); 
               $this->activity_log->add_log($log_info);

				$this -> show_notification('success', 'Stock added successfully');
			} else {
				$this -> show_notification('danger', 'Something went wrong ! Stock not added');
			}
		}
	} 

	public function purchase_detail() {
		$this -> output -> set_header('Access-Control-Allow-Origin: *');
		$this -> output -> set_header("Access-Control-Allow-Methods: POST");
		$this -> output -> set_header('Access-Control-Allow-Headers: content-type');
		$this -> output -> set_content_type('application/json');
		if (!isset($_POST['purchase_id'])) {
			$json = array('status' => 0, 'msg' => 'Invalid id');
		} else {
			$this -> load -> model('purchase_model');
			$data = $this -> purchase_model -> get_purchase_details($_POST['purchase_id']);
			$purchase_info = array("purchase_id" => $data['id'], "item_name" => $data['item_name'], "quantity" => $data['total_quantity'], "cat" => $this -> get_cat_name($data['item_category']), "dept" => $this -> get_dept_name($data['ds_id']), "date_initiated" => $data['created_date'], "stock_title" => "#" . $data['id'] . " " . $data['item_name'] . " (" . $data['created_date'] . ")");
			$json = array('status' => 1, 'data' => $purchase_info);
		}
		echo json_encode($json);
	}

	public function show_notification($type, $msg) {
		
		$this->generate_page("Stock :: ".$type, array('alerts'=>array('type' => $type, 'msg' => $msg)));	
	}

	public function stock_list() {
		$this -> load -> model('purchase_model');
		$this -> load -> model('stock_model');
		$list = $this -> stock_model -> get_stock_list();
		$newlist = array();
		foreach ($list as $elem) {
			$data = $this -> purchase_model -> get_purchase_details($elem['purchase_id']);
			
			$arr['id'] = $elem['id'];
			$arr['product_name'] = $this -> get_product_name($elem['purchase_id']);
			$arr['category_name'] = $this -> get_cat_name($data['item_category']);
			$arr['entry_date'] = $elem['entry_date'];
			$arr['quantity'] = $elem['total_quantity'];
			$arr['available_quantity'] = $elem['available_quantity'];

			$newlist[] = $arr;
		}
			$this->generate_page("Stock :: List", array('stock_list'=>array('list' => $newlist)));	
		
		
		

	}

	public function stock_report($mode=''){
		$this -> load -> model('purchase_model');
		$this -> load -> model('stock_model');
		$list = $this -> stock_model -> get_stock_list();
		$newlist = array();
		foreach ($list as $elem) {
			$data = $this -> purchase_model -> get_purchase_details($elem['purchase_id']);
			
			$arr['id'] = $elem['id'];
			$arr['product_name'] = $this -> get_product_name($elem['purchase_id']);
			$arr['category_name'] = $this -> get_cat_name($data['item_category']);
			$arr['entry_date'] = $elem['entry_date'];
			$arr['quantity'] = $elem['total_quantity'];
			$arr['available_quantity'] = $elem['available_quantity'];

			$newlist[] = $arr;
		}

		if($mode=='export'){
			$this -> load -> library('Excel',array('stock_report.xls'));
            if ($this->excel == false)
                echo $excel -> error;
            for($i=0;$i<count($newlist);$i++){
                if($i==0){
                    $keyArr = array();
                    foreach($newlist[$i] as $key=>$value){
                        $keyArr[]=$key;
                    }
                    $this->excel -> writeLine($keyArr);
                }
                $this->excel -> writeRow();
                foreach($newlist[$i] as $key=>$value){
                        $this->excel -> writeCol($value);
                    }
            }        
            
            $this->excel -> close();
            
            header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
            header("Content-Disposition: inline; filename=\"" . "stock_report_".date('Y-m-d_H:i:s') . ".xls\"");
            readfile('stock_report.xls');
            unlink('stock_report.xls');
		}else{
			$this->generate_page("Stock :: List", array('stock_report'=>array('list' => $newlist)));	
		}
	}

	public function get_cat_name($id) {
		$this -> load -> model('stock_category');
		$cat = $this -> stock_category -> get_category_details($id);
		return $cat ? $cat['name'] : 'Undefined';
	}

	public function get_dept_name($id) {
		$this -> load -> model('department');
		$dept = $this -> department -> get_dept_details($id);
		return $dept ? $dept['ds_name'] : 'Undefined';
	}

	public function get_product_name($id) {

		$this -> load -> model('purchase_model');
		$item = $this -> purchase_model -> get_purchase_details($id);
		return '#' . $item['id'] . " " . $item['item_name'];
	}

	private function generate_page($title, $pdata, $page='purchase'){
        $this->load->library('pagebuilder');
        $this->pagebuilder->generate_page($title, $pdata, $page);    
    }
}
