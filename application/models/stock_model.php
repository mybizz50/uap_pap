<?php

class Stock_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

/* New codes*/

function enter_stock($purchase_id){
    $this->db->insert('stock', array('purchase_id'=>$purchase_id));
    return $this -> db -> count_all_results();
}

function delete_stock($purchase_id){
    $this->db->delete('stock', array('purchase_id'=>$purchase_id));
    return $this -> db -> count_all_results();
}

function get_stock($prop){
    $query = $this->db->get_where('stock',$prop);
    return $query->result_array();
}

function has_stock_entered($purchase_id){
    return count($this->get_stock(array('purchase_id'=>$purchase_id)));
}   

/* Old codes*/
   
function add_stock() {
        $array = $this -> input -> post();
        $this->db->insert('stock', $array);

        $this -> db -> where('id', $array['purchase_id']);
        $this -> db -> update('purchasing', array('stock_entry_complete'=>1));

        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_stock_list(){
    $this->db->select('*');
    $this->db->from('stock');
    $query = $this->db->get();
    return $query->result_array();
}

function get_stock_details($id){
    $query = $this->db->get_where('stock',array('id'=>$id));
    $result = $query->result_array();
    return count($result)? $result[0] : array();    
}

function get_stock_name($id){
    $info = $this->get_stock_details($id);

    return $info ? $info['stock_title']:$info;
}


function get_stock_by_dept($id){
    $query = $this -> db -> get_where('stock_distribution', array('distributed_to' => $id));
    return $query -> result_array();
}

function deduct_stock($id,$amount=0){
    $this->db->where('id',$id);
    $query = $this->db->get('stock');
    if($this -> db -> count_all_results()){
        $result = $query->result_array();
        $available = (int)$result[0]['available_quantity'];
        $res = $available - $amount;
        if($res<0){
            return FALSE;
        }
        $this->db->where('id',$id);
        $this->db->update('stock',array('available_quantity'=>$res));
        return $this -> db -> count_all_results()?TRUE:FALSE;
    }else{
        return FALSE;
    }
}

}
?>