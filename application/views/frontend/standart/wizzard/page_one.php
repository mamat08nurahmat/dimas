 <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= cclang('wizzard_setup'); ?>
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> <?= cclang('wizzard'); ?></a></li>
          <li class="">Setup</li>
          <li class="active"><?= cclang('permission_and_requirement'); ?></li>
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
                <img class="img-circle" src="<?= BASE_ASSET . 'img/folder.jpg'; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?= cclang('directory_permission_and_requirements'); ?></h3>
            </div>
          </div>
          <!-- /.widget-user -->

          <?php if (!$directory_requirement_is_ok): ?>
            <div class="callout callout-danger">
              <h4><?= cclang('warning'); ?>!</h4>
              <p><?= cclang('there_are_some_files__write_mode_0666'); ?></p>
            </div>
          <?php endif; ?>
            <table width="100%" class="table table-striped">
              <thead>
                <tr>
                  <th width="80%"><?= cclang('directory_and_permission'); ?></th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($directory_requirements as $sec => $path): ?>
                <tr>
                  <td>../<?= $path ?> <?= cclang('is_writable'); ?></td>
                  <td>
                    <?php if (is_writeable(FCPATH . $path)): ?>
                    <span class="badge bg-green"><?= cclang('success'); ?></span>
                    <?php else: ?>
                    <span class="badge bg-orange"><?= cclang('warning'); ?></span>
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>

             <div class="box box-widget widget-user-2" style="margin-top: 20px;">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="<?= BASE_ASSET . 'img/server.jpg'; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?= cclang('server_requirements'); ?></h3>
            </div>
          </div>
          <!-- /.widget-user -->

          <?php if (!$server_requirement_is_ok): ?>
            <div class="callout callout-danger">
              <h4><?= cclang('warning'); ?>!</h4>
              <p><?= cclang('there_are_several_server__this_problem'); ?></p>
            </div>
          <?php endif; ?>
            <table width="100%" class="table table-striped">
              <thead>
                <tr>
                  <th><?= cclang('server_requirements'); ?></th>
                  <th><?= cclang('status'); ?></th>
                </tr>
              </thead>
              <tbody>
                               
                <tr>
                  <td width="80%"><?= cclang('you_have__or_greater_current_version', ['5.5', phpversion() ]); ?></td>
                  <td>
                    <?php if ($php_version_is_greater): ?>
                    <span class="badge bg-green"><?= cclang('success'); ?></span>
                    <?php else: ?>
                    <span class="badge bg-orange"><?= cclang('warning'); ?></span>
                    <?php endif; ?>
                  </td>
                </tr>    
                <tr>
                  <td>
                  <?= cclang('you_have__or_greater_current_version', ['4.1.13', $mysql_version_number ]); ?>
                 </td>
                  <td>
                    <?php if ($mysql_version_is_greater): ?>
                    <span class="badge bg-green"><?= cclang('success'); ?></span>
                    <?php else: ?>
                    <span class="badge bg-orange"><?= cclang('warning'); ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td><?= cclang('you_have_the_extension', 'mysqli'); ?></td>
                  <td>
                    <?php if ($mysqli_extension_installed): ?>
                    <span class="badge bg-green"><?= cclang('success'); ?></span>
                    <?php else: ?>
                    <span class="badge bg-orange"><?= cclang('warning'); ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td><?= cclang('you_have_the_extension', 'session'); ?></td>
                  <td>
                    <?php if ($session_extension_installed): ?>
                    <span class="badge bg-green"><?= cclang('success'); ?></span>
                    <?php else: ?>
                    <span class="badge bg-orange"><?= cclang('warning'); ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td><?= cclang('you_have_the_extension', 'mcrypt'); ?></td>
                  <td>
                    <?php if ($mcrypt_extension_installed): ?>
                    <span class="badge bg-green"><?= cclang('success'); ?></span>
                    <?php else: ?>
                    <span class="badge bg-orange"><?= cclang('warning'); ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr>
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
              <center>
                <div class="step">
                  <div class="line">
                    <div class="round-step"></div>
                    <div class="round-step" style="margin-left: 100px !important"></div>
                    <div class="round-step" style="margin-left: 200px !important"></div>
                  </div>
                </div>
              </center>
            </div>
            <div class="col-md-2" style="padding-left: 0px !important; ">
              <a class="btn bg-green margin btn-lg btn-block" href="<?= BASE_URL . 'wizzard/setup/2'; ?>" ><?= cclang('next'); ?></a>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->