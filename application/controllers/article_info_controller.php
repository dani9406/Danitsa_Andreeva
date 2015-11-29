<?php

class Article_info_controller extends CI_Controller {
  





    function show_update($article_id) {
        $this->load->model('article_model');
        $article['row'] = $this->article_model->show_article($article_id);
        $_SESSION['is_up_to_date'] = true;
        $_SESSION['update_id'] = $article_id;
        $this->load->view('update_article_view', $article);
    }

}
