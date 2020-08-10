<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}
		$this->load->model("comment_model");
		$this->load->model("product_model");
		$this->load->model("invoice_model");
		$this->load->model("visitor_model");

	}
	
	public function index()
	{
		$datenow = date("Y-m-d")." 00:00:00";

		if($this->session->level != 1) {

			$pushdata['comments'] = $this->comment_model->get_list_comment([0,3])->result();
			$pushdata['stocks'] = $this->product_model->get_list_product(["stock_product <=" => 10,"stock_product >=" => 0],["stock_product","ASC"],[0,10])->result();

			$pushdata['num_send'] = $this->invoice_model->get_list_invoice(['status_invoice' => 3],NULL,0)->num_rows();
			$pushdata['num_success'] = $this->invoice_model->get_list_invoice(['status_invoice' => 5,"date_invoice >=" => $datenow],NULL,0)->num_rows();

			$pushdata['num_stock'] = $this->product_model->get_list_product(['stock_product' => 0],NULL,0)->num_rows();
		
			$pow = pow ( 10, 2 );
			$value = $this->comment_model->get_average_rating(); 
			$pushdata['num_rating'] = ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

			$load = "admin/dashboard/dashboard";

			
		} else {
			$chartquery = $this->invoice_model->get_monthly();
			$month = "";

			if($chartquery->num_rows() > 0) {

			$chart = $chartquery->result_array();

			$pushdata['chart'] = "";
			$text = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

			$firstmonth = $chart[0]['month'] - 1;
			$count = count($chart) - 1;
			$lastmonth = $chart[$count]['month'];
			$pushdata['title_chart'] = $text[$firstmonth]." ".$chart[0]['year']." - ".$text[$count]." ".$chart[$count]['year'];

			$i = 1;
			foreach($chart as $cht){
				$getnum = $cht['month'] - 1;
				if($i == count($chart)) {
					$month .= "'".$text[$getnum]."'";
					$pushdata['chart'] .= "'".$cht['hit']."'";
				} else {
					$month .= "'".$text[$getnum]."', ";
					$pushdata['chart'] .= "'".$cht['hit']."', ";
				}
				$i++;
			}

			$pushdata['month'] = $month;

			}

			$pushdata['num_comment'] = $this->comment_model->get_num_comment_where(['date_comment >=' => $datenow])->num_rows();

			$pushdata['num_new_order'] = $this->invoice_model->get_list_invoice(['status_invoice >=' => 3,'date_invoice >=' => $datenow],NULL,0)->num_rows();

			$profit = $this->invoice_model->get_profit(['status_invoice' => 5,'date_invoice >=' => $datenow])->row();

			$pushdata['num_profit'] = $this->toolset->rupiah_short($profit->total);
			$pushdata['num_visitor'] = $this->visitor_model->get_today();
			$pushdata['num_visitor_month'] = $this->visitor_model->get_month();
			$pushdata['num_visitor_year'] = $this->visitor_model->get_year();
			$pushdata['num_visitor_total'] = $this->visitor_model->get_total();

			$load = "admin/dashboard/index";
		}

		$pushdata['admin_info'] = $this->profile_info;
		$this->load->view('admin/header',$pushdata);
		$this->load->view($load,$pushdata);
		$this->load->view('admin/footer',$pushdata);
	}
}
