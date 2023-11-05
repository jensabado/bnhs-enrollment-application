<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('home-assets/img/logo.png') ?>" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('home-assets/img/logo.png') ?>" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('home-assets/img/logo.png') ?>" />

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?= $pageTitle ?></title>

  <style>
  body {
    font-family: "Poppins", sans-serif !important;
  }

  table {
    width: 100%;
    border: 1px solid black;
  }

  th,
  td {
    text-align: center;
    border: 1px solid black;
  }

  .custom_header {
    display: flex;
    justify-content: space-between;
    padding: 0;
  }

  .btn-primary {
    background-color: #274c43 !important;
    border-color: #274c43 !important;
    font-weight: 700;
  }

  .btn-primary:hover {
    background-color: #1e3832 !important;
    border-color: #1e3832 !important;
  }

  .container-fluid {
    padding: 0px 350px;
  }

  #printed_info {
    display: none;
  }

  #header_logo {
    display: none !important;
  }

  @media print {
    #print_page {
      display: none;
    }

    @page {
      margin: 0;
    }

    body {
      margin: 1.6cm;
    }

    .container-fluid {
      padding: 0px;
    }

    #printed_info {
      display: flex;
    }

    #header_logo {
      display: flex !important;
    }
  }
  </style>
</head>

<body>
  <div class="container-fluid my-5">
    <div class="row mb-4 d-flex flex-column align-items-center justify-content-center" id="header_logo">
      <img style="width: 150px;" class="mb-2" src="<?= base_url('home-assets/img/logo.png') ?>" alt="">
      <p class="h3 text-center fw-bold">BACOOR NATIONAL HIGH SCHOOL - MAIN</p>
    </div>
    <?php foreach($schedHeader as $header) { ?>
    <div class=" custom_header">
      <p class="fw-bold">
        GRADE & SECTION:
        <span
          style="font-weight: 500; padding-left: 10px;"><?= ucwords($header['grade'] . ' ' . $header['section']) ?></span>
        <br><br>
        ROOM:
        <span
          style="font-weight: 500; padding-left: 10px;"><?= ucwords($header['building'] . ' - ' . $header['room']) ?></span>
      </p>
      <p class="fw-bold">
        ADVISER:
        <span
          style="font-weight: 500; padding-left: 10px;"><?= ucwords($header['f_name'] . ' ' . $header['l_name']) ?></span>
        <br><br>
      </p>
    </div>
    <?php } ?>

    <table class="table">
      <tr>
        <th>Time</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
      </tr>
      <?php if(count($schedules) > 0) { ?>
      <?php foreach($schedules as $row) { ?>
      <?php $schedule[date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A',
      strtotime($row['end_time']))][$row['day_id']] = ucwords($row['subject']) . '<br>' . ucwords($row['f_name'] . ' ' .
      $row['l_name']); ?>
      <?php } ?>

      <?php foreach($schedule as $time => $days) {
      ?>
      <tr>
        <td class="fw-bold"><?= $time ?></td>
        <?php $daysOfWeek = array('1', '2', '3', '4', '5'); ?>
        <?php foreach($daysOfWeek as $day) { ?>
        <td>
          <?php if(isset($days[$day])) { ?>
          <?= $days[$day] ?>
          <?php } ?>
        </td>
        <?php } ?>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td colspan="6">NO RESULT</td>
      </tr>
      <?php } ?>
    </table>
    <div class="row" id="printed_info">
      <p class="fw-bold">Printed By: <span style="font-weight: 500; padding-left: 10px"><?= getUser()->name; ?></span>
      </p>
    </div>
  </div>

  <script>
  window.onload = function() {
    window.print();
  }

  window.onafterprint = function() {
    // Redirect back to the index page
    window.close();
  }
  </script>
</body>

</html>