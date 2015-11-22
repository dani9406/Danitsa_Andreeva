<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->CI = & get_instance();

$config['base_url'] = base_url().'article_info_controller/index';
$config['total_rows'] = $this->CI->db->get('articles')->num_rows();
$config['per_page'] = 3;
$config['num_links'] = 2;