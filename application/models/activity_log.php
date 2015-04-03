<?php

class Activity_log extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   
   
function add_log($array) {
        //print_r($array);
        $this->db->insert('activity_log', $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_log($id){
    $query = $this->db->get_where('activity_log',array('id'=>$id));
    $ret = $query->result_array();
    return count($ret) ? $ret[0] : array();
}

function get_logs(){
    $this->db->order_by('date','desc');
    $query = $this->db->get('activity_log');
    $ret = $query->result_array();
    return $ret;   
}

    
}
?>