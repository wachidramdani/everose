<?php
class Product_list extends CI_Model {
    private function generate_query() {
        $this->db->select("product.*,photo_product.id_photo,photo_product.url_photo,category.name_category,(SUM(comment.rating_comment) / COUNT(comment.name_comment)) AS total_rating",FALSE);
        $this->db->from("product");
        $this->db->join("photo_product","photo_product.id_product=product.id_product","left");
        $this->db->join("category","category.id_category=product.id_category","left");
        //$this->db->join("meta_value","meta_value.meta_value=product.id_category","left");
        $this->db->join("comment","comment.id_product=product.id_product","left");
        $this->db->group_by("id_product");
    }

    private function sort_by($raworder) {
        if(empty($raworder)) {
            $raworder = 'id_product-DESC';
        }
        $exp = explode("-",$raworder);
        $this->db->order_by($exp[0],$exp[1]);
    }

    private function category($raw) {
        if(!empty($raw)) {
            $this->db->where("category.id_category",$raw);
        }
    }

    private function metavalue($raw) {
        if(!empty($raw)) {
            $this->db->where("meta_value.meta_value",$raw);
        }
    }

    private function price($raw) {
        if(!empty($raw)) {
            $explode = explode("-",$raw);
            if(count($explode) > 1 AND is_numeric($explode[1])) {
                $this->db->where('price_product <=',$explode[1]);
            }
            if(is_numeric($explode[0])) {
                $this->db->where('price_product >=',$explode[0]);
            }
        }
    }

    function search($q,$raworder,$category,$price,$limit = "") {
        $this->generate_query();
        $this->db->like('name_product',$q);
        $this->category($category);
        $this->price($price);
        $this->sort_by($raworder);
        if(!empty($limit)) {
            $this->db->limit($limit[1],$limit[0]);
        }
        return $this->db->get();
    }
    function category_list($raworder,$category,$price,$limit = "") {
        $this->generate_query();
        $this->category($category);
        $this->price($price);
        $this->sort_by($raworder);
        if(!empty($limit)) {
            $this->db->limit($limit[1],$limit[0]);
        }
        return $this->db->get();
    }

    function showall($raworder,$price,$limit = "") {
        $this->generate_query();
        $this->price($price);
        $this->sort_by($raworder);
        if(!empty($limit)) {
            $this->db->limit($limit[1],$limit[0]);
        }
        return $this->db->get();
    }

    public function saveWishlist($datatopost)
    {
        $data =  $datatopost;
        $this->db->insert('wishlist', $data);
        return $this->db->affected_rows();
    }

    public function getWishlist($where)
    {
        $id =  $where;
        $this->db->select("pp.url_photo, pr.name_product, pr.price_product");
        $this->db->from("wishlist as ws");
        $this->db->join("usercustomer as uc","uc.nohandphone = ws.user_id","left");
        $this->db->join("product as pr","pr.id_product = ws.produk_id","left");
        $this->db->join("photo_product as pp","pp.id_product = pr.id_product","left");
        $this->db->where('ws.user_id',$id);
        return $this->db->get();
    }
}