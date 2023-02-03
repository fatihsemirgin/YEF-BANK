<?php
class Profile_set extends CI_Controller
{
    private $view_folder = "";

    public function __construct()
    {
        parent::__construct();

        $this->view_folder = "profile_v";
        $this->load->model("customer_model");
        $this->load->model("log_ins_model");
        $this->load->model("Transfer_model");
    }
    public function password()
    {
        $user = get_active_user();
        if ($user) {
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "change_password";
            $view_data->change_password = 0;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
    public function reset_password()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("available", "Password", "required|trim|min_length[6]|max_length[11]");
        $this->form_validation->set_rules("new", "Password_New", "required|trim|min_length[6]|max_length[11]");
        $this->form_validation->set_rules("repeat", "Password_Repeat", "required|trim|matches[new]");
        $this->form_validation->set_message(
            array(
                "required"     => "<b>{field} must be filled. ",
                "exact_length" => "<b>{field} must be exactly 11 characters in length.",
                "matches"        => "Passwords do not match.",
                "min_length"     => "<b>Your password is less than 6.",
                "max_length"     => "<b>Your password is more than 11."
            )
        );
        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "change_password";
        $view_data->change_password = 0;
        // print_r($view_data);
        if ($this->form_validation->run() == FALSE) {
            $view_data->form_error = true;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            $available = $this->input->post('available');
            $new = $this->input->post('new');
            // $repeat = $this->input->post('repeat');
            $user = get_active_user();
            if ($user) {
                $customer = $this->customer_model->getUserById(array("Identity_No" => $user->Identity_No));
                if ($customer->Password == $available) {
                    $result = $this->customer_model->update_password($new, array(
                        "Identity_No" => $user->Identity_No
                    ));
                    if ($result) {
                        $view_data->change_password = 1;
                        $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
                    }
                } else {
                    $view_data->change_password = -1;
                    $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
                }
            }
        }
    }
    public function contact_info()
    {
        $user = get_active_user();
        if ($user) {
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "contact_information";
            $view_data->contact = "";
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
    public function reset_contact_info()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("phone", "Phone No", "trim|exact_length[11]");
        $this->form_validation->set_rules("email", "E-mail", "trim|valid_email|is_unique[customer.Mail]");
        $this->form_validation->set_message(
            array(
                "required"     => "<b>{field} must be filled. ",
                "valid_email"    => "Please enter a valid e-mail address.",
                "exact_length" => "<b>{field} must be exactly 11 characters in length.",
                "is_unique"      => "<b>{field}</b> has been used before.",
            )
        );
        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "contact_information";
        $view_data->contact = "";
        if ($this->form_validation->run() == FALSE) {
            $view_data->form_error = true;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            $new_phone = $this->input->post("phone");
            $new_email = $this->input->post("email");
            if ($new_email == "" && $new_phone == "") {
                redirect(base_url("Profile_set/contact_info"));
            } else {
                $user = get_active_user();
                if ($user) {
                    // $customer = $this->customer_model->getUserById(array("Identity_No" => $user->Identity_No));
                    if ($new_phone != "") {
                        $this->customer_model->update_phone(array(
                            "Phone" => $new_phone
                        ), array(
                            "Identity_No" => $user->Identity_No
                        ));
                    }
                    if ($new_email != "") {
                        $this->customer_model->update_email(array(
                            "Mail" => $new_email
                        ), array(
                            "Identity_No" => $user->Identity_No
                        ));
                    }
                    $view_data->contact = "Done";
                    $user->Mail = $new_email;
                    $user->Phone = $new_phone;
                    $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
                }
            }
        }
    }
    public function records()
    {
        $user = get_active_user();
        if ($user) {
            $logins = $this->log_ins_model->pull_log_ins($user->Identity_No, 1);
            $wrong_logins = $this->log_ins_model->pull_log_ins($user->Identity_No);
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "login_records";
            $view_data->logins = $logins;
            $view_data->wrong_logins = $wrong_logins;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
    public function profile()
    {
        $user = get_active_user();
        if ($user) {
            $customer = $this->customer_model->getUserById(array(
                'Identity_No' => $user->Identity_No
            ));
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->customer = $customer;
            $view_data->sub_view_folder = "profile";
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
    public function history()
    {
        $user = get_active_user();
        if ($user) {
            $transcations = $this->Transfer_model->get_transactions($user->Customer_ID);
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "history";
            $view_data->transactions = $transcations;
            $view_data->change_password = 0;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
};
