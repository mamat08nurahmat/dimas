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
          <li class="active"><?= cclang('setup_is_completed'); ?></li>
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
              <h3 class="widget-user-username"><?= cclang('setup_is_completed'); ?></h3>
            </div>
          </div>
          <!-- /.widget-user -->

            <div class="callout callout-success">
              <h4><?= cclang('success'); ?>!</h4>
              <p><?= cclang('database_has_been_installed__the_page_administrator'); ?></p>
            </div>
              <hr>
              <div class="col-md-2" style="padding-left: 0px !important; ">
              </div>
              <div class="col-md-8">
                  <center>
                    <div class="step">
                      <div class="line">
                        <div class="round-step success"></div>
                        <div class="round-step success" style="margin-left: 100px !important"></div>
                        <div class="round-step success" style="margin-left: 200px !important"></div>
                      </div>
                    </div>
                  </center>
              </div>
              <div class="col-md-2" style="padding-left: 0px !important; ">
                <a href="<?= site_url('administrator/login'); ?>" class="btn bg-green margin btn-lg btn-block" > <?= cclang('finish'); ?></a>
              </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

          <?= form_close(); ?>
      </section>
      <!-- /.content -->