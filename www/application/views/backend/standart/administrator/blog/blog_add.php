
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
        Blog        <small><?= cclang('new', ['Blog']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/blog'); ?>">Blog</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
 <?= form_open('', [
  'name'    => 'form_blog', 
  'class'   => 'form-horizontal', 
  'id'      => 'form_blog', 
  'enctype' => 'multipart/form-data', 
  'method'  => 'POST'
  ]); ?>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-8">
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
                            <h3 class="widget-user-username">Blog</h3>
                            <h5 class="widget-user-desc"><?= cclang('new', ['Blog']); ?></h5>
                            <hr>
                        </div>
                       
                         
                                                <div class="form-group ">
                            <label for="title" class="col-sm-2 control-label">Title 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?= set_value('title'); ?>">
                                <small class="info help-block">
                                <span class="info help-block"><?= site_url('blog/') ?>
                                <span contenteditable="true" class="blog-slug"></span> <i class="fa fa-pencil" title="Custom URL"></i></span>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="content" class="col-sm-2 control-label">Content 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-9">
                                <textarea id="content" name="content" rows="8" cols="80"><?= set_value('Content'); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                       
                                
                        
                        <div class="message"></div>
                        <div class="row-fluid col-md-12">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
        <div class="col-md-4">
            <div class="box box box-solid box-blog-right">
                <div class="box-header">
                  <h3>Status</h3>
                </div>
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                       
                      <div class="clear"></div>
                      <br>

                      <div class="form-group ">
                          <label for="status" class="col-sm-3 control-label">Status 
                          </label>
                          <div class="col-sm-9">
                              <select  class="form-control chosen chosen-select" name="status" id="status" data-placeholder="Select Status" >
                                  <option value="publish">publish</option>
                                  <option value="draft">draft</option>
                                  <option value="archive">archive</option>
                                  </select>
                          </div>
                      </div>
                      <hr>

                   
                                        
              </div>
            </div>

        </div>
          <div class="col-md-4">
            <div class="box box box-solid box-blog-right">
                <div class="box-header">
                  <h3>Category</h3>
                </div>
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                       
                      <div class="clear"></div>
                      <br>
                         

                        <div class="form-group ">
                            <label for="category" class="col-sm-3 control-label">Category 
                            </label>
                            <div class="col-sm-9">
                                <select  class="form-control chosen chosen-select-deselect" name="category" id="category" data-placeholder="Select Category" >
                                    <option value=""></option>
                                    <?php foreach (db_get_all_data('blog_category') as $row): ?>
                                    <option value="<?= $row->category_id ?>"><?= $row->category_name; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>
                        <div class="row"></div>
                        <br>

                        <div class="form-group ">
                            <label for="tags" class="col-sm-3 control-label">Tags 
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tags" id="tags" placeholder="Holiday,Hunting" value="<?= set_value('tags'); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>

                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box box box-solid box-blog-right">
                <div class="box-header">
                  <h3>Media</h3>
                </div>
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                       
                      <div class="clear"></div>
                                                
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <div id="blog_image_galery"></div>
                                <div id="blog_image_galery_listed"></div>
                                <small class="info help-block">
                                <b>Extension file must</b> JPG,JPEG,PNG.</small>
                            </div>
                        </div>
                                                 
                </div>
            </div>
          </div>

    </div>
</section>

           <?= form_close(); ?>
<!-- /.content -->
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){


    $(document).on('keyup', '#title', function(event) {
      var link = $(this).val().replaceAll(/[^0-9a-z]/gi, '-').replaceAll(/_+/g, '-').toLowerCase();
      var title = $(this).val().replaceAll(/[^0-9a-z ]/gi, ' ').toLowerCase().replaceAll(/ +/g, ' ').toLowerCase();

      $('.blog-slug').html(link);
      $('#title').val(title);
    });


    $(document).on('focusout', '.blog-slug', function(event) {
      var link = $(this).html().replaceAll(/[^0-9a-z]/gi, '-').replaceAll(/-+/g, '-').toLowerCase();

      $('.blog-slug').html(link);
    });
      

            CKEDITOR.replace('content'); 
      var content = CKEDITOR.instances.content;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
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
              window.location.href = BASE_URL + 'administrator/blog';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#content').val(content.getData());
                    
        var form_blog = $('#form_blog');
        var data_post = form_blog.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
        data_post.push({name: 'slug', value: $('.blog-slug').html()});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/blog/add_save',
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            $('#blog_image_galery').find('li').each(function() {
               $('#blog_image_galery').fineUploader('deleteFile', $(this).attr('qq-file-id'));
            });
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
            content.setData('');
                
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

       $('#blog_image_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/blog/upload_image_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/blog/delete_image_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
          validation: {
              allowedExtensions: ["jpg","jpeg","png"],
              sizeLimit : 0,
                            
          },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#blog_image_galery').fineUploader('getUuid', id);
                   $('#blog_image_galery_listed').append('<input type="hidden" class="listed_file_uuid" name="blog_image_uuid['+id+']" value="'+uuid+'" /><input type="hidden" class="listed_file_name" name="blog_image_name['+id+']" value="'+xhr.uploadName+'" />');
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#blog_image_galery_listed').find('.listed_file_uuid[name="blog_image_uuid['+id+']"]').remove();
                  $('#blog_image_galery_listed').find('.listed_file_name[name="blog_image_name['+id+']"]').remove();
                }
              }
          }
      }); /*end image galery*/
              
    
    
    }); /*end doc ready*/
</script>