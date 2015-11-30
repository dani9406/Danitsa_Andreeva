<?php

class Users_model extends CI_Model {

    function insert_users($user_data) {
        if ($this->db->insert('users', $user_data)) {
            echo 'success';
        } else {
            echo 'false';
        }
    }

    function verify_email($verify_key) {
        $this->db->where('email_verification_code', $verify_key);
        $activate_user = array(
            'is_active' => 1,
        );
        if ($this->db->update('users', $activate_user)) {
            return true;
        }
    }

    function login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function is_active($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('is_active', 1);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function is_admin($username) {
        $result = $this->db->query("SELECT is_admin FROM `users` WHERE `username` = '$username'")->row();
        $admin = (string) $result->is_admin;
        return $admin;
    }

    function show_users() {
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function delete_user($user_id) {
        $this->db->query("DELETE FROM `users` where user_id = '$user_id'");
    }

    function show_single_user($user_id) {
        $result = $this->db->get_where('users', array('user_id' => $user_id))->row();
        return $result;
    }

    function update_user($user_data, $user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $user_data);
    }

}
