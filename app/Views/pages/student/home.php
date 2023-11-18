<?= $this->extend('layout/student/page-layout') ?>

<?= $this->section('content') ?>
<style>
.bg-light-gray {
  background-color: #f7f7f7;
}

.table-bordered thead td,
.table-bordered thead th {
  border-bottom-width: 2px;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table-bordered td,
.table-bordered th {
  border: 1px solid #dee2e6;
}

.padding-15px-lr {
  padding-left: 15px;
  padding-right: 15px;
}

.padding-5px-tb {
  padding-top: 5px;
  padding-bottom: 5px;
}

.margin-10px-bottom {
  margin-bottom: 10px;
}

.border-radius-5 {
  border-radius: 5px;
}

.margin-10px-top {
  margin-top: 10px;
}

.font-size14 {
  font-size: 14px;
}

.text-light-gray {
  color: #d6d5d5;
}

.font-size13 {
  font-size: 13px;
}

.table-bordered td,
.table-bordered th {
  border: 1px solid #dee2e6;
}

.table td,
.table th {
  padding: .75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.custom_header {
  display: flex;
  justify-content: space-between;
  padding: 0;
}
</style>

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>Dashboard</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">
                Dashboard
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <div class="container-fluid">
        <div class="row mb-4 d-flex flex-column align-items-center justify-content-center" id="header_logo">
          <img style="width: 80px;" class="mb-2" src="<?= base_url('home-assets/img/logo.png') ?>" alt="">
          <p class="h3 text-center fw-bold">BACOOR NATIONAL HIGH SCHOOL - MAIN</p>
        </div>
        <?php foreach($schedHeader as $header) { ?>
        <div class="row">
          <div class="col-md-6">
            <p class="font-weight-bold">
              GRADE & SECTION:
              <span
                style="font-weight: 500; padding-left: 10px;"><?= ucwords($header['grade'] . ' ' . $header['section']) ?></span>
            </p>
          </div>
          <div class="col-md-6 text-md-right">
            <p class="font-weight-bold">
              ADVISER:
              <span
                style="font-weight: 500; padding-left: 10px;"><?= ucwords($header['f_name'] . ' ' . $header['l_name']) ?></span>
            </p>
          </div>
          <div class="col-md-6">
            <p class="font-weight-bold">
              ROOM:
              <span
                style="font-weight: 500; padding-left: 10px;"><?= ucwords($header['building'] . ' - ' . $header['room']) ?></span>
            </p>
          </div>
        </div>
        <?php } ?>
        <div class="timetable-img text-center">
          <img src="img/content/timetable.png" alt="">
        </div>
        <div class="table-responsive">
          <table class="table table-bordered text-center">
            <thead>
              <tr class="bg-light-gray">
                <th class="text-uppercase">Time
                </th>
                <th class="text-uppercase">Monday</th>
                <th class="text-uppercase">Tuesday</th>
                <th class="text-uppercase">Wednesday</th>
                <th class="text-uppercase">Thursday</th>
                <th class="text-uppercase">Friday</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($schedules) > 0) { ?>
              <?php foreach($schedules as $row) { ?>
              <?php $schedule[date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A',
              strtotime($row['end_time']))][$row['day_id']] = '<span
              class="bg-primary padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13 mb-2">' . ucwords($row['subject']) . '</span> <div class="font-size13 text-dark mt-2">' . ucwords($row['f_name'] . ' ' .
              $row['l_name']) . '</div>' ?>
              <?php } ?>

              <?php foreach($schedule as $time => $days) { ?>
              <tr>
                <td class="align-middle font-weight-bold"><?= $time ?></td>
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
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>