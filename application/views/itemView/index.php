<?php
if (!isset($this->session->UserName)) {
  redirect(base_url() . 'index.php/usermaster/login');
}
?>
<style>
  .content {
    margin-left: 30%;
    margin-top: 10%;


  }
</style>

<div class="content">
  <div class="" style="margin-left:4%;">
    <div id="ItemForm" style="margin-left:25px;" class="row offset-md-1 col-md-12">
      <span id="success_message"></span>
      <form id="item_Form" method='post'>
        <div class="form-group col-md-2 mx-1">
          <input id="name" type="text" class="form-control" name="name" placeholder="Item Name">
          <span class="text-danger" id="name_error"></span>
        </div>
        <div class="form-group col-md-2 mx-1">
          <input id="price" type="text" class="form-control" name="price" placeholder="Price">
          <span class="text-danger" id="price_error"></span>
        </div>
        <div class="form-group col-md-2 mx-1">
          <input type="url" id="link" class="form-control" name="link" placeholder="Enter Video Link">
        </div>
        <div class="form-group col-md-3 mx-1">
          <input type="file" id="itemImg" name="itemImg">
          <span class="text-danger" id="upload_error"></span>
        </div>

        <div class="form-group col-md-2 mx-1">
          <button id="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <div class="col-md-2" style="margin-bottom: 1%;margin-left:76.3%;">
      <a class="btn btn-primary ml-4 mb-3" id="addItem" type="button">Add Item</a>
    </div>
  </div>
  <table id="clientTable" style="width:79%;margin-left:56px;" class="table">
    <thead>
      <tr>
        <th class="text-center">S.No</th>
        <th class="text-center">Item Name</th>
        <th class="text-center">Price</th>
        <th class="text-center">Images</th>
        <th class="text-center">LINK</th>
        <th class="text-center">Created Date</th>
        <th class="text-center">Created By</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <script src="<?php echo base_url() . 'assets/js/itemView.js' ?>"></script>
    <tbody id='tbody'>
      <?php for ($i = 0; $i < count($res); $i++) { ?>
        <tr id="<?php echo "row-" . ($i + 1) ?>">
          <td class="text-center"><?php echo $i + 1; ?></td>
          <td class="text-left"><?php echo $res[$i]['itemName']; ?></td>
          <td class="text-left"><?php echo $res[$i]['price']; ?></td>
          <td class="text-center"><object id="fileUpload" data="<?php echo base_url() . 'upload/' . $res[$i]['img']; ?>" height="50px" width="50px"></object></td>

          <td class="text-center"><iframe src="<?php echo $this->db->query('select link from itemmaster where itemId=?', $res[$i]['itemId'])->row()->link; ?>" height=60px width=60px></iframe></td>
          <td class="text-center"><?php echo $res[$i]['created_Date']; ?></td>
          <td class="text-left"><?php echo $res[$i]['created_By']; ?></td>
          <td class="text-center">
            <button type="button" id="<?php echo 'upd-' . ($i + 1); ?>" data-id="<?php echo $res[$i]['itemId'] ?>" class="btn btn-primary" onclick='getItem(this.id)'>Edit</button>
            <a type="button" id="<?php echo 'del-' . ($i + 1); ?>" data-id="<?php echo $res[$i]['itemId'] ?>" class="btn btn-danger" onclick='deleteItem(this.id)'>Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="updForm">
          <div class="modal-body">
            <div class="form-group">
              <input id="updId" type="text" style="display:none;" class="form-control" name="updId">
            </div>
            <div class="form-group">
              <input id="updName" type="text" data-id="" class="form-control" name="updName" placeholder='Item Name'>
              <span class="text-danger" id="updname_error"></span>
            </div>
            <div class="form-group">
              <input id="updPrice" type="text" class="form-control" name="updPrice" placeholder='Item Name'>
              <span class="text-danger" id="updprice_error"></span>
            </div>
            <div class="form-group">

              <!-- <input id="updlink" type="text" class="form-control" name="updlink" placeholder='Link'> -->
            </div>
            <div class="form-group">
              <object id="updImg1" data="" height="80px" width="100px"></object>
              <iframe id="updlink" src="" height=80px width=150px></iframe>
              <?php echo form_upload(['class' => 'form-control', 'type' => 'file', 'name' => 'updImg', 'id' => 'updImg']); ?>
              <span class="text-danger" id="updupload_error"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url() . 'assets/js/itemView.js' ?>"></script>