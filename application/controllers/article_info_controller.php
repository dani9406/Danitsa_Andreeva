<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
class Article_info_controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->config->load('pagination', TRUE);
    }
    
    function index() {
        $per_page = $this->config->item('per_page', 'pagination');
        $row = $this->uri->segment(3);        
        $this->load->model('article_model');
        $data['row'] = $this->article_model->get_article_info($per_page, $row);
        $this->load->view('article_table_view', $data);
    }
     function article($article_id) {
        $this->load->model('article_model');
        $article['row'] = $this->article_model->show_article($article_id);
        $this->load->view('single_article_view', $article);
    }
    function delete_article($article_id){
        $this->load->model('article_model');
        $this->article_model->delete($article_id);
        $this->index();        
    }
    function update_article($article_id){
        $this->load->model('article_model');
        $article['row'] = $this->article_model->show_article($article_id);
        $_SESSION['is_up_to_date'] = true;
        $_SESSION['update_id'] = $article_id;
        $this->load->view('update_article_view', $article);
    }
}