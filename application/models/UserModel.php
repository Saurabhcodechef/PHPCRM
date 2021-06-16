<?php 

    class UserModel extends CI_model{
        public function __construct(){
            parent::__construct();
        }
        public function getAll(){
            return $this->db->get('usermaster')->result_array();
        }
        public function addUser($formArray){
            $this->db->insert('usermaster',$formArray);
        }

        public function get_user($id){
            $this->db->where('USERID',$id);
            return $this->db->get('usermaster')->result_array();
        }

        public function delete_user($id){
             $this->db->where('USERID',$id);
             $this->db->delete('usermaster');
        }

        public function user_by_email($email){
            $this->db->where('email',$email);
            return $this->db->get('usermaster')->result_array();

        }

        public function updateUser($userId,$formArray){
            $this->db->where('USERID',$userId);
            $this->db->update('usermaster',$formArray);
        }

    }

?>