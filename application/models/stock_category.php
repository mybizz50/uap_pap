<?php

class Stock_category extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   
   
function add_stock_category() {
        $array = array(
            'name' => $this -> input -> post('name'), 
            'description' =>$this -> input -> post('description')
        
        );
        
        $this->db->insert('stock_category', $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_stock_category(){
    $query = $this->db->get('stock_category');
    return $query->result_array();
}

function get_category_details($id){
    $query = $this->db->get_where('stock_category',array('id'=>$id));
    $query = $query->result_array();
    return count($query) ? $query[0]:FALSE;
}

function get_category_name($id){
    $info = $this->get_category_details($id);

    return $info ? $info['name']:$info;
}

function update_stock_category($id){
    $array = array(
            'name' => $this -> input -> post('name'), 
            'description' =>$this -> input -> post('description')
        
        );
        
    $this->db->where('id', $id);
    $this->db->update('stock_category', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}    

function change_status($id,$status){
    $array = array(
            'stock_category_status' => $status
        
        );
        
    $this->db->where('id', $id);
    $this->db->update('stock_category', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}    

    
}
?>