<div class="header">
  <div class="header-left">
    <div class="menu-icon bi bi-list"></div>
  </div>
  <div class="header-right">
    <div class="user-info-dropdown d-flex align-items-center">
      <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
          <span class="user-icon" style="width: 40px; height: 40px;">
            <img
              src="<?= !empty(getStudent()->photo) ? base_url('/admin-assets/vendors/images/avatar/' . getStudent()->photo) : base_url('avatar/no-image/avatar-1.png') ?>"
              alt="" />
          </span>
          <span class="user-name"><?= getStudent()->firstname . ' ' . getStudent()->lastname; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
          <a class="dropdown-item" href="<?= route_to('admin.logout') ?>"><i class="dw dw-logout"></i> Log Out</a>
        </div>
      </div>
    </div>
  </div>
</div>