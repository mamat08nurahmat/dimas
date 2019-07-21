 <!-- Content Header (Page header) -->
 <style type="text/css">
   .info {
    color: #666;
    font-style: italic;
   }

   .required {
    color: #E62020
   }
 </style>
      <section class="content-header">
        <h1>
          <?= cclang('wizzard_setup'); ?>
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> <?= cclang('wizzard'); ?></a></li>
          <li class=""><?= cclang('setup'); ?></li>
          <li class="active"><?= cclang('database_setup'); ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="box box-warning">
        

          <div class="box-body">

          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?= BASE_ASSET . 'img/cloud.png'; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?= cclang('database_and_site_configuration'); ?></h3>
            </div>
          </div>
          <!-- /.widget-user -->

          <?php if (isset($error) AND !empty($error)): ?>
            <div class="callout callout-danger">
              <h4><?= cclang('warning'); ?>!</h4>
              <p><?= $error; ?></p>
            </div>
          <?php endif; ?>
          <style type="text/css">
            .legend-title {
              border-bottom: 1px solid #f39c12 ;
              margin-bottom: 30px;
              margin-top: 30px;
              text-align: center;
            }
             .legend-title .title {
              background: #fff;
              font-size: 18px;
              position: relative;
              padding: 0 10px;
              bottom: -13px;
              color: #646464
             }
          </style>
          <?= form_open('', [
                   'name'    => 'form_wizzard', 
                   'class'   => 'form-horizontal', 
                   'id'      => 'form_wizzard', 
                   'method'  => 'POST'
                   ]); ?>
          <div class="legend-title"><span class="title"><?= cclang('database_configuration'); ?></span></div>
              <div class="form-group <?= form_error('database') ? 'has-error' :''; ?>">
                  <label for="database" class="col-md-3 control-label"><?= cclang('database_name'); ?> <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="database" id="database" placeholder="<?= cclang('database_name'); ?>" value="<?= set_value('database', $this->config->item('database', 'database')); ?>">
                    <small class="info help-block"><?= cclang('database_name_help_block'); ?></small>
                  </div>
              </div>
              <div class="form-group <?= form_error('username') ? 'has-error' :''; ?>">
                  <label for="username" class="col-md-3 control-label"><?= cclang('username'); ?> <i class="required">*</i></label>

                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="username" id="username" placeholder="<?= cclang('username'); ?>" value="<?= set_value('username', 'root'); ?>">
                      <small class="info help-block">
                        <?= cclang('username_help_block'); ?>
                      </small>
                  </div>
              </div>
              <div class="form-group input-password <?= form_error('password') ? 'has-error' :''; ?>">
                  <label for="password" class="col-md-3 control-label"><?= cclang('password'); ?> </label>

                  <div class="col-sm-6">
                    <div class="input-group col-md-8">
                    <input type="password" class="form-control password input-password" name="password" id="password" placeholder="<?= cclang('password'); ?>" value="<?= set_value('password', $this->config->item('password', 'database')); ?>">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                      </span>
                    </div>
                     <small class="info help-block">
                       <?= cclang('password_help_block'); ?>
                    </small>
                  </div>
              </div>
              <div class="form-group <?= form_error('hostname') ? 'has-error' :''; ?>">
                  <label for="hostname" class="col-md-3 control-label"><?= cclang('database_host'); ?> <i class="required">*</i></label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="hostname" id="hostname" placeholder="<?= cclang('database_host'); ?>" value="<?= set_value('hostname', 'localhost'); ?>">
                     <small class="info help-block">
                       <?= cclang('database_host_help_block'); ?>
                    </small>
                  </div>
              </div>
              <div class="legend-title"><span class="title"><?= cclang('site_configuration'); ?></span></div>
               <div class="form-group <?= form_error('site_name') ? 'has-error' :''; ?>">
                  <label for="site_name" class="col-md-3 control-label"><?= cclang('site_name'); ?> <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_name" id="site_name" placeholder="<?= cclang('site_name'); ?>" value="<?= set_value('site_name'); ?>">
                    <small class="info help-block"><?= cclang('site_name_help_block'); ?></small>
                  </div>
              </div>
               <div class="form-group <?= form_error('site_email') ? 'has-error' :''; ?>">
                  <label for="site_email" class="col-md-3 control-label"><?= cclang('site_email'); ?> <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_email" id="site_email" placeholder="<?= cclang('site_email'); ?>" value="<?= set_value('site_email'); ?>">
                    <small class="info help-block"><?= cclang('site_email_help_block'); ?></small>
                  </div>
              </div>

               <div class="form-group input-password <?= form_error('site_password') ? 'has-error' :''; ?>">
                  <label for="site_password" class="col-md-3 control-label"><?= cclang('site_password'); ?> <i class="required">*</i></label>
                  <div class="col-sm-6">
                    <div class="input-group col-md-8">
                      <input type="password" class="form-control password" type="site_password" name="site_password" id="site_password" placeholder="<?= cclang('site_password'); ?>" value="<?= set_value('site_password'); ?>">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                      </span>
                    </div>
                    <small class="info help-block"><?= cclang('site_password_help_block'); ?>
                    </small>
                  </div>
              </div>


              <hr>
              <div class="col-md-2" style="padding-left: 0px !important; ">
              <a class="btn bg-green margin btn-lg btn-block pull-left" href="<?= BASE_URL . 'wizzard/setup/2'; ?>" ><?= cclang('back'); ?></a>
              </div>
              <div class="col-md-8">
                  <center>
                    <div class="step">
                      <div class="line">
                        <div class="round-step success"></div>
                        <div class="round-step success" style="margin-left: 100px !important"></div>
                        <div class="round-step" style="margin-left: 200px !important"></div>
                      </div>
                    </div>
                  </center>
              </div>
              <div class="col-md-2" style="padding-left: 0px !important; ">
                <input type="submit" class="btn bg-green margin btn-lg btn-block" value="<?= cclang('next'); ?>" >
              </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

          <?= form_close(); ?>
      </section>
      <!-- /.content -->

       <script type="text/javascript">
        $(document).ready(function(){
            
            /*show  hide password*/
            $('.input-password').each(function(index, el) {
                var eye = $(this).parent().parent().find('.eye');
                $(this).find('.show-password').mousedown(function() {
                    $(this).parent().parent().find('.password').attr('type', 'text');
                    eye.addClass('fa-eye-slash');
                    eye.removeClass('fa-eye');
                });
                $(this).find('.show-password').mouseup(function() {
                    $(this).parent().parent().find('.password').attr('type', 'password');
                    eye.removeClass('fa-eye-slash');
                    eye.addClass('fa-eye');
                });
            });


            var connection =  $('#hostname, #database, #username, #password');
            var timeout = null;
            function checkConnection() {
                 $.ajax({
                  url: '<?= BASE_URL; ?>/wizzard/check_db_connection',
                  type: 'POST',
                  dataType: 'JSON',
                  data: $('#form_wizzard').serialize(),
                })
                .done(function(response) {
                  if (response.success) {
                    connection.parents('.form-group').removeClass('has-error');
                  } else {
                    connection.parents('.form-group').addClass('has-error');
                  }
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");
                });
              
          }
            connection.keydown(function(event) {
             clearTimeout(timeout);
             timeout = setTimeout(checkConnection, 1000);
           });
        });
        </script>