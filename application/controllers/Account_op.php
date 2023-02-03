<?php

class Account_op extends CI_Controller{

    private $view_folder ="";

    public function __construct(){
        parent::__construct();

        $this->view_folder = "account_v";
        $this->load->model("account_model");
        $this->load->model("branch_model");
        $this->load->model("card_model");
    }

    public function index(){

        if(get_active_user()){
            $accounts = $this->account_model->get();

            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->account_info = $accounts;
            $view_data->sub_view_folder = "list";
            $this->load->view("{$this->view_folder}/{$view_data->sub_view_folder}/index",$view_data);
        }
        else{
            redirect(base_url());
        }
    }

    public function new_form(){

        if(get_active_user()){
            $branches = $this->branch_model->get_all();
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "add";
            $view_data->branch_info = $branches;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index",$view_data);
        }
        else{
            redirect(base_url());
        }


    }

    public function new_account(){
        $user = get_active_user();

        $IBAN_NO = create_iban();

        $add_account = $this->account_model->add(array(
            "IBAN" => $IBAN_NO,
            "Identity_No" => $user->Identity_No,
            "Branch_ID"  =>$this->input->post("branch_id"),
            "Balance"    => 500.00
        )
        
       
        
    );
    if($add_account){
        $date = date('Y-m-d', strtotime('+6 years'));
        $add_card = $this->card_model->add(array(
            "Card_No" =>  create_card_no(),
            "Account_ID" => $this->account_model->get_with_iban($IBAN_NO)->Account_ID,
            "Exp_Date" =>  $date,
            "CVV" => rand(100,999)
        )
       
    );
    
    }
    if($add_account){
        redirect(base_url("account_op"));
    }
    else{
        redirect(base_url("account_op/new_form"));
    }

    }

    public function delete_account($data){
        $user = get_active_user();

        $delete_account = $this->account_model->delete($data);

        if($delete_account){
            $delete_card = $this->card_model->delete($data);
            redirect(base_url("account_op"));

        }
        else{
            redirect(base_url("account_op"));
        }

    }
}