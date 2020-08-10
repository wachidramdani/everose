<?php
class Comment_model extends CI_Model {
    function post_comment($data) {
        $data = [
            "id_comment" => NULL,
            "id_product" => $data['id_product'],
            "name_comment" => $data['name_comment'],
            "email_comment" => $data['email_comment'],
            "body_comment" => $data['body_comment'],
            "rating_comment" => $data['rating_comment'],
            "date_comment" => $data['date_comment']
        ];

        $this->db->insert('comment',$data);
    }

    function get_allcomment($id) {
        $this->db->order_by("date_comment","DESC");
        return $this->db->get_where("comment",['id_product' => $id]);
    }

    function get_list_comment($limit = [0,5]) {
        $this->db->select("comment.*,product.name_product");
        $this->db->from("comment");
        $this->db->join("product","product.id_product=comment.id_product","left");
        $this->db->order_by("date_comment","DESC");
        $this->db->limit($limit[1],$limit[0]);
        return $this->db->get();
    }

    function get_num_comment_where($data) {
        return $this->db->get_where("comment",$data);
    }

    function get_average_rating() {
        $this->db->select("(SUM(rating_comment) / COUNT(id_comment)) as average");
        $this->db->from("comment");
        $average = $this->db->get()->row();
        $average = $average->average;
        return $average;
    }
}