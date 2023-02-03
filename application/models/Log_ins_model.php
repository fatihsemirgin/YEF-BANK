<?php 
class Log_ins_model extends CI_Model{

    public $tableName = "log_ins";

    public function __construct(){
        parent:: __construct();
    }
    public function add_login($data= array()){
        $identityNo = $data["Identity_No"];
        $date= $data["Date"];
        $type = $data["Type"];

        $sql = "INSERT INTO {$this->tableName} VALUES ('{$identityNo}','{$date}','{$type}')";
        return $this->db->query($sql);

    }
    public function get($where = array())
    {
        $result = $this->db
        ->where($where)
        ->get("customer")
        ->row();
        return $result;
    }
    public function pull_log_ins($id,$type=0,$order ="Date DESC")
    {   //SELECT * FROM `log_ins` ORDER BY Date DESC;
        $query = "SELECT Date FROM {$this->tableName} WHERE Identity_No = {$id} AND Type = {$type} ORDER BY {$order} LIMIT 5";
        return $this->db->query($query)->result();
    }

    public function update($data=array(),$where=array())
        {
            $result= $this->db
            ->where($where)
            ->update("customer",$data);
            return $result;
        }
}

; ?>
