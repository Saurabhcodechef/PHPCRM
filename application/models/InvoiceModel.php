<?php
class InvoiceModel extends CI_model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function insert_Invoice($invoiceArray)
    {
        $this->db->insert('clientInvoice', $invoiceArray);
        return $this->db->insert_id();
    }
    public function insert_Purchase($itemArray)
    {
        $this->db->insert_batch('billing', $itemArray);
    }
    public function invoice()
    {
        $this->db->select(
            array(
                'i.client_Id as clientId', 'i.clientName as clientName',
                'i.phone as phone', 'i.email as email', 'i.address as add',
                'i.invoice_id as id', 'i.total as total', 'i.paid as paid',
                'i.due_pay as due'
            )
        );
        $this->db->from('clientInvoice as i');
        // $this->db->join('clientmaster as c', 'c.ClientID=i.client_Id');
        return $this->db->get()->result_array();
    }

    public function delInvoice($invoiceId)
    {
        $this->db->where('invoice_id', $invoiceId);
        $this->db->delete('ClientInvoice');

        $this->db->where('invoice_id', $invoiceId);
        $this->db->delete('billing');
    }

    public function getInvoiceDetail($invoiceId)
    {
        $this->db->select('*');
        $this->db->from('clientInvoice as i');
        $this->db->join('billing as p', 'p.invoice_id=i.invoice_id');
        $this->db->where('i.invoice_id', $invoiceId);
        return $this->db->get()->result_array();
    }

    public function updInvoiceDetail($invoiceArray, $itemArray, $invoiceId)
    {
        $this->db->where('invoice_id', $invoiceId);
        $this->db->update('clientInvoice', $invoiceArray);

        $this->db->where('invoice_id', $invoiceId);
        $this->db->delete('billing');

        $this->db->insert_batch('billing', $itemArray);
    }
}
