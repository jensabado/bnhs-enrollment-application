<div class="left-side-bar">
  <div class="brand-logo">
    <a href="<?= route_to('admin.home') ?>">
      <div class="d-flex align-items-center justify-content-center">
        <img src="<?= base_url('home-assets/img/bnhs-logo.png') ?>" style="width: 50px;" alt="" class="dark-logo" />
        <img src="<?= base_url('home-assets/img/bnhs-logo.png') ?>" style="width: 50px;" alt="" class="light-logo" />
        <h4 class="text-dark ml-2">BACOOR NHS</h4>
      </div>
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">
        <li>
          <a href="<?= route_to('admin.home') ?>" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-house"></span><span class="mtext">Home</span>
          </a>
        </li>
        <li>
          <div class="sidebar-small-cap">SCHOOL INFORMATION</div>
        </li>
        <li>
          <a href="<?= route_to('admin.building') ?>" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-building"></span><span class="mtext">Building</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>