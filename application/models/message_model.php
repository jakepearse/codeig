<?php
class message_model extends CI_Model
{
    
    public function __construct() {
        $this->load->database();
    }

    public function getMessageByPoster($name = False) {
        if ($name === False) {
            $query = $this->db->get('Messages');
            return $query->result_array();
        }
        $query = $this->db->get_where('Messages', array('user_username' => $name));
        return $query->result_array();
    }
    
    public function getFollowedMessages($name) {
        $sql = "SELECT * FROM Messages WHERE user_username in (SELECT followed_username from User_Follows WHERE follower_username =?) order by posted_at desc;";
        $results = $this->db->query($sql,array( $name)); 
        return $results->result_array();
        }
    
    public function searchMessages($string) {
        $this->db->select()->from('Messages')->like('text',$string);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function insertMessage($poster,$string) {
        // get the date_time
        $this->load->helper('date');
        $now=date('Y-m-d-H-m-s');
        $message = array('user_username'=>$poster,'text'=>$string,'posted_at'=>$now);
        $this->db->insert('Messages', $message);
    }
}
