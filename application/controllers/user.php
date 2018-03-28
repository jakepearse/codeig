<?php
class User extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('message_model');
        $this->load->model('user_model');
        $this->load->helper('url');

    }
    
    public function view($name=false) {
        $data['index']=true;
        $data['followed']=false;
        $data['messages'] = $this->message_model->getMessageByPoster($name);
        $data['title'] = 'Messages';
        $this->load->view('templates/header',$data);
        if ($name!=false && $this->user_model->isFollowing($this->session->userdata('username'),$name) && $this->session->userdata('username') != $name) {
            $data['followed']=$name;
            
        }
        if ($name !=false) {
            $data['index']=false;
        }
        if (isset($this->session->userdata['login']) && $this->session->userdata['login']==true) {
            $data['user']=$this->session->userdata['username'];
        }
        $this->load->view('ViewMessages',$data);
        $this->load->view('templates/footer');
        //$this->output->enable_profiler(TRUE);
    }
    
    public function follow($follow) {
        $follower=$this->session->userdata['username'];
        $this->user_model->follow($follower,$follow);
        redirect('/user/view/'.$follow,'refresh');
        
    }
    
    public function feed($name=False){
	if (!isset($this->session->userdata['login'])){
	    redirect('/login','refresh');
	}
	if ($this->session->userdata['login']!=true){
            redirect('/login','refresh');
        }
        $name = ucwords($this->session->userdata['username']);
        $data['title']= $name."'s Feed";
        $data['messages'] = $this->message_model->getFollowedMessages($name);
        $this->load->view('templates/header',$data);
        $this->load->view('ViewMessages',$data);
        $this->load->view('templates/footer');
    }
    
    public function login() {

        $data['error']=Null;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
        $data['title']= 'Login';
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
                
        if ($this->form_validation->run() === FALSE) { //form validation fails
            $this->load->view('templates/header',$data);
            $this->load->view('login');
            $this->load->view('templates/footer');
        } else { //form is vaild
               $this->doLogin();
                }
        }
        
        public function doLogin(){
                $username = $this->input->post('username');
                $pass = $this->input->post('pass'); 
                if ($this->user_model->checkLogin($username,$pass)) {
                    $login_data = array('login'=>TRUE,'username'=>$username);
                    $this->session->set_userdata($login_data);
                    $this->load->helper('url');
                    redirect('/user/view/'.$username,'refresh');
                }else{
                redirect ('/login',refresh);
        }
    }
        
        public function logout(){
        $this->session->sess_destroy();
        $this->load->view('logout');
        }

}
