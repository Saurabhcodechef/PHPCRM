<?php

class ClientModel extends CI_model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addClient($formArray)
    {
        $this->db->insert('clientmaster', $formArray);
    }

    public function getClient()
    {
        return $this->db->get('clientmaster')->result_array();
    }
    public function del_Client($clientId)
    {
        $this->db->where('ClientID', $clientId);
        $this->db->delete('clientmaster');
    }
    public function getClientById($clientId)
    {
        $this->db->where('ClientID', $clientId);
        return $this->db->get('clientmaster')->result_array();
    }

    public function upd_client($clientId, $formArray)
    {
        $this->db->where('ClientId', $clientId);
        $this->db->update('clientmaster', $formArray);
    }

    public function search($str)
    {
        $this->db->select(array('clientName', 'ClientID', 'phone', 'address', 'email'));
        $this->db->like('clientName', $str);
        return $this->db->get('clientmaster')->result_array();
    }
}
