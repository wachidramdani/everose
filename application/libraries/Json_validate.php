<?php

class Json_validate {
    private $CI;

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('form_validation');
    }

    function validate($data,$rules) {
        $callback['status'] = 1;

        $arraymsg = [
            "required" => "{field}-Tidak boleh kosong",
            "valid_email" => "{field}-Email tidak valid",
            "numeric" => "{field}-Harus berupa angka",
            "min_length" => "{field}-Minimal {param} karakter",
            "max_length" => "{field}-Maximal {param} karakter",
            "matches" => "{field}-Harap konfirmasi"
        ]; 

        $this->CI->form_validation->set_data($data);
        
        $this->CI->form_validation->set_rules($rules);
        $this->CI->form_validation->set_message($arraymsg);

        if ($this->CI->form_validation->run() == FALSE) {
            $callback['status'] = 0;
            $error = explode("|",validation_errors("|","-"));
            for($i=1;$i<count($error);$i++) {
                $split = explode("-",$error[$i]);
                $tmpcall = [
                    "field" => $split[0],
                    "msg" => $split[1]
                ];
                $callback['error'][] = $tmpcall;
            }
        }

        return $callback;
    }
}