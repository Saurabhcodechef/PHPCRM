<div class="row">
  <div style="position:fixed;width:102%;padding-right:0px; z-index: 1;">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <a class="navbar-brand mb-3" href="#"><img src="<?php echo base_url() . 'assets/img/logo.png' ?>" alt=""></a>
      <div class="row" style="width: 16%;margin-left:59%;">
        <h4 class="col-md-8 text-light">Welcome <?php echo $this->session->userdata('UserName') ?></h4>
        <a href="<?php echo base_url() . 'index.php/usermaster/logout' ?>" style="height: 50%;" class="btn col-md-4 btn-warning my-2 my-sm-0">Logout</a>
      </div>
    </nav>
  </div>
</div>