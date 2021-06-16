<div class="row border" style="margin-top:25px;">
    <div id="itemHead" class="col-md-12">Item Detail</div>
    <div id="row-1" class="col-md-12 itemrow">
        <div class="form-group col-md-3 mt-3">
            <input id="item-1" type="text" name="item-1" class="form-control item" onkeyup="searchItem(this.id)" placeholder="Item Name" autocomplete="off">
        </div>
        <div class="form-group col-md-3 mt-3">
            <input type="text" id="price-1" name="price-1" class="form-control price" onkeyup="amountCal(this.id,1)" placeholder="Price" autocomplete="off">
        </div>
        <div class="form-group col-md-2 mt-3">
            <input type="number" name="qty-1" id="qty-1" class="form-control qty" onkeyup=amountCal(this.id,0) placeholder="Quantity" autocomplete="off">
        </div>
        <div class="form-group col-md-3 mt-3">
            <input type="text" name="subtotal-1" id="subtotal-1" class="form-control subtotal" placeholder="Subtotal" autocomplete="off">
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
            <input class="form-control" type="text" name="total" id="total" placeholder="total" autocomplete="off">
        </div>
    </div>
</div>
<div class="row border" style="margin-top:25px;">
    <div id="billHead" class="col-md-12">Billing Detail</div>
    <div class="form-group col-md-4 mt-3">
        <input type="text" class="form-control" name="totalPay" id="totalPay" onchange="calDue()" placeholder="Total Pay" autocomplete="off">
    </div>
    <div class="form-group col-md-4 mt-3">
        <input type="text" class="form-control" name="paid" id="paid" onkeyup="calDue()" placeholder="Pay Amount" autocomplete="off">
    </div>
    <div class="form-group col-md-4 mt-3">
        <input type="text" class="form-control" name="due" id="due" placeholder="Due Pay" autocomplete="off">
    </div>
    <div class="form-group col-md-2 mt-3 offset-md-4">
        <button class="form-control btn btn-primary">Submit</button>
    </div>
</div>