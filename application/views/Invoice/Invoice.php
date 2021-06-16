<?php
if (!isset($this->session->UserName)) {
    redirect(base_url() . 'index.php/usermaster/login');
}
?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<style>
    .content {
        margin-left: 25%;
        margin-top: 6%;

        margin-right: 5%;
    }
</style>
<div class="content">
    <div class="row" id="updForm">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>S.No</th>
                        <th>Client Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="text-right">Total Pay</th>
                        <th class="text-right">Paid Amount</th>
                        <th class="text-right">Due Amount</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">

                    <?php
                    for ($i = 0; $i < count($res); $i++) {
                    ?>
                        <tr>
                            <td><?php echo $i + 1;
                                ?></td>
                            <td><?php echo $res[$i]['clientName'];
                                ?></td>
                            <td><?php echo $res[$i]['phone'];
                                ?></td>
                            <td><?php echo $res[$i]['email'];
                                ?></td>
                            <td><?php echo $res[$i]['add'];
                                ?></td>
                            <td class="text-right"><?php echo $res[$i]['total'];
                                                    ?></td>
                            <td class="text-right"><?php echo $res[$i]['paid'];
                                                    ?></td>
                            <td class="text-right"><?php echo $res[$i]['due'];
                                                    ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url() . 'index.php/invoice/pdfInvoice?id=' . $res[$i]['id'] ?>" id="<?php echo 'pdf-' . ($i + 1) ?>" data-id="<?php echo $res[$i]['id'] ?>" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                <a id="<?php echo 'upd-' . ($i + 1) ?>" data-id="<?php echo $res[$i]['id'] ?>" class="btn btn-info" onclick="getInvoice(this.id)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a id="<?php echo 'del-' . ($i + 1) ?>" data-id="<?php echo $res[$i]['id'] ?>" class="btn btn-danger" onclick="delInvoice(this.id)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?php echo base_url() . 'assets/js/invoice.js' ?>"></script>
</div>