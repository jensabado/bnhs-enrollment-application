<?=$this->extend('layout/admin/page-layout')?>

<?=$this->section('content')?>
<!-- styles -->
<style>
.password-container {
  position: relative;
  width: 100%;
}

.password-container .form-control {
  width: 100% !important;
  box-sizing: border-box;
}

.password-container .bi {
  position: absolute;
  top: 18%;
  font-size: 19px;
  color: #495057;
  right: 4%;
  cursor: pointer;
}
</style>

<!-- model section -->
<!-- add -->
<div class="modal fade" style="padding-right: 17px;" id="add_modal" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">
          Add Teacher
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <div class="modal-body">
        <form id="add_form">
          <?= csrf_field(); ?>
          <div class="p-0 d-none alert_div" id="add_form_alert_div"></div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="add_fname" id="add_fname" class="form-control" placeholder="Enter First Name">
                <span class="text-danger error" style="font-size: 13px;" id="add_fname_error"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="add_lname" id="add_lname" class="form-control" placeholder="Enter First Name">
                <span class="text-danger error" style="font-size: 13px;" id="add_lname_error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Gender</label>
                <select name="add_gender" id="add_gender" class="form-control" style="width: 100%;">
                  <option value="" selected disable>SELECT GENDER</option>
                  <option value="FEMALE">FEMALE</option>
                  <option value="MALE">MALE</option>
                </select>
                <span class="text-danger error" style="font-size: 13px;" id="add_gender_error"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Contact</label>
                <div class="input-group mb-0">
                  <div class="input-group-prepend border"
                    style="border-top-left-radius: 3px; border-bottom-left-radius: 3px;">
                    <span class="input-group-text" id="basic-addon1" style="font-size: 14px;">+63</span>
                  </div>
                  <input type="text" class="form-control" placeholder="9*********" aria-label="Username"
                    aria-describedby="basic-addon1" id="add_contact" name="add_contact" maxlength="10" minlength="10">
                </div>
                <span class="text-danger error" style="font-size: 13px;" id="add_contact_error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Avatar</label>
                <input type="file" name="add_avatar" id="add_avatar" class="form-control">
                <span class="text-danger error" style="font-size: 13px;" id="add_avatar_error"></span>
              </div>
            </div>
          </div>
          <div class="row justify-content-center align-items-center">
            <div class="col-md-6 d-flex flex-column align-items-center">
              <div class="form-group d-flex flex-column align-items-center">
                <label for="" class="text-center">Image Preview</label>
                <img id="imagePreview" src="#" alt="Preview" class="text-center"
                  style="width: 300px; max-width: 100%; border: 1px solid black;">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="add_email" id="add_email" class="form-control" placeholder="Enter Email">
                <span class="text-danger error" style="font-size: 13px;" id="add_email_error"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Password</label>
                <div class="password-container" id="password-container">
                  <input type="password" name="add_password" id="add_password" class="form-control"
                    placeholder="Enter Password">
                  <i class="bi bi-eye"></i>
                </div>
                <span class="text-danger error" style="font-size: 13px;" id="add_password_error"></span>
              </div>
            </div>
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
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">
          Edit Teacher
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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="edit_fname" id="edit_fname" class="form-control"
                  placeholder="Enter First Name">
                <span class="text-danger error" style="font-size: 13px;" id="edit_fname_error"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="edit_lname" id="edit_lname" class="form-control"
                  placeholder="Enter First Name">
                <span class="text-danger error" style="font-size: 13px;" id="edit_lname_error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Gender</label>
                <select name="edit_gender" id="edit_gender" class="form-control" style="width: 100%;">
                  <option value="" selected disable>SELECT GENDER</option>
                  <option value="FEMALE">FEMALE</option>
                  <option value="MALE">MALE</option>
                </select>
                <span class="text-danger error" style="font-size: 13px;" id="edit_gender_error"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Contact</label>
                <div class="input-group mb-0">
                  <div class="input-group-prepend border"
                    style="border-top-left-radius: 3px; border-bottom-left-radius: 3px;">
                    <span class="input-group-text" id="basic-addon1" style="font-size: 14px;">+63</span>
                  </div>
                  <input type="text" class="form-control" placeholder="9*********" aria-label="Username"
                    aria-describedby="basic-addon1" id="edit_contact" name="edit_contact" maxlength="10" minlength="10">
                </div>
                <span class="text-danger error" style="font-size: 13px;" id="edit_contact_error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Avatar</label>
                <input type="file" name="edit_avatar" id="edit_avatar" class="form-control">
                <span class="text-danger error" style="font-size: 13px;" id="edit_avatar_error"></span>
              </div>
            </div>
          </div>
          <div class="row justify-content-center align-items-center">
            <div class="col-md-6 d-flex flex-column align-items-center">
              <div class="form-group d-flex flex-column align-items-center">
                <label for="" class="text-center">Image Preview</label>
                <img id="imagePreviewEdit" src="#" alt="Preview" class="text-center"
                  style="width: 300px; max-width: 100%; border: 1px solid black;">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="edit_email" id="edit_email" class="form-control" placeholder="Enter Email">
                <span class="text-danger error" style="font-size: 13px;" id="edit_email_error"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Password</label>
                <div class="password-container" id="edit-password-container">
                  <input type="password" name="edit_password" id="edit_password" class="form-control"
                    placeholder="Enter Password">
                  <i class="bi bi-eye"></i>
                </div>
                <span class="text-danger error" style="font-size: 13px;" id="edit_password_error"></span>
              </div>
            </div>
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
            <h4>Teacher</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?=route_to('admin.home')?>">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Teacher
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <button class="btn btn-primary btn-sm mb-3" id="add_btn"><i class="bi bi-plus-lg"></i> ADD TEACHER</button>
      <button class="btn btn-warning btn-sm mb-3" id="reset_filter"><i class="bi bi-arrow-clockwise"></i> RESET
        FILTER</button>
      <!-- <h6 class="mb-1">Filter: </h6> -->
      <div class="row mb-3">
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <select name="filter_status" id="filter_status" class="form-control" style="width: 100% !important;">
            <option value="" selected disabled>SELECT STATUS</option>
            <option value="enable">ENABLED</option>
            <option value="disable">DISABLED</option>
          </select>
        </div>
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <select name="filter_gender" id="filter_gender" class="form-control" style="width: 100% !important;">
            <option value="" selected disabled>SELECT GENDER</option>
            <option value="FEMALE">FEMALE</option>
            <option value="MALE">MALE</option>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table hover nowrap" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Avatar</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Account Status</th>
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
  // Select2 Initialization
  $('#add_gender, #edit_gender, #filter_status, #filter_gender').select2();

  // DataTables initialization
  var dataTable = $('#table').DataTable().destroy();
  dataTable = $('#table').DataTable({
    serverSide: true,
    paging: true,
    pagingType: "simple",
    scrollX: true,
    sScrollXInner: "100%",
    ajax: {
      url: "<?= route_to('admin.teacher-data') ?>",
      type: "POST",
      data: function(d) {
        return $.extend({}, d, {
          "filter_status": $('#filter_status').val(),
          "filter_gender": $('#filter_gender').val(),
        });
      },
      error: function(xhr, error, code) {
        console.log(xhr, code);
      }
    },
    order: [
      [7, 'desc']
    ],
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "All"]
    ]
  }).columns.adjust();

  setInterval(() => dataTable.ajax.reload(null, false), 10000);

  dataTable.draw();

  // Filter onchange
  $('#filter_status, #filter_gender').on("input change", () => dataTable.draw());

  // Reset filter
  $('#reset_filter').on('click', (e) => {
    e.preventDefault();
    $('#filter_status, #filter_gender').val('').trigger('change');
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

  // Get Edit Data
  $(document).on('click', '.get_edit', function() {
    const id = $(this).data('id');
    const csrfToken = $('input[name="<?= csrf_token() ?>"]').val();
    const form = new FormData();
    form.append('id', id);

    $.ajax({
      type: 'POST',
      url: '<?= route_to("admin.get-teacher-data") ?>',
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

          $.each(response.message, function(field, val) {
            if (field === 'edit_avatar') {
              $('#imagePreviewEdit').attr('src', '<?= base_url('avatar/teacher/') ?>' + val);
            } else {
              $(`#${field}`).val(val).trigger('change');
            }
          })
        }
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });

  // submit forms
  // disable form
  $(document).on('click', '.disable', function(e) {
    e.preventDefault();

    const id = $(this).data('id');
    const form = new FormData();
    form.append('id', id);

    Swal.fire({
      icon: 'question',
      title: 'Hey!',
      text: 'Are you sure you want to disable this account?',
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
          url: "<?= route_to('admin.disable-teacher') ?>",
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
                text: `${response.message}`,
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

  // enable form
  $(document).on('click', '.enable', function(e) {
    e.preventDefault();

    const id = $(this).data('id');
    const form = new FormData();
    form.append('id', id);

    Swal.fire({
      icon: 'question',
      title: 'Hey!',
      text: 'Are you sure you want to enable this account?',
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
          url: "<?= route_to('admin.enable-teacher') ?>",
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
                text: `${response.message}`,
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

  // add form
  $('#add_form').on('submit', function(e) {
    e.preventDefault();

    const form = new FormData(this);

    $.ajax({
      type: "POST",
      url: "<?= route_to('admin.add-teacher') ?>",
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
      url: "<?= route_to('admin.edit-teacher') ?>",
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
          url: "<?= route_to('admin.delete-teacher') ?>",
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

  // hide modal reset 
  $('#add_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
    $('#add_gender').val('').trigger('change');
    $('#imagePreview').attr('src', '');
  });

  $('#edit_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
    $('#edit_gender').val('').trigger('change');
    $('#imagePreviewEdit').attr('src', '');
  });

  // Password Show and Hide Action
  $("#password-container i").click(function() {
    togglePasswordVisibility("#add_password", this);
  });

  $("#edit-password-container i").click(function() {
    togglePasswordVisibility("#edit_password", this);
  });
})
</script>
<?php $this->endSection()?>