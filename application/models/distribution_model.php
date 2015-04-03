<?php

class Distribution_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }


function get_distribution_details($id){
    $query = $this->db->get_where('stock_distribution',array('id'=>$id));
    $result = $query->result_array();
    return count($result)? $result[0] : array();    
}

function get_stock_id($id){
    $ret = $this->get_distribution_details($id);
    return $ret ? $ret['stock_id']:0;
}
   
function update_wastes($id,$data){
    $this->db->where('id',$id);
    $this->db->update('stock_distribution',$data);
    return $this -> db ->count_all_results()?TRUE:FALSE;
}

   
function add_distribution() {
        $array = $this -> input -> post();
        $this->db->insert('stock_distribution', $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_distribution_list($id){
    $this->db->select('*');
    $this->db->from('stock_distribution');
    if($id){
        $this->db->where('stock_id',$id);
    }
    $query = $this->db->get();
    return $query->result_array();
            
}



    
}
?>