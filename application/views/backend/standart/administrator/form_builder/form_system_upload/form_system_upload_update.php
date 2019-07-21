
<!-- Fine Uploader Gallery CSS file
    ====================================================================== -->
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        System Upload        <small><?= cclang('update'); ?> System Upload</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/form_system_upload'); ?>">System Upload</a></li>
        <li class="active"><?= cclang('update'); ?></li>
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
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">System Upload</h3>
                            <h5 class="widget-user-desc">Edit System Upload</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/form_system_upload/edit_save/'.$this->uri->segment(4)), [
                            'name'    => 'form_form_system_upload', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_form_system_upload', 
                            'method'  => 'POST'
                            ]); ?>
                         
                                                <div class="form-group ">
                            <label for="file_name" class="col-sm-2 control-label">File Name 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <div id="form_system_upload_file_name_galery" ></div>
                                <input class="data_file data_file_uuid" name="form_system_upload_file_name_uuid" id="form_system_upload_file_name_uuid" type="hidden" value="<?= set_value('form_system_upload_file_name_uuid'); ?>">
                                <input class="data_file" name="form_system_upload_file_name_name" id="form_system_upload_file_name_name" type="hidden" value="<?= set_value('form_system_upload_file_name_name', $form_system_upload->file_name); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="application_source" class="col-sm-2 control-label">Application Source 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select-deselect" name="application_source" id="application_source" data-placeholder="Select Application Source"  >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('form_application_source') as $row): ?>
                                    <option <?=  $row->source_name ==  $form_system_upload->application_source ? 'selected' : ''; ?> value="<?= $row->source_name ?>"><?= $row->source_name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                                                 
                                                <div class="form-group ">
                            <label for="batch_id" class="col-sm-2 control-label">Batch Id 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="batch_id" value="<?= set_value('batch_id', $form_system_upload->batch_id); ?>" id="batch_id" placeholder=""  >
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="process_month" class="col-sm-2 control-label">Process Month 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="process_month" id="process_month" data-placeholder="Select Process Month" >
                                    <option value=""></option>
                                    <option <?= $form_system_upload->process_month == "1" ? 'selected' :''; ?> value="1">JANUARI</option>
                                    <option <?= $form_system_upload->process_month == "2" ? 'selected' :''; ?> value="2">FEBRUARI</option>
                                    <option <?= $form_system_upload->process_month == "3" ? 'selected' :''; ?> value="3">MARET</option>
                                    <option <?= $form_system_upload->process_month == "4" ? 'selected' :''; ?> value="4">APRIL</option>
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="process_year" class="col-sm-2 control-label">Process Year 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-2">
                                <select  class="form-control chosen chosen-select-deselect" name="process_year" id="process_year" data-placeholder="Select Process Year" >
                                    <option value=""></option>
                                    <?php for ($i = 1970; $i < date('Y')+100; $i++){ ?>
                                    <option <?=  $i ==  $form_system_upload->process_year ? 'selected' : ''; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php }; ?> 
                                </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                         
                                                <!-- <div class="form-group ">
                            <label for="upload_at" class="col-sm-2 control-label">Upload At 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-6">
                            <div class="input-group date col-sm-8">
                              <input type="text" class="form-control pull-right datetimepicker" name="upload_at" value="<?= set_value('upload_at', $form_system_upload->upload_at); ?>" id="upload_at" >
                            </div>
                            <small class="info help-block">
                            </small>
                            </div>
                        </div> -->
                                                 
                        
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="cancel (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_field_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<!-- Page script -->
<script>
    $(document).ready(function(){
      
             
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/form_system_upload';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_form_system_upload = $('#form_form_system_upload');
        var data_post = form_form_system_upload.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_form_system_upload.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#form_system_upload_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/
      
              var params = {};
       params[csrf] = token;

       $('#form_system_upload_file_name_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/form_system_upload/upload_file_name_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/form_system_upload/delete_file_name_file'
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/form_system_upload/get_file_name_file/<?= $form_system_upload->id; ?>',
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#form_system_upload_file_name_galery').fineUploader('getUuid', id);
                   $('#form_system_upload_file_name_uuid').val(uuid);
                   $('#form_system_upload_file_name_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#form_system_upload_file_name_uuid').val();
                  $.get(BASE_URL + '/administrator/form_system_upload/delete_file_name_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#form_system_upload_file_name_uuid').val('');
                  $('#form_system_upload_file_name_name').val('');
                }
              }
          }
      }); /*end file_name galey*/
           
    
    }); /*end doc ready*/
</script>