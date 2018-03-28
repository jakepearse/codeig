<?php
class Message extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
        $this->load->library('session');
        $this->load->helper('url');
        
    }
    public function index() {
        if (!$this->session->userdata('login')) {
            redirect('login','refresh');
        } else {
            $data['menu']=true;
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
            $data['title']= 'Post';
            $this->form_validation->set_rules('message', 'Message', 'required');
            
            if ($this->form_validation->run() === FALSE) { //form validation fails
                $this->load->view('templates/header',$data);
                $this->load->view('post');
                $this->load->view('templates/footer');
            } else {
                $message = $this->input->post('message');
                $this->doPost($message);
            }
        }
    }

    public function doPost($post){
        $user = $this->session->userdata('username');
        $this->message_model->insertMessage($user,$post);
        redirect('/user/view/'.$user,'refresh');
    }
}
