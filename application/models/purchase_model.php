<?php
class Purchase_model extends CI_Model {
          
             
    private $last_purchase_id;
    private $last_log_id = 0;
    
    function __construct() {
        parent::__construct();
    }

    public function getPurchaseTypes() {
        $query = $this -> db -> get('purchase_type');
        return $query -> result_array();
    }

    public function getPurchaseTypeName($id) {
        $query = $this -> db -> get_where('purchase_type', array('id' => $id));
        $ret = $query -> result_array();
        return count($ret)?$ret[0]['name']:FALSE;
    }

    public function getStockCategories() {
        $query = $this -> db -> get_where('stock_category', array('stock_category_status' => 1));
        return $query -> result_array();
    }

    public function getStockCategory($id) {
        $query = $this -> db -> get_where('stock_category', array('id' => $id));
        $ret = $query -> result_array();
        return $ret[0]['name'];
    }

    public function getRecommendations() {
        $query = $this -> db -> get('recommendation_maintenance');
        $ret = $query -> result_array();
        return $ret;
    }

    public function getDept($id, $id_only = false) {
        $this -> db -> select('*');
        $this -> db -> from('user_profile');
        $this -> db -> where(array('user_id' => $id));
        $this -> db -> join('DepartmentSection', 'DepartmentSection.id = user_profile.department');
        $query = $this -> db -> get();
        $ret = $query -> result_array();
		
        return $ret? ($id_only ? $ret[0]['id'] : $ret[0]):null;
    }

    public function getDeptName($id) {
        $query = $this -> db -> get_where('DepartmentSection', array('id' => $id));
        $ret = $query -> result_array();
        return $ret[0]['ds_name'];
    }

    public function getPurchaseInfo($id) {
        $query = $this -> db -> get_where('purchase_category', array('id' => $id));
        $ret = $query -> result_array();
        return count($ret)?$ret[0]:null;
    }

    public function pop_array(array &$array, $key) {
        if (array_key_exists($key, $array)) {
            $b = $array[$key];
            unset($array[$key]);
            return $b;
        }

        return null;
    }

    private function upload_files($purchase_id=null) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf';
        $config['max_size'] = '2048';
        $file_name = empty($purchase_id)?$this->last_purchase_id:$purchase_id . "_" . $this -> session -> userdata('id') . "_" . $_FILES['file_name']['name'];
        $config['file_name'] = $file_name;
        $this -> load -> library('upload', $config);

        if (!$this -> upload -> do_upload('file_name')) {
            return '';
        } else {
            return $file_name;
        }
    }



    private function insert_inspection_report($data) {
        $this -> db -> insert('inspection_report', $data);
        $data = array('inspection_report_id' => ($this -> db -> affected_rows() != 1) ? '' : $this -> db -> insert_id(), );

        $this -> db -> where('id', $this -> last_purchase_id);
        $this -> db -> update('purchasing', $data);

        return ($this -> db -> affected_rows() != 1) ? '' : true;
    }

    private function insert_quotation_info($data) {
        $data['file_name'] = $this -> upload_files();
        $this -> db -> insert('quotation_detail', $data);
        $data = array('quotation_details_id' => ($this -> db -> affected_rows() != 1) ? '' : $this -> db -> insert_id(), );

        $this -> db -> where('id', $this -> last_purchase_id);
        $this -> db -> update('purchasing', $data);

        return ($this -> db -> affected_rows() != 1) ? '' : true;
    }
    
    private function insert_quotation_info_to_log($data) {
        $data['file_name'] = $this -> upload_files($data['purchase_id']);
        unset($data['purchase_id']);
        $this -> db -> insert('quotation_detail', $data);
        $data = array('quotation_details_id' => ($this -> db -> affected_rows() != 1) ? '' : $this -> db -> insert_id(), );

        $this -> db -> where('id', $this -> last_log_id);
        $this -> db -> update('purchase_management_status_log', $data);

        return ($this -> db -> affected_rows() != 1) ? '' : true;
    }
    

    public function register_log($array) {
        
        //print_r($array);
        $this -> db -> insert('purchase_management_status_log', $array);
        if ($this -> db -> affected_rows()) {
            $this -> last_log_id = $this -> db -> insert_id();
        }
        return ($this -> db -> affected_rows() != 1) ? FALSE : true;
    }


    public function init_initial_log() {
        $array = array("purchase_id" => $this -> last_purchase_id, "assigned_by" => $this -> session -> userdata('id'), "assigned_to" => $this -> session -> userdata('id'), "role_id" => $this -> session -> userdata('role'), "status" => 1);

        return $this -> register_log($array);
    }

    public function insert_purchase_data() {
        $post_array = $this -> input -> post();
        $quotation_info = array();
        $inspection_report = array();

        $is_file_attached = isset($post_array['file_attched']) ? true : FALSE;
        $has_inspection_report = $post_array['purchase_type'] == 3 ? true : FALSE;

        $quotation_info['file_name'] = $this -> pop_array($post_array, 'file_name');
        $quotation_info['no_of_quotation'] = $this -> pop_array($post_array, 'no_of_quotation');
        $quotation_info['comperetive_statement'] = $this -> pop_array($post_array, 'comperetive_statement');
        $quotation_info['quotation_justification'] = $this -> pop_array($post_array, 'quotation_justification');
        $quotation_info['recommended_supplier'] = $this -> pop_array($post_array, 'recommended_supplier');

        unset($post_array['file_attched']);

        $inspection_report['present_status'] = $this -> pop_array($post_array, 'present_status');
        $inspection_report['recommendation'] = $this -> pop_array($post_array, 'recommendation');
        $inspection_report['inspector_name'] = $this -> pop_array($post_array, 'inspector_name');
        $inspection_report['inspector_designation'] = $this -> pop_array($post_array, 'inspector_designation');
        $inspection_report['inspection_date'] = $this -> pop_array($post_array, "inspection_date");

        $post_array['inspection_report_id'] = '';

        $post_array['created_by'] = $this -> session -> userdata('id');

        $this -> db -> insert('purchasing', $post_array);
        $this -> last_purchase_id = ($this -> db -> affected_rows() != 1) ? null : $this -> db -> insert_id();
        if ($has_inspection_report) {
            $this -> insert_inspection_report($inspection_report);
        }

        if ($is_file_attached) {
            $this -> insert_quotation_info($quotation_info);
        }
        if ($this -> init_initial_log()) {
            $this -> create_notification($this -> session -> userdata('id'), 1);
        }
        //$this -> init_initial_log();
    }

    

    public function get_log_status_name($id) {
        $query = $this -> db -> get_where('purchase_related_status', array('id' => $id));
        return ($this -> db -> affected_rows() != 1) ? FALSE : true;
    }

    public function is_purchase_completed($id) {
        $query = $this -> db -> get_where('purchasing', array('id' => $id, 'purchase_status' => 'Completed'));
        $ret = $query -> result_array();
        return ($this -> db -> affected_rows() != 1) ? null : $ret[0]['status'];
    }

    public function get_current_purchase_status($id) {
        $this->db->order_by('time','desc');
        $ret = $this->db->get_where('purchase_management_status_log',array('purchase_id'=>$id),1);
        return $ret->result_array();
    }

    public function get_user_name($id) {
        $query = $this -> db -> get_where('user_profile', array('user_id' => $id));
        $ret = $query -> result_array();
        return ($this -> db -> affected_rows() != 1) ? null : $ret[0]['first_name'] . " " . $ret[0]['last_name'];
    }

    public function get_role_name_by_user_id($id, $id_only = false) {
        $query = $this -> db -> get_where('users', array('id' => $id));
        $ret = $query -> result_array();
        $role_id = $ret[0]['role_id'];
        $query = $this -> db -> get_where('role', array('id' => $role_id));
        $ret = $query -> result_array();

        return ($this -> db -> affected_rows() != 1) ? null : $id_only ? $ret[0]['id'] : $ret[0]['name'];

    }

    
    public function getLogStatusInfo($id) {
        //echo $id;
        $query = $this -> db -> get_where('purchase_management_status_log', array('purchase_id' => $id));
        $ret = $query -> result_array();
        return count($ret)?$ret[0]:array();

    }

    

    public function get_purcase_name($id){
        $ret = $this->get_purchase_details($id);
        return $ret ? $ret['item_name']:"none";
    }

    public function get_quotation_details($id) {
        $query = $this -> db -> get_where('quotation_detail', array('id' => $id));
        $ret = $query -> result_array();
        return count($ret)?$ret[0]:array();
    }

    public function get_inspection_report($id) {
        $query = $this -> db -> get_where('inspection_report', array('id' => $id));
        $ret = $query -> result_array();
        return count($ret)?$ret[0]:array();
    }

    public function get_log_id_from_notification_id($id) {
        $query = $this -> db -> get_where('purchase_notifications', array('id' => $id));
        $ret = $query -> result_array();
        return $ret[0]['log_id'];
    }

    public function get_purchase_id_from_notification_id($id) {
        $query = $this -> db -> get_where('purchase_management_status_log', array('id' => $this -> get_log_id_from_notification_id($id)));
        $ret = $query -> result_array();
        return $ret[0]['purchase_id'];
    }

    public function update_item_info($purchase_id, $item_id, $unit, $unit_price, $payment_method){
        $query_str = "UPDATE purchase_item_info SET unit=$unit, unit_price=$unit_price, payment_method='$payment_method' WHERE id=$item_id AND purchase_id=$purchase_id";
        $query = $this->db->query($query_str);

    }

    
    
    public function get_purchase_info($id) {
        $quotation_detail = array();
        $inspection_report = array();
        $purchase_info = $this -> get_purchase_details($id);
        $purchase_info['purchase_category'] = $this -> getPurchaseInfo($purchase_info['purchase_category']);
        $purchase_info['ds_id'] = $this -> getDeptName($purchase_info['ds_id']);
        $purchase_info['purchase_type'] = $this -> getPurchaseTypeName($purchase_info['purchase_type']);
        $purchase_info['item_category'] = $this -> getStockCategory($purchase_info['item_category']);
        $purchase_info['created_by'] = $this -> get_user_name($purchase_info['created_by']) . " (" . $this -> get_role_name_by_user_id($purchase_info['created_by']) . ")";
        $purchase_info['notification_id']=$id;
        if (!empty($purchase_info['inspection_report_id'])) {
            $inspection_report = $this -> get_inspection_report($purchase_info['inspection_report_id']);
        }

        if (!empty($purchase_info['quotation_details_id'])) {
            $inspection_report = $this -> get_quotation_details($purchase_info['quotation_details_id']);
        }
        
                return array_merge($quotation_detail, $inspection_report, $purchase_info);

    }

    
    public function get_dept_from_purchase_id($id){
        $query = $this->db->get_where('purchasing',array('id'=>$id));
        $ret = $query->result_array();
        return $ret[0]['ds_id'];
    }

    
    public function get_purchase_initiator_id($id){
        $query_array=array('id'=>$id);
        $ret = $this->db->get_where('purchasing',$query_array);
        $ret = $ret->result_array();
        return $ret[0]['created_by'];
    }
    
    public function change_purchase_status($id,$status=0){
        $query_array=array('purchase_status'=>$status);
        $this->db->where('id',$id);
        $this->db->update('purchasing',$query_array);
        return ($this -> db -> affected_rows() != 1) ? FALSE : TRUE;
    }

    public function change_stock_status($id,$status=0){
        $query_array=array('stock_status'=>$status);
        $this->db->where('id',$id);
        $this->db->update('purchasing',$query_array);
        return ($this -> db -> affected_rows() != 1) ? FALSE : TRUE;
    }

    public function change_bill_status($id,$status=0){
        $query_array=array('bill_status'=>$status);
        $this->db->where('id',$id);
        $this->db->update('purchasing',$query_array);
        return ($this -> db -> affected_rows() != 1) ? FALSE : TRUE;
    }
    
    public function process_notification($id){
        $post_array = $this -> input -> post();
        unset($post_array['id']);
        $is_file_attached = isset($post_array['file_attched']) ? true : FALSE;
        $quotation_info['purchase_id'] = $post_array['purchase_id'];
        $quotation_info['file_name'] = $this -> pop_array($post_array, 'file_name');
        $quotation_info['no_of_quotation'] = $this -> pop_array($post_array, 'no_of_quotation');
        $quotation_info['comperetive_statement'] = $this -> pop_array($post_array, 'comperetive_statement');
        $quotation_info['quotation_justification'] = $this -> pop_array($post_array, 'quotation_justification');
        $quotation_info['recommended_supplier'] = $this -> pop_array($post_array, 'recommended_supplier');
        
        
        
        unset($post_array['file_attched']);
        if($post_array['status']==5){
            $post_array['assigned_to']=$post_array['forward_id'];
            unset($post_array['forward_id']);
            unset($post_array['return_id']);
        }else if($post_array['status']==6){
            $post_array['assigned_to']=$post_array['return_id'];
            unset($post_array['return_id']);
            unset($post_array['forward_id']);
            
        }else if($post_array['status']==3){
            $purchase_id = $this->get_purchase_id_from_notification_id($id);
            $post_array['assigned_to']=$this->get_purchase_initiator_id($purchase_id);
            $this->change_purchase_status($purchase_id,1);
            unset($post_array['return_id']);
            unset($post_array['forward_id']);
            
        }
        
        
        $post_array['assigned_by']=$this->session->userdata('id');
        
        
        
        $log_inserted = $this->register_log($post_array);
        
         
        if ($is_file_attached) {
            $this -> insert_quotation_info_to_log($quotation_info);
        }
        
        if($log_inserted){
            if($this->change_notification_status($id,1)){
               
                $this->create_notification($post_array['assigned_to'], $post_array['status']);   
            }
            
        }
        
        
        
    }

    public function change_notification_status($id,$is_processed=1){
        $this -> db -> where('id', $id);
        $this -> db -> update('purchase_notifications', array('is_processed'=>$is_processed));

        return ($this -> db -> affected_rows() != 1) ? FALSE : TRUE;
    }
    
    public function get_completed_purchase_list(){
        $query = array(
            "purchase_status"=>1
        );
        
        $ret = $this->db->get_where('purchasing',$query);
        return $ret->result_array();
    }

    public function get_purchase_processed_by_user($id){
        $this->db->distinct();
        $this->db->select('purchase_id');
        $this->db->from('purchase_management_status_log');
        $this->db->where('assigned_to',$id);
        $this->db->order_by('time','desc');

        $res = $this->db->get();
        return $res->result_array();
    }

    /*New functions*/

    public function insert_to_purchasing($data){
       // $this->db->select->()
        $this -> db -> insert('purchasing', $data);
        return ($this -> db -> affected_rows() != 1) ? null : $this -> db -> insert_id();
        
    }

    public function insert_to_log($data){
        $this -> db -> insert('purchase_flow', $data);
        return ($this -> db -> affected_rows() != 1) ? null : $this -> db -> insert_id();
    }

    public function insert_to_purchase_attachment($data){
        $this -> db -> insert('purchase_attachment', $data);
        return ($this -> db -> affected_rows() != 1) ? null : $this -> db -> insert_id();   
    }


    public function insert_to_purchase_item_info($data){
        $this -> db -> insert('purchase_item_info', $data);
        return ($this -> db -> affected_rows() != 1) ? null : $this -> db -> insert_id();   
    }

    public function get_purchase_item_list($id){
        $query = $this->db->get_where('purchase_item_info',array('purchase_id'=>$id));

        return $query->result_array();
    }


    public function insert_to_purchase_notification($data){
        $this -> db -> insert('purchase_notifications', $data);
        return ($this -> db -> affected_rows() != 1) ? null : $this -> db -> insert_id();
    }

    public function get_purchase_details($id) {
        $query = $this -> db -> get_where('purchasing', array('id' => $id));
        $ret = $query -> result_array();
        return count($ret)?$ret[0]:array();
    }


    public function get_attachment_list($id){
        $query = $this->db->query("Select * from purchase_attachment where purchase_id =$id");

        return $query->result_array();
    }
	
	
    public function get_purchase_list($filters){
        $query = $this -> db -> get_where('purchasing', $filters);
        return $query -> result_array();   
    }

    public function get_bill_processes($dept){
        $query = $this->db->query("SELECT purchasing.id, created_date, status FROM `purchasing` LEFT JOIN purchase_related_status ON purchasing.bill_status = purchase_related_status.id WHERE bill_status > 0 AND ds_id = $dept");

        return $query -> result_array(); 
    }


}
?>