<?php
session_start();

class Article_Controller extends CI_Controller {

    function index() {
        //$this->load->view('article_view');
    }

    function show_articles() {
        $this->cookie();
        $this->config->load('pagination', TRUE);
        $per_page = $this->config->item('per_page', 'pagination');
        $row = $this->uri->segment(3);
        $this->load->model('article_model');
        $data['row'] = $this->article_model->get_article_info($per_page, $row);
        $this->load->view('article_table_view', $data);
    }

    function show_single_article($article_id) {
        $this->cookie();
        $this->load->model('article_model');
        $article['row'] = $this->article_model->show_article($article_id);
        $this->load->view('single_article_view', $article);
    }

    function show_update($article_id) {
        $this->cookie();
        $this->is_admin();
        $this->load->model('article_model');
        $article['row'] = $this->article_model->show_article($article_id);
        $_SESSION['is_up_to_date'] = true;
        $_SESSION['update_id'] = $article_id;
        $this->load->view('update_article_view', $article);
    }

    function delete_article($article_id) {
        $this->cookie();
        $this->is_admin();
        $this->load->model('article_model');
        $this->article_model->delete($article_id);
        redirect(site_url('article_controller/show_articles'));
    }

    public function upload_image() {

        $is_update = $this->session->userdata('update');

        if ($is_update == 'yes' && $this->input->post('delete_photo') == "checked") {
            $_SESSION['image_path'] = '';
            return TRUE;
        } else if ($is_update == 'yes' && $_FILES['image']['size'] == 0) {
            return TRUE;
        } else {

            $image_config = array(
                'allowed_types' => 'jpg|png|jpeg|bmp|gif',
                'upload_path' => './images/'
            );
            $this->load->library('upload', $image_config);
            if ($this->upload->do_upload('image')) {
                $data = $this->upload->data();
                $this->load->library('image_lib');
                $resize = array(
                    'image_library' => 'gd2',
                    'source_image' => './images/' . $data['file_name'],
                    'maintain_ratio' => true,
                    'width' => 250,
                    'height' => 250
                );
                $_SESSION['image_path'] = 'http://localhost/ci_2.2.6/images/' . $data['file_name'];

                $this->image_lib->initialize($resize);
                if ($this->image_lib->resize()) {
                    echo 'yes';
                } else {
                    echo $this->image_lib->display_errors();
                }
                return true;
            } else {
                $this->form_validation->set_message('validate_image', $this->upload->display_errors());
                return false;
            }
        }
    }

    function validate() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('content', 'Content', 'trim|required|max_length[200]');
        $this->form_validation->set_rules('author', 'Author', 'trim|required|max_length[15]');
        //$this->form_validation->set_rules('image', 'Image', 'callback_validate_image');

        if ($this->form_validation->run()) {
            if ($this->upload_image()) {
                return TRUE;
            } else {
                echo 'You need to upload an image.';
            }
        } else {
            return FALSE;
        }
        //$this->load->model('article_model');
        // $this->load->helper('date');
        //// $time = now();
        //  $datestring = "%Y/%m/%d/%G:%i";
        //  $article_date = mdate($datestring, $time);
//               
//                $article_data = array (
//                    'article_title' => $this->input->post('title'),
//                    'article_content' => $this->input->post('content'),
//                    'article_author' => $this->input->post('author'),
//                    'article_image'=> $_SESSION['image_path'],  
//                    'article_date' => $article_date,
//                        );
//                $this->article_model->article_details($article_data);
//         }          
//        $this->load->view('article_view');
    }

//    public function validate_image() {
//        $is_update = isset($_SESSION['is_up_to_date']);
//        if ($is_update == true) {
//            if ($this->input->post('delete_photo') == "checked") {
//                $_SESSION['image_path'] = '';
//                return TRUE;
//            } else if ($_FILES['image']['size'] == 0) {
//                return TRUE;
//            } else {
//                $this->upload_image();
//            }
//        } else {
//            $this->upload_image();
//        }
//    }

    function insert_article() {
        $this->cookie();
        $this->is_logged();
        if ($this->validate()) {

            $this->load->model('article_model');

            $this->load->helper('date');
            $time = now();
            $datestring = "%Y/%m/%d/%G:%i";
            $article_date = mdate($datestring, $time);

            $article_data = array(
                'article_title' => $this->input->post('title'),
                'article_content' => $this->input->post('content'),
                'article_author' => $this->input->post('author'),
                'article_image' => $_SESSION['image_path'],
                'article_date' => $article_date,
            );
            $this->article_model->article_details($article_data);
            $this->show_articles();
        } else {
            $this->load->view('article_view');
        }
    }

    function update() {
        if ($this->validate()) {

            $this->load->model('article_model');

            $this->load->helper('date');
            $time = now();
            $datestring = "%Y/%m/%d/%G:%i";
            $article_date = mdate($datestring, $time);

            $article_data = array(
                'article_title' => $this->input->post('title'),
                'article_content' => $this->input->post('content'),
                'article_author' => $this->input->post('author'),
                'article_image' => $_SESSION['image_path'],
                'article_date' => $article_date,
            );
            $update_id = $_SESSION['update_id'];
            $this->article_model->update($article_data, $update_id);
            $_SESSION['is_up_to_date'] = false;
            $this->show_articles();
        } else {
            echo 'Update is not up to date.';
        }
    }

    function is_logged() {
        $this->cookie();
        if ($_SESSION['username'] == '') {
            echo 'Login to see.';
            ?> <a href="<?php echo site_url('login_controller/') ?>">Login</a><br/> <?php
            exit();
        } else {
            return true;
        }
    }

    function is_admin() {
        $this->cookie();
        if ($this->is_logged()) {
            if ($_SESSION['is_admin'] == 0) {
                echo 'Access denied for normal users.';
                ?> <a href="<?php echo site_url('article_controller/show_articles') ?>">Return home</a><br/> <?php
                exit();
            }
        }
    }

    function cookie() {
        if (isset($_COOKIE['username'])) {
            $_SESSION['username'] = $_COOKIE['username'];
            $this->load->model('users_model');
            $_SESSION['is_admin'] = $this->users_model->is_admin($_SESSION['username']);
        }
    }

}
