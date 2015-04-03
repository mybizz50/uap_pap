<?php

class notification_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

private $db_name = "notifications";    
   
   
function add_notification($array) {
        $this->db->insert($this->db_name, $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }

function mark_processed($id) {
	$query = $this->db->query("UPDATE notifications SET is_processed=1 WHERE id=$id");
     return $this -> db -> affected_rows();    
    }

function is_readonly($id){
	$query = $this->db->query("SELECT * FROM notifications WHERE id=$id AND is_readonly=1");
     return $this -> db -> affected_rows();
}

function get_current_action($id){
    $query = $this->db->get_where('notifications',array('id'=>$id));
    $record = $query->result_array();
    return count($record) ? $record[0]['action'] : 0;
}    

function get_notification($id,$user_id=null, $is_processed=false){
    $filter['id'] = $id;
    $filter['is_processed'] = 0;
    if($user_id){
        $filter['to']=$user_id;
    } 

    if($is_processed){
        $filter['is_processed']=1;
    }
    
    $query = $this->db->get_where($this->db_name,$filter);
    $ret = $query->result_array();
    return count($ret) ? $ret[0] : array();
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




    
}
?>