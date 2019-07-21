<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= get_option('site_name'); ?> | Forgot Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/square/blue.css">
  <style type="text/css">
    .captcha-box {
      padding: 5px 0;
    }
    .captcha-box input {
      width: 30%;
      border:1px solid #E5E2E2;
      padding: 5px;
    }
    .captcha-box img {
      width: 55%;
      float: right;
    }

    .required {
      color: #D02727
    }

     .login-box-body {
      border-top: 5px solid #D7320C;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?= cclang('login'); ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?= cclang('send_me_link_to_reset_password'); ?></p>
    <?php if(isset($error) AND !empty($error)): ?>
         <div class="callout callout-error"  style="color:#C82626">
              <h4><?= cclang('error'); ?>!</h4>
              <p><?= $error; ?></p>
            </div>
    <?php endif; ?>
    <?php
    $message = $this->session->flashdata('f_message'); 
    $type = $this->session->flashdata('f_type'); 
    if ($message):
    ?>
   <div class="callout callout-<?= $type; ?>"  style="color:#C82626">
        <p><?= $message; ?></p>
      </div>
    <?php endif; ?>
     <?= form_open('', [
        'name'    => 'form_forgot_password', 
        'id'      => 'form_forgot_password', 
        'method'  => 'POST'
      ]); ?>
      <div class="form-group has-feedback <?= form_error('email') ? 'has-error' :''; ?>">
        <label><?= cclang('email') ?> <span class="required">*</span> </label>
        <input type="email" class="form-control" placeholder="Email" name="email" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <?php $cap = get_captcha(); ?>
      <div class="form-group <?= form_error('email') ? 'has-error' :''; ?>">
      <label><?= cclang('human_challenge'); ?> <span class="required">*</span> </label>
      <div class="captcha-box"  data-captcha-time="<?= $cap['time']; ?>">
          <input type="text" name="captcha" placeholder="">
          <a class="btn btn-flat  refresh-captcha  "><i class="fa fa-refresh text-danger"></i></a>
          <span  class="box-image"><?= $cap['image']; ?></span>
      </div>
      <small class="info help-block">
      </small>
      </div>
      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?= cclang('reset'); ?></button>
        </div>
        <!-- /.col -->
      </div>
    <?= form_close(); ?>

    <!-- /.social-auth-links -->

    <a href="<?= site_url('administrator/register'); ?>" class="text-center"><?= cclang('register_a_new_membership'); ?></a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= BASE_ASSET; ?>/admin-lte/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= BASE_ASSET; ?>/admin-lte/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function() {
     var BASE_URL = "<?= base_url(); ?>";

     $.fn.printMessage = function(opsi) {
         var opsi = $.extend({
             type: 'success',
             message: 'Success',
             timeout: 500000
         }, opsi);

         $(this).hide();
         $(this).html(' <div class="col-md-12 message-alert" ><div class="callout callout-' + opsi.type + '"><h4>' + opsi.type + '!</h4>' + opsi.message + '</div></div>');
         $(this).slideDown('slow');
         // Run the effect
         setTimeout(function() {
             $('.message-alert').slideUp('slow');
         }, opsi.timeout);
     };
     $('.refresh-captcha').on('click', function() {
         var capparent = $(this);

         $.ajax({
                 url: BASE_URL + '/captcha/reload/' + capparent.parent('.captcha-box').attr('data-captcha-time'),
                 dataType: 'JSON',
             })
             .done(function(res) {
                 capparent.parent('.captcha-box').find('.box-image').html(res.image);
                 capparent.parent('.captcha-box').attr('data-captcha-time', res.captcha.time);
             })
             .fail(function() {
                 $('.message').printMessage({
                     message: 'Error getting captcha',
                     type: 'warning'
                 });
             })
             .always(function() {});
     });


     $('input').iCheck({
         checkboxClass: 'icheckbox_square-blue',
         radioClass: 'iradio_square-blue',
         increaseArea: '20%' // optional
     });
 });
</script>
</body>
</html>
