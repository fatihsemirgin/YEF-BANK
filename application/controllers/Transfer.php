<?php
class Transfer extends CI_Controller
{
    private $view_folder = "";

    public function __construct()
    {
        parent::__construct();

        $this->view_folder = "transfer_v";
        $this->load->model("transfer_model");
    }
    public function index()
    {
        $user = get_active_user();
        // var_dump($user->Identity_No);
        if ($user) {
            $accounts = $this->transfer_model->get_all($user->Identity_No);
            // echo "<pre>";
            // print_r($accounts);
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "transfer_between";
            $view_data->accounts = $accounts;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else
            redirect(base_url());
    }
    public function recipient()
    {
        $q = intval($_GET['q']);
        $user = get_active_user();
        $account = $this->transfer_model->get($q);
        $count = $this->transfer_model->count($user->Customer_ID);
        $tempp = $this->transfer_model->done($user->Customer_ID);
        if (!$count)   
            $this->transfer_model->insert_transaction(0, $account->IBAN, $account->Customer_ID, 0, $q);
        else if ($tempp !== null && $tempp->Done === "1") {

            $this->transfer_model->insert_transaction(0, $account->IBAN, $account->Customer_ID, 0, $q);
        } else {
            $transaction = $this->transfer_model->last_id($user->Customer_ID);
            $this->transfer_model->update(array(
                'IBAN_recipient' => $account->IBAN,
                'Recipient' => $account->Account_ID
            ), array(
                'T_ID' => $transaction->T_ID
            ));
        }
        $data_accounts = $this->transfer_model->get_sender_accounts($q, $user->Customer_ID);
        echo '<h4>Sender Account</h4>
        <div class="row">
        ';
        foreach ($data_accounts as $account) {
            echo '<div class="card col-sm-4 shadow text-center" style="width: 18rem;">
            <div class="card-body text-center ">';
            echo '<h5 class="card-title">' . $account->City . '</h5>';
            echo '<h6 class="card-subtitle mb-2 text-muted">' . $account->District . '</h6>';
            echo '<p class="card-text">Balance: ' . $account->Balance . '</p>';
            echo '<button onclick=' . "showTransfer("   . $account->Account_ID .  ",'amount','sender',this)";
            echo ' class="btn btn-primary" type="button">Select</button>';
            echo '</div>
            </div>
            ';
            //  '",'amount','sender')"'
        }
        echo '</div>';
    }
    public function sender()
    {
        $r = intval($_GET['r']);
        // var_dump($r);
        $user = get_active_user();
        $account = $this->transfer_model->get($r);
        $transaction = $this->transfer_model->last_id($user->Customer_ID);
        // var_dump($transaction);
        // $float_value_of_var = floatval($account->Balance);
        // var_dump($account->Balance);
        $this->transfer_model->update(array(
            'IBAN_sender' => $account->IBAN,
            'Sender' => $account->Account_ID
        ), array(
            'T_ID' => $transaction->T_ID
        ));

        echo '<hr><h4 class="mb-3 mt-2">Amount</h4>';
        echo '<div class="d-flex  justify-content-around">';
        echo '<label class="mr-3" for="currency-field">Enter Amount:</label>';
        echo '<input type="number" class="ml-3" name="currency-field" id="currency-field" step=0.001  placeholder="Format: $1,000">';
        echo '<button  onclick="amount()"  id="amount_btn" class="btn btn-primary ml-5" type="button">Send</button>';
        echo '</div>';
    }
    public function done()
    {
        $user = get_active_user();
        $d = ($_GET['d']);
        $amount = floatval(str_replace(array(','), '.', $d));
        // var_dump($amount);
        $transaction = $this->transfer_model->last_id($user->Customer_ID);
        // var_dump($transaction);
        /// SENDER
        $account = $this->transfer_model->get_valid($transaction->Sender, $amount);
        // echo '<pre>Sender';
        // print_r($account);
        if ($account) {
            $where = array(
                'Identity_No' => $account->Identity_No,
                'Account_ID' => $account->Account_ID
            );
            $data = array(
                'Balance' => ($account->Balance - $amount)
            );
            $this->transfer_model->update_balance($data, $where);

            /// Recipient
            $account2 = $this->transfer_model->get_recipient($transaction->Recipient);
            // echo '<pre>Recipient';
            // print_r($account2);

            $where_2 = array(
                'Identity_No' => $account2->Identity_No,
                'Account_ID' => $account2->Account_ID
            );
            $data_2 = array(
                'Balance' => ($account2->Balance + $amount)
            );
            $this->transfer_model->update_balance($data_2, $where_2);
            $this->transfer_model->update(array(
                'Done' => '1',
                'Amount' => $amount
            ), array(
                'T_ID' => $transaction->T_ID
            ));
            // $this->transfer_model->delete_transaction();
            echo '<h3><pre>The Transfer Has Been Done Successfully.</pre></h3>';
        } else {
            // $this->transfer_model->delete_transaction();
            echo '<h3><pre>      The Amount You Will Send is Not Available in Your Balance.</pre><br>
            <pre>Please Try Again With Another Amount or Account.</pre></h3>';
        }
    }
};
