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
          Add Section
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
            <select name="add_grade" id="add_grade" class="form-control" style="width: 100% !important;">
              <option value="" selected disabled>SELECT GRADE LEVEL</option>
              <?php if(!empty($gradeLevelData) || $gradeLevelData == null) { ?>
              <?php foreach($gradeLevelData as $gradeLevel) { ?>
              <option value="<?= $gradeLevel->id ?>"><?= ucwords($gradeLevel->grade) ?></option>
              <?php } ?>
              <?php } else { ?>
              <option value="">NO RESULT</option>
              <?php } ?>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="add_grade_error"></span>
          </div>
          <div class="form-group">
            <label for="">Subject Name</label>
            <input type="text" name="add_subject" id="add_subject" class="form-control"
              placeholder="Enter Subject Name">
            <span class="text-danger error" style="font-size: 13px;" id="add_subject_error"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="add_form_close_btn">
          Close
        </button>
        <button type="submit" class="btn btn-primary" form="add_form" id="add_form_submit_btn">
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
          Edit Room
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
            <label for="">Subject ID</label>
            <input type="text" name="edit_id" id="edit_id" class="form-control" placeholder="">
            <span class="text-danger error" style="font-size: 13px;" id="edit_id_error"></span>
          </div>
          <div class="form-group">
            <label for="">Grade Level</label>
            <select name="edit_grade" id="edit_grade" class="form-control" style="width: 100% !important;">
              <option value="" selected disabled>SELECT GRADE LEVEL</option>
              <?php if(!empty($gradeLevelData) || $gradeLevelData == null) { ?>
              <?php foreach($gradeLevelData as $gradeLevel) { ?>
              <option value="<?= $gradeLevel->id ?>"><?= ucwords($gradeLevel->grade) ?></option>
              <?php } ?>
              <?php } else { ?>
              <option value="">NO RESULT</option>
              <?php } ?>
            </select>
            <span class="text-danger error" style="font-size: 13px;" id="edit_grade_error"></span>
          </div>
          <div class="form-group">
            <label for="">Subject Name</label>
            <input type="text" name="edit_subject" id="edit_subject" class="form-control"
              placeholder="Enter Subject Name">
            <span class="text-danger error" style="font-size: 13px;" id="edit_subject_error"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit_form_close_btn">
          Close
        </button>
        <button type="submit" class="btn btn-primary" id="edit_form_submit_btn" form="edit_form">
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
            <h4>Subject</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?=route_to('admin.home')?>">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Subject
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <button class="btn btn-primary btn-sm mb-3" id="add_btn"><i class="bi bi-plus-lg"></i> ADD SUBJECT</button>
      <button class="btn btn-warning btn-sm mb-3" id="reset_filter"><i class="bi bi-arrow-clockwise"></i> RESET
        FILTER</button>
      <!-- <h6 class="mb-1">Filter: </h6> -->
      <div class="row mb-3">
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <select name="filter_grade" id="filter_grade" class="form-control" style="width: 100% !important;">
            <option value="" selected disabled>SELECT GRADE LEVEL</option>
            <?php if(!empty($gradeLevelData) || $gradeLevelData == null) { ?>
            <?php foreach($gradeLevelData as $gradeLevel) { ?>
            <option value="<?= $gradeLevel->id ?>"><?= ucwords($gradeLevel->grade) ?></option>
            <?php } ?>
            <?php } else { ?>
            <option value="">NO RESULT</option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table hover nowrap" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Grade Level</th>
              <th>Subject</th>
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
$(document).ready(function() {
  // Select2 initialization
  $('#filter_grade, #add_grade').select2();

  // DataTables initialization
  var dataTable = $('#table').DataTable().destroy();
  dataTable = $('#table').DataTable({
    serverSide: true,
    paging: true,
    pagingType: "simple",
    scrollX: true,
    sScrollXInner: "100%",
    ajax: {
      url: "<?= route_to('admin.subject-data') ?>",
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
      [3, 'desc']
    ],
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "All"]
    ]
  }).columns.adjust();

  setInterval(() => dataTable.ajax.reload(null, false), 10000);

  dataTable.draw();

  // Filter onchange
  $('#filter_grade').on("input change", () => dataTable.draw());

  // Reset filter
  $('#reset_filter').on('click', (e) => {
    e.preventDefault();
    $('#filter_grade').val('').trigger('change');
  });

  // Modal action
  // Add modal
  $(document).on('click', '#add_btn', (e) => {
    e.preventDefault();
    $('#add_modal').modal('show');
  });

  // Edit modal
  $(document).on('click', '.get_edit', function() {
    const id = $(this).data('id');
    const csrfToken = $('input[name="<?= csrf_token() ?>"]').val();
    const form = new FormData();
    form.append('id', id);

    $.ajax({
      type: 'POST',
      url: '<?= route_to("admin.get-subject-data") ?>',
      data: form,
      headers: {
        'X-CSRF-TOKEN': csrfToken,
      },
      contentType: false,
      processData: false,
      cache: false,
      success: function(response) {
        $('input[name="<?= csrf_token() ?>"]').val(response.csrfHash);
        if (response.status === 'success') {
          $('#edit_modal').modal('show');

          $.each(response.message, (field, val) => (
            $(`#${field}`).val(val).trigger('change')
          ));
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

    let form = new FormData(this);

    $.ajax({
      type: "POST",
      url: "<?=route_to('admin.add-subject')?>",
      data: form,
      headers: {
        'X-CSRF-TOKEN': $('input[name="<?= csrf_token() ?>"]').val()
      },
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function() {
        $('#add_form_submit_btn').attr('disabled', true);
      },
      complete: function() {
        $('#add_form_submit_btn').attr('disabled', false);
      },
      success: function(response) {
        $('.error').text('');
        $('.alert_div').addClass('d-none');
        $('.alert_div .alert').remove();
        $('input[name="<?= csrf_token() ?>"]').val(response.csrfHash);
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
          for (const [field, errorMessage] of Object.entries(response.message)) {
            $(`#${field}_error`).text(`${errorMessage}`);
          }
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
      url: "<?= route_to('admin.edit-subject') ?>",
      data: form,
      headers: {
        'X-CSRF-TOKEN': $('input[name="<?= csrf_token() ?>"]').val()
      },
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function() {
        $('#edit_form_submit_btn').attr('disabled', true);
      },
      complete: function() {
        $('#edit_form_submit_btn').attr('disabled', false);
      },
      success: function(response) {
        $('input[name="<?= csrf_token() ?>"]').val(response.csrfHash);
        $('.error').text('');
        $('.alert_div').addClass('d-none');
        $('.alert_div .alert').remove();
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
          for (const [field, errorMessage] of Object.entries(response.message)) {
            $(`#${field}_error`).text(`${errorMessage}`);
          }
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
          url: "<?= route_to('admin.delete-subject') ?>",
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

  $('#add_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
    $('#add_grade').val('').trigger('change');
  });

  $('#edit_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
    $('#edit_grade').val('').trigger('change');
  });
})
</script>
<?php $this->endSection()?>