<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_order extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');
        $this->load->model("invoice_model");

        if(!$this->session->login_status) {
            redirect(base_url('admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}

	}
	
	public function index()
	{
        $pushdata['admin_info'] = $this->profile_info;
        $pushdata['pagetitle'] = "Orderan";
		$this->load->view('admin/header',$pushdata);
		$this->load->view('admin/order/index',$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    private function mapping(&$item,$key) {
        $arrayfield = ['sub_detail','total_invoice','price_detail','grand_invoice','shipping_invoice'];
        if(in_array($key,$arrayfield)) {
            $item = $this->toolset->rupiah($item);
        }
    }

    public function get_json($orderid) {
        $response = $this->invoice_model->get_invoice($orderid)->row_array();
        $response['grand_invoice'] = $response['total_invoice'] + $response['shipping_invoice'];
        $response['data'] = $this->invoice_model->get_invoice_detail($response['id_invoice'])->result_array();

        array_walk_recursive($response,array($this,'mapping'));

        echo json_encode($response);
    }

    private function create_json($thismonth = TRUE) {
        $this->load->library("datatables");
        $this->datatables->from("invoice");
        $this->datatables->set_column([NULL,"no_invoice","name_invoice","total_invoice","status_invoice","date_invoice"]);
        $this->datatables->set_search_field("no_invoice");

        if($thismonth) {
            $date_invoice = date("Y-m")."-01 00:00:00";
            $this->datatables->set_where("date_invoice >",$date_invoice);
        }

        if(!empty($this->input->get("status"))) {
            $this->datatables->set_where("status_invoice",$this->input->get("status"));
        }

        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            if($field->status_invoice > 2) {
                $row[] = "<td><input type='checkbox' class='check-item' name='idorder' value='".$field->no_invoice."'></td>";
            }else{
                $row[] = "";
            }
            $row[] = $no;
            $row[] = $field->no_invoice;
            $row[] = $field->name_invoice;
            $row[] = $this->toolset->rupiah($field->total_invoice + $field->shipping_invoice);
            $row[] = $this->toolset->order_status($field->status_invoice);
            $row[] = $field->date_invoice;

            $actionbtn = '<button type="button" class="btn btn-sm btn-success btn-detail" data-id="'.$field->no_invoice.'"><i class="fas fa-eye"></i></button>';

            if($field->status_invoice > 2) {
                $actionbtn .= ' <button type="button" class="btn btn-sm btn-dark btn-edit" data-id="'.$field->no_invoice.'"><i class="fas fa-pen"></i></button>';
            } else {
                $actionbtn .= ' <button type="button" class="btn btn-sm btn-dark" disabled><i class="fas fa-pen"></i></button>';
            }

            $row[] = $actionbtn;
 
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

    function index_json() {
        $this->create_json();
    }
    
    function allindex_json() {
        $this->create_json(FALSE);
    }

    function cetak(){
        $kode = $_POST['idorder'];
        $datacetak['cetak'] = $this->invoice_model->get_invoice_cetak($kode)->result();

        if($datacetak['cetak']['courier_invoice' == "JNE REG"] || $datacetak['cetak']['courier_invoice' == "JNE YES"] || $datacetak['cetak']['courier_invoice' == "JNE OKE"]){
            $datacetak['kurir'] = "<img style='width: 150px' src='https://sepatoe.id/assets/img/jne.png'>";
        }else{
            $datacetak['kurir'] = "<img style='width: 150px' src='https://sepatoe.id/assets/img/tiki.png'>";
        }

        $this->load->view('admin/order/cetaklabel', $datacetak);
    }

    function edit_resi() {
        $id = $this->input->post("id");
        $status = $this->input->post("status");
        $resi = $this->input->post("resi");

        $query = $this->invoice_model->get_invoice($id);
        $data = $query->row();

        //print_r($data);exit();

        if($query->num_rows() < 1) {
            $error = TRUE;
        }

        if($data->status_invoice < 3) {
            $error = TRUE;
        }

        if($status < 3) {
            $error = TRUE;
        }

        if(empty($resi)) {
            $error = TRUE;
        }

        if(empty($status)) {
            $error = TRUE;
        }

        if(!isset($error)) {
            $setdata = ["status_invoice" => $status];
            $residata = [
                "id_invoice" => $data->id_invoice,
                "no_resi" => $resi
            ];

            
            $this->invoice_model->put_invoice($id,$setdata);

            $this->load->model("resi_model");

            if($this->resi_model->get_resi($data->id_invoice)->num_rows() < 1) {
                $this->resi_model->post_resi($residata);
            } else {
                $this->resi_model->put_resi($data->id_invoice,$residata);
            }
        }

        $response['status'] = 1;
        $this->sendEmail($resi, $data);
        echo json_encode($response);
    }

    public function sendEmail($resi, $kurir){
        $this->load->library('mailer');
        $html = "<html>
                    <body>
                        <table style='width: 95%; margin: 30px; border: 1px solid'>
                            <tr>
                                <td style='background-color: #e6e6e6;'>
                                    <img style='margin: 20px; width: 150px' src='https://sepatoe.id/assets/cover.png'>
                                </td>
                            </tr>
                            <tr style='background-color: #FEFEFE'>
                                <td colspan='2'>
                                    <div style='height: 250px; color: #313131'>
                                        <p style='margin: 20px'>
                                            Halo '".$kurir->name_invoice."', <br>
                                            Terima kasih sudah berbelanja di <b>sepatoe.id</b> <br>
                                            Berikut ini adalah nomor resi pengiriman anda : ".$resi."<br>
                                            dengan kurir pengiriman ".$kurir->courier_invoice.".
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>
        ";

        $sendmail = array(
          'email_penerima'=> $kurir->email_invoice,
          'subjek'=>'No. Resi Pesanan No. Order : '.$kurir->no_invoice,
          'content'=>$html
          //'attachment'=>$attachment
        );
        if(empty($attachment['name'])){ // Jika tanpa attachment
          $send = $this->mailer->send($sendmail); // Panggil fungsi send yang ada di librari Mailer
        }else{ // Jika dengan attachment
          $send = $this->mailer->send_with_attachment($sendmail); // Panggil fungsi send_with_attachment yang ada di librari Mailer
        }
    }
}
