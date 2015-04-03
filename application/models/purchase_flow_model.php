<?php

class purchase_flow_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

private $db_flow = "purchase_flow";
private $db_structure ="purchase_flow_structure";
private $db_attachment = "purchase_flow_attachment";


function can_role_approve($id){
	$query = $this->db->get_where($this->db_structure,array('concerned_role'=>$id, 'can_approve'=>1));
    $record = $query->result_array();
	return count($record);
}
   
function get_purchase_flow_structure(){
	$query = $this->db->query("SELECT users.id as user_id, role.name, departmentsection.ds_name FROM purchase_flow_structure LEFT JOIN users ON purchase_flow_structure.concerned_role = users.role_id LEFT JOIN user_profile ON user_profile.user_id = users.id LEFT JOIN departmentsection ON  user_profile.department = departmentsection.id LEFT JOIN role ON purchase_flow_structure.concerned_role = role.id WHERE purchase_flow_structure.id !=( SELECT MAX(id) FROM purchase_flow_structure )");

    return $query->result_array();
}

function insert_flow($array){
	$this->db->insert($this->db_flow, $array);
	
	return $this->db->insert_id();
}

function insert_attachment($file){
	$this->db->insert($this->db_attachment, $file);
	
	return ($this -> db -> affected_rows() != 1) ? null : $this -> db -> insert_id();
}

function get_purchase_flow($purchase_id){
	$query = $this->db->query("Select * from purchase_flow where purchase_id =$purchase_id");
    return $query->result_array();
}



function get_purchase_attachments($flow_id){
	$query = $this->db->query("Select * from purchase_flow_attachment where flow_id =$flow_id");
    return $query->result_array();
}


function get_flow_type_name($id){
	$query = $this->db->get_where('purchase_related_status',array('id'=>$id));
    $record = $query->result_array();
    return $record[0]['status'];
}

function get_initiator($purchase_id){
	$query = $this->db->query("SELECT * FROM `purchase_flow` WHERE purchase_id=$purchase_id AND status_type=1 LIMIT 0,1");
	$record = $query->result_array();
    return $record[0]['from'];
}

function get_final_destination(){
	$query = $this->db->query("SELECT users.id as user_id, role.name, departmentsection.ds_name FROM purchase_flow_structure LEFT JOIN users ON purchase_flow_structure.concerned_role = users.role_id LEFT JOIN user_profile ON user_profile.user_id = users.id LEFT JOIN departmentsection ON  user_profile.department = departmentsection.id LEFT JOIN role ON purchase_flow_structure.concerned_role = role.id WHERE purchase_flow_structure.id =( SELECT MAX(id) FROM purchase_flow_structure )");
    $record = $query->result_array();
    return $record[0]['user_id'];
}

function get_appo1(){
    $query = $this->db->query("SELECT id FROM users WHERE role_id = 37");
    $record = $query->result_array();
    return $record[0]['id'];   
}

public function get_status_details($log_id){
        $query = $this->db->get_where('purchase_related_status',array('id'=>$log_id));
        $ret = $query->result_array();
        return $ret[0]['status'];
    }

public function purchase_log($purchase_id){
    $query = $this->db->get_where('purchase_flow',array('purchase_id'=>$purchase_id));
    $ret = $query->result_array();
    
    
    return $ret;
}

public function check_issued($purchase_id){
    $query = $this->db->get_where('purchase_flow',array('status_type'=>11, 'purchase_id'=>$purchase_id));
    $record = $query->result_array();
    return count($record);
}

/* olders*/   
function add_status($array) {
        //print_r($array);
        $this->db->insert($this->db_status, $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_flow_status($purchase_id){
    $query = $this->db->get_where($this->db_status,array('purchase_id'=>$purchase_id));
    $record = $query->result_array();
    return count($record)?$record[0]:array();
}

function get_current_step_info($step){
    $query = $this->db->get_where($this->db_flow,array('current_step'=>$step));
    $record = $query->result_array();
    return $record;   
}

function get_current_step_info_by_id($id){
    $query = $this->db->get_where($this->db_flow,array('id'=>$id));
    $record = $query->result_array();
    return count($record)?$record[0]:$record;   
}


function get_step_info($id){
    $query = $this->db->get_where($this->db_flow,array('id'=>$id));
    $record = $query->result_array();
    return $record;   
}

function get_notifications($origin_module='all',$user_id,$processed_log=false){
    $this->db->order_by('date','desc');
    if($origin_module!='all'){
        $this->db->where('origin_module',$origin_module);
    }
    if($processed_log){
        $this->db->where('is_processed',1);   
    }else{
        $this->db->where('is_processed',0);
    }

    $this->db->where('to',$user_id);

    $query = $this->db->get($this->db_name);
    $ret = $query->result_array();
    return $ret;   
}

public function get_next_steps($current_step){
    $query = $this->db->query("select * from purchase_flow where current_step in (select next_step from purchase_flow where current_step=$current_step) group by processing_dept");

    return $query->result_array();    

}



public function get_prev_steps($current_step){
    $query = $this->db->query("select * from purchase_flow where next_step=$current_step group by processing_dept");

    return $query->result_array();    
}

public function get_proecssing_dept($purchase_id){
    $query = $this->db->query("select * from purchase_flow where current_step in (select current_step from purchase_flow_status where purchase_id=$purchase_id) group by processing_dept");
    $ret = $query->result_array();
    return  count($ret)? $ret[0]:$ret;
}


public function get_purchase_list($user_id){
    $query = $this->db->query("SELECT DISTINCT  purchase_id FROM  `purchase_flow` WHERE  `from` =$user_id");
    return $query->result_array();
    
}

    
}
?>