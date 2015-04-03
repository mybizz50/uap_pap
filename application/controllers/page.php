<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    $this->generate_page("404 :: Page not found", array('alerts'=> array('type'=>'error','msg'=>'Page not found')));
	}

	function __construct() {
		parent::__construct();
		if ($this -> session -> userdata('logged_in') == FALSE) {
			redirect('/user', 'refresh');
		}

		if($this -> session -> userdata('registration_completed')==0){
         redirect('/user/complete_registration', 'refresh');   
        }

        
	}

	public function page_not_found(){
		$this->generate_page("404 :: Page not found", array('alerts'=> array('type'=>'error','msg'=>'Page not found')));
	}

	public function home(){
		$this->generate_page("Home :: Welcome", array('alerts'=> array('type'=>'success','msg'=>'Welcome')));	
	}

     private function print_a($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        
    }



private function generate_page($title, $pdata, $page='purchase'){
        $this->load->library('pagebuilder');
        $this->pagebuilder->generate_page($title, $pdata, $page);    
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */