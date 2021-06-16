<?php
if (!isset($this->session->UserName)) {
    redirect(base_url() . 'index.php/usermaster/login');
}
?>
<style>
    .content {
        margin-left: 25%;
        margin-top: 6%;

        margin-right: 5%;
    }

    #clientHead,
    #itemHead,
    #billHead {
        background-color: #2e353d;
        color: white;
        font-size: 25px;
        text-align: center;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="text"]:disabled {
        background: white;
    }

    .number {
        text-align: right;
    }

    .number::placeholder {
        text-align: left;
    }
</style>

<div class="content">
    <form class="invoiceForm" method="post">
        <div class="row border">
            <div id="clientHead" class="col-md-12">Client Detail</div>
            <div class="form-group col-md-3 mt-3">
                <input style="display:none" type="text" class="form-control " name="clientId" data-id="" id="clientId">
                <input type="text" class="form-control" name="client" data-id="" id="client" placeholder="Client Name" autocomplete="off">
                <span class="text-danger" id="name_Error"></span>
            </div>
            <div class="form-group col-md-3 mt-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                <span class="text-danger" id="email_Error"></span>
            </div>
            <div class="form-group col-md-3 mt-3">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone No" autocomplete="off">
                <span class="text-danger" id="phone_Error"></span>
            </div>
            <div class="form-group col-md-3 mt-3">
                <input type="text" class="form-control" name="address" id="address" placeholder="Address" autocomplete="off">
                <span class="text-danger" id="add_Error"></span>
            </div>
        </div>
        <div class="row border" style="margin-top:25px;">
            <div id="itemHead" class="col-md-12">Item Detail</div>
            <div id="row-1" class="col-md-12 itemrow">
                <div class="form-group col-md-3 mt-3">
                    <input style="display:none" id="itemId-1" type="text" name="itemId-1" class="form-control itemId" autocomplete="off">
                    <input id="item-1" type="text" name="item-1" class="form-control item" onkeyup="searchItem(this.id)" placeholder="Item Name" autocomplete="off">
                </div>
                <div class="form-group col-md-3 mt-3">
                    <input type="text" id="price-1" name="price-1" class="form-control price number" onkeyup="amountCal(this.id,1)" placeholder="Price" autocomplete="off">
                </div>
                <div class="form-group col-md-2 mt-3">
                    <input type="number" name="qty-1" id="qty-1" class="form-control qty number" onkeyup=amountCal(this.id,0) placeholder="Quantity" autocomplete="off">
                </div>
                <div class="form-group col-md-3 mt-3">
                    <input type="text" name="subtotal-1" id="subtotal-1" class="form-control subtotal number" placeholder="Subtotal" autocomplete="off">
                </div>
                <div class="form-group col-md-1 mt-3">
                    <a id="del-1" class="btn btn-danger" onclick="delRow(this.id)">Delete</a>
                </div>
            </div>
            <div class="col-md-12" style="margin-bottom:1%;">
                <div class="col-md-2">
                    <a onclick="addrow()" class="btn btn-info" id="add">Add Row</a>
                </div>
                <div class="col-md-2 offset-md-8">
                    <input class="form-control number" type="text" name="total" id="total" placeholder="total" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row border" style="margin-top:25px;">
            <div id="billHead" class="col-md-12">Billing Detail</div>
            <div class="form-group col-md-4 mt-3">
                <input type="text" class="form-control number" name="totalPay" id="totalPay" onchange="calDue()" placeholder="Total Pay" autocomplete="off">
            </div>
            <div class="form-group col-md-4 mt-3">
                <input type="text" class="form-control number" name="paid" id="paid" onkeyup="calDue()" placeholder="Pay Amount" autocomplete="off">
                <span class="text-danger" id='paid_Error'></span>
            </div>
            <div class="form-group col-md-4 mt-3">
                <input type="text" class="form-control number" name="due" id="due" placeholder="Due Pay" autocomplete="off">

            </div>
            <div class="form-group col-md-2 mt-3 offset-md-4">
                <button class="form-control btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>
<script src="<?php echo base_url() . "assets/js/invoice.js" ?>"></script>