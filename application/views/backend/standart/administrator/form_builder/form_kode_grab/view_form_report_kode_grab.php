<!-- <script src="<?php echo base_url('asset/bootstrap/jquery-3.3.1.slim.min.js')?>" type="text/javascript"></script> -->


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h3> Report Semua Data</h3>
            <?php if($this->input->post('_stardate')==TRUE){
                ?>
            <h4>Periode <?= $this->input->post('_stardate') ?> s/d <?= $this->input->post('_enddate') ?> </h4>
                <?php }else{echo ' ';} ?>
        </div>
        <div class="col-md-5">

        </div>
        <div class="col-md-3">
            <ol class="breadcrumb" style="background:transparent">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Kode Grab</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row" >
      
      <div class="col-md-6">
         <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <div class="">


                  <?= form_open(base_url('administrator/Form_report_kode_grab/allsort'), [
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST']); ?> 

                    <input type="date" name="_stardate" required class="form-control valid-feedback">
                    
                    <input type="date" name="_enddate" required class="form-control valid-feedback">
                    <button type="submit" class="btn btn-info">Submit</button>
                  <?= form_close(); ?>
                  <button class="btn btn-primary">Export</button>
                  <table id="myTable" class="table table-striped table-hover table-striped table-sm table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Used At</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php 
                    $no=1;
                    $statusbayar=['<span class="badge badge-danger">Belum</span>','<span class="badge badge-success">Sudah</span>'];
                    $stt_acc=['<span class="badge badge-danger">Un-accept</span>','<span class="badge badge-success">Accepted</span>'];
                        foreach($data as $dt):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dt['nama']?></td>
                            <td><?= $dt['kode_grab']?></td>
                            <td><?= $dt['used_at']?></td>
                            <td>
                                <a href="<?= base_url('administrator/Form_report_kode_grab/alldetail/').$dt['kode_grab']?>" class="badge badge-dark" title="Detail"><i class="fa fa-search"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                  </div>
               </div>
            </div>
            
         </div>
         <!--/box -->
      </div>
      <div class="col-md-6">
           <div class="box box-warning">
            <div class="box-body ">
               <!-- Widget: user widget style 1 -->
               <div class="box box-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header ">
                     <div class="row pull-right">
                        <?php is_allowed('form_kode_grab_export', function(){?>
                        <a class="btn btn-flat btn-success" title="<?= cclang('export', 'Form Kode Grab'); ?>" href="<?= site_url('administrator/form_kode_grab/export'); ?>"><i class="fa fa-file-excel-o" ></i> <?= cclang('export'); ?></a>
                        <?php }) ?>
                     </div>
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/list.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Kode Grab</h3>
                     <h5 class="widget-user-desc"><?= cclang('list_all', 'Kode Grab'); ?>  <i class="label bg-yellow">ABC<?= cclang('items'); ?></i></h5>
                  </div>

                  <form name="form_form_kode_grab" id="form_form_kode_grab" action="<?= base_url('administrator/form_kode_grab/index'); ?>">
                  
                  <div class="table-responsive">
                  
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-2 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="bulk" id="bulk" placeholder="Site Email" >
                           <option value="">Bulk</option>
                           <option value="delete"><?= cclang('delete'); ?></option>
                        </select>
                     </div>
                     <div class="col-sm-2 padd-left-0 ">
                        <button type="button" class="btn btn-flat" name="apply" id="apply" title="apply bulk actions"><?= cclang('apply_button'); ?></button>
                     </div>
                     <div class="col-sm-3 padd-left-0  " >
                        <input type="text" class="form-control" name="q" id="filter" placeholder="<?= cclang('filter'); ?>" value="<?= $this->input->get('q'); ?>">
                     </div>
                     <div class="col-sm-3 padd-left-0 " >
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value=""><?= cclang('all'); ?></option>
                            <option <?= $this->input->get('f') == 'kode_grab' ? 'selected' :''; ?> value="kode_grab">Kode Grab</option>
                           <option <?= $this->input->get('f') == 'expired' ? 'selected' :''; ?> value="expired">Expired</option>
                           <option <?= $this->input->get('f') == 'is_used' ? 'selected' :''; ?> value="is_used">Is Used</option>
                           <option <?= $this->input->get('f') == 'used_at' ? 'selected' :''; ?> value="used_at">Used At</option>
                           <option <?= $this->input->get('f') == 'timestamp' ? 'selected' :''; ?> value="timestamp">Timestamp</option>
                          </select>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                        Filter
                        </button>
                     </div>
                     <div class="col-sm-1 padd-left-0 ">
                     BUttn
                        <i class="fa fa-undo"></i>
                        </a>
                     </div>
                  </div>
                               <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                        
                     </div>
                  </div>
               </div>
            </div>
            <!--/box body -->
         </div>          
      </div>
   </div>
</section>



<!-- <script src="<?php echo base_url('asset/bootstrap/popper.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('asset/bootstrap/bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url('asset/datatables/datatables.js') ?>"></script>

  <script>
  	$(document).ready( function () {
  		$('#myTable').DataTable();
  	} );
  </script> -->
