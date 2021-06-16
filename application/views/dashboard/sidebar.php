<div class="nav-side-menu">
  <div class="brand">Press Curing Control</div>
  <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  <div class="menu-list">
    <ul id="menu-content" class="menu-content collapse out">
      <li>
        <a href="<?php echo base_url() . 'index.php/usermaster/dashboard' ?>">
          <i class="fa fa-dashboard fa-lg"></i> Dashboard
        </a>
      </li>
      <li data-toggle="collapse" data-target="#Master" class="collapsed active">
        <a href="#"><i class="fa fa-gift fa-lg"></i> Master <span class="arrow"></span></a>
      </li>
      <ul class="sub-menu collapse" id="Master">
        <li class="" id="clientmaster"><a href="<?php echo base_url() . 'index.php\clientmaster' ?>">Client Master</a></li>
        <li class="" id="usermaster"><a href="<?php echo base_url() . 'index.php\usermaster' ?>">User Master</a></li>
        <li class="" id="itemmaster"><a href="<?php echo base_url() . 'index.php\itemmaster' ?>">Item Master</a></li>
      </ul>
      <li data-toggle="collapse" data-target="#service" class="collapsed">
        <a><i class="fa fa-globe fa-lg"></i> Invoice <span class="arrow"></span></a>
      </li>
      <ul class="sub-menu collapse" id="service">
        <li class="" id="invoice"><a href="<?php echo base_url() . 'index.php\invoice' ?>">Invoice Detail</a></li>
        <li class="" id="invoiceForm"><a href="<?php echo base_url() . 'index.php\invoice\invoiceForm' ?>">Invoice Form</a></li>
      </ul>
      <!--<li data-toggle="collapse" data-target="#new" class="collapsed">
        <a href="#"><i class="fa fa-car fa-lg"></i> Reporting <span class="arrow"></span></a>
      </li>
      <ul class="sub-menu collapse" id="new">
        <li>Alarmstatistik</li>
        <li>Prozessfähigkeit</li>
      </ul>
      <li>
        <a href="#">
          <i class="fa fa-user fa-lg"></i> Profile
        </a>
      </li>
      <li data-toggle="collapse" data-target="#new" class="collapsed">
        <a href="#"><i class="fa fa-car fa-lg"></i> Service <span class="arrow"></span></a>
      </li>
      <ul class="sub-menu collapse" id="new">
        <li>Sensorkonfiguration</li>
        <li>Betriebsarten</li>
      </ul> -->
    </ul>
  </div>
</div>


<script>
  $(document).ready(function() {

    path = window.location.href;
    if (path.match('clientmaster')) {
      $('#Master').removeClass('collapse');
      $('#clientmaster').siblings().removeClass('active')
      $('#clientmaster').addClass('active');
    }
    if (path.match('usermaster')) {
      $('#Master').removeClass('collapse');
      $('#usermaster').siblings().removeClass('active')
      $('#usermaster').addClass('active');
    }
    if (path.match('itemmaster')) {
      $('#Master').removeClass('collapse');
      $('#itemmaster').siblings().removeClass('active')
      $('#itemmaster').addClass('active');
    }
    if (path.match('invoice')) {
      $('#service').removeClass('collapse');
      $('#invoice').siblings().removeClass('active')
      $('#invoice').addClass('active');
    }
    if (path.match('invoiceForm')) {
      $('#service').removeClass('collapse');
      $('#invoiceForm').siblings().removeClass('active')
      $('#invoiceForm').addClass('active');
    }


  });
</script>