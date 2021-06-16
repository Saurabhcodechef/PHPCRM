
             <?php //echo form_open('clientmaster/add_Client')?>
            <div class="form-group col-md-2 mx-1">
                <input id="clientName"data-id=''type="text"class="form-control" name="name" placeholder="Client Name">
                <?php echo form_error('name')?>
            </div>
            <div class="form-group col-md-2 mx-1">
                <input id="email"type="email"class="form-control" name="email"placeholder="Email">
                <?php echo form_error('email')?>
            </div>
            <div class="form-group col-md-2 mx-1">
                <input id="phone"type="text"class="form-control" name="phone" placeholder="Phone">
                <?php echo form_error('phone')?>
            </div>
            <div class="form-group col-md-3 mx-1">
                <input id="address"type="text"class="form-control" name="address"placeholder="Address">
                <?php echo form_error('address')?>
            </div>
            <div class="form-group col-md-2 mx-1">
                <button id="submit"class="btn btn-primary">Submit</button>
                 <button id="update"style="display:none;"class="btn btn-primary">Update</button>
            </div>
            
             <!-- </form> -->
       