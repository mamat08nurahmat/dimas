
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
      System Incoming      <small><?= cclang('detail', 'System Incoming'); ?></small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/form_system_incoming'); ?>">System Incoming</a></li>
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
                     <h3 class="widget-user-username">System Incoming</h3>
                     <h5 class="widget-user-desc">Detail System Incoming</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_form_system_incoming" id="form_form_system_incoming" >
                   
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">KODE SALES </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->kode_sales); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">NO IDENTITAS </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->no_identitas); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">NAMA NASABAH </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->nama_nasabah); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">DOB </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->dob); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">NAMA PERUSAHAAN </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->nama_perusahaan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">KOTA </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->kota); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">JENIS PERUSAHAAN </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->jenis_perusahaan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">KODE POS </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->kode_pos); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">SOURCECODE </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->sourcecode); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">KETERANGAN </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->keterangan); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">Batch Id </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->batch_id); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group option">               
                  <label for="content" class="col-sm-2 control-label">Status </label>

                        <div class="col-sm-8">
                           <?= _ent($form_system_incoming->status); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('form_system_incoming_update', function() use ($form_system_incoming){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="<?= cclang('update', 'form_system_incoming'); ?> (Ctrl+e)" href="<?= site_url('administrator/form_system_incoming/edit/'.$form_system_incoming->id); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', 'Form System Incoming'); ?></a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('administrator/form_system_incoming/'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list', 'Form System Incoming'); ?></a>
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
