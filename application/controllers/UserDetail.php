<?php 

    class UserDetail extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('UserD');
        }
        public function index(){
            $data['res']=$this->UserD->getAll();
            $this->load->view('UserDetails/index',$data);
        }

        public function getUser(){
            $id=$this->input->post('userId');
            $data['res']=$this->UserD->getById($id);
            echo $this->load->view('UserDetails/table',$data,true);
            //echo $data;
        }
    }


?>