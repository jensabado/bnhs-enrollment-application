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
            <a class="nav-link font-weight-bold" data-toggle="tab" href="#status_tab" role="tab"
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
                  <a href="<?= !empty($studentRequirements->video_record) ? $studentRequirements->video_record : 'javascript:void(0)' ?>"
                    <?= !empty($studentRequirements->video_record) ? 'target="_blank"' : '' ?>
                    style="text-decoration: underline; overflow-wrap: break-word;"
                    class="font-weight-bold"><?= !empty($studentRequirements->video_record) ? $studentRequirements->video_record : 'N/A' ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">PDF File</label>
                  <a href="<?= !empty($studentRequirements->pdf_file) ? base_url('requirements/pdf-file/' . $studentRequirements->pdf_file) : '#' ?>"
                    <?= !empty($studentRequirements->pdf_file) ? 'target="_blank"' : '' ?> style="text-decoration: underline; overflow-wrap: break-word;"
                    class="font-weight-bold"><?= !empty($studentRequirements->pdf_file) ? $studentRequirements->pdf_file : 'N/A' ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">Form 138</label>
                  <a href="<?= !empty($studentRequirements->form_138) ? base_url('requirements/form-138/' . $studentRequirements->form_138) : '#' ?>"
                    <?= !empty($studentRequirements->form_138) ? 'target="_blank"' : '' ?> style="text-decoration: underline; overflow-wrap: break-word;"
                    class="font-weight-bold"><?= !empty($studentRequirements->form_138) ? $studentRequirements->form_138 : 'N/A' ?></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">PSA Birth Cert</label>
                  <a href="<?= !empty($studentRequirements->psa_birth_cert) ? base_url('requirements/psa-birth-cert/' . $studentRequirements->psa_birth_cert) : '#' ?>"
                    <?= !empty($studentRequirements->psa_birth_cert) ? 'target="_blank"' : '' ?>
                    style="text-decoration: underline; overflow-wrap: break-word;"
                    class="font-weight-bold"><?= !empty($studentRequirements->psa_birth_cert) ? $studentRequirements->psa_birth_cert : 'N/A' ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">Barangay Clearance</label>
                  <a href="<?= !empty($studentRequirements->brgy_clearance) ? base_url('requirements/brgy-clearance/' . $studentRequirements->brgy_clearance) : '#' ?>"
                    <?= !empty($studentRequirements->brgy_clearance) ? 'target="_blank"' : '' ?>
                    style="text-decoration: underline; overflow-wrap: break-word;"
                    class="font-weight-bold"><?= !empty($studentRequirements->brgy_clearance) ? $studentRequirements->brgy_clearance : 'N/A' ?></a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">Good Moral</label>
                  <a href="<?= !empty($studentRequirements->good_moral) ? base_url('requirements/good-moral/' . $studentRequirements->good_moral) : '#' ?>"
                    <?= !empty($studentRequirements->good_moral) ? 'target="_blank"' : '' ?> style="text-decoration: underline; overflow-wrap: break-word;"
                    class="font-weight-bold"><?= !empty($studentRequirements->good_moral) ? $studentRequirements->good_moral : 'N/A' ?></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group d-flex flex-column">
                  <label for="">ID of Guardian</label>
                  <a href="<?= !empty($studentRequirements->guardian_id) ? base_url('requirements/guardian-id/' . $studentRequirements->guardian_id) : '#' ?>"
                    <?= !empty($studentRequirements->guardian_id) ? 'target="_blank"' : '' ?>
                    style="text-decoration: underline; overflow-wrap: break-word;"
                    class="font-weight-bold"><?= !empty($studentRequirements->guardian_id) ? $studentRequirements->guardian_id : 'N/A' ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="status_tab" role="tabpanel">
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
                      <option value="11">DECLINE</option>
                    </select>
                    <span class="text-danger error" style="font-size: 13px;" id="status_error"></span>
                  </div>
                </div>
                <div class="col-md-4 d-none" id="section_cont">
                  <div class="form-group">
                    <label for="">Section</label>
                    <select name="section" id="section" class="form-control" style="width: 100%;">

                    </select>
                    <span class="text-danger error" style="font-size: 13px;" id="section_error"></span>
                  </div>
                </div>
                <div class="col-md-4 d-none" id="status_password_cont">
                  <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="status_password" id="status_password" class="form-control">
                    <span class="text-danger error" style="font-size: 13px;" id="status_password_error"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 d-none" id="reason_cont">
                  <div class="form-group">
                    <label for="">Reason</label>
                    <textarea name="reason" id="reason" cols="30" rows="4" class="form-control"
                      style="height: 70px; resize: none;"></textarea>
                    <span class="text-danger error" style="font-size: 13px;" id="reason_error"></span>
                  </div>
                </div>
              </div>
              <div class="row">
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
// Dynamic dependent dropdown action
function populateSectionDropdown(targetDropdown) {
  const form = new FormData();
  form.append('id', '<?= $studentData->grade_level_id ?>');
  $.ajax({
    type: 'POST',
    url: '<?= route_to("admin.get-section-option") ?>',
    data: form,
    contentType: false,
    processData: false,
    cache: false,
    success: function(response) {
      console.log(response);
      targetDropdown.empty().prop('disabled', false).append(
        '<option value="" selected disabled>SELECT SECTION</option>');
      if (response.status === 'success') {
        for (const [id, value] of Object.entries(response.message)) {
          targetDropdown.append(`<option value="${value.id}">${value.section}</option>`);
        }
      } else if (response.status === 'error') {
        targetDropdown.append(`<option value="">${response.message}</option>`);
      }
    }
  });
}

$(document).ready(function() {
  $('#status, #gender').select2({
    minimumResultsForSearch: -1
  });

  $('#section').select2();

  // status onchange
  $('#status').on('change', function(e) {
    e.preventDefault();

    let status = $(this).val();

    if (status == 1) {
      $('#status_password_cont').removeClass('d-none');
      $('#section_cont').removeClass('d-none');
      $('#reason_cont').addClass('d-none');
      populateSectionDropdown($('#section'))
    } else if (status == 11) {
      $('#status_password_cont').addClass('d-none');
      $('#section_cont').addClass('d-none');
      $('#reason_cont').removeClass('d-none');
    }
  })

  // update status
  $('#status_form').on('submit', function(e) {
    e.preventDefault();

    const form = new FormData(this);
    form.append('id', '<?= $studentData->id ?>');

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
          localStorage.setItem('status', 'success');
          localStorage.setItem('message', response.message);
          window.location.href = '<?= route_to('admin.enrollees/grade-7') ?>'
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