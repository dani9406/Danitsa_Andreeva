<?php

class Registration_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('username') != '') {
            echo 'You are already logged in.';
            ?> <a href="<?php echo site_url('login_controller/logout') ?>">Logout</a><br/> <?php
            exit();
        }
    }

    function index() {
        $this->load->view('registration_view');
    }

    function validate() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[10]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');

        if ($this->form_validation->run()) {
            $key = md5(uniqid());
            if ($this->send_email($key)) {
                $user_data = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'email_verification_code' => $key
                );
                $this->load->model('users_model');
                $this->users_model->insert_users($user_data);
            } else {
                echo 'activation email was not sent successfully.';
            }
            // $this->load->view('registration_view');
        } else {
            $this->load->view('registration_view');
        }
    }

    function send_email($key) {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => '',
            'smtp_pass' => '',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('mimimama686@gmail.com', 'Dani');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Admin');
        $this->email->message(site_url('registration_controller/verify/' . $key));

        if ($this->email->send()) {
            echo 'Email sent.';
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function verify($verify_key) {
        $this->load->model('users_model');
        if ($this->users_model->verify_email($verify_key)) {
            echo 'your account is activated.';
        } else {
            echo 'activation failed.';
        }
    }

}
