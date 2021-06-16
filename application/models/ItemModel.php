<?php 

    class ItemModel extends CI_model{
        public function __construct(){
            parent :: __construct();
        }
        public function addItem($formArray){
            $this->db->insert('itemmaster',$formArray);
        }
        public function getItem(){
            return $this->db->get('itemmaster')->result_array();
        }
        public function getItemById($itemId){
            $this->db->where('itemId',$itemId);
            return $this->db->get('itemmaster')->result_array();
        }
        public function del_Item($itemId){
            $this->db->where('itemId',$itemId);
            $this->db->delete('itemmaster');
        }

        public function upd_Item($itemId,$Upd_Detail){
                
                $this->db->where('itemId',$itemId);
                $this->db->update('itemmaster',$Upd_Detail);
        }
        public function searchItem($str){
            $this->db->select(array('itemName','itemId','price'));
            $this->db->like('itemName',$str);
            return $this->db->get('itemmaster')->result_array();
        }

    }
