<?php

class Card_op extends CI_Controller{
    private $view_folder ="";

    public function __construct(){
        parent::__construct();

        $this->view_folder = "card_v";
        $this->load->model("card_model");
    }

    public function index(){

        if(get_active_user()){
            $card = $this->card_model->get();

            
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->card_info = $card;
            $this->load->view("{$this->view_folder}/index",$view_data);
        }
        else{
            redirect(base_url());
        }
       
      
    }


}