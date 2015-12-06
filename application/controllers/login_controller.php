<?php

session_start();

class Login_controller extends CI_Controller {

    function index() {
        if (isset($_SESSION['username'])) {
            redirect("article_controller/show_articles/");
        } else {
            $this->load->view('login_view');
        }
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
        $password = md5($this->input->post('password'));
        $this->load->model('users_model');
        if ($this->users_model->login($username, $password)) {
            $this->is_active($username, $password);
        } else {
            $data['login_error'] = 'Wrong username/password.';
            $this->load->view('login_view', $data);
        }
    }

    function logout() {
        session_destroy();
        $this->load->helper('cookie');
        $this->input->set_cookie('username', null);
        redirect(site_url("login_controller/"));
    }

    function is_active() {
        $username = $this->input->post('username');
        $this->load->model('users_model');
        if ($this->users_model->is_active($username)) {
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
            $data['login_error'] = 'Account not activated.';
            $this->load->view('login_view', $data);
            return false;
        }
    }

}
