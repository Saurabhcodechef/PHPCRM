<?php

class ItemMaster extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->model('ItemModel');
    }

    public function index()
    {
        $data['res'] = $this->ItemModel->getItem();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/navbar');
        $this->load->view('dashboard/sidebar');
        $this->load->view('itemView/index', $data);
        $this->load->view('dashboard/footer');
    }
    public function add_Item()
    {
        $this->form_validation->set_error_delimiters('<span class="errors" style="color:red;">', '</span>');
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Item Name',
                'rules' => 'required',
                'errors' => array('required' => 'Item Name is required')
            ),
            array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required|integer',
                'errors' => array('required' => 'Price is required', 'integer' => 'Only Number is allowed')
            ),
            array(
                'field' => 'itemImg',
                'label' => 'img',
                'rules' => 'required',
                'errors' => array('required' => 'Image is required')
            )

        );
        $imgdata['upload_path']          = './upload/';
        $imgdata['allowed_types']        = 'gif|jpg|png|mp4';
        $imgdata['max_size'] = '0';
        $this->form_validation->set_rules($config);
        $this->load->library('upload', $imgdata);
        if ((!$this->form_validation->run()) && (!$this->upload->do_upload('itemImg'))) {
            $array = array(
                'error'   => true,
                'name_error' => form_error('name'),
                'price_error' => form_error('price'),
                'upload_error' => $this->upload->display_errors()
            );
            echo json_encode($array);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $ItemData = array();
            $ItemData['itemName'] = $this->input->post('name');
            $ItemData['price'] = $this->input->post('price');
            $link = $this->input->post('link');
            $st1 = str_replace("watch?v=", "embed/", $link);
            $pos = strpos($st1, '&');
            if ($pos != '') {
                $st1 = str_split($st1, $pos);
                $st1 = $st1[0];
            }
            $ItemData['link'] = $st1;
            $ItemData['img'] = $this->upload->data('file_name');
            $ItemData['created_By'] = $this->session->userdata('UserName');
            $ItemData['created_Date'] = date('Y-m-d');
            $this->ItemModel->addItem($ItemData);
            $data = array();
            $data['res'] = $this->ItemModel->getItem();
            $res = $this->load->view('itemView/table', $data, true);
            $array = array(
                'success' => '<div class="alert alert-success">Record Inserted </div>',
                'html' => $res
            );
            echo json_encode($array);
        }
    }

    public function delete_Item()
    {
        $id = $this->input->post('itemId');
        $res = $this->ItemModel->getItemById($id);
        unlink('./upload/' . $res[0]['img']);
        $this->ItemModel->del_Item($id);
       
        $data['res'] = $this->ItemModel->getItem();
        $res = $this->load->view('itemView/table', $data, true);
        echo $res;
    }

    public function get_Item()
    {

        $id = $this->input->post('itemId');
        $res = $this->ItemModel->getItemById($id);
        $res[0]['img'] = base_url() . 'upload/' . $res[0]['img'];
        $data = json_encode($res[0]);
        echo $data;
    }
    public function update_Item()
    {
        $config = array(
            array(
                'field' => 'updName',
                'label' => 'Item Name',
                'rules' => 'required',
                'errors' => array('required' => 'Item Name is required')
            ),
            array(
                'field' => 'updPrice',
                'label' => 'Price',
                'rules' => 'required|integer',
                'errors' => array('required' => 'Price is required', 'integer' => 'Only Number is allowed')
            )

        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $formArray = array();
            $itemId = $this->input->post('updId');
            $formArray['itemName'] = $this->input->post('updName');
            $formArray['price'] = $this->input->post('updPrice');
            $link = $this->input->post('updlink');
            $st1 = str_replace("watch?v=", "embed/", $link);
            $pos = strpos($st1, '&');
            if ($pos != '') {
                $st1 = str_split($st1, $pos);
                $st1 = $st1[0];
            }
            $formArray['link'] = $st1;
            if ($_FILES['updImg']['error'] !== 4) {
                $imgdata['upload_path']          = './upload/';
                $imgdata['allowed_types']        = 'gif|jpg|png|mp4';
                $imgdata['max_size'] = '0';
                $this->load->library('upload', $imgdata);
                if (!$this->upload->do_upload('updImg')) {
                    $array = array(
                        'error'   => true,
                        'upload_error' => $this->upload->display_errors()
                    );
                    echo json_encode($array);
                } else {
                    $res = $this->ItemModel->getItemById($itemId);
                    unlink('./upload/' . $res[0]['img']);
                    $formArray['img'] = $this->upload->data('file_name');
                    $this->ItemModel->upd_Item($itemId, $formArray);
                    $data = array();
                    $data['res'] = $this->ItemModel->getItem();
                    $res = $this->load->view('itemView/table', $data, true);
                    $array = array(
                        'success' => '<div class="alert alert-success">Update Record successfully </div>',
                        'html' => $res
                    );
                    echo json_encode($array);
                }
            } else {
                $this->ItemModel->upd_Item($itemId, $formArray);
                $data = array();
                $data['res'] = $this->ItemModel->getItem();
                $res = $this->load->view('itemView/table', $data, true);
                $array = array(
                    'success' => '<div class="alert alert-success">Update Record successfully </div>',
                    'html' => $res
                );
                echo json_encode($array);
            }
        } else {
            $array = array(
                'error'   => true,
                'name_error' => form_error('updName'),
                'price_error' => form_error('updPrice')
            );
            echo json_encode($array);
        }
    }

    public function youtubevideo()
    {
        $this->load->view('itemView/youtube');
    }
}
