<style>
    #clientHead,
    #itemHead,
    #billHead {
        background-color: #2e353d;
        color: white;
        font-size: 25px;
        text-align: center;
    }

    #updinvoiceForm {
        margin-top: 4%;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="text"]:disabled {
        background: white;
    }
</style>
<form id="updinvoiceForm" method="post">
    <div class="row border">
        <div id="clientHead" class="col-md-12">Client Detail</div>
        <div class="form-group col-md-3 mt-3">
            <input style="display:none" id="itemId-1" type="text" name="itemId-1" value="<?php echo $clientDetail['ClientID'] ?>class=" form-control itemId" autocomplete="off">
            <input type="text" class="form-control" data-id="<?php echo $clientDetail['ClientID'] ?>" value="<?php echo $clientDetail['clientName'] ?>" name="client" data-id="" id="client" placeholder="Client Name" autocomplete="off">
            <span class="text-danger" id="name_Error"></span>
        </div>
        <div class="form-group col-md-3 mt-3">
            <input type="email" class="form-control" value="<?php echo $clientDetail['email'] ?>" name="email" id="email" placeholder="Email" autocomplete="off">
            <span class="text-danger" id="email_Error"></span>
        </div>
        <div class="form-group col-md-3 mt-3">
            <input type="text" class="form-control" value="<?php echo $clientDetail['phone'] ?>" name="phone" id="phone" placeholder="Phone No" maxlength="12" autocomplete="off">
            <span class="text-danger" id="phone_Error"></span>
        </div>
        <div class="form-group col-md-3 mt-3">
            <input type="text" class="form-control" value="<?php echo $clientDetail['address'] ?>" name="add" id="add" placeholder="Address" autocomplete="off">
            <span class="text-danger" id="add_Error"></span>
        </div>
    </div>
    <div class="row border" style="margin-top:25px;">
        <div id="itemHead" class="col-md-12">Item Detail</div>
        <?php for ($i = 0; $i < count($itemDetail); $i++) { ?>
            <div id="<?php echo 'row-' . ($i + 1) ?>" class="col-md-12 itemrow">
                <div class="form-group col-md-3 mt-3">
                    <input style="display:none" id="<?php echo 'itemId-' . ($i + 1) ?>" value="<?php echo $itemDetail[$i]['itemId'] ?>" type="text" name="<?php echo 'itemId-' . ($i + 1) ?>" data-id="<?php echo $itemDetail[$i]['itemId'] ?>" class="form-control itemId" placeholder="" autocomplete="off">
                    <input id="<?php echo 'item-' . ($i + 1) ?>" value="<?php echo $itemDetail[$i]['itemName'] ?>" type="text" name="<?php echo 'item-' . ($i + 1) ?>" data-id="<?php echo $itemDetail[$i]['itemId'] ?>" class="form-control item" onkeyup="searchItem(this.id)" placeholder="Item Name" autocomplete="off">
                </div>
                <div class="form-group col-md-3 mt-3">
                    <input type="text" id="<?php echo 'price-' . ($i + 1) ?>" value="<?php echo $itemDetail[$i]['price'] ?>" name="<?php echo 'price-' . ($i + 1) ?>" class="form-control price" onkeyup="amountCal(this.id,1)" placeholder="Price" autocomplete="off">
                </div>
                <div class="form-group col-md-2 mt-3">
                    <input type="number" name="<?php echo 'qty-' . ($i + 1) ?>" value="<?php echo $itemDetail[$i]['quantity'] ?>" id="<?php echo 'qty-' . ($i + 1) ?>" class="form-control qty" onkeyup=amountCal(this.id,0) placeholder="Quantity" autocomplete="off">
                </div>
                <div class="form-group col-md-3 mt-3">
                    <input type="text" name="<?php echo 'subtotal-' . ($i + 1) ?>" value="<?php echo $itemDetail[$i]['subtotal'] ?>" id="<?php echo 'subtotal-' . ($i + 1) ?>" class="form-control subtotal" placeholder="Subtotal" autocomplete="off" disabled>
                </div>
                <div class="form-group col-md-1 mt-3">
                    <a id="del-1" class="btn btn-danger" onclick="delRow(this.id)">Delete</a>
                </div>
            </div>
        <?php } ?>
        <div class="col-md-12" style="margin-bottom:1%;">
            <div class="col-md-2">
                <a onclick="addrow()" class="btn btn-info" id="add">Add Row</a>
            </div>
            <div class="col-md-2 offset-md-8">
                <input class="form-control" type="text" value="<?php echo $invoiceDetail['total'] ?>" name="total" id="total" placeholder="total" autocomplete="off" disabled>
            </div>
        </div>
    </div>
    <div class="row border" style="margin-top:25px;">
        <div id="billHead" class="col-md-12">Billing Detail</div>
        <div class="form-group col-md-4 mt-3">
            <input data-id="<?php echo $invoiceDetail['invoice_Id']; ?>" type="text" class="form-control" value="<?php echo $invoiceDetail['total'] ?>" name="totalPay" id="totalPay" onchange="calDue()" placeholder="Total Pay" autocomplete="off" disabled>
        </div>
        <div class="form-group col-md-4 mt-3">
            <input type="text" class="form-control" value="<?php echo $invoiceDetail['paid'] ?>" name="paid" id="paid" onkeyup="calDue()" placeholder="Pay Amount" autocomplete="off">
            <span class="text-danger" id="paid_Error"></span>
        </div>
        <div class="form-group col-md-4 mt-3">
            <input type="text" class="form-control" value="<?php echo $invoiceDetail['due_pay'] ?>" name="due" id="due" placeholder="Due Pay" autocomplete="off" disabled>
        </div>
        <div class="form-group col-md-2 mt-3 offset-md-4">
            <button class="form-control btn btn-primary">Update</button>
        </div>
    </div>
</form>

<script src="<?php echo base_url() . 'assets/js/invoice.js' ?>"></script>