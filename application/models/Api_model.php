<?php

class Api_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function connect_and_get_currency_data($base, $to): string
    {
        $today = date("Y-m-d");
        $yesterday = date("Y-m-d", strtotime("yesterday"));
        $req_url = "https://api.exchangerate.host/timeseries?start_date={$yesterday}&end_date={$today}&base={$base}&symbols={$to}";

        $response_json = file_get_contents($req_url);

        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
//                    debug_to_console($response_json);
                    return $response_json;
                }
            } catch(Exception $e) {
//                echo $response_json->display_errors();
            }
        }
        return "Response is false.";
    }

    public function convert_data_for_calculator($amount, $base, $to) : String {
        $req_url = "https://api.exchangerate.host/convert?from={$base}&to={$to}&amount={$amount}";


        $response_json = file_get_contents($req_url);

        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
//                    debug_to_console($response_json);
                    return $response_json;
                }
            } catch(Exception $e) {
//                echo $response_json->display_errors();
            }
        }
        return "Response is false.";
    }
}