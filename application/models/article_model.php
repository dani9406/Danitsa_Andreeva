<?php

class Article_Model extends CI_Model {
    
    function article_details($article_data) {
        
         
      if ($this->db->insert('articles', $article_data)){
          echo 'Your stuff is in the database now.';
      }
      else{ 
          echo 'YOU ARE WRONG. :)';      
      }
    }
    
    function get_article_info($per_page, $row){
        $this->db->limit($per_page, $row);
        $query = $this->db->get('articles');
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
      function show_article($article_id) {
        $this->view_count($article_id);
        $result = $this->db->get_where('articles', array('article_id'=>$article_id))->row();        
        return $result;
        }
        
        function view_count($article_id){
            $result = $this->db->get_where('articles', array('article_id'=>$article_id))->row();
             $result->view_count++;
            $this->db->query("UPDATE `articles` SET `view_count`= $result->view_count WHERE article_id = $article_id");
        }
        
        function delete($article_id){
            $this->db->query("DELETE FROM `articles` WHERE `article_id`= $article_id");
        }
        
        
        function update($article_data, $update_id) {
            $this->db->where('article_id', $update_id);
            $this->db->update('articles', $article_data); 
        }
    }