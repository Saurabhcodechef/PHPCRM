<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
</head>
<style>
    body {
        background-color: whitesmoke;
    }

    img {
        margin-bottom: 30px;
        margin-left: 180px;
        height: 30px;
    }

    .item {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body>

    <img src="<?php echo base_url() . 'assets/img/Logo.png' ?>">
    <table>

        <tr>
            <td width="400">Address:<br>
                419, 4th Floor,<br>
                M3M Urbana, Sector 67,<br>
                Gurugram, Haryana 122018</td>
            <td>Email:sansSoftware@gmail.com<br>
                Contact: 9754875122</td>
        </tr>
    </table>
    <section style="margin-top:30px">
        <h4>Billed To</h4>
        <table>
            <tr>
                <td width="100px">Client Name:</td>
                <td><?php echo $invoiceDetail[0]['clientName']
                    ?></td>
            </tr>
            <tr>
                <td width="100px">Phone:</td>
                <td><?php echo $invoiceDetail[0]['phone']
                    ?></td>
            </tr>
            <tr>
                <td width="100px">Email:</td>
                <td><?php echo $invoiceDetail[0]['email']
                    ?></td>
            </tr>
            <tr>
                <td width="100px">Address:</td>
                <td><?php echo $invoiceDetail[0]['address']
                    ?></td>
            </tr>
        </table>
    </section>

    <section style="margin-top:30px;margin-left:30px">
        <h4 style="text-align:center;width:80%">Item Detail</h4>
        <table class='item' width="100%">
            <tr style="background-color:gold">
                <th class="item" width="120px">Item Name</th>
                <th class="item" width="120px">Price</th>
                <th class="item" width="120px">Quantity</th>
                <th class="item" width="120px">Subtotal</th>
            </tr>
            <?php for ($i = 0; $i < count($itemDetail); $i++) { ?>
                <tr class='item'>
                    <td class="item" style="text-align:center;width:120px"><?php echo $itemDetail[$i]['itemName'] ?></td>
                    <td class="item" style="text-align:center;width:120px"><?php echo $itemDetail[$i]['price'] ?></td>
                    <td class="item" style="text-align:center;width:120px"><?php echo $itemDetail[$i]['quantity'] ?></td>
                    <td class="item" style="text-align:center;width:120px"><?php echo ($itemDetail[$i]['price'] * $itemDetail[$i]['quantity']) ?></td>
                </tr>

            <?php } ?>
            <tr style="background-color:burlywood" class='item'>
                <th class="item" style="text-align:right;width:360px" colspan="3">Total</th>
                <td class="item" style="text-align:center;width:120px">4000</td>
            </tr>
        </table>
    </section>
    <section style="margin-top:20px;margin-left:400px;">
        <h3>Invoice Detail</h3>
        <table>
            <tr>
                <td style="width:120px">Invoice No</td>
                <td><?php echo $invoiceDetail[0]['invoice_id'] ?></td>
            </tr>
            <tr>
                <td style="width:120px">Date Of Issue</td>
                <td><?php echo date('Y-m-d') ?></td>
            </tr>
            <tr>
                <td style="width:120px">Total Payment</td>
                <td><?php echo $invoiceDetail[0]['total'] ?></td>
            </tr>
            <tr>
                <td style="width:120px">Paid Amount</td>
                <td><?php echo $invoiceDetail[0]['paid'] ?></td>
            </tr>
            <tr>
                <td style="width:150px">Remaining Amount</td>
                <td><?php echo $invoiceDetail[0]['due_pay'] ?></td>
            </tr>
        </table>
    </section>
</body>

</html>