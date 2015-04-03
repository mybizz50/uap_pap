<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends CI_Controller {

    private $elements_per_page = 2;

    function __construct() {
        parent::__construct();
        if ($this -> session -> userdata('logged_in') == FALSE) {
            redirect('/user', 'refresh');
        }

        $this -> load -> model('users');
        $access = $this->users->get_role_defination($this -> session -> userdata('role'));
        if(empty($access['stock_mod_access'])){
            redirect('/page/page_not_found', 'refresh');    
            
        }

        if($this -> session -> userdata('registration_completed')==0){
         redirect('/user/complete_registration', 'refresh');   
        }
    }

    public function index() {
        $this -> load -> model('purchase_model');
        $form_data = array("item_cats" => $this -> purchase_model -> getStockCategories(), "p_types" => $this -> purchase_model -> getPurchaseTypes(), "depts" => $this -> get_dept_list());
        $this->generate_page("Purchase report :: Search", array('purchase_search_form'=>$form_data));
 
    }

    private function get_dept_list() {
        $this -> load -> model('department');
        return $this -> department -> get_departments();

    }

    private function get_item_category_list() {
        $this -> load -> model('stock_category');
        return $this -> stock_category -> get_stock_category();
    }

    private function get_purchase_category_list() {
        $this -> load -> model('department');
        return $this -> department -> get_departments();

    }

    public function search_purchase() {
        if (trim($_GET['ds_id']) != '') {
            $this -> db -> where('ds_id', $_GET['ds_id']);
        }

        if (trim($_GET['purchase_category']) != '') {
            $this -> db -> where('purchase_category', $_GET['purchase_category']);
        }

        if (trim($_GET['item_category']) != '') {
            $this -> db -> where('item_category', $_GET['item_category']);
        }

        if (trim($_GET['purchase_type']) != '') {
            $this -> db -> where('purchase_type', $_GET['purchase_type']);
        }

        if (trim($_GET['payment_mode']) != '') {
            $this -> db -> where('payment_mode', $_GET['payment_mode']);
        }

        if (trim($_GET['purchase_status']) != '') {
            $this -> db -> where('purchase_status', $_GET['purchase_status']);
        }

        if (trim($_GET['distribution_status']) != '') {
            $this -> db -> where('distribution_status', $_GET['distribution_status']);
        }

        if (trim($_GET['estimated_cost_lower']) != '') {
            $this -> db -> where('estimated_cost <=', $_GET['estimated_cost_lower']);
        }

        if (trim($_GET['estimated_cost_upper']) != '') {
            $this -> db -> where('estimated_cost >=', $_GET['estimated_cost_upper']);
        }

        if (trim($_GET['date_from']) != '') {
            $this -> db -> where('created_date >=', $_GET['date_from']);
        }

        if (trim($_GET['date_to']) != '') {
            $this -> db -> where('created_date <=', $_GET['date_to']);
        }
        $res = $this -> db -> get('purchasing');
        return $res -> result_array();
    }

    private function make_readable_purchase_result($results) {
        $array = array();
        foreach ($results as $item) {
            if ($item['ds_id'] != '') {
                $item['ds_id'] = $this -> get_dept_name($item['ds_id']);
            }

            if ($item['item_category'] != '') {
                $item['item_category'] = $this -> get_cat_name($item['item_category']);
            }

            if ($item['purchase_type'] != '') {
                $item['purchase_type'] = $this -> getPurchaseType($item['purchase_type']);
            }

            if ($item['purchase_category'] != '') {
                $item['purchase_category'] = $this -> getPurchaseCat($item['purchase_category']);
            }

            if ($item['created_by'] != '') {
                $item['created_by'] = $this -> initiator_info($item['created_by']);
            }

            if ($item['payment_mode'] != '') {
                $item['payment_mode'] = $item['payment_mode'] ? "Cheque" : "Cash";
            }

            if ($item['purchase_status'] != '') {
                $item['purchase_status'] = $item['purchase_status'] ? "Work oder issued" : "In progress";
            }

            if ($item['distribution_status'] != '') {
                $item['distribution_status'] = $item['distribution_status'] ? "Distributed" : "Available";
            }

            $array[] = $item;

        }

        return $array;
    }

    public function initiator_info($id) {
        $this -> load -> model('purchase_model');
        $dept = $this -> purchase_model -> getDept($id);
        $user = $this -> purchase_model -> get_user_name($id);
        $role = $this -> purchase_model -> get_role_name_by_user_id($id);

        return $user . "(" . $role . ") ," . $dept['ds_name'];
    }

    public function getPurchaseType($id) {
        $this -> load -> model('purchase_model');
        return $this -> purchase_model -> getPurchaseTypeName($id);
    }

    public function getPurchaseCat($id) {
        $this -> load -> model('purchase_model');
        $ret = $this -> purchase_model -> getPurchaseInfo($id);
        return count($ret) ? $ret["name"] : "Undefined";
    }

    public function get_cat_name($id) {
        $this -> load -> model('stock_category');
        $cat = $this -> stock_category -> get_category_details($id);
        return $cat ? $cat['name'] : 'Undefined';
    }

    public function get_dept_name($id) {
        $this -> load -> model('department');
        $dept = $this -> department -> get_dept_details($id);
        return $dept ? $dept['ds_name'] : 'Undefined';
    }

    public function purchase_report() {
        $this -> load -> model('purchase_model');
        $form_data = array("item_cats" => $this -> purchase_model -> getStockCategories(), "p_types" => $this -> purchase_model -> getPurchaseTypes(), "depts" => $this -> get_dept_list());
        if (isset($_GET['search'])) {
            $get_q = $_GET;
            $this -> load -> library('paginator');
            $res = $this -> search_purchase();
            $page = !empty($_GET['page']) ? $_GET['page'] : 0;

            $this -> paginator -> items_total = count($res);
            $this -> paginator -> mid_range = 2;
            $this -> paginator -> items_per_page = $this -> elements_per_page;
            $this -> paginator -> default_ipp = $this -> elements_per_page;
            $result;
            if (isset($_GET['ipp']) AND $_GET['ipp'] == 'All') {
                $result =$this -> make_readable_purchase_result($res);
            } else {
                $result = $this -> make_readable_purchase_result(array_slice($res, ($page * $this -> elements_per_page) - 1, $this -> elements_per_page));
            }
             $get_q['print']=1;
            unset($get_q['search']);  
                
            $this->generate_page("Purchase report :: Search result", array('purchase_search_form'=>$form_data,
                              'purchase_search_result_table'=>array('result'=>$result),
                               'print_btn'=>array('purl'=>current_url()."/?".http_build_query($get_q)),
                               'pagination'=>array('pagination'=>$this -> paginator -> display_pages()) 
                               
                               ));
        } else if (isset($_GET['print'])) {
            $this -> load -> library('Excel',array('myxls.xls'));
            $this -> load -> library('paginator');
            $res = $this -> search_purchase();
            $res = $this -> make_readable_purchase_result($res);
            
            
            
            if ($this->excel == false)
                echo $excel -> error;

            for($i=0;$i<count($res);$i++){
                if($i==0){
                    $keyArr = array();
                    foreach($res[$i] as $key=>$value){
                        $keyArr[]=$key;
                    }
                    $this->excel -> writeLine($keyArr);
                }
                $this->excel -> writeRow();
                foreach($res[$i] as $key=>$value){
                        
                        $this->excel -> writeCol($value);
                    }
            }        
            
            $this->excel -> close();
            
            header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
            header("Content-Disposition: inline; filename=\"" . "Purchase_report_".date('Y-m-d_H:i:s') . ".xls\"");
            readfile('myxls.xls');
            unlink('myxls.xls');
            
        } else {
            $this->generate_page("Purchase report :: Search", array('purchase_search_form'=>''));
            
        }
    }

    function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    function array2csv(array &$array) {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    public function stock_report() {
        if (isset($_POST['search'])) {
            $this->generate_page("Purchase report :: Search results", array('form'=>'','result'));
            $this->generate_page("Purchase report :: Search results", array('stock_search_form'=>'','stock_search_result_table'));
        } else {

             $this->generate_page("Purchase report :: Search", array('stock_search_form'=>'','stock_search_result_table'));
        }

    }
    
    private function generate_page($title, $pdata, $page='purchase'){
        $this->load->library('pagebuilder');
        $this->pagebuilder->generate_page($title, $pdata, $page);    
    }

}
