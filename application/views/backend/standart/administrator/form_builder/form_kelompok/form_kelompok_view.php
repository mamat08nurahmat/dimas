
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Kelompok      <small><?= cclang('detail', 'Kelompok'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/form_kelompok'); ?>">Kelompok</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
     
      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">

               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                    
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Kelompok</h3>
                     <h5 class="widget-user-desc">Detail Kelompok</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_form_kelompok" id="form_form_kelompok" >
                   
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">Kelompok </label>

                        <div class="col-sm-8">
                           <?= _ent($form_kelompok->kelompok); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">Pemimpin </label>

                        <div class="col-sm-8">
                           <?= _ent($form_kelompok->pemimpin); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">Number </label>

                        <div class="col-sm-8">
                           <?= _ent($form_kelompok->number); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('form_kelompok_update', function() use ($form_kelompok){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="<?= cclang('update', 'form_kelompok'); ?> (Ctrl+e)" href="<?= site_url('administrator/form_kelompok/edit/'.$form_kelompok->id); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', 'Form Kelompok'); ?></a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/form_kelompok/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list', 'Form Kelompok'); ?></a>
                     </div>
                    
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->
