<?=$this->extend('layout/admin/page-layout')?>

<?=$this->section('content')?>
<!-- model section -->
<!-- add -->
<div class="modal fade" style="padding-right: 17px;" id="add_modal" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">
          Add Subject Schedule
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <div class="modal-body">
        <form id="add_form">
          <?= csrf_field(); ?>
          <div class="p-0 d-none alert_div" id="add_form_alert_div"></div>
          <div class="form-group">
            <label for="">Grade Level</label>
            <select name="add_grade" id="add_grade" class="form-control" style="width: 100%;">
              <option value="" selected disabled>SELECT GRADE LEVEL</option>
              <?php if(!empty($gradeLevelData) || $gradeLevelData == null) { ?>
              <?php foreach($gradeLevelData as $grade) { ?>
              <option value="<?= $grade->id ?>"><?= ucwords($grade->grade) ?></option>
              <?php } ?>
              <?php } else { ?>
              <option value="">NO RESULT</option>
              <?php } ?>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="add_grade_error"></span>
          </div>
          <div class="form-group">
            <label for="">Section</label>
            <select name="add_section" id="add_section" class="form-control" style="width: 100%;" disabled>
              <option value="" selected disabled>SELECT GRADE LEVEL FIRST</option>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="add_section_error"></span>
          </div>
          <div class="form-group">
            <label for="">Start Time</label>
            <input type="time" name="add_start_time" id="add_start_time" class="form-control">
            <span class="text-danger error" style="font-size: 13px;" id="add_start_time_error"></span>
          </div>
          <div class="form-group">
            <label for="">End Time</label>
            <input type="time" name="add_end_time" id="add_end_time" class="form-control">
            <span class="text-danger error" style="font-size: 13px;" id="add_end_time_error"></span>
          </div>
          <div class="form-group">
            <label for="">Day</label>
            <select name="add_day" id="add_day" class="form-control" style="width: 100%;">
              <option value="" selected disabled>SELECT DAY</option>
              <?php if(!empty($dayData) || $dayData == null) { ?>
              <?php foreach($dayData as $day) { ?>
              <option value="<?= $day->id ?>"><?= ucwords($day->name) ?></option>
              <?php } ?>
              <?php } else { ?>
              <option value="">NO RESULT</option>
              <?php } ?>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="add_day_error"></span>
          </div>
          <div class="form-group">
            <label for="">Subject</label>
            <select name="add_subject" id="add_subject" class="form-control" style="width: 100%;" disabled>
              <option value="" selected disabled>SELECT GRADE LEVEL FIRST</option>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="add_subject_error"></span>
          </div>
          <div class="form-group">
            <label for="">Teacher</label>
            <select name="add_teacher" id="add_teacher" class="form-control" style="width: 100%;" disabled>
              <option value="" selected disabled>SELECT SUBJECT FIRST</option>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="add_teacher_error"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="add_form_close_btn">
          Close
        </button>
        <button type="submit" class="btn btn-primary btn-sm" form="add_form" id="add_form_submit_btn">
          Add
        </button>
      </div>
    </div>
  </div>
</div>
<!-- end add -->
<!-- edit -->
<div class="modal fade" style="padding-right: 17px;" id="edit_modal" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">
          Edit Subject Schedule
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="edit_form">
          <?= csrf_field(); ?>
          <div class="p-0 d-none alert_div" id="edit_form_alert_div"></div>
          <div class="form-group d-none">
            <label for="">ID</label>
            <input type="text" name="edit_id" id="edit_id" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Grade Level</label>
            <select name="edit_grade" id="edit_grade" class="form-control" style="width: 100%;">
              <option value="" selected disabled>SELECT GRADE LEVEL</option>
              <?php if(!empty($gradeLevelData) || $gradeLevelData == null) { ?>
              <?php foreach($gradeLevelData as $grade) { ?>
              <option value="<?= $grade->id ?>"><?= ucwords($grade->grade) ?></option>
              <?php } ?>
              <?php } else { ?>
              <option value="">NO RESULT</option>
              <?php } ?>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="edit_grade_error"></span>
          </div>
          <div class="form-group">
            <label for="">Section</label>
            <select name="edit_section" id="edit_section" class="form-control" style="width: 100%;" disabled>
              <option value="" selected disabled>SELECT GRADE LEVEL FIRST</option>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="edit_section_error"></span>
          </div>
          <div class="form-group">
            <label for="">Start Time</label>
            <input type="time" name="edit_start_time" id="edit_start_time" class="form-control">
            <span class="text-danger error" style="font-size: 13px;" id="edit_start_time_error"></span>
          </div>
          <div class="form-group">
            <label for="">End Time</label>
            <input type="time" name="edit_end_time" id="edit_end_time" class="form-control">
            <span class="text-danger error" style="font-size: 13px;" id="edit_end_time_error"></span>
          </div>
          <div class="form-group">
            <label for="">Day</label>
            <select name="edit_day" id="edit_day" class="form-control" style="width: 100%;">
              <option value="" selected disabled>SELECT DAY</option>
              <?php if(!empty($dayData) || $dayData == null) { ?>
              <?php foreach($dayData as $day) { ?>
              <option value="<?= $day->id ?>"><?= ucwords($day->name) ?></option>
              <?php } ?>
              <?php } else { ?>
              <option value="">NO RESULT</option>
              <?php } ?>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="edit_day_error"></span>
          </div>
          <div class="form-group">
            <label for="">Subject</label>
            <select name="edit_subject" id="edit_subject" class="form-control" style="width: 100%;" disabled>
              <option value="" selected disabled>SELECT GRADE LEVEL FIRST</option>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="edit_subject_error"></span>
          </div>
          <div class="form-group">
            <label for="">Teacher</label>
            <select name="edit_teacher" id="edit_teacher" class="form-control" style="width: 100%;" disabled>
              <option value="" selected disabled>SELECT SUBJECT FIRST</option>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="edit_teacher_error"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="edit_form_close_btn">
          Close
        </button>
        <button type="submit" class="btn btn-primary btn-sm" id="edit_form_submit_btn" form="edit_form">
          Save changes
        </button>
      </div>
    </div>
  </div>
</div>
<!-- end edit -->
<!-- end modal section -->

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>Classroom Schedule</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?=route_to('admin.home')?>">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Classroom Schedule
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <button class="btn btn-primary btn-sm mb-3" id="add_btn"><i class="bi bi-plus-lg"></i> ADD SUBJECT
        SCHEDULE</button>
      <button class="btn btn-warning btn-sm mb-3" id="reset_filter"><i class="bi bi-arrow-clockwise"></i> RESET
        FILTER</button>
      <button class="btn btn-info btn-sm mb-3" id="view_schedule"><i class="bi bi-printer"></i> VIEW SCHEDULE</button>
      <!-- <h6 class="mb-1">Filter: </h6> -->
      <div class="row mb-3">
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <select name="filter_grade" id="filter_grade" class="form-control" style="width: 100% !important;">
            <?php if(!empty($gradeLevelData) || $gradeLevelData == null) { ?>
            <?php foreach($gradeLevelData as $grade) { ?>
            <option value="<?= $grade->id ?>"><?= ucwords($grade->grade) ?></option>
            <?php } ?>
            <?php } else { ?>
            <option value="">NO RESULT</option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <select name="filter_section" id="filter_section" class="form-control" style="width: 100%;">
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table hover nowrap" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Grade</th>
              <th>Section</th>
              <th>Time</th>
              <th>Day ID</th>
              <th>Day</th>
              <th>Subject</th>
              <th>Teacher</th>
              <th>Created At</th>
              <th class="datatable-nosort">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?=$this->endSection();?>

<?=$this->section('script')?>
<script>
// Dynamic dependent dropdown action
function populateSectionDropdown(id, targetDropdown, filter = false) {
  if (id === null) {
    targetDropdown.empty().append('<option>SELECT GRADE LEVEL FIRST</option>').prop('disabled', true);
  } else {
    const form = new FormData();
    form.append('id', id);
    $.ajax({
      type: 'POST',
      url: '<?= route_to("admin.get-section-option") ?>',
      data: form,
      contentType: false,
      processData: false,
      cache: false,
      success: function(response) {
        if (filter === false) {
          targetDropdown.empty().prop('disabled', false).append(
            '<option value="" selected disabled>SELECT SECTION</option>');
        }
        if (response.status === 'success') {
          console.log(response);
          for (const [id, value] of Object.entries(response.message)) {
            targetDropdown.append(
              `<option value="${value.id}">${value.section}</option>`);
          }
        } else if (response.status === 'error') {
          targetDropdown.append(`<option value="">${response.message}</option>`);
        }
      }
    });
  }
}

function populateSubjectDropdown(id, targetDropdown) {
  if (id === null) {
    targetDropdown.empty().append('<option>SELECT GRADE LEVEL FIRST</option>').prop('disabled', true);
  } else {
    const form = new FormData();
    form.append('id', id);
    $.ajax({
      type: 'POST',
      url: '<?= route_to("admin.get-subject-option") ?>',
      data: form,
      contentType: false,
      processData: false,
      cache: false,
      success: function(response) {
        targetDropdown.empty().prop('disabled', false).append(
          '<option value="" selected disabled>SELECT SUBJECT</option>');
        if (response.status === 'success') {
          console.log(response);
          for (const [id, value] of Object.entries(response.message)) {
            targetDropdown.append(`<option value="${value.id}">${value.subject}</option>`);
          }
        } else if (response.status === 'error') {
          targetDropdown.append(`<option value="">${response.message}</option>`);
        }
      }
    });
  }
}

function populateTeacherDropdown(id, targetDropdown, val = '') {
  if (id === null) {
    targetDropdown.empty().append('<option>SELECT SUBJECT FIRST</option>').prop('disabled', true);
  } else {
    const form = new FormData();
    form.append('id', id);
    $.ajax({
      type: 'POST',
      url: '<?= route_to("admin.get-teacher-option") ?>',
      data: form,
      contentType: false,
      processData: false,
      cache: false,
      success: function(response) {
        targetDropdown.empty().prop('disabled', false).append(
          '<option value="" selected disabled>SELECT TEACHER</option>');
        if (response.status === 'success') {
          console.log(response);
          for (const [id, value] of Object.entries(response.message)) {
            targetDropdown.append(
              `<option value="${value.id}" ${val == value.id ? 'selected' : ''}>${value.f_name} ${value.l_name}</option>`
            );
          }
        } else if (response.status === 'error') {
          targetDropdown.append(`<option value="">${response.message}</option>`);
        }
      }
    });
  }
}

$(window).on('load', function() {
  if ($('#filter_grade').val() != '') {
    const id = $('#filter_grade').val();
    populateSectionDropdown(id, $('#filter_section'), true);
  }
})

$(document).ready(function() {
  // Select2 Initialization
  $('#add_grade, #add_section, #add_teacher, #add_day, #add_subject, #edit_teacher, #edit_grade, #edit_section, #edit_day, #edit_subject, #filter_grade, #filter_section')
    .select2();

  // DataTables initialization
  var dataTable = $('#table').DataTable().destroy();
  dataTable = $('#table').DataTable({
    serverSide: true,
    paging: true,
    pagingType: "simple",
    scrollX: true,
    sScrollXInner: "100%",
    ajax: {
      url: "<?= route_to('admin.classroom-schedule-data') ?>",
      type: "POST",
      data: function(d) {
        return $.extend({}, d, {
          "filter_grade": $('#filter_grade').val(),
        });
      },
      error: function(xhr, error, code) {
        console.log(xhr, code);
      }
    },
    order: [
      [3, 'desc'],
      [4, 'asc'],
    ],
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "All"]
    ]
  }).columns.adjust();

  dataTable.column(4).visible(false);

  setInterval(() => dataTable.ajax.reload(null, false), 10000);

  dataTable.draw();

  // Filter onchange
  $('#filter_grade, #filter_section').on("input change", () => dataTable.draw());

  // Reset filter
  $('#reset_filter').on('click', (e) => {
    e.preventDefault();
    $('#filter_grade').val('').trigger('change');
    $('#filter_section').empty();
    $('#filter_section').append(`<option value="" selected disabled>SELECT GRADE LEVEL FIRST</option>`);
    $('#filter_section').val('').trigger('change');
  });

  // disable drag and drop
  $('#add_avatar').on('dragover drop', function(event) {
    event.preventDefault();
  });

  // image preview 
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $("#imagePreview").attr("src", e.target.result);
        $("#imagePreview").css("display", "block");
        $("#imagePreviewEdit").attr("src", e.target.result);
        $("#imagePreviewEdit").css("display", "block");
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#add_avatar, #edit_avatar").on('change', function(e) {
    e.preventDefault();
    readURL(this);
  });

  // Modal action
  // Add modal
  $(document).on('click', '#add_btn', (e) => {
    e.preventDefault();
    $('#add_modal').modal('show');
  });

  $('#add_grade').on('change', (e) => {
    const id = $(e.target).val();
    populateSectionDropdown(id, $('#add_section'));
    populateSubjectDropdown(id, $('#add_subject'));
  })

  $('#edit_grade').on('change', (e) => {
    const id = $(e.target).val();
    populateSectionDropdown(id, $('#edit_section'));
    populateSubjectDropdown(id, $('#edit_subject'));
  })

  $('#filter_grade').on('change', (e) => {
    const id = $(e.target).val();
    $('#filter_section').empty();
    populateSectionDropdown(id, $('#filter_section'), true);
  })

  $('#add_subject').on('change', (e) => {
    const id = $(e.target).val();
    populateTeacherDropdown(id, $('#add_teacher'));
  })

  $('#edit_subject').on('change', (e) => {
    const id = $(e.target).val();
    populateTeacherDropdown(id, $('#edit_teacher'));
  })

  // Get Edit Data
  $(document).on('click', '.get_edit', function() {
    const id = $(this).data('id');
    const csrfToken = $('input[name="<?= csrf_token() ?>"]').val();
    const form = new FormData();
    form.append('id', id);
    let section = '';
    let subject = '';
    let teacher = '';

    $.ajax({
      type: 'POST',
      url: '<?= route_to("admin.get-classroom-schedule-data") ?>',
      data: form,
      headers: {
        'X-CSRF-TOKEN': csrfToken,
      },
      contentType: false,
      processData: false,
      cache: false,
      success: function(response) {
        console.log(response);
        $('input[name="<?= csrf_token() ?>"]').val(response.csrfHash);
        if (response.status === 'success') {
          $('#edit_modal').modal('show');

          $.each(response.message, function(field, val) {
            if (field === 'edit_section') {
              section = val;
            } else if (field === 'edit_subject') {
              subject = val;
            } else if (field === 'edit_teacher') {
              teacher = val;
            } else {
              $(`#${field}`).val(val).trigger('change');
            }
          })

          $('#edit_modal').on('shown.bs.modal', function(e) {
            e.preventDefault();
            console.log(teacher);
            $('#edit_section').val(section).trigger('change');
            $('#edit_subject').val(subject).trigger('change');
            populateTeacherDropdown(subject, $('#edit_teacher'), teacher);
          })
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });

  // submit forms
  // add form
  $('#add_form').on('submit', function(e) {
    e.preventDefault();

    const form = new FormData(this);

    $.ajax({
      type: "POST",
      url: "<?= route_to('admin.add-classroom-schedule') ?>",
      data: form,
      headers: {
        'X-CSRF-TOKEN': $('input[name="<?= csrf_token() ?>"]').val()
      },
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function() {
        $('#add_form_submit_btn').attr('disabled', true);
        $('.error').text('');
        $('.alert_div').addClass('d-none');
        $('.alert_div .alert').remove();
      },
      complete: function() {
        $('#add_form_submit_btn').attr('disabled', false);
      },
      success: function(response) {
        console.log(response);
        if (response.status === 'success') {
          $('#add_modal').modal('hide');
          dataTable.ajax.reload(null, false);
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: `${response.message}`,
            iconColor: '#274c43',
            confirmButtonColor: '#274c43',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            color: '#000',
            background: '#fff',
          })
        } else if (response.status === 'error') {
          $.each(response.message, function(field, error) {
            $(`#${field}_error`).text(error);
          });
        } else if (response.status === 'error_alert') {
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

  // edit form
  $('#edit_form').on('submit', function(e) {
    e.preventDefault();

    let form = new FormData(this);

    $.ajax({
      type: "POST",
      url: "<?= route_to('admin.edit-classroom-schedule') ?>",
      data: form,
      headers: {
        'X-CSRF-TOKEN': $('input[name="<?= csrf_token() ?>"]').val()
      },
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function() {
        $('.error').text('');
        $('.alert_div').addClass('d-none');
        $('.alert_div .alert').remove();
        $('#edit_form_submit_btn').attr('disabled', true);
      },
      complete: function() {
        $('#edit_form_submit_btn').attr('disabled', false);
      },
      success: function(response) {
        console.log(response);
        $('input[name="<?= csrf_token() ?>"]').val(response.csrfHash);
        if (response.status === 'success') {
          $('#edit_modal').modal('hide');
          dataTable.ajax.reload(null, false);
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: `${response.message}`,
            iconColor: '#274c43',
            confirmButtonColor: '#274c43',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            color: '#000',
            background: '#fff',
          })
        } else if (response.status === 'error') {
          $.each(response.message, function(field, error) {
            $(`#${field}_error`).text(error);
          });
        } else if (response.status === 'error_alert') {
          $('#edit_form_alert_div').removeClass('d-none');
          $('#edit_form_alert_div').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
    });
  })

  // delete data
  $(document).on('click', '.get_delete', function(e) {
    e.preventDefault();

    const id = $(this).data('id');
    let form = new FormData();
    form.append('id', id);

    Swal.fire({
      icon: 'question',
      title: 'Hey!',
      text: 'Are you sure you want to delete this data?',
      iconColor: '#274c43',
      confirmButtonColor: '#274c43',
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonText: `Yes`,
      color: '#000',
      background: '#fff',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "<?= route_to('admin.delete-classroom-schedule') ?>",
          data: form,
          processData: false,
          contentType: false,
          cache: false,
          success: function(response) {
            if (response.status === 'success') {
              dataTable.ajax.reload(null, false);
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: `${response.message}`,
                iconColor: '#274c43',
                confirmButtonColor: '#274c43',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                color: '#000',
                background: '#fff',
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Sorry!',
                text: 'Something went wrong!',
                iconColor: '#274c43',
                confirmButtonColor: '#274c43',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                color: '#000',
                background: '#fff',
              })
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        })
      }
    })
  })

  // print function 
  $('#view_schedule').on('click', function(e) {
    e.preventDefault();
    const section = $('#filter_section').val();
    const url = '<?= route_to('admin.classroom-schedule-print', '') ?>' + section;
    window.open(url, '_blank');
  })

  // hide modal reset 
  $('#add_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
    $('#add_teacher, #edit_teacher, #add_grade, #edit_grade, #add_subject, #edit_subject').val('').trigger(
      'change');
  });

  $('#edit_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
    $('#add_teacher, #edit_teacher, #add_grade, #edit_grade, #add_subject, #edit_subject').val('').trigger(
      'change');
    $('.alert_div').addClass('d-none');
    $('.alert_div .alert').remove();
  });
})
</script>
<?php $this->endSection()?>