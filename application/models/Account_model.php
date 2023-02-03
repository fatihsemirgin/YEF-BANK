<?php

class Account_model extends CI_Model{
    private $table_name = "account";

    
    public function __construct(){
        parent:: __construct();
    }
    

    public function get_with_iban($data){
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("account.IBAN",$data);
        return $this->db->get()->row();
    }
    public function get(){

        $user=get_active_user();

        if($user){
            $this->db->select('*');
            $this->db->from($this->table_name);
            $this->db->join('branch','account.Branch_ID=branch.Branch_ID','left');
            $this->db->where('account.Identity_No',$user->Identity_No); 
            return $this->db->get()->result();
            

        }
        else{
            return false;
        }        
    }

    public function add($data= array()){
         // $this->db->query("ALTER TABLE personel AUTO_INCREMENT=1;");  
         $IBAN = $data["IBAN"];
         $identity_no= $data["Identity_No"];
         $branch_id = $data["Branch_ID"];
         $balance = $data["Balance"];
 
 
         $sql = "INSERT INTO {$this->table_name} (IBAN,Identity_No,Branch_ID,Balance) VALUES ('{$IBAN}','{$identity_no}','{$branch_id}','{$balance}')";
         // echo "INSERT INTO {$this->tableName} VALUES ("{$identityNo}","{$mail}","{$phone}","{$firstName}","{$lastNames}");
         return $this->db->query($sql);
    }

    public function delete($data){
        $user = get_active_user();
        $this->db->where("Account_ID",$data);
        $this->db->where("Identity_No",$user->Identity_No);
        $this->db->delete($this->table_name);
    }
}