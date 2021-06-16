<?php

class ClientMaster extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ClientModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['res'] = $this->ClientModel->getClient();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/navbar.php');
        $this->load->view('dashboard/sidebar');
        $this->load->view('clientView/index', $data);
        $this->load->view('dashboard/footer');
    }

    public function add_Client()
    {
        //$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
        // $this->form_validation->set_rules('name','clientName','required',array('required'=>'*Client Name is required'));
        // $this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'* Email is Required','valid_email'=>'Enter a Valid Email'));
        // $this->form_validation->set_rules('phone','phone','required',array('required'=>'Phone No is Required'));
        // $this->form_validation->set_rules('address','address','required',array('required'=>'Address is required'));

        $config = array(
            array(
                'field' => 'name',
                'label' => 'clientName',
                'rules' => 'required|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => array(
                    'required' => '*Client Name is required',
                    'regex_match' => '* Only Character are Allowed'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|valid_email',
                'errors' => array('required' => '* Email is Required', 'valid_email' => '*Enter a Valid Email')
            ),
            array(
                'field' => 'phone',
                'label' => 'phone',
                'rules' => 'required|regex_match[/^[0-9]+$/]|exact_length[10]',
                'errors' => array('required' => '*Phone No is Required', 'regex_match' => '*Only Digit are Allowed', 'exact_length' => '*Phone no is invalid')
            ),
            array(
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required|alpha_numeric_spaces',
                'errors' => array('required' => '* Address is required', 'alpha_numeric_spaces' => '*Enter a Valid address')
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == False) {
           
            $array = array(
                'error'   => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'phone_error' => form_error('phone'),
                'address_error' => form_error('address')
            );
            echo json_encode($array);
        } else {


            $ClientData = array();
            $ClientData['ClientName'] = $this->input->post('name');
            $ClientData['email'] = $this->input->post('email');
            $ClientData['phone'] = $this->input->post('phone');
            $ClientData['address'] = $this->input->post('address');
            $ClientData['created_By'] = $this->session->userData('UserName');
            $ClientData['created_Date'] = date('Y-m-d');
            $this->ClientModel->addClient($ClientData);
            $data = array();
            $data['res'] = $this->ClientModel->getClient();
            $res = $this->load->view('clientView/table', $data, true);
            $array = array(
                'success' => '<div class="alert alert-success">Record Inserted </div>',
                'html' => $res
            );
            echo json_encode($array);
        }
    }



    public function delete_Client()
    {
        $ClientId = $this->input->post('clientId');
        $this->ClientModel->del_Client($ClientId);
        $data = json_encode($this->ClientModel->getClient());
        echo $data;
    }

    public function get_Client()
    {
        $ClientId = $this->input->post('clientId');
        $res = $this->ClientModel->getClientById($ClientId);
        $data = json_encode($res[0]);
        echo $data;
    }

    public function update_client()
    {
        $data = $this->input->post('clientData');
        //echo $data;
        $data = json_decode(html_entity_decode($data));
        $clientId = $data->clientId;
        $clientData = array();
        $clientData['clientName'] = $data->clientName;
        $clientData['email'] = $data->email;
        $clientData['phone'] = $data->phone;
        $clientData['address'] = $data->address;
        $this->ClientModel->upd_client($clientId, $clientData);
        $data = array();
        $data['res'] = $this->ClientModel->getClient();
        $res = $this->load->view('clientView/table', $data, true);
        echo $res;
    }
}
