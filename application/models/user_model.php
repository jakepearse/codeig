<?php
Class User_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
        }
     
     public function checkLogin($username, $pass) {
         
         $query = $this->db->get_where('Users', array ('username' => $username));
         $results = $query->row_array();
         
        
            if ($results['password'] == hash('sha1',$pass)) {
                return true;
            }
            
        return false;
    }
    
    public function isFollowing($follower,$followed) {
        $query=$this->db->get_where('User_Follows', array('follower_username'=>$follower,'followed_username'=>$followed));
        $results = $query->row_array();

        if (count($results)!=0) {//not sure if in will work
            return true;
        } else {
            return false;
        }
    }
    public function follow ($follower,$followed) {
        $user_follow = array('follower_username'=>$follower,'followed_username'=>$followed);
        $this->db->insert('User_Follows', $user_follow);
        
        }
}

