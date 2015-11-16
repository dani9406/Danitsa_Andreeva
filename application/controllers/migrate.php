<?php

class Migrate extends CI_Controller{
    
function index(){
   // $this->load->library('migration');
        if ($this->migration->latest())
        {
            echo 'success';
        }
        else {
            show_error($this->migration->error_string());
        }
    }


}
