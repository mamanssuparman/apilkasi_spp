<?php 
  $levelmenu=$this->session->userdata('level');
  if ($levelmenu=='admin') { ?>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li>
          <a href="<?php echo base_url() ?>index.php/Admin/Kelas">
            <i class="fa fa-bank"></i> <span>Data Kelas</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url() ?>index.php/Admin/Siswa">
            <i class="fa fa-users"></i> <span>Data Siswa</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url() ?>index.php/Admin/SPP">
            <i class="fa fa-book"></i> <span>Data SPP</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url() ?>index.php/Admin/Petugas">
            <i class="fa fa-user"></i> <span>Data Petugas</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url() ?>index.php/Admin/Transaksi">
            <i class="fa fa-gg"></i> <span>Data Transaksi</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        
      </ul>
  <?php }
  if ($levelmenu=='petugas') { ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="<?php echo base_url() ?>index.php/Admin/Transaksi">
            <i class="fa fa-gg"></i> <span>Data Transaksi</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
      </ul>
  <?php }

?>



