<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_account extends CI_Controller {
	private $profile_info;

	function __construct() {
		parent::__construct();

        $this->load->model('admin_model');

        if(!$this->session->login_status) {
            redirect(base_url('index.php/admin'));
		} else {
			$this->profile_info = $this->admin_model->profile_usn($this->session->usn)->row_array();
		}

        if($this->session->level != 1) {
            redirect(base_url('index.php/admin'));
        }

	}
	
	public function index()
	{
        
		$pushdata['admin_info'] = $this->profile_info;
		$this->load->view('admin/header',$pushdata);
		$this->load->view("admin/account/index",$pushdata);
		$this->load->view('admin/footer',$pushdata);
    }

    function add() {
        $this->proccess();
    }

    function delete($id) {
        $query = $this->admin_model->get_id($id);
        $data = $query->row();
        if($query->num_rows() < 1) {
            redirect(base_url('404'));
        }

        if($data->id_level != 1) {

            $photo = $data->photo_profile;

            $filebefore = '././'.$photo;
            if(is_readable($filebefore)) {
                unlink($filebefore);
            }

            $this->admin_model->delete_admin($id);
        }

        $response = [
            'status' => 1,
            'msg' => "Akun berhasil dihapus"
        ];

        echo json_encode($response);
    }

    function edit($id) {
        $query = $this->admin_model->get_id($id);
        if($query->num_rows() < 1) {
            redirect(base_url('404'));
        }

        $databefore = $query->row();

        $this->proccess("Edit",$id,$databefore);
    }

    function get($id) {
        $query = $this->admin_model->get_id($id);
        if($query->num_rows() < 1) {
            redirect(base_url('404'));
        }

        echo json_encode($query->row_array());
    }

    private function proccess($action = "add",$id = 0,$databefore = 0) {
        $data = $this->input->post();
        $rules = [
            [
                'field' => 'usn_admin',
                'label' => 'usn_admin',
                'rules' => 'required|alpha_numeric'
            ],
            [
                'field' => 'pass_admin',
                'label' => 'pass_admin',
                'rules' => 'required'
            ],
            [
                'field' => 'name_profile',
                'label' => 'name_profile',
                'rules' => 'required'
            ],
            [
                'field' => 'gender_profile',
                'label' => 'gender_profile',
                'rules' => 'required'
            ],
            [
                'field' => 'email_profile',
                'label' => 'email_profile',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'phone_profile',
                'label' => 'phone_profile',
                'rules' => 'required|numeric|min_length[11]|max_length[12]'
            ],
            [
                'field' => 'address_profile',
                'label' => 'address_profile',
                'rules' => 'required'
            ]
        ];

        $this->load->library('json_validate');

        $response = $this->json_validate->validate($data,$rules);

        if($action == "add") {
                $usncheck = TRUE;
        } else {
            if($databefore->usn_admin != $data['usn_admin']) {
                $usncheck = FALSE;
            }
        }

        if($usncheck) {
            if($this->admin_model->get_username($data['usn_admin'])->num_rows() > 0) {
                $response['status'] = 0;
                $response['error'] = [
                    [
                        'field' => 'usn_admin',
                        'msg' => 'Username telah digunakan'
                    ]
                ];
            }
        }

        if($response['status']) {
            $datatopost = [
                "id_admin" => NULL,
                "usn_admin" => $data['usn_admin'],
                "pass_admin" => password_hash($data['pass_admin'],PASSWORD_BCRYPT),
                "id_level" => 2
            ];
            $datatopost2 = [
                "id_profile" => NULL,
                "name_profile" => $data['name_profile'],
                "gender_profile" => $data['gender_profile'],
                "email_profile" => $data['email_profile'],
                "phone_profile" => $data['phone_profile'],
                "address_profile" => $data['address_profile']
            ];
        }

        if(!empty($_FILES['photo_profile']['name'])) {

            if($response['status']) {
                $this->load->helper("string");
                $this->load->helper("file");
                $name = time().random_string("numeric",8);
    
                $config['upload_path']          = '././upload/profile_pic';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1920;
                $config['file_name']            = $name;
                $config['overwrite']            = TRUE;
    
                $this->load->library('upload', $config);
    
                if ( ! $this->upload->do_upload('photo_profile'))
                {
                    $response['status'] = 0;
                    $response['error'][] = ['field'=>'photo_profile','msg'=>'Foto gagal diupload'];
                } else {
                    $result = $this->upload->data();
                    $datatopost2['photo_profile'] = "upload/profile_pic/".$result['file_name'];
                }
            }
        } else {
            if($action == "add") {
                $response['status'] = 0;
                $response['error'][] = ['field'=>'photo_profile','msg'=>'Pilih foto'];
            }
        }

        if($response['status']) {
            if($action == "add") {
                $insertid = $this->admin_model->post_admin($datatopost);
                $datatopost2['id_admin'] = $insertid;

                $this->admin_model->post_profile($datatopost2);
                $response['msg'] = "Akun telah ditambahkan";
            } else {
                unset($datatopost['id_admin']);
                unset($datatopost['id_level']);
                unset($datatopost2['id_profile']);

                if($databefore->pass_admin == $data['pass_admin']) {
                    unset($datatopost['pass_admin']);
                }

                $this->admin_model->set_admin($datatopost,$id);
                $this->admin_model->set_profile($datatopost2,$id);
                $response['msg'] = "Akun telah diperbaharui";
            }
        }

        echo json_encode($response);
    }

    function index_json() {
        $this->load->library("datatables");
        $this->datatables->select("*");
        $this->datatables->from("admin");
        $this->datatables->join("profile","profile.id_admin=admin.id_Admin","inner");
        $this->datatables->set_search_field("name_profile");
        $this->datatables->set_column([NULL,'usn_admin','name_profile','phone_profile','email_profile']);
        $list = $this->datatables->get_datatables()->result();
        $data = array();
        $no = $this->input->get('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->usn_admin;
            $row[] = $field->name_profile;
            $row[] = $field->phone_profile;
            $row[] = $field->email_profile;
            $row[] = '<button type="button" class="btn btn-dark btn-sm btn-show" data-toggle="modal" data-target="#addModal" data-action="Edit" data-id="'.$field->id_admin.'"><i class="fas fa-pen"></i></button> <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="'.$field->id_admin.'" data-name="'.$field->usn_admin.'"><i class="fas fa-trash"></i></button>';

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
}