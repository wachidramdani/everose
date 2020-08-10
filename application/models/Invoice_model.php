<?php

class Invoice_model extends CI_Model {
    function generate_invoice() {
        $date = date('Y-m-d');
        $date = $date." 00:00:00";
        $this->db->where('date_invoice >', $date);
        $num = $this->db->get("invoice")->num_rows();
        $num++;

        return date("Ymd").$num;
    }
    function post_invoice($data) {
        $this->db->insert("invoice",$data);
        $insertid = $this->db->insert_id();

        return $insertid;
    }

    function get_invoice($noinvoice) {
        $this->db->select("invoice.*,resi.no_resi");
        $this->db->from("invoice");
        $this->db->join("resi","resi.id_invoice=invoice.id_invoice","left");
        $this->db->where("invoice.no_invoice",$noinvoice);
        return $this->db->get();
    }

    function get_invoice_cetak($noinvoice) {
        $this->db->select('inv.id_invoice, inv.courier_invoice, inv.name_invoice, inv.address_invoice, inv.hp_invoice, inv.date_invoice, di.product_detail, di.qty_detail');
        $this->db->from("invoice as inv");
        $this->db->join("detail_invoice as di","di.id_invoice = inv.id_invoice","left");
        $this->db->where("no_invoice",$noinvoice);
        return $this->db->get();
    }

    function put_invoice($noinvoice,$data) {
        $this->db->where("no_invoice",$noinvoice);
        $this->db->update("invoice",$data);
    }

    function post_detail_batch($data) {
        $this->db->insert_batch('detail_invoice', $data);
    }

    function get_invoice_detail($id) {
        $this->db->select('`id_product`,`product_detail`,`qty_detail`,`price_detail`,`qty_detail` * `price_detail` as "sub_detail"',FALSE);
        $this->db->from("detail_invoice");
        $this->db->where("id_invoice",$id);
        return $this->db->get();
    }
    function delete_invoice($id) {
        $this->db->delete("invoice",['no_invoice' => $id]);
    }
    function get_total_range($date1,$date2) {
        $this->db->select("SUM(total_invoice) as total,SUM(shipping_invoice) as shipping,SUM(total_invoice + shipping_invoice) as grand");
        $this->db->from("invoice");

        $this->db->where("status_invoice",5);
        $this->db->where("date_invoice <=",$date2);
        $this->db->where("date_invoice >=",$date1);

        return $this->db->get();
    }

    function get_invoice_range($date1,$date2) {
        $this->db->where("status_invoice",5);
        $this->db->where("date_invoice <=",$date2);
        $this->db->where("date_invoice >=",$date1);

        return $this->db->get("invoice");
    }

    function get_list_invoice($data,$order = ["id_invoice","DESC"],$limit = [0,10]) {
        $this->db->order_by($order[0],$order[1]);
        if(is_array($limit)) {
            $this->db->limit($limit[1],$limit[0]);
        }
        return $this->db->get_where("invoice", $data);
    }

    function get_profit($data) {
        $this->db->select("SUM(total_invoice) as total,SUM(shipping_invoice) as shipping,SUM(total_invoice + shipping_invoice) as grand");

        return $this->db->get_where("invoice",$data);
    }

    function get_monthly($limit = [0,6]) {
        $this->db->select("MONTH(date_invoice) as month,YEAR(date_invoice) as year,COUNT(*) as hit");
        $this->db->from("invoice");
        $this->db->group_by("MONTH(date_invoice)");
        $this->db->limit($limit[1],$limit[0]);
        return $this->db->get();
    }

    function get_invoice_by_email($orderid) {
        return $this->db->get_where("invoice",["no_invoice" => $orderid]);
    }

    function update_stock($data) {
        $this->db->update_batch('product',$data, 'id_product');
    }

    function get_invoice_detail_byno($no) {
        $this->db->select('`id_product`,`product_detail`,`qty_detail`,`price_detail`,`qty_detail` * `price_detail` as "sub_detail"',FALSE);
        $this->db->from("detail_invoice");
        $this->db->where("no_invoice",$no);
        return $this->db->get();   
    }
} 