 <!-- Content Header (Page header) -->
 <style type="text/css">
   .info {
    color: #666;
    font-style: italic;
   }

   .required {
    color: #E62020
   }

   .container-advance-configuration {
    display: none;
   }
 </style>
      <section class="content-header">
        <h1>
          <?= cclang('wizzard_setup'); ?> 
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> <?= cclang('wizzard'); ?></a></li>
          <li class=""> <?= cclang('setup'); ?></li>
          <li class="active"> <?= cclang('configuration_setup'); ?></li>
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
                <img class="img-circle" src="<?= BASE_ASSET . 'img/settings.jpg'; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?= cclang('system_configuration'); ?></h3>
            </div>
          </div>
          <!-- /.widget-user -->

          <?php if (isset($error) AND !empty($error)): ?>
            <div class="callout callout-danger">
              <h4><?= cclang('warning'); ?>!</h4>
              <p><?= $error; ?></p>
            </div>
          <?php endif; ?>
              <?= form_open('', [
                'class'   => 'form-horizontal', 
                'method'  => 'POST'
              ]); ?>
           
              <div class="form-group">
                  <label for="url_suffix" class="col-md-3 control-label"><?= cclang('url_suffix'); ?></label>

                  <div class="col-sm-9">
                    <div class="input-group col-sm-3">
                      <input type="text" class="form-control" name="url_suffix" id="url_suffix" placeholder="<?= cclang('url_suffix'); ?>" value="<?= set_value('url_suffix', $this->config->item('url_suffix')); ?>">
                      </div>
                      <small class="info help-block">
                         <?= cclang('url_suffix_help_block', 'http://example.com/blog/article-1<b>.html</b>'); ?>.
                      </small>
                  </div>
              </div>

               <div class="form-group <?= form_error('sess_expiration') ? 'has-error' :''; ?>">
                  <label for="sess_expiration" class="col-md-3 control-label"><?= cclang('session_expiration'); ?> <i class="required">*</i></label>
                  <div class="col-sm-9">
                  <div class="input-group col-sm-6">
                    <div class="row">
                      <div class="col-md-8 ">
                        <select class="form-control" name="sess_expiration" id="sess_expiration">
                          <?php foreach ($times as $time): ?>
                            <option value="<?= $time['value']; ?>" <?= $time['value'] == $this->config->item('sess_expiration') ? 'selected' : ''; ?>><?= $time['label']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    </div>
                     <small class="info help-block">
                       <?= cclang('session_expiration_help_block'); ?>
                    </small>
                  </div>
              </div>


              <div class="form-group">
                  <div class="col-md-4 col-md-offset-3 control-label">
                    <u><a href="#" class="btn-advance pull-left"><?= cclang('show_advance_configuration'); ?>  <i class="fa fa-chevron-up"></i></a>
                    </u>
                  </div>
              </div>

              <div class="container-advance-configuration">
               <div class="form-group <?= form_error('permitted_uri_chars') ? 'has-error' :''; ?>">
                  <label for="permitted_uri_chars" class="col-md-3 control-label"><?= cclang('permitted_uri_chars'); ?> <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="permitted_uri_chars" id="permitted_uri_chars" placeholder="Permitted Uri Chars" value="<?= set_value('permitted_uri_chars', $this->config->item('permitted_uri_chars')); ?>">
                    <small class="info help-block"><?= cclang('permitted_uri_chars', "! preg_match('/^[<permitted_uri_chars>]+$/i"); ?>: </small>
                  </div>
              </div>


              <div class="form-group <?= form_error('encryption_key') ? 'has-error' :''; ?>">
                  <label for="encryption_key" class="col-md-3 control-label"><?= cclang('encryption_key'); ?> <i class="required">*</i></label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="encryption_key" id="encryption_key" placeholder="<?= cclang('encryption_key'); ?>" value="<?= set_value('encryption_key', str_shuffle(md5(time()).'*&*^%$#@')); ?>">
                     <small class="info help-block">
                       <?= cclang('encryption_key_help_block'); ?>.
                    </small>
                  </div>
              </div>
             
              <div class="form-group <?= form_error('sess_time_to_update') ? 'has-error' :''; ?>">
                  <label for="sess_time_to_update" class="col-md-3 control-label"><?= cclang('session_time_to_update'); ?> <i class="required">*</i></label>
                  <div class="col-sm-9">
                  <div class="input-group col-sm-6">
                    <div class="row">
                      <div class="col-md-8 ">
                        <select class="form-control" name="sess_time_to_update" id="sess_time_to_update">
                          <?php foreach ($times as $time): ?>
                            <option value="<?= $time['value']; ?>" <?= $time['value'] == $this->config->item('sess_time_to_update') ? 'selected' : ''; ?>><?= $time['label']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                  </div>
                     <small class="info help-block">
                       <?= cclang('session_time_to_update_help_block'); ?>
                    </small>
                  </div>
              </div>

              <div class="form-group <?= form_error('global_xss_filtering') ? 'has-error' :''; ?>">
                  <label for="global_xss_filtering" class="col-md-3 control-label"><?= cclang('global_xss_filtering'); ?> <i class="required">*</i></label>
                  <div class="col-sm-6">
                  <div class="col-md-4 input-group">
                    <select class="form-control" name="global_xss_filtering" id="global_xss_filtering" placeholder="Global XSS Filtering">
                    <?php
                    $global_xss_filtering = $this->config->item('global_xss_filtering');
                    ?>
                      <option value="TRUE" <?= $global_xss_filtering == TRUE ? 'selected' :'' ; ?>><?= cclang('yes'); ?></option>
                      <option value="FALSE" <?= $global_xss_filtering == FALSE ? 'selected' :'' ; ?>><?= cclang('no'); ?></option>
                    </select>
                  </div>
                     <small class="info help-block">
                      <?= cclang('global_xss_filtering_help_block'); ?>. <span class="text-danger">if set to true page builder not working correctly</span>
                    </small>
                  </div>
              </div>
              </div>
              <hr>
              <div class="col-md-2" style="padding-left: 0px !important; ">
              <a class="btn bg-green margin btn-lg btn-block pull-left" href="<?= BASE_URL . 'wizzard/setup/1'; ?>" ><?= cclang('back'); ?></a>
              </div>
              <div class="col-md-8">
                <center>
                    <div class="step">
                      <div class="line">
                        <div class="round-step success"></div>
                        <div class="round-step" style="margin-left: 100px !important"></div>
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
        $(function(){
          $('.btn-advance').click(function(event){
            event.preventDefault();
            $('.container-advance-configuration').toggle();

            if ($('.btn-advance').find('.fa').hasClass('fa-chevron-up')) {
              $('.btn-advance').find('.fa').removeClass('fa-chevron-up')
              $('.btn-advance').find('.fa').addClass('fa-chevron-down')
            } else {
              $('.btn-advance').find('.fa').addClass('fa-chevron-up')
              $('.btn-advance').find('.fa').removeClass('fa-chevron-down')
            }
            
          })
        });
      </script>