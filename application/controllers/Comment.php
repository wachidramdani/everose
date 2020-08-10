<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("comment_model");
    }

    function index($id = "0") {
        $query = $this->product_model->get_product($id);
        if($query->num_rows() < 1) {
            redirect(base_url("404"));
            die();
        }

        $data = $this->input->post();
        $rules = [
            [
                "field" => "name_comment",
                "label" => "Nama",
                "rules" => "required"
            ],
            [
                "field" => "email_comment",
                "label" => "Email",
                "rules" => "required|valid_email"
            ],
            [
                "field" => "body_comment",
                "label" => "Ulasan",
                "rules" => "required"
            ],
            [
                "field" => "rating_comment",
                "label" => "Rating",
                "rules" => "required|numeric"
            ]
        ];
        $this->load->library('json_validate');

        $response = $this->json_validate->validate($data,$rules);

        if($response['status']) {
            $data['id_product'] = $id;
            $data['date_comment'] = date("Y-m-d H:i:s"); 
            $this->comment_model->post_comment($data);
        }

        $response['csrf_regenerate'] = $this->security->get_csrf_hash();

        echo json_encode($response);
    }
}
?>