<?php

class Email_Model extends CI_Model {
    
    function email_details($data) {
         
        $this->db->insert('email_send', $data);
    }
}
