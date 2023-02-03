<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_menu extends CI_Controller
{
    private $view_folder_name;
    private $currency_data;
    private $currency_list = array(
        "0"     => "XAU",
        "1"     => "EUR",
        "2"     => "USD",
        "3"     => "GBP",
        "4"     => "BTC",
        "5"     => "XAG"
    );

    //    private $view_sub_folder_name;

    public function __construct()
    {
        parent::__construct();
        $this->view_folder_name = "main_menu_v";
        $this->load->model("api_model");
        $this->load->model("Branch_Model");
        error_reporting(0); // for str_replace error
        //        $this->view_sub_folder_name = "";
    }

    public function index($data = array())
    {
        // $branches = $this->Branch_Model->get_all(array());
        $branches = $this->Branch_Model->query("CALL GetBranches();")->result(); // stored procedure is working
        $data_to_be_passed = new stdClass();
        $data_to_be_passed->view_folder_name = $this->view_folder_name;
        if (!$this->session->userdata("currency")) {
            $data_to_be_passed->currency = $this->screen_currencies();
        }
        $data_to_be_passed->branches = $branches;
        $this->load->view("{$data_to_be_passed->view_folder_name}/index", $data_to_be_passed, $branches);
    }

    //<<<<<<< Updated upstream

    //=======
    public function try()
    {
        echo "YOU MADE IT!";
    }

    public function screen_currencies(): array
    {
        //>>>>>>> Stashed changes
        $currency_data = array();


        $i = 0;
        foreach ($this->currency_list as $curr) {
            $latest_and_old = $this->foreign_currency_data($curr, "TRY");
            $latest = $latest_and_old["rates"][date("Y-m-d")];
            $old = $latest_and_old["rates"][date("Y-m-d", strtotime("yesterday"))];

            $latestVal      = floatval($latest["TRY"]);
            $oldVal         = floatval($old["TRY"]);
            $diff           = $latestVal - $oldVal;
            $rate           = ($diff / $oldVal) * 100;

            $this->currency_data[$i][0] = $curr;        //Currency Name
            $this->currency_data[$i][1] = $latestVal;   //Latest Value
            $this->currency_data[$i][2] = $rate;        //Increase Rate
            $i++;
        }
        //        $this->session->set_userdata("currency", $this->currency_data);
        $current_time = strtotime(date("H:i:s"));
        $end_time = strtotime("23:59:59");
        $this->session->set_tempdata('currency', $this->currency_data, $end_time - $current_time);
        return $this->currency_data;
    }



    public function foreign_currency_data($base, $to): array
    {

        $apiData = $this->api_model->connect_and_get_currency_data($base, $to);
        return json_decode($apiData, true);
    }

    public function retrieve_data()     //  Pull and print for districts
    {
        $q = intval($_GET['q']);
        $branch_data = $this->Branch_Model->get_districts($q);
        echo ' <form>
        <select name="branches" onchange=' . "showBranch(this.value,'info','showinfo')" . ' class="form-control text-center">
            <option value="">Select Branch:</option>';

        foreach ($branch_data as $branch) {
            echo '<option value=' . $branch->City . '>' . $branch->District . '</option>';
        }
        echo '
        </select>
        </form>';
    }
    public function show_info()      //  Pull and print for branch's address
    {
        $r = ($_GET['r']);
        $branch_data = $this->Branch_Model->get_info($r);
        echo '<h4 style="text-align:center;">Addresses</h4>
            
        ';
        foreach ($branch_data as $branch) {
            echo '<br><h4><address><pre>' . $branch->Address . '</pre></address></h4>';
        }
    }
}
