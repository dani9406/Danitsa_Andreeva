<?php
session_start();

class Email_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cookie();
        if (!isset($_SESSION['username'])) {
            echo 'Access denied. <br/>';
            ?> <a href="<?php echo site_url('login_controller/') ?>">Login</a><br/> <?php
            exit();
        }
    }

    function index() {
        $this->Captcha();
        // $this->load->view('email_view'); 
    }

    function validate() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('content', 'Content', 'trim|required|max_length[200]');
        $this->form_validation->set_rules('captcha', 'Captcha', 'callback_Captcha_validate');

        if ($this->form_validation->run()) {
            if ($this->SendEmail()) {
                $this->load->model('email_model');
                $data = Array(
                    'receiver_name' => $this->input->post('name'),
                    'receiver_email' => $this->input->post('email'),
                    'receiver_phone' => $this->input->post('phone'),
                    'receiver_content' => $this->input->post('content')
                );
                $this->email_model->email_details($data);
            }
        }
        //$this->load->view('email_view');
        $this->Captcha();
    }

    function SendEmail() {
        $config = Array(
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

        $this->email->from('', 'User');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Email test');
        $this->email->message($this->input->post('content'));


        if ($this->email->send()) {
            echo 'Email sent.';
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function Captcha() {
        $captcha_generator = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $word = '';
        $count = 0;
        while ($count < 6) {
            $word .= $captcha_generator[mt_rand(0, 35)];
            $count++;
        }
        $captcha = array(
            'word' => $word,
            'img_path' => './captcha/',
            'img_url' => base_url() . '../captcha/',
            'font_path' => './font/impact.ttf',
            'img_width' => '200',
            'img_height' => '50',
            'expiration' => '3600'
        );
        $picture = create_captcha($captcha);
        $data['image'] = $picture['image'];
        $_SESSION['captcha_word'] = $word;
        $this->load->view('email_view', $data);
    }

    function Captcha_validate() {
        if ($this->input->post('captcha') == $_SESSION['captcha_word']) {
            return true;
        } else {
            $this->form_validation->set_message('Captcha_validate', 'Wrong captcha');
            return false;
        }
    }
    function cookie() {
        if (!isset($_SESSION['username'])) {
            if (isset($_COOKIE['username'])) {
                $this->load->model('users_model');
                if ($this->users_model->is_active($_COOKIE['username'])) {
                    $_SESSION['username'] = $_COOKIE['username'];
                    $this->load->model('users_model');
                    $_SESSION['is_admin'] = $this->users_model->is_admin($_SESSION['username']);
                } else {
                    echo 'You are not an active user.';
                    exit();
                }
            }
        }
    }

}
