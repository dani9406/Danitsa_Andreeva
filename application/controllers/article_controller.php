<?php
session_start();
class Article_Controller extends CI_Controller{
    function index(){
        $this->load->view('article_view');
    }
    
      public function upload_image() {
       $image_config = array(
                'allowed_types' => 'jpg|png|jpeg|bmp|gif',
                'upload_path' => './images/'
            );
        $this->load->library('upload', $image_config);
        if ($this->upload->do_upload('image')) {
            $data = $this->upload->data();
            $this->load->library('image_lib');
            $resize = array (
                'image_library' => 'gd2',
                'source_image' => './images/'.$data['file_name'],
                'maintain_ratio' => true,
                'width' => 250,
                'height' => 250
            );
            $_SESSION['image_path'] = 'http://localhost/ci_2.2.6/images/'.$data['file_name'];
            
            $this->image_lib->initialize($resize);
            if($this->image_lib->resize()) {
                echo 'yes';
            }
            else {
                echo $this->image_lib->display_errors();
            }            
            return true;
        } else {
            $this->form_validation->set_message('validate_image',$this->upload->display_errors());
            return false;
        }
     }
    
    function validate(){
        $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('content', 'Content', 'trim|required|max_length[200]');
        $this->form_validation->set_rules('author', 'Author', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('image', 'Image', 'callback_validate_image');
        
        if ($this->form_validation->run())
        {           
            return true;
        }  else {
            return false;
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
        public function validate_image() {
            if($_SESSION['is_up_to_date'] == true){
                if($this->input->post('delete_photo') == "checked"){
                    $_SESSION['image_path'] = '';
                    return TRUE;
                }
                else if($_FILES['image']['size'] == 0) {
                    return TRUE;
                }
                else{
                    $this->upload_image();
                }
            }
            else{
                $this->upload_image();
        }
    }
    
    function insert_article(){
         if($this->validate()){
        
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
        }
        else {            
            $this->load->view('article_view');
        }
    }
    function update(){
           if($this->validate()){
        
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
            $this->load->library('../controllers/article_info_controller');
            $this->article_info_controller->index();
        }
        else {
            echo 'Update is not up to date.';
        }
    }

}