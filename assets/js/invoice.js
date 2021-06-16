base_path = 'http://localhost:81/project1/index.php/invoice/'
$(document).ready(function () {

    $('#client').autocomplete({
        source: function (request, response) {
            $.post(
                base_path + 'search_Name',
                {
                    data: request.term
                }, (data) => {
                    data = JSON.parse(data);

                    response($.map(data, function (item, i) {
                        return {
                            label: item.clientName,
                            value: item.clientName,
                            id: item.ClientID,
                            email: item.email,
                            phone: item.phone,
                            add: item.address
                        }
                    }))
                });
        },
        select: function (event, ui) {
            // console.log(ui);
            $('#client').attr('data-id', ui.item.id);
            $('#clientId').val(ui.item.id);
            $('#email').val(ui.item.email);
            $('#phone').val(ui.item.phone);
            $('#address').val(ui.item.add);

        }

    });
    $('.invoiceForm').on('submit', function (e) {
        e.preventDefault();
        debugger;
        let len = $('.item').length;
        if (len == 0) {
            alert('Atleast one Item is required');
            return;
        }
        $.ajax({
            url: base_path + "addInvoice",
            method: "POST",
            data: $(this).serialize() + '&itemCount=' + len,
            dataType: "json",
            success: function (data) {
                if (data.error) {
                    if (data.name_Error != '') {
                        $('#name_Error').html(data.name_Error);
                        setTimeout(function () {
                            $('#name_Error').html('');
                        }, 3000);
                    }
                    else {
                        $('#name_Error').html('');
                    }
                    if (data.email_Error != '') {
                        $('#email_Error').html(data.email_Error);
                        setTimeout(function () {
                            $('#email_Error').html('');
                        }, 3000);
                    }
                    else {
                        $('#email_Error').html('');
                    }
                    if (data.phone_Error != '') {
                        $('#phone_Error').html(data.phone_Error);
                        setTimeout(function () {
                            $('#phone_Error').html('');
                        }, 3000);
                    }
                    else {
                        $('#phone_Error').html('');
                    }
                    if (data.add_Error != '') {
                        $('#add_Error').html(data.add_Error);
                        setTimeout(function () {
                            $('#add_Error').html('');
                        }, 3000);
                    }
                    else {
                        $('#add_Error').html('');
                    }
                }
                if (data.success) {

                    window.location.href = base_path;
                }
            }
        });
    });
    $('#updinvoiceForm').on('submit', function (e) {
        e.preventDefault();
        debugger;
        let invoiceId = Number($('#totalPay').attr('data-id'));
        let len = $('.item').length;
        itemDetail = new Array();
        for (let i = 1; i <= len; i++) {
            let itemId = Number($('#item-' + i).attr('data-id'));
            let qty = Number($('#qty-' + i).val());
            let price = Number($('#price-' + i).val());
            if (itemId != '' && qty != '' && price != '') {
                let Item = { 'invoice_id': invoiceId, 'item_Id': itemId, 'quantity': qty, 'price': price };
                itemDetail.push(Item);
            }
        }
        itemDetail = JSON.stringify(itemDetail);
        let clientId = Number($('#client').attr('data-id'));
        let clientName =$('#client').val();
        let total = Number($('#totalPay').val());
        let paid = Number($('#paid').val());
        let due = Number($('#due').val());
        if (isEmpty(clientId)) {
            $('#name_Error').html('');
            $('#name_Error').html('Client is not Exists')
        }
        if (isEmpty(clientName)) {
            $('#name_Error').html('');
            $('#name_Error').html('Client Name is Required')
        }
        if (isEmpty(phone)) {
            $('#phone_Error').html('');
            $('#phone_Error').html('Phone No is Required')
        }
        if (isEmpty(email)) {
            $('#email_Error').html('');
            $('#email_Error').html('Email is Required')
        }
        if (isEmpty(add)) {
            $('#add_Error').html('');
            $('#add_Error').html('Address is Required')
        }
        if (clientId == 0 || total == 0 || paid == 0 || due == 0 || itemDetail.length == 0) {
            return;
        }
        let invoice = {
            'invoice_id': invoiceId, 'client_Id': clientId, 'clientName': clientName,
            'phone': phone, 'email': email, 'address': add, 'total': total, 'paid': paid, 'due_pay': due
        };
        invoice = JSON.stringify(invoice);
        $.post(base_path + 'updInvoice', {
            itemData: itemDetail,
            invoiceData: invoice
        }, (response) => {
            $('#updinvoiceForm').remove();
            let data = JSON.parse(response);
            $('.table').before(data['msg']);
            $('#tbody').html(data['html'])
        });
        setTimeout(function () {
            $('.alert-success').remove();
        }, 3000);
    });


    $('#client').keyup(function () {
        let str1 = $(this).val();
        let len = $(this).val().length;
        let flag;

        for (let i = 0; i < len; i++) {
            let s1 = new RegExp('[a-z|A-Z\\s]', 'g');
            flag = 0;
            if (!s1.exec(str1[i])) {
                flag = 1;
                break;
            }
        }
        if (flag == 1) {
            $('#name_Error').html('');
            $('#name_Error').html("<p>* Name is Invalid</p>");
        }
        else {
            $('#name_Error').html('');
        }

    });
    $('#phone').keyup(function () {

        let str1 = $('#phone').val();
        let len = $('#phone').val().length;
        let flag;
        if (len == 10) {
            $('#phone_Error').html('');
            $('#phone_Error').html('<p class="text-success">Phone NO is Correct</p>');
        }
        if (len > 10) {
            $('#phone_Error').html('');
            $('#phone_Error').html("<p>* Phone No exceed the max length is Invalid</p>");
        }

        else {
            for (let i = 0; i < len; i++) {
                let s1 = new RegExp('[0-9]', 'g');
                flag = 0;
                if (!s1.exec(str1[i])) {
                    flag = 1;
                    break;
                }
            }
            if (flag == 1) {
                $('#phone_Error').html('');
                $('#phone_Error').html("<p>* Phone no is Invalid</p>");
            }
            else {
                $('#phone_Error').html('');
            }
        }
    });


});


function setClientVal(id) {
    $('#suggest1').remove();
    $.post(base_path + 'getClient', {
        clientId: id
    }, (response) => {
        let data = JSON.parse(response);
        $('#client').val(data['clientName']);
        $('#clientId').val(data['ClientID']);
        $('#client').attr('data-id', data['ClientID']);
        $('#email').val(data['email']);
        $('#phone').val(data['phone']);
        $('#add').val(data['address']);

    });
}

function addrow() {

    let ele = $('#row-1').clone();
    ele.find('input').val('');
    let len = $('.itemrow').length;
    ele.attr('id', 'row-' + (len + 1));
    let ele1 = addId(ele, len + 1)
    $('#row-' + len).after(ele1);

}

function delRow(id) {
    if ($('.itemrow').length == 1) {
        alert('1 row is required');
    } else {
        l1 = id.substr(4);
        ele = $('#row-' + l1).next('.itemrow');
        $('#row-' + l1).remove();
        len = $(".itemrow").length;
        for (let i = l1; i <= l1 + len; i++) {
            ele.attr('id', 'row-' + i);
            addId(ele, i);
            ele = ele.next();
        }
        totalCal();

    }
}

function addId(ele, id) {
    ele.find('.item').attr({
        id: 'item-' + id,
        name: 'item-' + id
    });
    ele.find('.itemId').attr({
        id: 'itemId-' + id,
        name: 'ItemId-' + id
    });
    ele.find('.price').attr({
        id: 'price-' + id,
        name: 'price-' + id
    });
    ele.find('.qty').attr({
        id: 'qty-' + id,
        name: 'qty-' + id
    });
    ele.find('.subtotal').attr({
        id: 'subtotal-' + id,
        name: 'subtotal-' + id
    });
    ele.find('.btn-danger').attr('id', 'del-' + id);
    return ele;
}

function searchItem(id) {
    $('#' + id).autocomplete({
        source: function (request, response) {
            $.post(
                base_path + 'search_Item',
                {
                    data: request.term
                }, (data) => {
                    data = JSON.parse(data);
                    response($.map(data, function (item, i) {
                        return {
                            label: item.itemName,
                            value: item.itemName,
                            id: item.itemId,
                            price: item.price,
                        }
                    }))
                });
        },
        select: function (event, ui) {
            let n = Number(id.substr(5));
            $('#' + id).val(ui.item.itemName);
            $('#' + id).attr('data-id', ui.item.id);
            $('#itemId-' + n).val(ui.item.id);
            $('#price-' + n).val(ui.item.price);
        }

    });

}
function setItemVal(id) {
    let r = $('#' + id).attr('data-id');
    //$('#suggest').remove();
    $.post(base_path + 'getItem', {
        itemId: id
    }, (response) => {
        data = JSON.parse(response);
        $('#item-' + r).val(data['itemName']);
        $('#item-' + r).attr('data-id', data['itemId']);
        $('#price-' + r).val(data['price']);
    })
}

function amountCal(id, state) {
    if (state == 1) {
        id = id.substr(6);
    } else {
        id = id.substr(4);
    }
    let price = $('#price-' + id).val();
    let qty = $('#qty-' + id).val();
    if (qty <= 0) {
        $('#qty-' + id).val(0);
    }
    qty = $('#qty-' + id).val();
    let amount = price * qty;
    $('#subtotal-' + id).val(amount);
    totalCal();

}

function totalCal() {
    len = $(".subtotal").length;
    let total = 0;
    for (let i = 1; i <= len; i++) {
        total += Number($('#subtotal-' + i).val());
    }
    $("#total").val(total);
    $('#totalPay').val(total);
    let paid = $('#paid').val();
    if (paid == 0)
        $('#due').val(total);
    else
        calDue();
}

function calDue() {
    let total = Number($('#totalPay').val());
    let paid = Number($('#paid').val());
    $('#paid_Error').html('');
    if (total >= paid) {
        let due = total - paid;
        $('#due').val(due);
        $('#submit').prop('disabled', false);
    } else {
        $('#paid_Error').html('Invalid Amount');
        $('#submit').prop('disabled', true);
    }
}

function getInvoice(id) {
    debugger;
    let Id = $('#' + id).attr('data-id');
    $.post(base_path + 'get_Invoice', {
        invoiceId: Id
    }, (html) => {
        $('#updinvoiceForm').remove();
        $('#updForm').after(html);
    });
}

function delInvoice(id) {
    let Id = $('#' + id).attr('data-id');
    let res = confirm('Are you sure to Delete Invoice ' + Id)
    if (res) {
        $.post(base_path + 'delete_Invoice', {
            'invoice_id': Id
        }, (response) => {

            data = JSON.parse(response);
            $('.table').before(data['msg']);
            $('#tbody').html(data['html']);
            setTimeout(function () {
                $('.alert-success').remove();
            }, 3000);
        });
    }
}

function isEmpty(str) {
    return (!str || str.length === 0);
}