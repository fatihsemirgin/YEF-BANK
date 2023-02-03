<?php
class Transfer_other extends CI_Controller
{
    private $view_folder = "";

    public function __construct()
    {
        parent::__construct();

        $this->view_folder = "transfer_v";
        $this->sub_view_folder = "transfer_other";
        $this->load->model("transfer_model");
    }
    public function index()
    {
        $user = get_active_user();
        // $accounts = $this->transfer_model->get_all($user->Identity_No);
        if ($user) {
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = $this->sub_view_folder;
            // $view_data->accounts = $accounts;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index_other", $view_data);
        } else
            redirect(base_url());
    }
    public function recipient_other()
    {
        $m = ($_GET['m']);
        $user = get_active_user();
        $iban = $this->transfer_model->get_IBAN($m);
        // var_dump($iban);
        if ($iban) {
            // print_r($iban);
            $count = $this->transfer_model->count($user->Customer_ID);
            //$this->transfer_model->insert_transaction(0,$iban->IBAN,$iban->Customer_ID,0,$iban->Account_ID);
            $tempp = $this->transfer_model->done($user->Customer_ID);
            if (!$count) {
                $this->transfer_model->insert_transaction(0, $iban->IBAN, $user->Customer_ID, 0, $iban->Account_ID);
            } else if ($tempp !== null && $tempp->Done === "1") {
                $this->transfer_model->insert_transaction(0, $iban->IBAN, $user->Customer_ID, 0, $iban->Account_ID);
            } else {
                $transaction = $this->transfer_model->last_id($user->Customer_ID);
                $this->transfer_model->update(array(
                    'IBAN_recipient' => $iban->IBAN,
                    'Recipient' => $iban->Account_ID
                ), array(
                    'T_ID' => $transaction->T_ID
                ));
            }
            $accounts = $this->transfer_model->get_all($user->Identity_No);
            // echo '<pre>';
            // print_r($iban);
            echo '<h5 class="col-sm-12"><pre>' . $iban->First_Name . "  " . $iban->Last_Name . '</pre></h5><hr>';
            foreach ($accounts as $account) {
                echo '<div class="card col-sm-4 shadow " style="width: 18rem;">';
                echo '<div class="card-body text-center ">';
                echo '<h5 class="card-title">' . $account->City . '</h5>';
                echo '<h6 class="card-subtitle mb-2 text-muted">' . $account->District . '</h6>';
                echo '<p class="card-text">Balance: ' . $account->Balance . ' $</p>';
                echo '<button onclick=' . "showTransfer_other("   . $account->Account_ID .  ",'send_part','send_amount',this)";
                echo ' class="btn btn-primary" type="button">Select</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<h4 class="text-center ml-auto mr-auto "><pre class="text-danger font-weight-bold">Invalid Or NonExistent IBAN , Please Enter a Valid IBAN</pre></h4>';
        }
    }
    public function sender_select()
    {
        $user = get_active_user();
        $g = ($_GET['g']);
        // var_dump($g);
        $account = $this->transfer_model->get($g);
        $transaction = $this->transfer_model->last_id($user->Customer_ID);
        // echo '<pre>';
        // print_r($transaction);
        // print_r($account);
        $this->transfer_model->update(array(
            'IBAN_sender' => $account->IBAN,
            'Sender' => $account->Account_ID
        ), array(
            'T_ID' => $transaction->T_ID
        ));
        // print_r($account);

        echo '<hr><h4 class="mb-3 mt-2">Amount</h4>';
        echo '<div class="d-flex  justify-content-around">';
        echo '<label class="mr-3" for="input_amount">Enter Amount:</label>';
        echo '<input type="number" class="ml-3" name="input_amount" id="input_amount" step=0.001  placeholder="Format: $1,000">';
        echo '<button  onclick="amount_other(' . "'amount_p'" . ')"' . 'id="amount_btn" class="btn btn-primary ml-5" type="button">Send</button>';
        echo '</div>';
    }
    public function send_amount()
    {
        $user = get_active_user();
        $g = ($_GET['v']);
        // var_dump($g);
        $amount = floatval(str_replace(array(','), '.', $g));
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
            echo '<h3><pre>The Transfer Has Been Done Successfully.</pre></h3>';
        } else {
            // $this->transfer_model->delete_transaction();
            echo '<h3><pre>      The Amount You Will Send is Not Available in Your Balance.</pre><br>
                <pre>Please Try Again With Another Amount or Account.</pre></h3>';
        }
    }
};
