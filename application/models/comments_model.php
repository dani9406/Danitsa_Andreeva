<?php
class Comments_model extends CI_Model {

    function add_comment($comment) {
        if ($this->db->insert('comments', $comment)) {
            echo 'success';
        } else {
            echo 'false';
        }
    }

    function show_comments($article_id) {
        $result = $this->db->get_where('comments', array('article_id' => $article_id));
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $comment[] = $row;
            }
            return $comment;
        }
    }
}
