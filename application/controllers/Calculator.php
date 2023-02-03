<?php
class Calculator extends CI_Controller
{
//    private $view_sub_folder_name;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("api_model");
//        $this->view_sub_folder_name = "";
    }

    public function index()
    {
        echo "YOU MADE IT!";
    }

    public function convert($amount, $from, $to) {
        $returned_value = $this->api_model->convert_data_for_calculator($amount, $from, $to);
        echo json_decode($returned_value, true)["result"];
    }
}