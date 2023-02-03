<?php

class Card_model extends CI_Model{
    private $table_name = "card";

    
    public function __construct(){
        parent:: __construct();
    }
    

    public function get(){

        $user=get_active_user();

        if($user){
            $this->db->select('account.Balance,DATE_FORMAT(card.Exp_Date,"%m") AS dateM,DATE_FORMAT(card.Exp_Date,"%y") AS dateY,card.CVV,card.Card_No,customer.First_Name,customer.Last_Name');
            $this->db->from('customer');
            $this->db->join('account','customer.Identity_No=account.Identity_No','right');
            $this->db->join('card','card.Account_ID=account.Account_ID','right');
            $this->db->where('customer.Identity_No',$user->Identity_No);
           
            
            return $this->db->get()->result();
            

        }
        else{
            return false;
        }        
    }
    public function add($data= array()){
        // $this->db->query("ALTER TABLE personel AUTO_INCREMENT=1;");  
        $card_no = $data["Card_No"];
        $account_id= $data["Account_ID"];
        $exp_date = $data["Exp_Date"];
        $cvv = $data["CVV"];


        $sql = "INSERT INTO {$this->table_name} (Card_No,Account_ID,Exp_Date,CVV) VALUES ('{$card_no}','{$account_id}','{$exp_date}','{$cvv}')";
        // echo "INSERT INTO {$this->tableName} VALUES ("{$identityNo}","{$mail}","{$phone}","{$firstName}","{$lastNames}");
        return $this->db->query($sql);
   }
   
   public function delete($data){
    $user = get_active_user();
    $this->db->where("Account_ID",$data);
    $this->db->delete($this->table_name);
    }  
}