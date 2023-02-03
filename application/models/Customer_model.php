<?php

class Customer_model extends CI_Model
{

    public $tableName = "customer";
    public $colName = "Mail";
    public $colName2 = "Phone";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($where = array(), $order = "id ASC")
    {
        $sql = "SELECT * FROM {$this->tableName} ORDER BY {$order}";

        return $this->db->query($sql, $where)->row();
    }

    public function update_password($password, $where = array())
    {
        $sql = "UPDATE {$this->tableName} SET Password = {$password} WHERE Identity_No = ?";

        return $this->db->query($sql, $where);
    }
    public function update_email($mail, $where)
    {
        return $this->db->update($this->tableName, $mail, $where);
    }
    public function update_phone($phone, $where)
    {
        return $this->db->update($this->tableName, $phone, $where);
    }
    public function update_name($name, $where)
    {
        return $this->db->update($this->tableName, $name, $where);
    }
    public function update_last_name($last_name, $where)
    {
        return $this->db->update($this->tableName, $last_name, $where);
    }
    public function getUserById($where = array())
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE Identity_No = ?";

        return $this->db->query($sql, $where)->row();
    }

    public function get($where = array())
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE Identity_No = ? AND Password=?";

        return $this->db->query($sql, $where)->row();
    }

    public function add($data = array())
    {
        // $this->db->query("ALTER TABLE personel AUTO_INCREMENT=1;");  
        $identityNo = $data["Identity_no"];
        $mail = $data["Mail"];
        $phone = $data["Phone"];
        $firstName = $data["First_Name"];
        $lastName = $data["Last_Name"];
        $password = $data["Password"];


        $sql = "INSERT INTO {$this->tableName} (Identity_no,Mail,Phone,First_Name,Last_Name,Password) VALUES ('{$identityNo}','{$mail}','{$phone}','{$firstName}','{$lastName}','{$password}')";
        // echo "INSERT INTO {$this->tableName} VALUES ("{$identityNo}","{$mail}","{$phone}","{$firstName}","{$lastNames}");
        return $this->db->query($sql);
    }
    public function get_customer($id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE {$this->tableName}.Customer_ID = {$id}";
        return $this->db->query($query)->row();
    }
}
