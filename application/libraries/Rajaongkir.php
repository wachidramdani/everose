<?php
class Rajaongkir {
    private function base($type) {
        if($type == "starter") {
            return "https://api.rajaongkir.com/starter/";
        }
        if($type == "basic") {
            return "https://api.rajaongkir.com/basic/";
        }
        if($type == "pro") {
            return "https://pro.rajaongkir.com/api/";
        }
    }

    private function get_proccess($key,$endpoint,$base) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->base($base).$endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
    }

    function all_province($key,$type = "starter") {
        $response = $this->get_proccess($key,"province",$type);
        return json_decode($response,TRUE);
    }

    function all_city($key,$province,$type = "starter") {
        $response = $this->get_proccess($key,"city?province=$province",$type);
        return json_decode($response,TRUE);
    }

    function cost($key,$data,$type = "starter") {
        $curl = curl_init();

        $origin = $data['origin'];
        $destination = $data['destination'];
        $weight = $data['weight'];
        $courier = $data['courier'];

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->base($type)."cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: $key"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return json_decode($response,TRUE);

    }
}