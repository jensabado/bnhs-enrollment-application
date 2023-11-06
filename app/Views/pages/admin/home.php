<?= $this->extend('layout/admin/page-layout') ?>

<?= $this->section('content') ?>
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
    <div class="row d-flex flex-row align-item-center mb-30">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/building.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $buildingCount ?></p>
              <p class="h6 text-right">Building</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/room.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $roomCount ?></p>
              <p class="h6 text-right">Room</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/section.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $sectionCount ?></p>
              <p class="h6 text-right">Section</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/teacher.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $teacherCount ?></p>
              <p class="h6 text-right">Teacher</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/grade_7_sub.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $grade7SubjectCount ?></p>
              <p class="h6 text-right">Grade 7 Subject</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/grade_8_sub.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $grade8SubjectCount ?></p>
              <p class="h6 text-right">Grade 8 Subject</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/grade_9_sub.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $grade9SubjectCount ?></p>
              <p class="h6 text-right">Grade 9 Subject</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px;">
        <div class="card shadow p-3 h-100 d-flex justify-content-center" style="border: none;">
          <div class="d-flex flex-row align-items-center">
            <img src="<?= base_url('admin-assets/illustration/grade_10_sub.svg') ?>" alt="" style="height: 80px;">
            <div class="d-flex flex-column align-items-end w-100 h-100">
              <p style="font-weight: 900; color: #274C43;" class="h1"><?= $grade10SubjectCount ?></p>
              <p class="h6 text-right">Grade 10 Subject</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>