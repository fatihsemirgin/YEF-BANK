<?php
class Admin_model extends CI_Model {
    
    public function __construct(){
        parent:: __construct();
    }

    public function get_table($table_name){
        $sql ="SELECT * FROM {$table_name}";

        return $this->db->query($sql)->result_array();
    }

    public function delete_account($data){
        $this->db->where("Account_ID",$data);
        $this->db->delete("account");
    }

    public function delete_customer($data){
        $this->db->where("Customer_ID",$data);
        $this->db->delete("customer");
    }
}