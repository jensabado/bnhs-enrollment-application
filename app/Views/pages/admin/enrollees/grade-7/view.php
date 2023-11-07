<?= $this->extend('layout/admin/page-layout') ?>

<?= $this->section('content') ?>
<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>
              <?= empty($studentData->middle_initial) ? $studentData->lastname . ', ' . $studentData->firstname : $studentData->lastname . ', ' . $studentData->firstname . ' ' . $studentData->middle_initial . '.' ?>
            </h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?=route_to('admin.home')?>">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                View Enrollee
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active font-weight-bold" data-toggle="tab" href="#personal" role="tab"
              aria-selected="true">Personal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-bold" data-toggle="tab" href="#contact" role="tab"
              aria-selected="false">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-bold" data-toggle="tab" href="#requirements" role="tab"
              aria-selected="false">Requirements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-bold" data-toggle="tab" href="#status" role="tab"
              aria-selected="false">Status</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="personal" role="tabpanel">
            <div class="row mt-4">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">LRN</label>
                  <input type="text" name="lrn" id="lrn" class="form-control" value="<?= $studentData->lrn ?>" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Grade Level</label>
                  <input type="text" name="grade" id="grade" class="form-control" value="<?= $studentData->grade ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Last Name</label>
                  <input type="text" name="lastname" id="lastname" class="form-control"
                    value="<?= $studentData->lastname ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">First Name</label>
                  <input type="text" name="firstname" id="firstname" class="form-control"
                    value="<?= $studentData->firstname ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Middle Initial</label>
                  <input type="text" name="middle_initial" id="middle_initial" class="form-control"
                    value="<?= $studentData->middle_initial ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Gender</label>
                  <select name="gender" id="gender" class="form-control">
                    <option value="" disabled>SELECT GENDER</option>
                    <option value="Female" <?= $studentData->gender == 'Female' ? 'selected' : '' ?>>FEMALE</option>
                    <option value="Male" <?= $studentData->gender == 'Male' ? 'selected' : '' ?>>MALE</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Date of Birth</label>
                  <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                    value="<?= $studentData->date_of_birth ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Address</label>
                  <textarea name="address" id="address" cols="30" rows="4" class="form-control"
                    style="height: 70px; resize: none;"><?= $studentData->address ?></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Place of Birth</label>
                  <textarea name="place_of_birth" id="place_of_birth" cols="30" rows="4" class="form-control"
                    style="height: 70px; resize: none;"><?= $studentData->place_of_birth ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Nationality</label>
                  <input type="text" name="nationality" id="nationality" class="form-control"
                    value="<?= $studentData->nationality ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Religion</label>
                  <input type="text" name="religion" id="religion" class="form-control"
                    value="<?= $studentData->religion ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel">
            <div class="row mt-4">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Student Contact</label>
                  <div class="input-group">
                    <div class="input-group-prepend border rounded-left" style="border-color: #d4d4d4 !important;">
                      <span class="input-group-text" id="basic-addon1" style="font-size: 14px;">+63</span>
                    </div>
                    <input type="text" class="form-control" id="contact_no" name="contact_no"
                      value="<?= $studentData->contact_no ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Student Email</label>
                  <input type="text" name="email" id="email" class="form-control" value="<?= $studentData->email ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Guardian's Name</label>
                  <input type="text" name="guardian" id="guardian" class="form-control"
                    value="<?= $studentData->guardian ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Guardian's Contact</label>
                  <div class="input-group">
                    <div class="input-group-prepend border rounded-left" style="border-color: #d4d4d4 !important;">
                      <span class="input-group-text" id="basic-addon1" style="font-size: 14px;">+63</span>
                    </div>
                    <input type="text" class="form-control" id="parent_contact_no" name="parent_contact_no"
                      value="<?= $studentData->parent_contact_no ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="requirements" role="tabpanel">
            <div class="row mt-4">
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">Video Record</label>
                  <a href="<?= base_url('requirements/video-record/' . $studentRequirements->video_record) ?>"
                    target="_blank" style="text-decoration: underline;"
                    class="font-weight-bold"><?= $studentRequirements->video_record ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">PDF File</label>
                  <a href="<?= base_url('requirements/pdf-file/' . $studentRequirements->pdf_file) ?>" target="_blank"
                    style="text-decoration: underline;"
                    class="font-weight-bold"><?= $studentRequirements->pdf_file ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">Form 138</label>
                  <a href="<?= base_url('requirements/form-138/' . $studentRequirements->form_138) ?>" target="_blank"
                    style="text-decoration: underline;"
                    class="font-weight-bold"><?= $studentRequirements->form_138 ?></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">PSA Birth Cert</label>
                  <a href="<?= base_url('requirements/psa-birth-cert/' . $studentRequirements->psa_birth_cert) ?>"
                    target="_blank" style="text-decoration: underline;"
                    class="font-weight-bold"><?= $studentRequirements->psa_birth_cert ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">Barangay Clearance</label>
                  <a href="<?= base_url('requirements/brgy-clearance/' . $studentRequirements->brgy_clearance) ?>"
                    target="_blank" style="text-decoration: underline;"
                    class="font-weight-bold"><?= $studentRequirements->brgy_clearance ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">Good Moral</label>
                  <a href="<?= base_url('requirements/good-moral/' . $studentRequirements->good_moral) ?>"
                    target="_blank" style="text-decoration: underline;"
                    class="font-weight-bold"><?= $studentRequirements->good_moral ?></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">ID of Guardian</label>
                  <a href="<?= base_url('requirements/guardian-id/' . $studentRequirements->guardian_id) ?>"
                    target="_blank" style="text-decoration: underline;"
                    class="font-weight-bold"><?= $studentRequirements->guardian_id ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="status" role="tabpanel">
            <form action="" id="status_form">
              <div class="row mt-4">
                <?= csrf_field(); ?>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">STATUS</label>
                    <select name="status" id="status" class="form-control" style="width: 100% !important">
                      <option value="" selected disabled>SELECT STATUS</option>
                      <?php if($studentData->status == 0) { ?>
                      <option value="1">APPROVED</option>
                      <?php } ?>
                      <option value="8">CANCEL</option>
                    </select>
                    <span class="text-danger error" style="font-size: 13px;" id="status_error"></span>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary" id="status_submit_btn">Update Status</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
  $('#status, #gender').select2({
    minimumResultsForSearch: -1
  });

  // update status
  $('#status_form').on('submit', function(e) {
    e.preventDefault();

    const form = new FormData(this);
    
    $.ajax({
      type: "POST",
      url: "<?=route_to('admin.update-enrollees-status')?>",
      data: form,
      headers: {
        'X-CSRF-TOKEN': $('input[name="<?= csrf_token() ?>"]').val()
      },
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function() {
        $('.error').text('');
        $('#status_submit_btn').attr('disabled', true);
      },
      complete: function() {
        $('#status_submit_btn').attr('disabled', false);
      },
      success: function(response) {
        $('input[name="<?= csrf_token() ?>"]').val(response.csrfHash);
        if (response.status === 'success') {
          
        } else if (response.status === 'error') {
          for (const [field, errorMessage] of Object.entries(response.message)) {
            $(`#${field}_error`).text(`${errorMessage}`);
          }
        } else {
          $('#add_form_alert_div').removeClass('d-none');
          $('#add_form_alert_div').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>${response.message}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>`);
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    })
  })
})
</script>
<?= $this->endSection() ?>