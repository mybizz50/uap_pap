<?php

class Department extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   
   
function add_department() {
        $array = array(
            'ds_name' => $this -> input -> post('ds_name'), 
            'ds_loc' =>$this -> input -> post('ds_loc'),
            'ds_phone' =>$this -> input -> post('ds_phone'),
            'ds_mail' =>$this -> input -> post('ds_mail'),
            'ds_type' =>$this -> input -> post('ds_type')
        
        );
        
        $this->db->insert('DepartmentSection', $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_departments(){
    $query = $this->db->get('DepartmentSection');
    return $query->result_array();
}



function get_active_departments(){
    $query = $this->db->get_where('DepartmentSection',array('ds_status'=>1));
    return $query->result_array();
}

function get_active_sections(){
 $query = $this->db->query("select * from DepartmentSection where ds_status=1 and (ds_type='section' or ds_type='rec_com')");
    return $query->result_array();   
}

function update_department($id){
    $array = array(
            'ds_name' => $this -> input -> post('ds_name'), 
            'ds_loc' =>$this -> input -> post('ds_loc'),
            'ds_phone' =>$this -> input -> post('ds_phone'),
            'ds_mail' =>$this -> input -> post('ds_mail'),
            'ds_type' =>$this -> input -> post('ds_type')
        
        );
        
    $this->db->where('id', $id);
    $this->db->update('DepartmentSection', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}    

function change_status($id,$status){
    $array = array(
            'ds_status' => $status
        
        );
        
    $this->db->where('id', $id);
    $this->db->update('DepartmentSection', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}    

function get_dept_details($id){
    $query = $this->db->get_where('DepartmentSection',array('id'=>$id));
    $query = $query->result_array();
    return $query ? $query[0]:FALSE;
}

function get_dept_name($id){
    $query = $this->db->get_where('DepartmentSection',array('id'=>$id));
    $query = $query->result_array();
    return $query ? $query[0]['ds_name']:'none';   
}


function get_cmt_name($id){
    $query = $this->db->get_where('recommendation_committee',array('id'=>$id));
    $query = $query->result_array();
    return $query ? $query[0]['name']:'none';   
}

function is($id,$type){
    $query = $this->db->get_where('DepartmentSection',array('id'=>$id,'ds_type'=>$type));
    $query = $query->result_array();
    return count($query) ? 1:0;   
}

function get_dept_rank_name($rank){
    $query = $this->db->query("select name from role where role_for='department' and rank=$rank");
    return $query->result_array();
}

function get_section_rank_name($rank,$id){
    $query = $this->db->query("select name from role where section_id=$id and rank=$rank");
    return $query->result_array();
}
    
}
?>