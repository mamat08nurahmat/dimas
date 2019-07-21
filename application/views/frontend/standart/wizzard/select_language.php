
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>flag-icon/css/flag-icon.css" rel="stylesheet" media="all" />


      <section class="content-header" style="margin-left: 17%;">
        <h1>
          
          <small></small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content col-md-7 " style="margin-left: 17%;">

          <center>
            
          <h3><?= cclang('select_language'); ?></h3>
          </center>

        <div class="box ">
        

          <div class="box-body">


            <div class="col-md-10 col-md-offset-1">
            <div class="row">
            <center>


              <style type="text/css"> 
              .bootstrap-select .dropdown-toggle {
                padding: 20px;
                font-size: 25px;
              }

              .bootstrap-select .dropdown-menu ul li a {
                padding: 20px;
                font-size: 25px;
              }
              </style>

               <?= form_open('wizzard/select_language', [
                    'name'    => 'form_group', 
                    'method'  => 'POST'
                  ]); ?>
              
              <select class="selectpicker" data-width="100%" name="language">
              <?php foreach (get_langs() as $lang): ?>
                  <option value="<?= $lang['folder_name']; ?>" data-content='<span class="flag-icon <?= $lang['icon_name']; ?>"></span> <?= $lang['name']; ?>'><?= $lang['name']; ?></option>
              <?php endforeach; ?>
              </select>
            </center>

            </div>
            
            <div class="row">

             <button type="submit" class="btn bg-green margin btn-lg btn-flat btn-block pull-right" style="margin-right: -0px"  ><?= cclang('next'); ?></button>
             </div>
            </div>
            <div class="col-md-2" style="padding-left: 0px !important; ">
              
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->


      <script > 
          $(function(){
              $('.selectpicker').selectpicker({
                 style: 'btn-block btn-flat',
                  size: 4   
              });
          });
      </script>