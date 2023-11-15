<?= $this->extend('layout/student/auth-layout') ?>

<?= $this->section('content') ?>
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
  top: 20%;
  font-size: 22px;
  color: #495057;
  right: 11%;
  cursor: pointer;
}
</style>

<div class="login-box bg-white box-shadow border-radius-10">
  <div class="login-title">
    <h2 class="text-center text-primary">Student Login</h2>
  </div>
  <form id="login_form">
    <div class="p-0 d-none" id="alert_div"></div>
    <div class="input-group custom">
      <input type="text" class="form-control form-control-lg" placeholder="Email" id="email" name="email" value="<?= (isset($_COOKIE['bnhsStudentEmail'])) ? $_COOKIE['bnhsStudentEmail'] : '' ?>" />
      <div class="input-group-append custom">
        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
      </div>
    </div>
    <div class="text-danger d-none errors" style="margin-top: -25px; margin-bottom: 15px;" id="email_error"></div>
    <div class="input-group custom">
      <div class="password-container">
        <input type="password" class="form-control form-control-lg" placeholder="**********" id="password"
          name="password" value="<?= (isset($_COOKIE['bnhsStudentPass'])) ? $_COOKIE['bnhsStudentPass'] : '' ?>" />
        <i class="bi bi-eye"></i>
      </div>
      <div class="input-group-append custom">
        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
      </div>
    </div>
    <div class="text-danger d-none errors" style="margin-top: -25px; margin-bottom: 15px;" id="password_error"></div>
    <div class="row pb-30">
      <div class="col-6">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="remember" name="remember" <?= (isset($_COOKIE['bnhsStudentEmail'])) ? 'checked' : '' ?> />
          <label class="custom-control-label" for="remember">Remember</label>
        </div>
      </div>
      <div class="col-6">
        <div class="forgot-password">
          <a href="forgot-password.html">Forgot Password</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="input-group mb-0">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</a>
        </div>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {

  $('#login_form').on('submit', function(e) {
    e.preventDefault();

    let form = new FormData(this);

    $.ajax({
      type: "POST",
      url: "<?= route_to('student.login-handler') ?>",
      data: form,
      contentType: false,
      processData: false,
      cache: false,
      success: function(response) {
        console.log(response);
        $('#alert_div').addClass('d-none');
        $('#alert_div .alert').remove();
        $('.errors').text('');
        $('.errors').addClass('d-none');
        if (response.status === 'success') {
          window.location.href = '<?= route_to('student.home') ?>';
        } else if (response.status === 'error') {
          for (const [field, errorMessage] of Object.entries(response.message)) {
            $(`#${field}_error`).removeClass('d-none');
            $(`#${field}_error`).text(`${errorMessage}`);
          }
        } else if (response.status === 'error_alert') {
          $('#alert_div').removeClass('d-none');
          $('#alert_div').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
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

})
</script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
  $(".password-container i").click(function() {
    var passwordInput = $("#password");
    var icon = $(this);

    if (passwordInput.attr("type") === "password") {
      passwordInput.attr("type", "text");
      icon.removeClass("bi-eye").addClass("bi-eye-slash");
    } else {
      passwordInput.attr("type", "password");
      icon.removeClass("bi-eye-slash").addClass("bi-eye");
    }
  });
})
</script>
<?= $this->endSection() ?>