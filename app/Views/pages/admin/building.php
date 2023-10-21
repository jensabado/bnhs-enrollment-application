<?= $this->extend('layout/admin/page-layout') ?>

<?= $this->section('content') ?>
<!-- model section -->
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">
          Large modal
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <div class="modal-body">
        <p id="edit_modal_id">
          
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">
          Save changes
        </button>
      </div>
    </div>
  </div>
</div>
<!-- end modal section -->

<div class="pd-ltr-20 xs-pd-20-10">
  <div class="min-height-200px">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="title">
            <h4>Building</h4>
          </div>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?= route_to('admin.home') ?>">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Building
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <button class="btn btn-primary mb-4"><i class="bi bi-plus-lg"></i> ADD BUILDING</button>
      <div class="table-responsive">
        <table class="data-table table stripe hover nowrap" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Building Name</th>
              <th class="datatable-nosort">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
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
      url: "<?= route_to('admin.building-data') ?>",
      type: "POST",
      error: function(xhr, error, code) {
        console.log(xhr, code);
      }
    },
    "order": [
      [0, 'desc']
    ],
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ]
  });

  // edit modal
  $(document).on('click', '.get_edit', function(e) {
    e.preventDefault();

    const id = $(this).data('id');
    $('#edit_modal_id').text(id);
    $('#edit_modal').modal('show');
  })
})
</script>
<?php $this->endSection() ?>