<?php

class InvoiceMaster extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ClientModel');
        $this->load->model('ItemModel');
        $this->load->model('UserModel');
        $this->load->model('InvoiceModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['res'] = $this->InvoiceModel->invoice();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/navbar.php');
        $this->load->view('dashboard/sidebar');
        $this->load->view('Invoice/Invoice', $data);
        $this->load->view('dashboard/footer');
    }
    public function invoiceForm()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/navbar.php');
        $this->load->view('dashboard/sidebar');
        $this->load->view('Invoice/client');
        $this->load->view('dashboard/footer');
    }

    public function search_Name()
    {

        $name = $this->input->post('data');
        $res = $this->ClientModel->search($name);
        echo json_encode($res);
    }

    public function getClient()
    {
        $id = $this->input->post('clientId');
        $res = $this->ClientModel->getClientById($id);
        echo json_encode($res[0]);
    }
    public function search_Item()
    {
        $name = $this->input->post('data');
        $res  = $this->ItemModel->searchItem($name);
        echo json_encode($res);
    }

    public function getItem()
    {
        $id = $this->input->post('itemId');
        $res = $this->ItemModel->getItemById($id);
        echo json_encode($res[0]);
    }

    public function addInvoice()
    {
        $config = array(
            array(
                'field' => 'client',
                'label' => 'clientName',
                'rules' => 'required',
                'errors' => array(
                    'required' => '*Client Name is required',

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
                'rules' => 'required',
                'errors' => array('required' => '*Phone No is Required')
            ),
            array(
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required',
                'errors' => array('required' => '* Address is required')
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == False) {

            $array = array(
                'error'   => true,
                'name_Error' => form_error('client'),
                'email_Error' => form_error('email'),
                'phone_Error' => form_error('phone'),
                'add_Error' => form_error('address')
            );
            echo json_encode($array);
        } else {
            $invoiceArray = array();
            $invoiceArray['client_Id'] = $this->input->post('clientId');
            $invoiceArray['clientName'] = $this->input->post('client');
            $invoiceArray['phone'] = $this->input->post('phone');
            $invoiceArray['email'] = $this->input->post('email');
            $invoiceArray['address'] = $this->input->post('address');
            $invoiceArray['total'] = $this->input->post('total');
            $invoiceArray['created_Date'] = date('Y-m-d');
            $invoiceArray['created_By'] = $this->session->userdata('UserName');
            $invoiceArray['paid'] = $this->input->post('paid');
            $invoiceArray['due_pay'] = $this->input->post('due');
            $invoiceId = $this->InvoiceModel->insert_Invoice($invoiceArray);
            $count = $this->input->post('itemCount');
            $itemArray = array();
            for ($i = 1; $i <= $count; $i++) {
                $item_id = $this->input->post('itemId-' . $i);
                $price = $this->input->post('price-' . $i);
                $qty = $this->input->post('qty-' . $i);
                $item = array('invoice_id' => $invoiceId, 'item_Id' => $item_id, 'price' => $price, 'quantity' => $qty);
                array_push($itemArray, $item);
            }
            $this->InvoiceModel->insert_Purchase($itemArray);
            echo json_encode(array('success' => true));
        }
    }


    public function delete_Invoice()
    {
        $invoice_Id = $this->input->post('invoice_id');
        $this->InvoiceModel->delInvoice($invoice_Id);
        $data = array();
        $data['res'] = $this->InvoiceModel->invoice();
        $res = $this->load->view('Invoice/Table', $data, true);
        $array = array(
            'msg' => "<div class='alert alert-success'>Record Deleted Successfully</div>",
            'html' => $res
        );
        echo json_encode($array);
    }

    public function get_Invoice()
    {
        $id = $this->input->post('invoiceId');
        $res1 = $this->InvoiceModel->getInvoiceDetail($id);
        //print_r(json_encode($res1));
        $invoiceArray = array();
        $invoiceArray['invoice_Id'] = $res1[0]['invoice_id'];
        $invoiceArray['total'] = $res1[0]['total'];
        $invoiceArray['paid'] = $res1[0]['paid'];
        $invoiceArray['due_pay'] = $res1[0]['due_pay'];
        //print_r(json_encode($invoiceArray));
        $clientArray = $this->ClientModel->getClientById($res1[0]['client_Id']);
        //print_r(json_encode($clientArray));
        $itemArray = array();
        for ($i = 0; $i < count($res1); $i++) {
            $itemId = $res1[$i]['item_id'];
            $res = $this->ItemModel->getItemById($itemId);
            $res = $res[0];
            //print_r($res);
            //die;
            //$res['purchase_id'] = $res1[$i]['purchase_id'];
            $res['price'] = $res1[$i]['price'];
            $res['quantity'] = $res1[$i]['quantity'];
            $res['subtotal'] = $res1[$i]['price'] * $res1[$i]['quantity'];
            array_push($itemArray, $res);
        }

        $array = array(
            'clientDetail' => $clientArray[0],
            'itemDetail' => $itemArray,
            'invoiceDetail' => $invoiceArray
        );

        echo $this->load->view('Invoice/updInvoice', $array, true);
    }

    public function updInvoice()
    {
        $itemData = $this->input->post('itemData');
        $invoiceData = $this->input->post('invoiceData');

        $itemArray = json_decode($itemData);
        $invoiceArray = json_decode($invoiceData);
        $invoiceId = $invoiceArray->invoice_id;
        $this->InvoiceModel->updInvoiceDetail($invoiceArray, $itemArray, $invoiceId);
        $data['res'] = $this->InvoiceModel->invoice();
        $res = $this->load->view('Invoice/Table', $data, true);
        $array = array(
            'msg' => "<div class='alert alert-success'>Invoice Updated Successfully</div>",
            'html' => $res
        );
        echo json_encode($array);
    }

    public function pdfInvoice()
    {
        $id = $this->input->get('id');
        $res1 = $this->InvoiceModel->getInvoiceDetail($id);
        $itemArray = array();
        for ($i = 0; $i < count($res1); $i++) {
            $itemId = $res1[$i]['item_id'];
            $res = $this->ItemModel->getItemById($itemId);
            $res = $res[0];
            //print_r($res);
            //die;
            //$res['purchase_id'] = $res1[$i]['purchase_id'];
            $res['price'] = $res1[$i]['price'];
            $res['quantity'] = $res1[$i]['quantity'];
            $res['subtotal'] = $res1[$i]['price'] * $res1[$i]['quantity'];
            array_push($itemArray, $res);
        }
        $data = array('itemDetail' => $itemArray, 'invoiceDetail' => $res1);
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('Invoice/pdf', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
