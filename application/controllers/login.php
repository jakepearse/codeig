<?php
Class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        $users=$this->load->model('user_model');
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
        
    }    
    
    public function auth() {
        $data['auth']=NULL;
        $data['error']=NULL;
        $data['title']='login';

        $this->form_validation->set_rules('uname', 'Username', 'required');
        $this->form_validation->set_rules('psword', 'Password', 'required');
                
        if ($this->form_validation->run() === FALSE) { //form validation fails
            $this->load->view('templates/header',$data);
            $this->load->view('login/index',$data);
            $this->load->view('templates/footer');
        } else { //form is vaild
                $safe_username = $this->input->post('uname');
                $safe_password = $this->input->post('psword');
                
                if ($this->user_model->auth_user($safe_username, $safe_password)) {
                    // if the model says auth is true
                    $auth_data = array('auth'=>TRUE,'uname'=>$safe_username);
                    $this->session->set_userdata($auth_data);
                    $data['auth']=$this->session->userdata('auth');
                    $data['uname']=$this->session->userdata('uname');
                    $this->load->view('templates/header',$data);
                    $this->load->view('login/index',$data);
                    $this->load->view('templates/footer');
                } else {
                    //computer says no
                    $data['error']='Sorry, username or password incorrect!';
                    $this->load->view('templates/header',$data);
                    $this->load->view('login/index',$data);
                    $this->load->view('templates/footer');
            }
    }
}
}
