<?php
class Admin extends CI_Controller
{
    //    private $view_sub_folder_name;

    public function __construct()
    {
        parent::__construct();
        $this->view_folder = "admin_v";
        $this->sub_view_folder = "admin_v";
        $this->load->model("admin_model");
        $this->load->model("card_model");
        $this->load->model("Customer_model");
        $this->load->model("Branch_Model");
        //        $this->view_sub_folder_name = "";
    }

    public function index()
    {
        if ($this->session->userdata("admin")) {
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->account_table = $this->admin_model->get_table("account");
            $view_data->branch_table = $this->admin_model->get_table("branch");
            $view_data->card_table = $this->admin_model->get_table("card");
            $view_data->customer_table = $this->admin_model->get_table("customer");
            $view_data->log_ins_table = $this->admin_model->get_table("log_ins");
            $view_data->transaction_table = $this->admin_model->get_table("transaction");
            $view_data->account_changes_logs = $this->admin_model->get_table("account_changes_logs");
            $view_data->account_logs = $this->admin_model->get_table("account_logs");
            $view_data->customer_changes_log = $this->admin_model->get_table("customer_changes_log");
            $this->load->view("{$this->view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }

        //        print_r($this->admin_model->get_table("account"));
    }

    public function admin_login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");



        $this->load->library("form_validation");

        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("password", "Password", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"     => "<b>{field} must be filled. ",
            )
        );

        if (!$this->form_validation->run()) {
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "login";
            $view_data->form_error = true;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            if ($username == "admin" && $password == "admin") {
                $this->session->set_userdata("admin", "admin");
                redirect(base_url("admin"));
            } else {
                redirect("admin/login_page");
            }
        }
    }

    public function login_page()
    {
        print_r($this->session->userdata("admin"));
        if ($this->session->userdata("admin")) {
            redirect("admin/index");
        }

        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "login";
        $this->load->view("{$this->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
    }

    public function logout()
    {
        $this->session->unset_userdata("admin");
        redirect(base_url());
    }

    public function delete_account($data)
    {

        $delete_account = $this->admin_model->delete_account($data);

        if ($delete_account) {
            $delete_card = $this->card_model->delete($data);
            redirect(base_url("admin"));
        } else {
            redirect(base_url("admin"));
        }
    }

    public function delete_customer($data)
    {

        $delete_account = $this->admin_model->delete_customer($data);

        redirect(base_url("admin"));
    }
    public function edit_customer_page($id,$err=-1)
    {
        if ($this->session->userdata("admin")) {
            $user_data = $this->Customer_model->get_customer($id);
            $view_data = new stdClass();
            $view_data->error_add = $err;
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "edit_customer";
            $view_data->user_temp = $user_data;
            $this->load->view("{$this->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
    public function edit_customer($id)
    {
        $user_data = $this->Customer_model->get_customer($id);

        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "edit_customer";
        $view_data->user_temp = $user_data;
        $name = $this->input->post("first_name");
        $last_name = $this->input->post("last_name");
        if ($name == "" && $last_name == "") {
            redirect(base_url("Admin/edit_customer_page/$user_data->Customer_ID/-1"));
        } else {
            if ($name != "") {
                $this->Customer_model->update_name(array(
                    "First_Name" => $name
                ), array(
                    "Identity_No" => $user_data->Identity_No
                ));
            }
            if ($last_name != "") {
                $this->Customer_model->update_last_name(array(
                    "Last_Name" => $last_name
                ), array(
                    "Identity_No" => $user_data->Identity_No
                ));
            }
            redirect(base_url("Admin/edit_customer_page/$user_data->Customer_ID/0"));
            // $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        }
    }
    public function edit_branch_page($id,$err = -1)
    {
        if ($this->session->userdata("admin")) {
            $branch_data = $this->Branch_Model->get(array(
                'Branch_ID' => $id
            ));
            $view_data = new stdClass();
            $view_data->error_add = $err;
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "edit_branch";
            $view_data->branch_temp = $branch_data;
            $this->load->view("{$this->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
    public function edit_branch($id)
    {
        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "edit_branch";
        $view_data->user_temp = $user_data;
        $branch_data = $this->Branch_Model->get(array(
            'Branch_ID' => $id
        ));;

        $city = $this->input->post("city");
        $district = $this->input->post("district");
        $address = $this->input->post("address");
        $name = $this->input->post("name");
        if ($city == "" && $district == "" && $address == "" && $name == "") {
            redirect(base_url("Admin/edit_branch_page/$branch_data->Branch_ID/-1"));
        } else {
            if ($city != "") {
                $this->Branch_Model->update_city(array(
                    "City" => $city
                ), array(
                    "Branch_ID" => $branch_data->Branch_ID
                ));
            }
            if ($district != "") {
                $this->Branch_Model->update_district(array(
                    "District" => $district
                ), array(
                    "Branch_ID" => $branch_data->Branch_ID
                ));
            }
            if ($address != "") {
                $this->Branch_Model->update_address(array(
                    "Address" => $address
                ), array(
                    "Branch_ID" => $branch_data->Branch_ID
                ));
            }
            if ($name != "") {
                $this->Branch_Model->update_branch_name(array(
                    "Name" => $name
                ), array(
                    "Branch_ID" => $branch_data->Branch_ID
                ));
            }
            redirect(base_url("Admin/edit_branch_page/$branch_data->Branch_ID/0"));
            // $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);

        }
    }
    public function add_branch_page()
    {
        if ($this->session->userdata("admin")) {
            $view_data = new stdClass();
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "add_branch";
            $this->load->view("{$this->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            redirect(base_url());
        }
    }
    public function add_branch()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("city", "City", "required|trim|max_length[50]");
        $this->form_validation->set_rules("district", "District", "required|trim|max_length[50]");
        $this->form_validation->set_rules("address", "Address", "required|trim|max_length[100]");
        $this->form_validation->set_rules("name", "Name", "required|trim|max_length[50]");

        $this->form_validation->set_message(
            array(
                "required"       => "<b>{field}</b> must be filled.",
                "min_length"     => "You can not create a password with less than 6 characters",
                "max_length"     => "You can not create a password with more than 11 characters."
            )
        );

        $validate = $this->form_validation->run();
        $last_id = $this->Branch_Model->last_item();
        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "add_branch";
        $view_data->error_add = -1;
        if ($this->form_validation->run() == FALSE) {
       

            $view_data->form_error = true;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        }
        else{
            $city = $this->input->post("city");
            $district = $this->input->post("district");
            $address = $this->input->post("address");
            $name = $this->input->post("name");
            $check_data = $this->Branch_Model->check_query(array(
                'City' => $city,
                'District' => $district,
                'Address' => $address,
                'Name' => $name
            ));
            if(!$check_data){
                $data = array(
                    'Branch_ID' => $last_id->Branch_ID + 1,
                    'City' => $city,
                    'District' => $district,
                    'Address' => $address,
                    'Name' => $name
                );
                $this->Branch_Model->add_Branch($data);
                $view_data->error_add = 0;
                $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
            }
            else{
                $view_data->error_add = 1;
                $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
            }
        }
    }
}
