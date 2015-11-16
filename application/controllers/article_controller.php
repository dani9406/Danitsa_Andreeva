<?php

class Article_Controller extends CI_Controller{
    function index(){
        $this->load->view('article_view');
    }
    
    function validate(){
        $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('content', 'Content', 'trim|required|max_length[200]');
        $this->form_validation->set_rules('author', 'Author', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('image', 'Image', 'callback_validate_image');
        
        if ($this->form_validation->run())
        {     
            
        }
        $this->load->view('article_view');
    }
    function validate_image(){
        $image_config = array(
            'allowed_types' => 'jpg|png|jpeg|bmp',
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
            $this->image_lib->initialize($resize);
            if ($this->image_lib->resize()){
                echo 'Upload is done.';
            } else {
                echo $this->image_lib->display_errors();
            }            
            return true;
        } else {
            $this->form_validation->set_message('validate_image',$this->upload->display_errors());
            return false;
        }
    }

}