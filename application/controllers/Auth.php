<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Auth extends Application
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    
    function index()
    {
        $this->data['pagebody'] = 'login';
        $this->render();
    }
    
    function submit()
    {
        $key = $_POST['userid'];
        $user = $this->users->get($key);
        
        if (password_verify($this->input->post('password'), $user->password))
        {
            var_dump($key);
            $this->session->set_userdata('userID', $key);
            $this->session->set_userdata('userName', $user->name);
            $this->session->set_userdata('userRole', $user->role);
        }
        else
            echo "NO MATCH";
        
        header('Location: ../');
//        redirect('/');
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        header('Location: ../');
    }
}
