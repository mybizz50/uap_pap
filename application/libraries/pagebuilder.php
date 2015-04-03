<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pagebuilder {
	public function __construct()
		{
		    $this->CI =& get_instance();
		}

    function extract_notification($notification){
        $this -> CI->load -> model('users');
        $msg = '';
        if($notification['from']==$this->CI->session->userdata('id')){
            $msg .= "You";
        }else{
            $msg .= $this->CI->users->get_full_name($notification['from']);
            
        }
        if($notification['action']==1){
            
            $msg .=" initialized a purchase";
        }
        
        if($notification['action']==5){
            $msg .=" forwarded a purchase";
        }
        
        if($notification['action']==2){
            $msg .=" rejected a purchase";
        }
        
        if($notification['action']==7){
            $msg .=" approved a purchase";
        }

        if($notification['action']==8){
            $msg .=" ordered to issue work order";
        }

        if($notification['action']==9){
            $msg .=" issued work order";
        }

        if($notification['action']==10){
            $msg .=" forwarded a bill";
        }

        if($notification['action']==11){
            $msg .=" issued a check";
        }

        if($notification['action']==12){
            $msg .=" singed a check and forwarded to you";
        }

        if($notification['action']==13){
            $msg .=" singed a check and approved the bill";
        }

        if($notification['action']==14){
            $msg .=" paid a bill";
        }

        if($notification['action']==15){
            $msg .=" reject a bill";
        }

        if($notification['action']==16){
            $msg .=" entered items in stock";
        }

        if($notification['action']==17){
            $msg .=" adjusted items in stock";
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

            if($this->CI->session->userdata('id')==$notification['to']){
                $url .='process/';
            }else{
                $url .='show/';
            }

            $url .=$notification['id'];

        }

        if($notification['origin_module']=='bill_process'){
            $url .='index.php/bill_process/';
            if($notification['relation']=='bills'){
                $url .='bills/';
            }

            $url .=$notification['id'];

        }


        return $url;
    }
    
    function get_notification_short_list($origin_module='all'){
        $this -> CI->load -> model('notification_model');
        $list = $this->CI ->notification_model->get_notifications($origin_module,$this->CI->session->userdata('id'));
        $short_list = array();
        foreach($list as $item){
            $short_list[]=array('msg'=>$this->extract_notification($item),'url'=>$this->make_url($item),'ago'=>$this->timeAgo($item['date'],strtotime("now")));
        }
		
		//$this->print_a($list);
        return $short_list;
    }




    function generate_page($title, $pdata, $page='purchase'){
            $this -> CI->load -> model('users');
            $this -> CI->load -> model('purchase_model');
            
            //print_r(expression);
            $name = $this->CI->users->get_full_name($this -> CI -> session -> userdata('id'));
            $data['header'] = $this -> CI->load -> view("templates/header", array('title' => $title), TRUE);
            $data['nav_logged'] = $this -> CI->load -> view("templates/nav_logged", 
                  array(
                    'name'=>$name,
                    'purchase_notification'=>$this->get_notification_short_list('purchase'),
                    'bill_notification'=>$this->get_notification_short_list('bill_process'),
                    'stock_notification'=>$this->get_notification_short_list('stock_management'),
                  ), TRUE);
				  
            $data['sidebar'] = $this -> CI->load -> view("templates/sidebar", array('access'=>$this->CI->users->get_role_defination($this ->CI-> session -> userdata('role'))), TRUE);
            $content = '';
            foreach($pdata as $name => $value){
                $content.=$this -> CI->load -> view("templates/".$name, $value, TRUE);
            }

            $data['content']=$content;
            $data['footer'] = $this -> CI->load -> view("templates/footer", '', TRUE);
			$this -> CI->load -> view('pages/'.$page, $data);
    }
}