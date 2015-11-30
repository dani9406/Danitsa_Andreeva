<?php

session_start();

class Login_controller extends CI_Controller {

    function index() {
        $this->load->view('login_view');
    }

    function validate() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[10]');

        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->login($username, $password);
        } else {
            $this->load->view('login_view');
        }
    }

    function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('users_model');
        if ($this->users_model->login($username, $password)) {
            $this->is_active($username, $password);
        } else {
            echo 'Error.';
        }
    }

    function logout() {
        $_SESSION['username'] = '';
        $_SESSION['is_admin'] = 0;
        redirect(site_url("login_controller/"));
    }

    function is_active() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('users_model');
        if ($this->users_model->is_active($username, $password)) {
            $is_admin = $this->users_model->is_admin($username);
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = $is_admin;
            if (isset($_POST['remember'])) {
                $this->load->helper('cookie');
                $this->input->set_cookie('username', $username, 60);
            }
            redirect(site_url("article_controller/show_articles"));
            return true;
        } else {
            redirect(site_url("login_controller/"));
            echo 'Account not activated.';
            return false;
        }
    }

}
