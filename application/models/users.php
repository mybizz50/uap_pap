<?php

class Users extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function login() {
        $array = array(
                    'user_name' => $this -> input -> post('username'), 
                    'password' => md5($this -> input -> post('password')),
                    'account_status' => 1,
                    'registration_completed'=>1 
                    );


        $query = $this -> db -> get_where('users', $array, 1);
        $query = $query -> result_array();

        if (count($query)) {
            return $query;
        } else {
            unset($array['user_name']);
            $array['registration_completed']=0;
            
            $query = $this -> db -> get_where('users', $array, 1);
            $data = $query->result_array();
            if(count($data)){
                $id = $data[0]['id'];
                $array = array(
                        'email_address'=>$this -> input -> post('username'),
                        'user_id'=>$id
                    );
                $query = $this -> db -> get_where('user_profile', $array, 1);
                
                return count($query->result_array()) ? $data : FALSE;
            }
            return FALSE;
        }
    }
	
	public function index(){
		if ($this -> session -> userdata('logged_in') != FALSE) {
            redirect('/purchase','refresh');
        }
	}

    function get_user_dept($id){
        $query = $this -> db -> get_where('user_profile', array('user_id' => $id));
        $row = $query -> result_array();
        return $row[0]['department'];
    }

    function get_role_by_id($id) {
        $query = $this -> db -> get_where('users', array('id' => $id));
        $row = $query -> result_array();
        return $row[0]['role_id'];
    }
    
    function get_actual_role_by_id($id) {
        $query = $this -> db -> get_where('users', array('id' => $id));
        $row = $query -> result_array();
        return $row[0]['actual_role_id'];
    }

    function get_role_name($id) {
        $query = $this -> db -> get_where('role', array('id' => $id));
        $ret = $query -> result_array();
        return count($ret) ? $ret[0]['name']:'None';
    }

    function update_registration_status($id,$status){
        $this->db->where('id',$id);
        $this->db->update('users',array('registration_completed',$status));
        return $this->db->affected_rows();
    }

    function get_password($id){
        $query = $this->db->get_where('users',array('id'=>$id));
        $result = $query->result_array();
        return count($result) ? $result[0][password]:FALSE;

    }

    function is_registration_completed($id){
        $query = $this->db->get_where('users',array('id'=>$id,'registration_completed'=>1));
        return count($query->result_array());
    }

    function update_login_info($id,$info){
        $this->db->where('id',$id);
        $this->db->update('users',$info);
        return $this->db->affected_rows();
    }

    function complete_registration($id,$data){
        $this->db->where('user_id',$id);
        $this->db->update('user_profile',$data);
        return $this->db->affected_rows();   
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    function create_user($array_1, $array_2){
        $this->db->insert('users',$array_1);
        $array_2['user_id']=$this->db->insert_id();
        $this->db->insert('user_profile',$array_2);

        return $this->db->affected_rows();
    }
    
    function get_role_option(){
        $options = array();
        
        $query = $this -> db -> get_where('role', array('role_status' => 1));
        
        foreach ($query->result() as $row)
        {
            $options[$row->id]=$row->name;
        }
        
        return $options;
    }


    
    
    function get_department_name($id){
        $query = $this -> db -> get_where('DepartmentSection', array('id' => $id));
        $row = $query -> result_array();
        return isset($row[0]['ds_name'])?$row[0]['ds_name']:'';
    }
    
    function get_users(){
        $query = $this->db->get('user_profile');
        $list = array();
        foreach($query -> result_array() as $user){
            if($user['user_deleted']){
                continue;
            }
            $id = $user['user_id'];
            $row = $this -> db -> get_where('users', array('id' => $id))-> result_array();
            $role['id']=$row[0]['role_id'];
            $role['name']=$this->get_role_name($row[0]['role_id']);
            $user['role']=$role;
            
            $arole['id']=$row[0]['actual_role_id'];
            $arole['name']=$this->get_role_name($row[0]['actual_role_id']);
            $user['actual_role']=$arole;
            
            
            $dept['id']=$user['department'];
            $dept['name']=$this->get_department_name($user['department']);
            $user['department']=$dept;
            
            $user['account_status']=$row[0]['account_status'];
            
            array_push($list,$user); 
        }
        
        return $list;
    }

     function get_registered_users(){
        $query = $this->db->get('user_profile');
        $list = array();
        foreach($query -> result_array() as $user){
            if($user['user_deleted'] || !$this->is_registration_completed($user['user_id'])){
                continue;
            }
            $id = $user['user_id'];
            $row = $this -> db -> get_where('users', array('id' => $id))-> result_array();
            $role['id']=$row[0]['role_id'];
            $role['name']=$this->get_role_name($row[0]['role_id']);
            $user['role']=$role;
            
            $arole['id']=$row[0]['actual_role_id'];
            $arole['name']=$this->get_role_name($row[0]['actual_role_id']);
            $user['actual_role']=$arole;
            
            
            $dept['id']=$user['department'];
            $dept['name']=$this->get_department_name($user['department']);
            $user['department']=$dept;
            
            $user['account_status']=$row[0]['account_status'];
            
            array_push($list,$user); 
        }

        
        return $list;
    }
    
    function update_user($id){
        $data1 = array(
            "role_id"=>$this->input->post('role'),
            "actual_role_id"=>$this->input->post('actual_role')
        );
        
        $query = $this -> db -> get_where('user_profile', array('id' => $id));
        $row = $query -> result_array();
        $logid = $row[0]['user_id'];
        
        if($row[0]['user_deleted']){
            return FALSE;
        }
        
        $this->db->where('id', $logid);
        $this->db->update('users', $data1); 
        $res1 = $this -> db -> count_all_results();
        
        $this->db->where('id', $id);
        $this->db->update('user_profile',array('email_address' =>$this->input->post('email'))); 
        $res2 = $this -> db -> count_all_results();
        
        return ($res1==1 && $res2==1)?TRUE:FALSE;
         
    }
    
    function change_status($id,$status){
        $query = $this -> db -> get_where('user_profile', array('id' => $id));
        $row = $query -> result_array();
        $logid = $row[0]['user_id'];
        $this->db->where('id', $logid);
        $this->db->update('users', array('account_status'=>$status)); 
        
        return ($this -> db -> count_all_results()==1)?TRUE:FALSE;
    }
    
    function delete_user($id){
        $query = $this -> db -> get_where('user_profile', array('id' => $id));
        $row = $query -> result_array();
        $logid = $row[0]['user_id'];
        
        if($row[0]['user_deleted']){
            return FALSE;
        }
        
        $this->db->delete('users', array('id' => $logid)); 
        $res1 = $this -> db -> count_all_results();
        
        $this->db->where('id', $id);
        $this->db->update('user_profile',array('user_deleted' =>1)); 
        $res2 = $this -> db -> count_all_results();
        
        return ($res1==1 && $res2==1)?TRUE:FALSE;  
    }
    
    function get_full_name($id){
        $query = $this -> db -> get_where('user_profile', array('user_id' => $id));
        $row = $query -> result_array();
        return count($row)? $row[0]['first_name']." ".$row[0]['last_name']:"";
    }

    function get_email($id){
        $query = $this -> db -> get_where('user_profile', array('user_id' => $id));
        $row = $query -> result_array();
        return count($row)? $row[0]['email_address']:"";
    }

    function get_role_defination($id){
     $query = $this -> db -> get_where('role', array('id' => $id));
        $row = $query -> result_array();

        return count($row)? $row[0]:array();   
    }

    

}
?>