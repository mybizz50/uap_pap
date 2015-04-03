<?php

class bill_process_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

private $db_structure ="bill_process_flow_structure";


function can_role_approve($id){
    $query = $this->db->get_where($this->db_structure,array('concerned_role'=>$id, 'can_approve'=>1));
    $record = $query->result_array();
    return count($record);
}
   
function get_bill_process_flow_structure(){
    $query = $this->db->query("SELECT users.id as user_id, role.name, departmentsection.ds_name FROM bill_process_flow_structure LEFT JOIN users ON bill_process_flow_structure.concerned_role = users.role_id LEFT JOIN user_profile ON user_profile.user_id = users.id LEFT JOIN departmentsection ON  user_profile.department = departmentsection.id LEFT JOIN role ON bill_process_flow_structure.concerned_role = role.id WHERE bill_process_flow_structure.step !=( SELECT MAX(step) FROM bill_process_flow_structure )");

    return $query->result_array();
}



function get_final_destination(){
    $query = $this->db->query("SELECT users.id as user_id, role.name, departmentsection.ds_name FROM bill_process_flow_structure LEFT JOIN users ON bill_process_flow_structure.concerned_role = users.role_id LEFT JOIN user_profile ON user_profile.user_id = users.id LEFT JOIN departmentsection ON  user_profile.department = departmentsection.id LEFT JOIN role ON bill_process_flow_structure.concerned_role = role.id WHERE bill_process_flow_structure.step =( SELECT MAX(step) FROM bill_process_flow_structure )");
    $record = $query->result_array();
    return $record[0]['user_id'];
}


function is_check_issuer($user_role_id){
    $query = $this->db->query("SELECT * FROM bill_process_flow_structure WHERE concerned_role = $user_role_id AND can_approve = 1");
    $record = $query->result_array();
    return count($record);
}

    
}
?>