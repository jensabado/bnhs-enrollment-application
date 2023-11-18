<?=$this->extend('layout/admin/page-layout')?>

<?=$this->section('content')?>

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>Enrolled - Grade 7</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?=route_to('admin.home')?>">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Enrolled - Grade 7
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <button class="btn btn-warning btn-sm mb-3" id="reset_filter"><i class="bi bi-arrow-clockwise"></i> RESET
        FILTER</button>
      <div class="row mb-3">
        <div class="col-md-3">
          <select name="filter_section" id="filter_section" class="form-control" style="width: 100% !important;">
            <option value="" selected disabled>SELECT SECTION</option>
            <?php if(!empty($sectionData) || $sectionData == null) { ?>
            <?php foreach($sectionData as $section) { ?>
            <option value="<?= $section->id ?>"><?= ucwords($section->section) ?></option>
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
              <th>LRN</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Section</th>
              <th>Section ID</th>
              <th>Enrolled Date</th>
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
$(window).on('load', function() {
  if (localStorage.getItem('status') == 'success') {
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: localStorage.getItem('message'),
      iconColor: '#274c43',
      confirmButtonColor: '#274c43',
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
      color: '#000',
      background: '#fff',
    })

    localStorage.removeItem('status');
    localStorage.removeItem('message');
  }
})

$(document).ready(function() {
  // select2 initialization
  $('#filter_section').select2();

  var dataTable = $('#table').DataTable();

  if (dataTable !== null) {
    dataTable.destroy();
  }

  dataTable = $('#table').DataTable({
    "serverSide": true,
    "paging": true,
    "pagingType": "simple",
    "scrollX": true,
    "sScrollXInner": "100%",
    "ajax": {
      url: "<?= route_to('admin.enrolled/grade-7-data') ?>",
      type: "POST",
      data: function(d) {
        return $.extend({}, d, {
          "filter_section": $('#filter_section').val()
        })
      },
      error: function(xhr, error, code) {
        console.log(xhr, code);
      }
    },
    "order": [
      [8, 'desc']
    ],
    "lengthMenu": [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "All"]
    ],
  });

  dataTable.column(7).visible(false);


  $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

  setInterval(function() {
    dataTable.ajax.reload(null, false);
  }, 10000); // END DATATABLES

  dataTable.draw();

  // filter onchange
  $('#filter_section').bind("keyup change", function() {
    dataTable.draw();
  })

  // reset filter
  $('#reset_filter').on('click', function(e) {
    e.preventDefault();
    $('#filter_section').val('').trigger('change');
  })

  // submit forms
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
          url: "<?= route_to('admin.delete-building') ?>",
          data: form,
          processData: false,
          contentType: false,
          cache: false,
          success: function(response) {
            console.log(response);
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
          }
        })
      }
    })
  })

  $(document).on('click', '.get_edit', function(e) {
    e.preventDefault();
    const id = $(this).data('id');
    const url = '<?= route_to('admin.enrollees/grade-7/view', '') ?>' + id;
    window.location.href = url;
  })

  // hide modal reset 
  $('#add_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
  });

  $('#edit_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
  });
})
</script>
<?php $this->endSection()?>