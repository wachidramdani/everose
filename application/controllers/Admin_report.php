<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_report extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
        }
        
        if($this->session->level != 1) {
            redirect(base_url('admin'));
        }

        $this->load->model("invoice_model");

	}
	
	public function index()
	{
        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['pagetitle'] = "Laporan Penjualan Rangkuman";

		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/report/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    private function date_split($range) {
        $range = explode("-",$range);
        $date1 = array_map("trim",explode("/",$range[0]));
        $date1 = $date1[2]."-".$date1[0]."-".$date1[1]." 00:00:00";
        
        $date2 = array_map("trim",explode("/",$range[1]));
        $date2 = $date2[2]."-".$date2[0]."-".$date2[1]." 00:00:00";

        if($date1 == $date2) {
            $date2 = str_replace("00:00:00","23:59:00",$date2);
        }

        $response[] = $date1;
        $response[] = $date2;

        return $response;
    }
    
    function create_json() {
        $range = $this->input->get("range");

        $this->load->library("datatables");
        $this->datatables->select("date_invoice,no_invoice,name_invoice,total_invoice,shipping_invoice,(total_invoice + shipping_invoice) as grand_invoice");
        $this->datatables->from("invoice");
        $this->datatables->set_column(["date_invoice","no_invoice","name_invoice","total_invoice","shipping_invoice","grand_invoice"]);
        $this->datatables->set_search_field("no_invoice");

        $getdate = $this->date_split($range);

            $this->datatables->set_where("date_invoice <=",$getdate[1]);
            $this->datatables->set_where("date_invoice >=",$getdate[0]);

            $this->datatables->set_where("status_invoice",5);

        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->date_invoice;
            $row[] = $field->no_invoice;
            $row[] = $field->name_invoice;
            $row[] = $this->toolset->rupiah($field->total_invoice);
            $row[] = $this->toolset->rupiah($field->shipping_invoice);
            $row[] = $this->toolset->rupiah($field->grand_invoice);
            $row[] = $field->date_invoice;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $this->input->get('draw'),
            "recordsTotal" => $this->datatables->count_all(),
            "recordsFiltered" => $this->datatables->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function total_json() {
        $range = $this->input->get("range");
        
        $getdate = $this->date_split($range);

        $result = $this->invoice_model->get_total_range($getdate[0],$getdate[1])->row();

        $response = [
            "total" => $this->toolset->rupiah($result->total),
            "shipping" => $this->toolset->rupiah($result->shipping),
            "grand" => $this->toolset->rupiah($result->grand)
        ];

        echo json_encode($response);
    }

    function pdf_report() {
        $range = $this->input->get("range");

        $getdate = $this->date_split($range);

        $push['data'] = $this->invoice_model->get_invoice_range($getdate[0],$getdate[1])->result();

        $textdate1 = date("l, j F Y",strtotime($getdate[0]));
        $textdate2 = date("l, j F Y",strtotime($getdate[1]));
        $push['range'] = $textdate1." - ".$textdate2;

        $title = "Laporan_penjualan_rangkuman_".$range.".pdf";
        $title = str_replace(" ","_",$title);
        $title = str_replace("/","-",$title);

        $this->load->library("pdf");

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $title;
        $this->pdf->load_view('admin/laporan_rangkuman',$push);

    }
}
