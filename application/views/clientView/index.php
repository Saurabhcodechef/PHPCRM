<?php
if (!isset($this->session->UserName)) {
    redirect(base_url() . 'index.php/usermaster/login');
}
?>
<style>
    .content {
        margin-left: 30%;
        margin-top: 10%;
        position: fixed;

    }
</style>
<div class="content">
    <div class="" style="margin-left:4%;">
        <div id="clientForm" style="margin-left:25px;" class="row offset-md-1 col-md-12">
            <span id="success_message"></span>
            <form method="post" id="client_Form">
                <div class="form-group col-md-2 mx-1">
                    <input id="name" data-id='' type="text" class="form-control" name="name" placeholder="Client Name">
                    <span class="error text-danger" id="name_error"></span>
                </div>
                <div class="form-group col-md-2 mx-1">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                    <span class="error text-danger" id="email_error"></span>
                </div>
                <div class="form-group col-md-2 mx-1">
                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone">
                    <span class="error text-danger" id="phone_error"></span>
                </div>
                <div class="form-group col-md-3 mx-1">
                    <input id="address" type="text" class="form-control" name="address" placeholder="Address">
                    <span class="error text-danger" id="address_error"></span>
                </div>
                <div class="form-group col-md-2 mx-1">
                    <button id="submit" class="btn btn-primary">Submit</button>
                    <a id="update" style="display:none;" class="btn btn-primary" onclick="updateClient()">Update</a>
                </div>
            </form>
        </div>
        <div class="col-md-2" style="margin-bottom: 1%;margin-left:76%;">
            <a class="btn btn-primary ml-4 mb-3" id="addClient" type="button">Add Client</a>
        </div>
    </div>

    <table id="clientTable" style="width:79%;margin-left:56px;" class="table">
        <thead>
            <tr>
                <th class="text-center">S.NO</th>
                <th class="text-center">Client Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Address</th>
                <th class="text-center">Created Date</th>
                <th class="text-center">Created By</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id='tbody'>
            <?php for ($i = 0; $i < count($res); $i++) { ?>
                <tr id="<?php echo "row-" . ($i + 1) ?>">
                    <td class="text-center"><?php echo $i + 1; ?></td>
                    <td class="text-left"><?php echo $res[$i]['clientName']; ?></td>
                    <td class="text-left"><?php echo $res[$i]['email']; ?></td>
                    <td class="text-center"><?php echo $res[$i]['phone']; ?></td>
                    <td class="text-left"><?php echo $res[$i]['address']; ?></td>
                    <td class="text-center"><?php echo $res[$i]['created_Date']; ?></td>
                    <td class="text-left"><?php echo $res[$i]['created_By']; ?></td>
                    <td class="text-center">
                        <a type="button" id="<?php echo 'upd-' . ($i + 1); ?>" data-id="<?php echo $res[$i]['ClientID'] ?>" class="btn  btn-info" aria-expanded="false" onclick='getClient(this.id)'>Edit</a>
                        <a type="button" id="<?php echo 'del-' . ($i + 1); ?>" data-id="<?php echo $res[$i]['ClientID'] ?>" class="btn  btn-danger" onclick='deleteClient(this.id)'>Delete</i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>



    </table>
    <script src="<?php echo base_url() . 'assets/js/client.js' ?>"></script>

</div>
</div>