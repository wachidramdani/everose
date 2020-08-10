<?php
class Midtrans extends CI_Model {
    function get_token($key,$order,$item,$customer) {
        $curl = curl_init();

        $payload['transaction_details'] = $order;
        $payload['item_details'] = $item;
        $payload['customer_details'] = $customer;
        $payload['callbacks'] = [
            "finish" => base_url("index.php/cart/myorder/").$payload['transaction_details']['order_id']
        ];
        $payload_json = json_encode($payload);
        $overridenotif = base_url("index.php/home/notif_midtrans");

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app.sandbox.midtrans.com/snap/v1/transactions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload_json,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "key: $key",
                "X-Override-Notification: $overridenotif"
            ),
            CURLOPT_USERPWD => "$key:"
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        
        if(curl_errno($curl)) {
            return $err;
        } else {
            return $response;
        }
        curl_close($curl);
    }

    function get_status($orderid,$serverKey) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/$orderid/status",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "key: $serverKey"
            ),
            CURLOPT_USERPWD => "$serverKey:"
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response,TRUE);

        return $response;
    }

    function get_access($which) {
        $query = $this->db->get_where("midtrans_api",['id_midtrans' => 1])->row();

        if($which == "serverkey") {
            return $query->serverkey_midtrans;
        }
        if($which == "clientkey") {
            return $query->clientkey_midtrans;
        }

    }

    function set_key($data) {
        $this->db->where("id_midtrans",1);
        $this->db->update("midtrans_api",$data);
    }
}