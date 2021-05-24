<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama_pengguna; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">LIST MENU</li>
      <!-- Optionally, you can add icons to the links -->
      <?php if ($this->userdata->level == "1") {?>
      <li <?php if ($page == 'Buku Tamu') {
    echo 'class="active"';
} ?>>
        <a href="<?php echo base_url('Bukutamu'); ?>">
          <i class="fa fa-book"></i>
          <span>Buku Tamu</span>
        </a>
      </li>

      <li <?php if ($page == 'Data Tamu') {
    echo 'class="active"';
} ?>>
        <a href="<?php echo base_url('Bukutamu/data_tamu'); ?>">
          <i class="fa fa-user"></i>
          <span>Data Tamu</span>
        </a>
      </li>
  <?php  } ?>

<?php if ($this->userdata->level == "2") {?>
      <li <?php if ($page == 'Laporan Kedeputian') {
    echo 'class="active"';
} ?>>
        <a href="<?php echo base_url('Kedeputian'); ?>">
          <i class="fa fa-book"></i>
          <span>Laporan Kedeputian</span>
        </a>
      </li>
    </ul>
  <?php } ?>

  <?php if ($this->userdata->level == "3") {?>
        <li <?php if ($page == 'Laporan Bidang PPID') {
    echo 'class="active"';
} ?>>
          <a href="<?php echo base_url('PpidInformasi'); ?>">
            <i class="fa fa-book"></i>
            <span>Laporan Informasi</span>
          </a>
        </li>
      </ul>
    <?php } ?>

    <?php if ($this->userdata->level == "4") {?>
          <li <?php if ($page == 'Laporan Bidang PPID') {
    echo 'class="active"';
} ?>>
            <a href="<?php echo base_url('PpidInformasiWeb'); ?>">
              <i class="fa fa-book"></i>
              <span>Laporan Informasi Web</span>
            </a>
          </li>
        </ul>
      <?php } ?>

      <?php if ($this->userdata->level == "5") {?>
            <li <?php if ($page == 'Laporan Bidang PPID') {
    echo 'class="active"';
} ?>>
              <a href="<?php echo base_url('PpidKegiatan'); ?>">
                <i class="fa fa-book"></i>
                <span>Laporan Kegiatan</span>
              </a>
            </li>
          </ul>
        <?php } ?>

        <?php if ($this->userdata->level == "6") {?>
              <li <?php if ($page == 'Laporan Bidang ULP') {
    echo 'class="active"';
} ?>>
                <a href="<?php echo base_url('Ulp'); ?>">
                  <i class="fa fa-book"></i>
                  <span>Laporan ULP</span>
                </a>
              </li>
            </ul>
          <?php } ?>

  <?php if ($this->userdata->level == "7") {?>
        <li <?php if ($page == 'Admin') {
    echo 'class="active"';
} ?>>
          <a href="<?php echo base_url('Admin'); ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview <?php if ($deskripsi == 'Input Laporan') {
    echo 'active';
} ?>">
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu" >
              <li class="treeview-menu-open <?php if ($page == 'Laporan Bidang PPID') {
    echo "active";
} ?>"><a href="#"><i class="fa fa-circle-o"></i> Bidang PPID   <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu" >
    <li class="<?php if ($judul == 'Bidang PPID Permintaan Informasi') {
    echo "active";
} ?>"><a href="<?php echo base_url('PpidInformasi'); ?>"><i class="fa fa-circle-o"></i> Permintaan Informasi</a></li>
<li class="<?php if ($judul == 'Bidang PPID Permintaan Informasi Web') {
    echo "active";
} ?>"><a href="<?php echo base_url('PpidInformasiWeb'); ?>"><i class="fa fa-circle-o"></i> Permintaan Informasi Web</a></li>
<li class="<?php if ($judul == 'Bidang PPID Kegiatan Kemenko Polhukam') {
    echo "active";
} ?>"><a href="<?php echo base_url('PpidKegiatan'); ?>"><i class="fa fa-circle-o"></i> Kegiatan Rapat Polhukam</a></li>
</ul>
</li>
              <li class="<?php if ($page == 'Laporan ULP') {
    echo "active";
} ?>"><a href="<?php echo base_url('Ulp'); ?>"><i class="fa fa-circle-o"></i> Bidang ULP</a></li>
              <li class="treeview-menu-open <?php if ($page == 'Laporan Kedeputian') {
    echo "active";
} ?>"><a href="#"><i class="fa fa-circle-o"></i> Kedeputian <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu" >
    <li class="<?php if ($judul == 'Bidang Pelayanan Fungsional Kedeputian I') {
    echo "active";
} ?>"><a href="<?php echo base_url('Kedeputian1'); ?>"><i class="fa fa-circle-o"></i> Kedeputian I</a></li>

  <li class="<?php if ($judul == 'Bidang Pelayanan Fungsional Kedeputian II') {
    echo "active";
} ?>"><a href="<?php echo base_url('Kedeputian2'); ?>"><i class="fa fa-circle-o"></i> Kedeputian II</a></li>

  <li class="<?php if ($judul == 'Bidang Pelayanan Fungsional Kedeputian III') {
    echo "active";
} ?>"><a href="<?php echo base_url('Kedeputian3'); ?>"><i class="fa fa-circle-o"></i> Kedeputian III</a></li>

  <li class="<?php if ($judul == 'Bidang Pelayanan Fungsional Kedeputian IV') {
    echo "active";
} ?>"><a href="<?php echo base_url('Kedeputian4'); ?>"><i class="fa fa-circle-o"></i> Kedeputian IV</a></li>

  <li class="<?php if ($judul == 'Bidang Pelayanan Fungsional Kedeputian V') {
    echo "active";
} ?>"><a href="<?php echo base_url('Kedeputian5'); ?>"><i class="fa fa-circle-o"></i> Kedeputian V</a></li>

  <li class="<?php if ($judul == 'Bidang Pelayanan Fungsional Kedeputian VI') {
    echo "active";
} ?>"><a href="<?php echo base_url('Kedeputian6'); ?>"><i class="fa fa-circle-o"></i> Kedeputian VI</a></li>

  <li class="<?php if ($judul == 'Bidang Pelayanan Fungsional Kedeputian VII') {
    echo "active";
} ?>"><a href="<?php echo base_url('Kedeputian7'); ?>"><i class="fa fa-circle-o"></i> Kedeputian VII</a></li>
  </ul>
              </li>
            </ul>
        </li>
      </ul>
    <?php } ?>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
