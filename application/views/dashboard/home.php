<?php
if (!isset($this->session->UserName)) {
    redirect(base_url() . 'index.php/usermaster/login');
}
?>
<style>
    .content {
        margin-left: 25%;
        margin-top: 7%;
    }

    .card-text {
        font-size: 20px;
    }

    .stretched-link {
        color: black;
        width: 150px;
        font-size: 25px;
        text-decoration: none;
        border: none;
    }

    .stretched-link:hover {
        color: black;
        text-decoration: none;
    }

    .card-header {
        background-color: #2e353d;
        color: white;
        margin: 0px;
    }
</style>
<div class="content row">
    <div class="row col-md-12 ">
        <div class="card col-md-3 px-0 mr-4">
            <h3 class="card-header text-center">User Master</h3>
            <div class="card-body">

                <p class="card-text text-center">Total No Of User</p>
                <div class="text-center">
                    <a href="<?php echo base_url() . 'index.php/usermaster' ?>" class="stretched-link"><?php echo $this->db->count_all_results('usermaster'); ?></a>
                </div>
            </div>
        </div>
        <div class="card col-md-3 px-0 mr-4">
            <h3 class="card-header text-center">Client Master</h3>
            <div class="card-body">
                <p class="card-text text-center">Total No of Client</p>
                <div class="text-center">
                    <a href="<?php echo base_url() . 'index.php/clientmaster' ?>" class="stretched-link"><?php echo $this->db->count_all_results('clientmaster'); ?></a>
                </div>
            </div>
        </div>
        <div class="card col-md-3 px-0 mr-4">
            <h3 class="card-header text-center">Item Master</h3>
            <div class="card-body">
                <p class="card-text text-center">Total No of Item</p>
                <div class="text-center">
                    <a href="<?php echo base_url() . 'index.php/itemmaster' ?>" class="stretched-link"><?php echo $this->db->count_all_results('itemmaster'); ?></a>
                </div>
            </div>
        </div>
        <div class="card col-md-3 px-0 mr-4" style="margin-top:2%">
            <h3 class="card-header text-center">Invoice Master</h3>
            <div class="card-body">
                <p class="card-text text-center">Total No of Invoice</p>
                <div class="text-center">
                    <a href="<?php echo base_url() . 'index.php/invoice' ?>" class="stretched-link"><?php echo $this->db->count_all_results('ClientInvoice'); ?></a>
                </div>
            </div>
        </div>
    </div>

</div>