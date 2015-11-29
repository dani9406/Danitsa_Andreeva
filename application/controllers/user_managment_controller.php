<?php
session_start();

class User_managment_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($_SESSION['is_admin'] != 1) {
            echo 'Only administrator can see this page';
            ?> <a href="<?php echo site_url('login_controller/') ?>">Login</a><br/> <?php
            exit();
        }
    }

    function index() {
        $this->show_users();
    }

    function validate() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('is_active', 'Activity', 'trim|required');

        if ($this->form_validation->run()) {
            return true;
        } else {
            return false;
        }
    }

    function show_users() {
        $this->load->model('users_model');
        $users_data['rows'] = $this->users_model->show_users();
        $this->load->view('user_managment_view', $users_data);
    }

    function update_user($user_id) {
        $this->load->model('users_model');
        $old_user_data = $this->users_model->show_single_user($user_id);
        if ($this->input->post()) {
            if ($this->validate()) {

                $user_data = array(
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'email' => $this->input->post('email'),
                    'is_active' => $this->input->post('is_active'),
                );
                $this->users_model->update_user($user_data, $user_id);
                redirect(site_url("user_managment_controller/"));
            } else {
                $user['row'] = (object) $this->input->post();
            }
        } else {
            $user['row'] = $old_user_data;
        }
        $this->load->view('update_user_view', $user);
    }

    function delete_user($user_id) {
        $this->load->model('users_model');
        $this->users_model->delete_user($user_id);
        redirect(site_url('user_managment_controller/'));
    }

}
