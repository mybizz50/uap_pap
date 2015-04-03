<?php

class supplier extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   
   
function add_supplier() {
        $array = array(
            'name' => $this -> input -> post('name'), 
            'description' =>$this -> input -> post('description'),
            'address' =>$this -> input -> post('address')
        
        );
        
        $this->db->insert('supplier', $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_supplier(){
    $query = $this->db->get('supplier');
    return $query->result_array();
}

function get_supplier_name($id){
    $query = $this->db->get_where('supplier',array('id'=>$id));
    $query = $query->result_array(); 
    return $query ? $query[0]['name']:"none";   
}

function update_supplier($id){
    $array = array(
            'name' => $this -> input -> post('name'), 
            'description' =>$this -> input -> post('description'),
            'address' =>$this -> input -> post('address')
        
        );
        
    $this->db->where('id', $id);
    $this->db->update('supplier', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}    

function change_status($id,$status){
    $array = array(
            'supplier_status' => $status
        
        );
        
    $this->db->where('id', $id);
    $this->db->update('supplier', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}    

    
}
?>