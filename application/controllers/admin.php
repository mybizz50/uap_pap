<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller { 

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    
    function __construct() {
        parent::__construct();
        if ($this -> session -> userdata('logged_in')==FALSE && $this -> session -> userdata('role')!=1) {
            redirect('/user','refresh');
        }

        $this -> load -> model('users');
        $access = $this->users->get_role_defination($this -> session -> userdata('role'));
        if(empty($access['admin_mod_access'])){
            redirect('/page/page_not_found', 'refresh');       
        }
        if($this -> session -> userdata('registration_completed')==0){
         redirect('/user/complete_registration', 'refresh');   
        }
    }

        function extract_notification($notification){
        $this -> load -> model('users');
        $msg = '';
        if($notification['action']==1){
            if($notification['from']==$this->session->userdata('id')){
                $msg .= "You";
            }else{
                $msg .= $this->users->get_full_name($notification['from']);
                
            }
            $msg .=" initialized a purchase";
        }
        
        if($notification['action']==5){
            if($notification['from']==$this->session->userdata('id')){
                $msg .= "You";
            }else{
                $msg .= $this->users->get_full_name($notification['from']);
                
            }
            $msg .=" forwarded a purchase";
        }
        
        if($notification['action']==2){
            if($notification['from']==$this->session->userdata('id')){
                $msg .= "You";
            }else{
                $msg .= $this->users->get_full_name($notification['from']);
                
            }
            $msg .=" rejected a purchase";
        }
        
        if($notification['action']==7){
            if($notification['from']==$this->session->userdata('id')){
                $msg .= "You";
            }else{
                $msg .= $this->users->get_full_name($notification['from']);
                
            }
            $msg .=" approved a purchase";
        }

        if($notification['action']==8){
            if($notification['from']==$this->session->userdata('id')){
                $msg .= "You";
            }else{
                $msg .= $this->users->get_full_name($notification['from']);
                
            }
            $msg .=" ordered to issue work order";
        }

        if($notification['action']==9){
            if($notification['from']==$this->session->userdata('id')){
                $msg .= "You";
            }else{
                $msg .= $this->users->get_full_name($notification['from']);
                
            }
            $msg .=" issued work order";
        }

        return $msg;
    }

    function timeAgo ($oldTime, $newTime, $timeType='x') {
        $timeCalc = $newTime - $oldTime;
        //echo "<br/>".$timeCalc;        
        if ($timeType == "x") {
            if ($timeCalc >= (60*60*24)) {
                $timeType = "d";
            }else if($timeCalc >= (60*60)){
                $timeType = "h";
            }else{
                $timeType = "m";
            }
        }        
        if ($timeType == "s") {
            $timeCalc .= " seconds ago";
        }
        if ($timeType == "m") {
            $timeCalc = round($timeCalc/60) . " minutes ago";
        }        
        if ($timeType == "h") {
            $timeCalc = round($timeCalc/60/60) . " hours ago";
        }
        if ($timeType == "d") {
            $timeCalc = round($timeCalc/60/60/24) . " days ago";
        } 


        return $timeCalc;
    }

    function make_url($notification){
        $url = '/';
        if($notification['origin_module']=='purchase'){
            $url .='index.php/purchase/';
            if($notification['is_processed']){
                $url .='old_process/';
            }else{
                $url .='current_process/';
            }

            if($this->session->userdata('id')==$notification['to']){
                $url .='process/';
            }else{
                $url .='show/';
            }

            $url .=$notification['id'];

        }


        return $url;
    }
    
    function get_notification_short_list($origin_module='all'){
        $this -> load -> model('notification_model');
        $list = $this->notification_model->get_notifications($origin_module,$this->session->userdata('id'));
        $short_list = array();
        foreach($list as $item){
            $short_list[]=array('msg'=>$this->extract_notification($item),'url'=>$this->make_url($item),'ago'=>$this->timeAgo($item['date'],strtotime("now")));
        }
		
		//$this->print_a($list);
        return $short_list;
    }




    private function generate_page($title, $pdata, $page='purchase'){
            $this -> load -> model('users');
            $this -> load -> model('purchase_model');
            
            //print_r(expression);
            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $data['header'] = $this -> load -> view("templates/header", array('title' => $title), TRUE);
            $data['nav_logged'] = $this -> load -> view("templates/nav_logged", 
                  array(
                    'name'=>$name,
                    'purchase_notification'=>$this->get_notification_short_list('purchase'),
                    'bill_notification'=>$this->get_notification_short_list('bill_process')
                  ), TRUE);
				  
            $data['sidebar'] = $this -> load -> view("templates/sidebar", array('access'=>$this->users->get_role_defination($this -> session -> userdata('role'))), TRUE);
            $content = '';
            foreach($pdata as $name => $value){
                $content.=$this -> load -> view("templates/".$name, $value, TRUE);
            }

            $data['content']=$content;
            $data['footer'] = $this -> load -> view("templates/footer", '', TRUE);
			$this -> load -> view('pages/'.$page, $data);
    }
     
    public function index() {
            $data['current_process_list'] = '';
            $this->generate_page("Admin : home", $data);
    }

    public function user_add($error='') {
        $this -> load -> model('users');
           $options = $this -> users -> get_role_option();
           $this->generate_page("Admin :: Add user",array('user_add_form'=>array('ferror'=>$error,'options'=>$options)));
    }

    public function create_user(){
        $this -> form_validation -> set_rules('usermail', 'Email', 'required|valid_email|is_unique[user_profile.email_address]');
        $this -> form_validation -> set_rules('password', 'password', 'required');
        
        if ($this -> form_validation -> run() == FALSE) {
            $this -> user_add();
        } else {
            $users_info = array(
                    'user_name'=>' ',
                    'password'=>md5($this->input->post('password')),
                    'role_id'=>$this->input->post('role'),
                    'actual_role_id'=>$this->input->post('role'),
                    'account_status'=>1,
                    'registration_completed'=>0
                );

            $profile_info = array(
                'first_name'=>' ',
                'last_name'=>' ',
                'designation'=>' ',
                'create_date'=>date('Y-m-d H:i:s'),
                'last_password_change_date'=>date('Y-m-d H:i:s'),
                'email_address'=>$this->input->post('usermail'),
                'contact_number'=>' ',
                'department'=>0
                );

            
            if($this->users->create_user($users_info, $profile_info)){

                $this->load->model('activity_log');

                $name = $this->users->get_full_name($this -> session -> userdata('id'));
                $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
                $role_2 = $this->users->get_role_name($this->input->post('role'));
                $email = $this->input->post('usermail');

                $action =   "created"; 
                $log_info = array(
                "activity_type"=>7,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>'',
                "description"=>"$name($role_1) $action $role_2($email)"
            ); 
           $this->activity_log->add_log($log_info);
                

               $this->show_success_msg("User created successfully","success");
           }else{
               $this->show_success_msg("Sorry ! something went wrong","error");
           }

            //print_r($users_info);
            //print_r($profile_info);
        }
    }

    public function show_success_msg($msg='',$type='success'){
        
        $this->generate_page('Admin :: '.$type, array('alerts'=>array('msg'=>$msg,'type'=>$type)));
        
        
    }

    public function user_show($id = '') {
            $this -> load -> model('users');
            $list = $this->users->get_registered_users();
           
            $ldata['users']=$list;
            $ldata['role_options']=$this->users->get_role_option();
            $ldata['status_options']=array('0'=>'Locked','1'=>'Active');
           
           $this->generate_page('Admin :: User list', array('user_list'=>$ldata));
        
    }
    
    public function edit_user($id=''){

        if(empty($id)){
            $this->show_success_msg("The user id is invalid","error");
            return;
        }
        
        $this -> load -> model('users');
       if($list = $this->users->update_user($id)){
           $this->show_success_msg("Informatin updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
           
        
    }
    
    public function delete_user($id=''){
        if(empty($id)){
            $this->show_success_msg("The user id is invalid","error");
            return;
        }
        return;
        $this -> load -> model('users');
       if($list = $this->users->delete_user($id)){
           $this->show_success_msg("Information updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
           
        
    }
    
    public function change_user_status(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this -> load -> model('users');
        $this -> load -> model('activity_log');
        

        if(empty($id)){
            $this->show_success_msg("The user id is invalid","error");
            return;
        }
        

       if($list = $this->users->change_status($id,$status)){
            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $name_2 = $this->users->get_full_name($id);
            $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
            $role_2 = $this->users->get_role_name($this->users->get_role_by_id($id));
            $action =   ($status)?"unclocked":"locked"; 
               $log_info = array(
                "activity_type"=>$status?11:10,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=>$id,
                "description"=>"$name_2($role_2) $action by $name($role_1)"
            ); 

           //print_r($log_info);
           $this->activity_log->add_log($log_info);
           //exit();
           $this->show_success_msg("User information updated successfully","success");

       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
    }
    
    /*
     * Department 
     */
    
    public function add_department(){
            $this->show_add_dept_form();
        
    }
    
    public function save_department(){
        $this -> form_validation -> set_rules('ds_name', 'Department name', 'trim|required|xss_clean|is_unique[DepartmentSection.ds_name]');
        $this -> form_validation -> set_rules('ds_loc', 'Department location', 'trim|required|xss_clean');
        $this -> form_validation -> set_rules('ds_phone', 'Department phone', 'trim|required|xss_clean');
        $this -> form_validation -> set_rules('ds_mail', 'Department mail', 'trim|required|valid_email');
        if ($this -> form_validation -> run() == FALSE) {
         $this->show_add_dept_form();
         return;       
        }
        
        $this->load->model('department');
        if($this->department->add_department()){

            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
            $dept = $this->input->post('ds_name');
            
            $action =   "created"; 
            $log_info = array(
            "activity_type"=>12,
            "executor"=>$this->session->userdata('id'),
            "executed_to"=>'',
            "description"=>"$name($role_1) $action new department ($dept))"
            ); 
           $this->activity_log->add_log($log_info);
                

            $this->show_success_msg("Department added successfully");
        }else{
            $this->show_success_msg("Failed ! try again later");
        }
    }

    function show_add_dept_form($error = '') {
        $this->generate_page("Admin :: Add department", array('add_department_form'=>array('ferror' => $error)));
        
    }
    
    public function show_department($id=''){
        if($id=='all'){
            $this->load->model('department');
            $this->generate_page("Admin :: Department list", array('department_list' => array('departments'=>$this->department->get_departments())));
            
        }
        
    }

    public function edit_department(){
        $id = $this->input->post('id');
        //echo "dept";
        if(empty($id)){
            $this->show_success_msg("The department id is invalid","error");
            return;
        }
        
        $this -> load -> model('department');
       if($list = $this->department->update_department($id)){

            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
            $dept = $this->department->get_dept_name($id);
            
            $action =   "updated department info"; 
            $log_info = array(
            "activity_type"=>13,
            "executor"=>$this->session->userdata('id'),
            "executed_to"=>'',
            "description"=>"$name($role_1) $action ($dept))"
            ); 
           $this->activity_log->add_log($log_info);
            

           $this->show_success_msg("Informatin updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
        
    }
    
    public function change_dept_status($id='',$status=1){
        $id =  $this->input->post('id');
        $status = $this->input->post('status');

        if(empty($id)){
            $this->show_success_msg("The department id is invalid","error");
            return;
        }
        
        $this -> load -> model('department');
       if($list = $this->department->change_status($id,$status)){

            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role_1= $this->users->get_role_name($this -> session -> userdata('role'));
            $dept = $this->department->get_dept_name($id);
            
            $action =   $status ? "unlcoked":"locked"; 
            $log_info = array(
            "activity_type"=>$status ? 15:14,
            "executor"=>$this->session->userdata('id'),
            "executed_to"=>'',
            "description"=>"$name($role_1) $action a department ($dept))"
            ); 
           $this->activity_log->add_log($log_info);
            


           $this->show_success_msg("Department information updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
    }
    /*
     * Roles
     */
     
     public function add_role(){
            $this->show_add_role_form();
        
    }
    
    public function save_role(){
        $this -> form_validation -> set_rules('name', 'Role name', 'trim|required|xss_clean|is_unique[role.name]');
        $this -> form_validation -> set_rules('description', 'Role location', 'trim|required|xss_clean');
        
        if ($this -> form_validation -> run() == FALSE) {
         $this->show_add_role_form();
         return;       
        }
        $id = $this->input->post('id');
        $this -> load -> model('users');
        $this -> load -> model('activity_log');
        $this -> load -> model('role');
       
        if($this->role->add_role()){
                $user = $this -> session -> userdata('id');
                $name = $this->users->get_full_name($user);
                $role_1 = $this->input->post('name');
                $role_2 = $this->users->get_role_name($this->users->get_role_by_id($user));
                $action =   "creadted"; 
                $log_info = array(
                "activity_type"=>16,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"\"$role_1\" role $action by $name($role_2)"
            ); 

           $this->activity_log->add_log($log_info);
        
            $this->show_success_msg("Role added successfully");
        }else{
            $this->show_success_msg("Failed ! try again later");
        }
    }

    function show_add_role_form($error = '') {
        $this -> load -> model('department');
        $this->generate_page("Admin :: Add role", array('add_role_form'=>array('ferror' => $error,'sections'=>$this->department->get_active_sections())));
        
    }
    
    public function show_role($id=''){
        $this -> load -> model('department');
        if($id=='all'){

            $this->load->model('role');
            $this->generate_page("Admin :: All roles",array('role_list'=>array('roles' => $this->role->get_role(),'sections'=>$this->department->get_active_sections())));
            
        }
        
    }

    public function edit_role(){
        $id = $this->input->post('id');
        $this -> load -> model('users');
        $this -> load -> model('activity_log');
        $this -> load -> model('role');
       
        if(empty($id)){
            $this->show_success_msg("The role id is invalid","error");
            return;
        }
        
        $this -> load -> model('role');
       if($list = $this->role->update_role($id)){
            $user = $this -> session -> userdata('id');
            $name = $this->users->get_full_name($user);
            $role_1 = $this->users->get_role_name($id);
            $role_2 = $this->users->get_role_name($this->users->get_role_by_id($user));
            $action =   "updated"; 
               $log_info = array(
                "activity_type"=>17,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"\"$role_1\" role $action by $name($role_2)"
            ); 

           $this->activity_log->add_log($log_info);
        
           $this->show_success_msg("Informatin updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
        
    }
    
    public function change_role_status(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this -> load -> model('users');
        $this -> load -> model('activity_log');
        $this -> load -> model('role');
       

        if(empty($id)){
            $this->show_success_msg("The role id is invalid","error");
            return;
        }
        
        if($list = $this->role->change_status($id,$status)){
        $user = $this -> session -> userdata('id');
        $name = $this->users->get_full_name($user);
        $role_1 = $this->users->get_role_name($id);
        $role_2 = $this->users->get_role_name($this->users->get_role_by_id($user));
        $action =   ($status)?"unclocked":"locked"; 
           $log_info = array(
                "activity_type"=>$status?33:18,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"\"$role_1\" role $action by $name($role_2)"
            ); 

           $this->activity_log->add_log($log_info);
        

           $this->show_success_msg("Role information updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
    }
    
    /*
     * Stock category
     */
     
     public function add_stock_category(){
            $this->show_add_stock_category_form();
        
    }
    
    public function save_stock_category(){
        $this -> form_validation -> set_rules('name', 'Stock category name', 'trim|required|xss_clean|is_unique[role.name]');
        $this -> form_validation -> set_rules('description', 'Stock category description', 'trim|required|xss_clean');
        if ($this -> form_validation -> run() == FALSE) {
         $this->show_add_stock_category_form();
         return;       
        }
        
        $this->load->model('stock_category');
        if($this->stock_category->add_stock_category()){

            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role = $this->users->get_role_name($this -> session -> userdata('role'));
            $cat = $this->input->post('name');

            $action =   "created stock cateogry"; 
               $log_info = array(
                "activity_type"=>23,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"$name($role) $action ($cat)"
            ); 

           $this->activity_log->add_log($log_info);


            $this->show_success_msg("Category added successfully");
        }else{
            $this->show_success_msg("Failed ! try again later");
        }
    }

    function show_add_stock_category_form($error = '') {
            $this->generate_page("Admin :: Add category", array('add_stock_category_form'=>array('ferror' => $error)));
        
    }
    
    public function show_stock_category($id=''){
        if($id=='all'){
            $this->load->model('stock_category');
            $this->generate_page("Admin :: Categories", array('stock_category_list'=>array('stock_categories'=>$this->stock_category->get_stock_category())));
            
        }
        
    }

    public function edit_stock_category(){
        $id = $this->input->post('id');

        if(empty($id)){
            $this->show_success_msg("The category id is invalid","error");
            return;
        }
        
        $this -> load -> model('stock_category');
       if($list = $this->stock_category->update_stock_category($id)){
            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role = $this->users->get_role_name($this -> session -> userdata('role'));
            $cat = $this->input->post('name');

            $action =   "updated stock cateogry"; 
               $log_info = array(
                "activity_type"=>24,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"$name($role) $action ($cat)"
            ); 

           $this->activity_log->add_log($log_info);


           $this->show_success_msg("Informatin updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
        
    }
    
    public function change_stock_category_status(){
        $id = $this->input->post('id');
        $status=$this->input->post('status');
        if(empty($id)){
            $this->show_success_msg("The category id is invalid","error");
            return;
        }
        
        $this -> load -> model('stock_category');
       if($list = $this->stock_category->change_status($id,$status)){

            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role = $this->users->get_role_name($this -> session -> userdata('role'));
            
            $cat = $this->stock_category->get_category_name($id);

            $action =   $status ? "unlocked category":"locked category"; 
               $log_info = array(
                "activity_type"=>$status ? 34 : 25,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"$name($role) $action ($cat)"
            ); 

           $this->activity_log->add_log($log_info);



           $this->show_success_msg("Category information updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
    }
    
    /*
     * Supplier
     */
     
     public function add_supplier(){
            $this->show_add_supplier_form();
        
    }
    
    public function save_supplier(){
        $this -> form_validation -> set_rules('name', 'Supplier name', 'trim|required|xss_clean|is_unique[role.name]');
        $this -> form_validation -> set_rules('description', 'Supplier description', 'trim|required|xss_clean');
        $this -> form_validation -> set_rules('address', 'Supplier address', 'trim|required|xss_clean');
        if ($this -> form_validation -> run() == FALSE) {
         $this->show_add_supplier_form();
         return;       
        }
        
        $this->load->model('supplier');
        if($this->supplier->add_supplier()){

            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role = $this->users->get_role_name($this -> session -> userdata('role'));
            
            $supplier = $this->input->post('name');

            $action =   "created supplier"; 
               $log_info = array(
                "activity_type"=>26,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"$name($role) $action ($supplier)"
            ); 

           $this->activity_log->add_log($log_info);



            $this->show_success_msg("Supplier added successfully");
        }else{
            $this->show_success_msg("Failed ! try again later");
        }
    }

    function show_add_supplier_form($error = '') {
            $this->generate_page("Admin :: Add supplier", array('add_supplier_form'=>array('ferror' => $error)));
        
    }
    
    public function show_supplier($id=''){
        if($id=='all'){
            $this->load->model('supplier');
            $this->generate_page("Admin :: Supplier list", array('supplier_list'=>array('suppliers' => $this->supplier->get_supplier())));
            
        }
        
    }

    public function show_activity_log($mode=''){
        $this->load->model('activity_log');
        $array = $this->activity_log->get_logs();
        //print_r($array);
        if($mode !='export'){
            $this->generate_page("Admin :: Activity log",array('user_activity'=>array('log'=>$array)));    
        }else{

            $this -> load -> library('Excel',array('activity_log.xls'));
            if ($this->excel == false)
                echo $excel -> error;


            $title = array('Sl. No.','Log id','Description', 'Date');
            $this->excel -> writeLine($title);


            for($i=0;$i<count($array);$i++){
                    $this->excel -> writeRow();
                    $this->excel -> writeCol($i+1);
                    $this->excel -> writeCol($array[$i]['id']);
                    $this->excel -> writeCol($array[$i]['description']);
                    $this->excel -> writeCol($array[$i]['date']);

                    
            }        
            
            $this->excel -> close();
            
            header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
            header("Content-Disposition: inline; filename=\"" . "Activity_log".date('Y-m-d_H:i:s') . ".xls\"");
            readfile('activity_log.xls');
            unlink('activity_log.xls');
        }
        
    }

    public function edit_supplier(){
        $id = $this->input->post('id');

        if(empty($id)){
            $this->show_success_msg("The supplier id is invalid","error");
            return;
        }
        
        $this -> load -> model('supplier');
       if($list = $this->supplier->update_supplier($id)){
            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role = $this->users->get_role_name($this -> session -> userdata('role'));
            
            $supplier = $this->input->post('name');

            $action =   "updated supplier info"; 
               $log_info = array(
                "activity_type"=>27,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"$name($role) $action ($supplier)"
            ); 

           $this->activity_log->add_log($log_info);

           $this->show_success_msg("Informatin updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
        
    }
    
    public function change_supplier_status(){
        $id = $this->input->post('id');
        $status =  $this->input->post('status');
        if(empty($id)){
            $this->show_success_msg("The supplier id is invalid","error");
            return;
        }
        
        $this -> load -> model('supplier');
       if($list = $this->supplier->change_status($id,$status)){
            $this->load->model('activity_log');

            $name = $this->users->get_full_name($this -> session -> userdata('id'));
            $role = $this->users->get_role_name($this -> session -> userdata('role'));
            
            $supplier = $this->supplier->get_supplier_name($id);

            $action =   $status?"unlocked supplier":"lock supplier"; 
               $log_info = array(
                "activity_type"=>$status?35:28,
                "executor"=>$this->session->userdata('id'),
                "executed_to"=> '',
                "description"=>"$name($role) $action ($supplier)"
            ); 

           $this->activity_log->add_log($log_info);


           $this->show_success_msg("Supplier information updated successfully","success");
       }else{
           $this->show_success_msg("Sorry ! something went wrong","error");
       }
    }
         
}

