<?php
class Search extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
        $this->load->helper('url');
    }
    
    public function index() {
        $data['title'] = 'Search';
        $this->load->view('templates/header',$data);
        $this->load->view('search');
        }
        
    public function doSearch() {
        $data['title'] = "search";
        $string = $this->input->get('search');
        $data['messages'] = $this->message_model->searchMessages($string);
        $this->load->view('templates/header',$data);
        $this->load->view('ViewMessages',$data);
        }
}
