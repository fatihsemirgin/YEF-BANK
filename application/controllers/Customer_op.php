<?php

class Customer_op extends CI_Controller
{
    private $view_folder = "";
    private $_customer;

    public function __construct()
    {
        parent::__construct();

        $this->view_folder = "customer_v";
        $this->load->model("customer_model");

        $this->load->model("Log_ins_model");

        $this->load->library("phpmailer_lib");
    }

    public function index()
    {
        if (get_active_user()) {
            redirect(base_url());
        }
        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "login";
       
        if($this->session->userdata('err')==1){
            $view_data->err = $this->session->userdata('err');
            $this->session->unset_userdata('err');
        }

        
        $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
    }

    public function login_form()
    {
        if (get_active_user()) {
            redirect(base_url());
        }
        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        if($this->session->userdata('wrong_login')==0){
            $view_data->error_log = $this->session->userdata('wrong_login');
            $this->session->unset_userdata('wrong_login');
        }
        $view_data->sub_view_folder = "login";

        $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
    }

    public function do_login()
    {

        if (get_active_user()) {
            redirect(base_url());
        }
        $this->load->library("form_validation");

        $this->form_validation->set_rules("identity", "Identity No", "required|trim|exact_length[11]");
        $this->form_validation->set_rules("password", "Password", "required|trim|min_length[6]|max_length[11]");

        $this->form_validation->set_message(
            array(
                "required"     => "<b>{field} must be filled. ",
                "exact_length" => "<b>{field} must be exactly 11 characters in length.",
                "min_length"     => "<b>Your password is less than 6.",
                "max_length"     => "<b>Your password is more than 11."
            )


        );

        if ($this->form_validation->run() == FALSE) {
            $view_data = new stdClass();

            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "login";
            $view_data->form_error = true;

            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        } else {
            $customer = $this->customer_model->get(
                array(
                    "Identity_No" => $this->input->post("identity"),
                    "Password"    => $this->input->post("password"),
                )
            );

            if ($customer) {
                date_default_timezone_set("Asia/Istanbul");
                $date = date('Y-m-d H:i:s');
                print_r($date);
                $log = array(
                    'Identity_No' => $customer->Identity_No,
                    'Date' => $date,
                    'Type' => 1
                );
                $this->Log_ins_model->add_login($log);

                $w_logins = $this->Log_ins_model->pull_log_ins($customer->Identity_No);
                $customer->log_ins = $w_logins;
                $this->session->set_userdata("customer", $customer);
                if ($customer->Wrong_Login === "1") {
                    $update = array(
                        'Wrong_Login' => "0"
                    );
                    $this->Log_ins_model->update($update, array(
                        "Identity_No" => $this->input->post("identity")
                    ));
                }
                redirect(base_url());
                $update = array(
                    'Wrong_Login=' => 0
                );
                $customer_id = $this->Log_ins_model->update(array(
                    "Identity_No" => $this->input->post("identity")
                ), $update);
            } else {
                $customer_id = $this->Log_ins_model->get(
                    array(
                        "Identity_No" => $this->input->post("identity")
                    )
                );
                if ($customer_id) {
                    date_default_timezone_set("Asia/Istanbul");
                    $date = date('Y-m-d H:i:s');
                    echo $date;
                    $data = array(
                        'Identity_No' => $customer_id->Identity_No,
                        'Date' => $date,
                        'Type' => 0
                    );
                    $update = array(
                        'Wrong_Login' => "1"
                    );
                    $this->Log_ins_model->update($update, array(
                        "Identity_No" => $this->input->post("identity")
                    ));
                    // $dateArray = date_parse_from_format('Y-m-d H:i:s', $date);
                    $this->Log_ins_model->add_login($data);
                }
                $this->session->set_userdata('wrong_login',0);
                redirect(base_url("customer_op/login_form"));
            }
        }
    }

    public function forgot_password()
    {
        $view_data = new stdClass();

        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "forgot_password";

        $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/identity/index", $view_data);
    }

    public function send_code()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("identity", "Identity", "required|trim|exact_length[11]");
        $this->form_validation->set_message(
            array(
                "required"     => "<b>{field} must be filled. ",
                "exact_length" => "<b>{field} must be exactly 11 characters in length.",
            )


        );
        if ($this->form_validation->run() == FALSE) {
            $view_data = new stdClass();

            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "forgot_password";
            $view_data->form_error = true;

            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/identity/index", $view_data);

        }
        else {
            $customer = $this->customer_model->getUserById(
                array(
                    "Identity_No" => $this->input->post("identity")
                )
            );

            if ($customer) {
                $customer_as_array = json_decode(json_encode($customer), true);
                $code = rand(1000, 9999);
                $this->session->set_flashdata('code',$code);
                $this->session->set_flashdata('c_id',$customer_as_array["Identity_No"]);

                $this->send_verification_code($customer_as_array["Mail"], $code);
                echo "<script>alert('Mail has sent!')</script>";
    
                //            $_customer = $customer_as_array["Identity_No"];
    
                $view_data = new stdClass();
    
                $view_data->view_folder = $this->view_folder;
                $view_data->sub_view_folder = "forgot_password";
                $view_data->code = $code;
                $view_data->ID = $customer_as_array["Identity_No"];
    
                $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/verification/index", $view_data);
            } 
            else {
                $view_data = new stdClass();
                $view_data->view_folder = $this->view_folder;
                $view_data->sub_view_folder = "forgot_password";
                $view_data->not_found = true;
                $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/identity/index", $view_data);

                
            }
        
        

        }

        //        $view_data = new stdClass();
        //
        //        $view_data->view_folder = $this->view_folder;
        //        $view_data->sub_view_folder = "forgot_password";
        //
        //        $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/verification/index", $view_data);
    }

    public function do_reset()
    {
        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "forgot_password";

        $code = $this->session->flashdata('code');

        if ($code == $this->input->post("verification_code")) {
            //            echo "<script>alert('Yeni şifrenizi giriniz.')</script>";
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/password/index", $view_data);
        } else {
            echo "<script>alert('Wrong code entered!')</script>";
            $view_data->view_folder = $this->view_folder;
            $view_data->code = $code;

            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/verification/index", $view_data);
        }
    }

    public function reset_password()
    {
        $ID =$this->session->flashdata('c_id');
        $this->load->library("form_validation");

        $this->form_validation->set_rules("new_password", "Password", "required|trim|min_length[6]|max_length[11]");
        $this->form_validation->set_rules("password_again", "Re-Password", "required|trim|matches[new_password]");

        $this->form_validation->set_message(
            array(
                "required"       => "<b>{field}</b> must be filled.",
                "matches"        => "Passwords do not match.",
                "min_length"     => "You can not create a password with less than 6 characters",
                "max_length"     => "You can not create a password with more than 11 characters."
            )
        );

        $validate = $this->form_validation->run();

        $view_data = new stdClass();
        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "forgot_password";
        $view_data->form_error = true;

        if ($validate) {

            //            echo "<script>alert('Şifre Değiştiriliyor!')</script>";

            $response = $this->customer_model->update_password($this->input->post("new_password"), array(
                "Identity_No" => $ID
            ));

            if ($response == 1) {
                $this->session->set_userdata("err",1);
                redirect(base_url("customer_op"));
               
                //$view_data->sub_view_folder = "login";
               // $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
            } else {
                echo "<script>alert('Error occurred! Please try again!')</script>";
                $view_data->ID = $ID;
                $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/password/index", $view_data);
            }
        } else {
            $view_data->ID = $ID;
            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/password/index", $view_data);
        }
    }

    function send_verification_code($email, $code)
    {
        $mail = $this->phpmailer_lib->load();
        $mail->ClearAddresses();
        $mail->ClearAttachments();
        $mail->isSMTP();
        //        $mail->SMTPDebug = 1;
        // $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        // $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = 'ssl';
        $mail->CharSet = 'utf-8';
        $mail->Port = 465;

        $mail->setFrom = 'ykralcan@gmail.com';
        $mail->FromName = 'Yiğit Can Akçay';
        // $mail->setFrom = 'akcay.yigitc@gmail.com';

        // $mail->addAddress("ykralcan@gmail.com");
        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = "Mail gönderme denemesi";

        $mail->Body = "Your verification code: {$code}";


        try {
            $mail->send();
            //            echo "sent";
        } catch (\Throwable $th) {
            echo "Error occured while sending verification email.";
        }
    }

    public function register_form()
    {

        if (get_active_user()) {
            redirect(base_url());
        }

        $view_data = new stdClass();

        $view_data->view_folder = $this->view_folder;
        $view_data->sub_view_folder = "register";

        $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
    }
    public function do_register()
    {

        $this->load->library("form_validation");

        $this->form_validation->set_rules("first_name", "First Name", "required|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "required|trim");
        $this->form_validation->set_rules("email", "E-mail", "required|trim|valid_email|is_unique[customer.Mail]");
        $this->form_validation->set_rules("password", "Password", "required|trim|min_length[6]|max_length[11]");
        $this->form_validation->set_rules("re_password", "Re-Password", "required|trim|matches[password]");
        $this->form_validation->set_rules("identity", "Identity No", "required|trim|exact_length[11]|is_unique[customer.Identity_No]");
        $this->form_validation->set_rules("phone", "Phone No", "required|trim|exact_length[11]");

        $this->form_validation->set_message(
            array(
                "required"       => "<b>{field}</b> must be filled.",
                "valid_email"    => "Please enter a valid e-mail address.",
                "is_unique"      => "<b>{field}</b> has been used before.",
                "matches"        => "Passwords do not match.",
                "min_length"     => "You can not create a password with less than 6 characters",
                "max_length"     => "You can not create a password with more than 11 characters."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {
            $register = $this->customer_model->add(
                array(
                    "Identity_no" => $this->input->post("identity"),
                    "Mail" => $this->input->post("email"),
                    "Phone" => $this->input->post("phone"),
                    "First_Name" => $this->input->post("first_name"),
                    "Last_Name" => $this->input->post("last_name"),
                    "Password"  => $this->input->post("password")

                )
            );

            redirect(base_url());
        } else {
            $view_data = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $view_data->view_folder = $this->view_folder;
            $view_data->sub_view_folder = "register";
            $view_data->form_error = true;

            $this->load->view("{$view_data->view_folder}/{$view_data->sub_view_folder}/index", $view_data);
        }
    }
    public function logout()
    {
        $user = get_active_user();
        date_default_timezone_set("Asia/Istanbul");
        $date = date('Y-m-d H:i:s');
        $this->session->unset_userdata("customer");
        $this->Log_ins_model->add_login(array(
            'Identity_No' => $user->Identity_No,
            'Date' => $date,
            'Type' => '-1'
        ));
        redirect(base_url("main_menu"));
    }
}
