<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('home-assets/img/logo.png') ?>" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('home-assets/img/logo.png') ?>" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('home-assets/img/logo.png') ?>" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('admin-assets/vendors/styles/core.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('admin-assets/vendors/styles/icon-font.min.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('admin-assets/vendors/styles/style.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('global/jquery.dataTables.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('global/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('global/ijaboCropTool/ijaboCropTool.min.css') ?>">
  <title><?= isset($pageTitle) ? $pageTitle : 'Student' ?></title>
</head>

<body>
  <!-- <div class="pre-loader">
    <div class="pre-loader-box">
      <div class="loader-logo">
        <img src="<?= base_url('home-assets/img/bnhs-logo.png') ?>" style="width: 90px;" alt="" />
      </div>
      <div class="loader-progress" id="progress_div">
        <div class="bar" id="bar1"></div>
      </div>
      <div class="percent" id="percent1">0%</div>
    </div>
  </div> -->

  <div class="header">
    <div class="header-left">
      <div class="menu-icon bi bi-list"></div>
      <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
      <div class="header-search">
        <form>
          <div class="form-group mb-0">
            <i class="dw dw-search2 search-icon"></i>
            <input type="text" class="form-control search-input" placeholder="Search Here" />
            <div class="dropdown">
              <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                <i class="ion-arrow-down-c"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="form-group row">
                  <label class="col-sm-12 col-md-2 col-form-label">From</label>
                  <div class="col-sm-12 col-md-10">
                    <input class="form-control form-control-sm form-control-line" type="text" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-12 col-md-2 col-form-label">To</label>
                  <div class="col-sm-12 col-md-10">
                    <input class="form-control form-control-sm form-control-line" type="text" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                  <div class="col-sm-12 col-md-10">
                    <input class="form-control form-control-sm form-control-line" type="text" />
                  </div>
                </div>
                <div class="text-right">
                  <button class="btn btn-primary">Search</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="header-right">
      <div class="dashboard-setting user-notification">
        <div class="dropdown">
          <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
            <i class="dw dw-settings2"></i>
          </a>
        </div>
      </div>
      <div class="user-notification">
        <div class="dropdown">
          <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
            <i class="icon-copy dw dw-notification"></i>
            <span class="badge notification-active"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="notification-list mx-h-350 customscroll">
              <ul>
                <li>
                  <a href="#">
                    <img src="<?= base_url('admin-assets/vendors/images/img.jpg') ?>" alt="" />
                    <h3>John Doe</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="<?= base_url('admin-assets/vendors/images/photo1.jpg') ?>" alt="" />
                    <h3>Lea R. Frith</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="<?= base_url('admin-assets/vendors/images/photo2.jpg') ?>" alt="" />
                    <h3>Erik L. Richards</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="<?= base_url('admin-assets/vendors/images/photo3.jpg') ?>" alt="" />
                    <h3>John Doe</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="<?= base_url('admin-assets/vendors/images/photo4.jpg') ?>" alt="" />
                    <h3>Renee I. Hansen</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="<?= base_url('admin-assets/vendors/images/img.jpg') ?>" alt="" />
                    <h3>Vicki M. Coleman</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
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
            <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
            <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
            <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
            <a class="dropdown-item" href="<?= route_to('admin.logout') ?>"><i class="dw dw-logout"></i> Log Out</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="right-sidebar">
    <div class="sidebar-title">
      <h3 class="weight-600 font-16 text-blue">
        Layout Settings
        <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
      </h3>
      <div class="close-sidebar" data-toggle="right-sidebar-close">
        <i class="icon-copy ion-close-round"></i>
      </div>
    </div>
    <div class="right-sidebar-body customscroll">
      <div class="right-sidebar-body-content">
        <h4 class="weight-600 font-18 pb-10">Header Background</h4>
        <div class="sidebar-btn-group pb-30 mb-10">
          <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
          <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
        </div>

        <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
        <div class="sidebar-btn-group pb-30 mb-10">
          <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
          <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
        </div>

        <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
        <div class="sidebar-radio-group pb-10 mb-10">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input"
              value="icon-style-1" checked="" />
            <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input"
              value="icon-style-2" />
            <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input"
              value="icon-style-3" />
            <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
          </div>
        </div>

        <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
        <div class="sidebar-radio-group pb-30 mb-10">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input"
              value="icon-list-style-1" checked="" />
            <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input"
              value="icon-list-style-2" />
            <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                aria-hidden="true"></i></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input"
              value="icon-list-style-3" />
            <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input"
              value="icon-list-style-4" checked="" />
            <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input"
              value="icon-list-style-5" />
            <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input"
              value="icon-list-style-6" />
            <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
          </div>
        </div>

        <div class="reset-options pt-30 text-center">
          <button class="btn btn-danger" id="reset-settings">
            Reset Settings
          </button>
        </div>
      </div>
    </div>
  </div>

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
          <li>
            <a href="<?= route_to('admin.room') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-door-closed"></span><span class="mtext">Room</span>
            </a>
          </li>
          <li>
            <a href="<?= route_to('admin.section') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-door-open"></span><span class="mtext">Section</span>
            </a>
          </li>
          <li>
            <a href="<?= route_to('admin.subject') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-journals"></span><span class="mtext">Subject</span>
            </a>
          </li>
          <li>
            <a href="<?= route_to('admin.teacher') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-person-video3"></span><span class="mtext">Teacher</span>
            </a>
          </li>
          <li>
            <a href="<?= route_to('admin.teacher-subject') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-journal-bookmark"></span><span class="mtext">Teacher Subject</span>
            </a>
          </li>
          <li>
            <a href="<?= route_to('admin.class-advisory') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-person-workspace"></span><span class="mtext">Class Advisory</span>
            </a>
          </li>
          <li>
            <a href="<?= route_to('admin.classroom-schedule') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-calendar"></span><span class="mtext">Classroom Schedule</span>
            </a>
          </li>
          <li>
            <div class="sidebar-small-cap">PENDING ENROLLEES</div>
          </li>
          <li>
            <a href="<?= route_to('admin.enrollees/grade-7') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-person"></span><span class="mtext">Grade 7</span>
            </a>
          </li>
          <li>
            <div class="sidebar-small-cap">ENROLLED</div>
          </li>
          <li>
            <a href="<?= route_to('admin.enrollees/grade-7') ?>" class="dropdown-toggle no-arrow">
              <span class="micon bi bi-person-check"></span><span class="mtext">Grade 7</span>
            </a>
          </li>
          <!-- <li>
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon bi bi-file-pdf"></span><span class="mtext">Documentation</span>
            </a>
            <ul class="submenu">
              <li><a href="introduction.html">Introduction</a></li>
              <li><a href="getting-started.html">Getting Started</a></li>
              <li><a href="color-settings.html">Color Settings</a></li>
              <li>
                <a href="third-party-plugins.html">Third Party Plugins</a>
              </li>
            </ul>
          </li> -->
        </ul>
      </div>
    </div>
  </div>
  <div class="mobile-menu-overlay"></div>

  <div class="main-container">
    <?= $this->renderSection('content') ?>
  </div>
  <!-- js -->
  <script src="<?= base_url('admin-assets/vendors/scripts/core.js') ?>"></script>
  <script src="<?= base_url('admin-assets/vendors/scripts/script.min.js') ?>"></script>
  <script src="<?= base_url('admin-assets/vendors/scripts/process.js') ?>"></script>
  <script src="<?= base_url('admin-assets/vendors/scripts/layout-settings.js') ?>"></script>
  <script src="<?= base_url('global/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('global/sweetalert2@11.js') ?>"></script>
  <script src="<?= base_url('global/select2.min.js') ?>"></script>
  <script src="<?= base_url('global/ijaboCropTool/ijaboCropTool.min.js') ?>"></script>

  <script>
  function togglePasswordVisibility(inputSelector, iconSelector) {
    var passwordInput = $(inputSelector);
    var icon = $(iconSelector);

    if (passwordInput.attr("type") === "password") {
      passwordInput.attr("type", "text");
      icon.toggleClass("bi-eye bi-eye-slash");
    } else {
      passwordInput.attr("type", "password");
      icon.toggleClass("bi-eye-slash bi-eye");
    }
  }
  </script>

  <?= $this->renderSection('script') ?>
</body>

</html>