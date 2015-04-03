<?php

class Role extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   
   
function add_role() {
        $array = array(
            'name' => $this -> input -> post('name'), 
            'description' =>$this -> input -> post('description'),
            'create_date' =>date("Y-m-d H:i:s", time()),
            'stock_mod_access'=>isset($_POST['stock_mod_access'])?1:0,
            'admin_mod_access'=>isset($_POST['admin_mod_access'])?1:0,
            'user_mod_access'=>isset($_POST['user_mod_access'])?1:0,
            'purchase_mod_access'=>isset($_POST['purchase_mod_access'])?1:0,
            'read_only'=>isset($_POST['read_only'])?1:0,
            'role_for'=>isset($_POST['role_for'])?$_POST['role_for']:'department',
            'section_id'=>isset($_POST['role_for'])?$_POST['section_id']:0,
            'rank'=>isset($_POST['rank'])?$_POST['rank']:0
            

        );
       
        $this->db->insert('role', $array); 
        return $this -> db -> count_all_results()?TRUE:FALSE;    
    }    

function get_role(){
    $query = $this->db->get('role');
    return $query->result_array();
}

function is_lowest_rank($role_id){
    $query = $this->db->get_where('role',array('id'=>$role_id));
    $record = $query->result_array();
    $record = $record[0];
    if($record['role_for']=='department'){
        $query = $this->db->query("Select * from role where role_for='department' and rank=(select max(rank) from role where role_for='department')");
        $record = $query->result_array();
        return $record[0]['id']==$role_id;
    }else{
        $section_id = $record['section_id'];
        $query = $this->db->query("Select * from role where section_id=$section_id and rank=(select max(rank) from role where section_id=$section_id)");
        $record = $query->result_array();
        return $record[0]['id']==$role_id;
    }
       
}


function is_highest_rank($role_id){
    $query = $this->db->get_where('role',array('id'=>$role_id));
    $record = $query->result_array();
    $record = $record[0];
    if($record['role_for']=='department'){
        $query = $this->db->query("Select * from role where role_for='department' and rank=(select min(rank) from role where role_for='department')");
        $record = $query->result_array();
        return $record[0]['id']==$role_id;
    }else{
        $section_id = $record['section_id'];
        $query = $this->db->query("Select * from role where section_id=$section_id and rank=(select min(rank) from role where section_id=$section_id)");
        $record = $query->result_array();
        return $record[0]['id']==$role_id;
    }
       
}

function update_role($id){
    $array = array(
            'name' => $this -> input -> post('name'), 
            'description' =>$this -> input -> post('description'),
            'stock_mod_access'=>isset($_POST['stock_mod_access'])?1:0,
            'admin_mod_access'=>isset($_POST['admin_mod_access'])?1:0,
            'user_mod_access'=>isset($_POST['user_mod_access'])?1:0,
            'purchase_mod_access'=>isset($_POST['purchase_mod_access'])?1:0,
            'read_only'=>isset($_POST['read_only'])?1:0,
            'role_for'=>isset($_POST['role_for'])?$_POST['role_for']:'department',
            'section_id'=>isset($_POST['role_for'])?$_POST['section_id']:0,
            'rank'=>isset($_POST['rank'])?$_POST['rank']:0
        
        );
            
    $this->db->where('id', $id);
    $this->db->update('role', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}    

function change_status($id,$status){
    $array = array(
            'role_status' => $status
        
        );
        
    $this->db->where('id', $id);
    $this->db->update('role', $array); 
    $res1 = $this -> db -> count_all_results();
    return $res1==1?TRUE:FALSE;  
}

function get_rank($id){
    $query = $this->db->get_where('role',array('id'=>$id));
    $record = $query->result_array();
    return $record[0]['rank'];
}

function get_rank_list($ds_type, $ds_id=''){
    //echo $ds_type;
    if($ds_type=="department"){
        $query = $this->db->query("select * from role where role_for='department' and role_status=1 order by rank");
        return $query->result_array(); 
    }else{
        $query = $this->db->query("select * from role where role_for='section' and role_status=1 and section_id=$ds_id order by rank");
        return $query->result_array();
    }

    
}

function find_person($rank, $section_id, $is_dept){
    if($is_dept){
        $query = $this->db->query("select id from users where role_id in (select id from role where role_for='department' and rank=$rank)");
        return $query->result_array();
    }else{
        $query = $this->db->query("select id from users where role_id in (select id from role where role_for='department' and rank=$rank)");
        return $query->result_array();
    }
}


}
?>