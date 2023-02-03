<?php
class Transfer_model extends CI_Model
{
    private $tableName = "customer";
    private $tableName2 = "account";
    private $tableName3 = "branch";
    private $tableName4 = "transaction";
    public function __construct()
    {
        parent::__construct();
    }
    public function get($id)
    {

        $query = "SELECT * FROM {$this->tableName2} 
        JOIN {$this->tableName} ON {$this->tableName2}.Identity_No = {$this->tableName}.Identity_No
        WHERE {$id} = {$this->tableName2}.Account_ID";
        return $this->db->query($query)->row();
    }
    public function get_valid($id, $amount)
    {

        $query = "SELECT * FROM {$this->tableName2} 
        JOIN {$this->tableName} ON {$this->tableName2}.Identity_No = {$this->tableName}.Identity_No
        WHERE {$id} = {$this->tableName2}.Account_ID AND {$this->tableName2}.Balance >={$amount}";
        return $this->db->query($query)->row();
    }
    public function get_recipient($id)
    {

        $query = "SELECT * FROM {$this->tableName2} 
        JOIN {$this->tableName} ON {$this->tableName2}.Identity_No = {$this->tableName}.Identity_No
        WHERE {$id} = {$this->tableName2}.Account_ID";
        return $this->db->query($query)->row();
    }
    public function get_all($id)
    {

        $query = "SELECT * FROM {$this->tableName} 
        JOIN {$this->tableName2} ON {$this->tableName}.Identity_NO = {$this->tableName2}.Identity_NO
        JOIN {$this->tableName3} ON {$this->tableName3}.Branch_ID = {$this->tableName2}.Branch_ID
        WHERE {$this->tableName}.Identity_No = {$id}";
        return $this->db->query($query)->result();
    }
    public function get_sender_accounts($account_id, $id)
    {
        $query = "SELECT * FROM {$this->tableName} 
        JOIN {$this->tableName2} ON {$this->tableName}.Identity_NO = {$this->tableName2}.Identity_NO AND {$this->tableName2}.Account_ID != {$account_id}
        JOIN {$this->tableName3} ON {$this->tableName3}.Branch_ID = {$this->tableName2}.Branch_ID
        WHERE {$this->tableName}.Customer_ID = {$id}";
        return $this->db->query($query)->result();
    }
    public function insert_transaction($iban, $iban_2, $id, $sender, $recipient)
    {
        $query = "INSERT INTO {$this->tableName4} VALUES ('{}','{$iban}','{$iban_2}','{$id}','{$sender}','{$recipient}','{0}', NOW(),'{0}')";
        return $this->db->query($query);
    }

    public function update($data = array(), $where = array())
    {
        $result = $this->db
            ->where($where)
            ->update("transaction", $data);
        return $result;
    }
    public function last_id($id, $order = "T_ID DESC")
    {
        $query = "SELECT * FROM {$this->tableName4}  
        WHERE {$this->tableName4}.Customer_ID = {$id}
        ORDER BY {$order} LIMIT 1";
        return $this->db->query($query)->row();
    }
    public function update_balance($data = array(), $where = array())
    {
        $result = $this->db
            ->where($where)
            ->update("account", $data);
        return $result;
    }
    public function delete_transaction()
    {
        // $this->db->query("ALTER TABLE personel AUTO_INCREMENT=1;");  
        // $query = "DELETE FROM {$this->tableName4}";
        $query = "TRUNCATE TABLE {$this->tableName4}";
        return $this->db->query($query);
    }
    public function reset_increment()
    {
        $query = "ALTER TABLE {$this->tableName4} AUTO_INCREMENT=1;";
        return $this->db->query($query);
    }
    public function last()
    {
        $str = $this->db->last_query();
        return $str;
    }
    // public function count()
    // {
    //     return $this->db->count_all('transaction');
    // }
    public function count($id)
    {
        $query = "SELECT Customer_ID,COUNT(*) FROM {$this->tableName4}
        WHERE {$this->tableName4}.Customer_ID = {$id}
        GROUP BY {$this->tableName4}.Customer_ID";
        return $this->db->query($query)->result();
    }

    public function get_IBAN($iban)
    {
        $query = "SELECT * FROM {$this->tableName2}
        JOIN  {$this->tableName} ON {$this->tableName}.Identity_No = {$this->tableName2}.Identity_No
        WHERE  {$this->tableName2}.IBAN = '{$iban}'";
        return $this->db->query($query)->row();
    }
    public function done($id, $order = "T_ID DESC")
    {
        $query = "SELECT Done FROM {$this->tableName4}
        WHERE {$this->tableName4}.Customer_ID = {$id}
        ORDER BY {$order} LIMIT 1";
        return $this->db->query($query)->row();
    }
    public function get_transactions($id)
    {
        $query = "SELECT * FROM {$this->tableName4}
        WHERE {$id}={$this->tableName4}.Customer_ID AND {$this->tableName4}.Done=1 ";
        return $this->db->query($query)->result();
    }
};
