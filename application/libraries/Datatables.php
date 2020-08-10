<?php
class Datatables {
    private $CI;
    private $posted;
    private $table;
    private $search_field;
    private $join;
    private $from;
    private $group_by;
    private $column_order;
    private $select;
    private $where;

    function __construct() {
        $this->CI =& get_instance();
        $this->posted = $this->CI->input->get();
        $this->join = array();
        $this->select = "*";
        $this->where = array();
    }

    function set_column($var) {
        $this->column_order = $var;
    }

    function set_where($var1,$var2) {
        $this->where[] = array("col"=>$var1,"value"=>$var2);
    }

    function set_search_field($var) {
        $this->search_field = $var;
    }

    function join($var1,$var2,$var3) {
        $this->join[] = array($var1,$var2,$var3);
    }

    function group_by($var) {
        $this->group_by = $var;
    }

    function from($var) {
        $this->from = $var;
    }

    function select($var) {
        $this->select = $var;
    }

    private function generate_query() {

        if(!isset($this->search_field)) {
            $this->search_field = "name_".$this->from;
        }

        $this->CI->db->select($this->select);
        $this->CI->db->from($this->from);

        foreach($this->join as $join) {
            $this->CI->db->join($join[0],$join[1],$join[2]);
        }

        if(isset($this->group_by)) {
            $this->CI->db->group_by($this->group_by);
        }
 
        $i = 0;
     
        if(isset($this->posted['search']['value'])) {
            $this->CI->db->like($this->search_field, $this->posted['search']['value']);
        }

        foreach($this->where as $where) {
            $this->CI->db->where($where['col'],$where['value']);
        }
         
        if(isset($this->posted['order'])) 
        {
            $this->CI->db->order_by($this->column_order[$this->posted['order']['0']['column']], $this->posted['order']['0']['dir']);
        }
    }

    function get_datatables()
    {
        $this->generate_query();
        $this->CI->db->limit($this->posted['length'],$this->posted['start']);
        return $this->CI->db->get();
    }
 
    function count_filtered()
    {
        $this->generate_query();
        $query = $this->CI->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->CI->db->from($this->from);
        return $this->CI->db->count_all_results();
    }
}