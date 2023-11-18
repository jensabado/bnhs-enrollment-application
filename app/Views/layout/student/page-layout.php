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
  <?= $this->include('layout/student/inc/preloader.php') ?>

  <?= $this->include('layout/student/inc/header.php') ?>

  <?= $this->include('layout/student/inc/right-sidebar.php') ?>

  <?= $this->include('layout/student/inc/left-sidebar.php') ?>
  
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