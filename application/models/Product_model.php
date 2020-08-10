<?php
class Product_model extends CI_Model {
    function post_product($data) {
        $this->db->insert("product",$data);
        $insertid = $this->db->insert_id();

        return $insertid;
    }

    function put_product($data,$id) {
        $this->db->where("id_product",$id);
        $this->db->update("product",$data);

        return $id;
    }

    function post_photo($data) {
        $this->db->insert("photo_product",$data);
    }

    function get_photo($id) {
        return $this->db->get_where("photo_product",["id_photo" => $id]);
    }
    function del_photo($id) {
        return $this->db->delete("photo_product",["id_photo" => $id]);
    }

    function all_product() {
        $this->getter();
        return $this->db->get();
    }

    private function getter() {
        $this->db->select("product.*,photo_product.id_photo,photo_product.url_photo,category.name_category,(SUM(comment.rating_comment) / COUNT(comment.name_comment)) AS total_rating");
        $this->db->from("product");
        $this->db->join("photo_product","photo_product.id_product=product.id_product","left");
        $this->db->join("category","category.id_category=product.id_category","left");
        $this->db->join("comment","comment.id_product=product.id_product","left");
        $this->db->group_by("id_product");
        $this->db->order_by('id_product','DESC');
    }

    function myorder($nohandphone){
        $this->db->select("inv.*, di.*,pr.*, pp.url_photo");
        $this->db->from("invoice as inv");
        $this->db->join("detail_invoice as di","di.id_invoice=inv.id_invoice","left");
        $this->db->join("product as pr","pr.id_product=di.id_product","left");
        $this->db->join("photo_product as pp","pp.id_product=pr.id_product","left");
        $this->db->join("usercustomer as uc","uc.nohandphone=inv.hp_invoice","left");
        //$this->db->group_by("pr.name_product");
        $this->db->where("inv.hp_invoice", $nohandphone);

        return $this->db->get();
    }

    function related_product($id,$except) {
        $this->getter();
        $this->db->where("product.id_category",$id);
        $this->db->where_not_in('product.id_product',[$except]);
        $this->db->limit(8);

        return $this->db->get();
    }

    function get_product($id) {
        $this->db->select("product.*,photo.id_photo,photo.photo_product,category.name_category,rating.total_rating",FALSE);
        $this->db->from("product");
        $this->db->join("(SELECT id_product,GROUP_CONCAT(id_photo SEPARATOR ',') as id_photo,GROUP_CONCAT(url_photo SEPARATOR ',') as photo_product FROM `photo_product` GROUP BY `id_product`) AS photo","photo.id_product=product.id_product","left");
        $this->db->join("category","category.id_category=product.id_category","left");
        $this->db->join("(SELECT id_product,(SUM(comment.rating_comment) / COUNT(comment.name_comment)) AS total_rating FROM `comment` GROUP BY `id_product`) as rating","rating.id_product=product.id_product","left");
        $this->db->group_by("id_product");
        $this->db->where("product.id_product",$id);
        return $this->db->get();
    }

    function slide_product($id) {
        $this->db->select("url_photo",FALSE);
        $this->db->from("product");
        $this->db->join("photo_product","photo_product.id_product=product.id_product","left");
        $this->db->where("product.id_product",$id);
        return $this->db->get();
    }

    function delete_product($id) {
        $this->db->delete("product",["id_product" => $id]);
        $this->db->delete("comment",["id_product" => $id]);

        return TRUE;
    }

    function del_allphoto($id) {
        $this->db->delete("photo_product",["id_product" => $id]);
    }

    function get_allurlpic($id) {
        $this->db->select("GROUP_CONCAT(url_photo) as url");
        $this->db->from("photo_product");
        $this->db->group_by("id_product");
        $this->db->where("id_product",$id);
        return $this->db->get();
    }

    function get_list_product($data,$order = ["id_product","DESC"],$limit = [0,5]) {
        $this->db->order_by($order[0],$order[1]);
        if(is_array($limit)) {
            $this->db->limit($limit[1],$limit[0]);
        }
        return $this->db->get_where("product",$data);
    }
}