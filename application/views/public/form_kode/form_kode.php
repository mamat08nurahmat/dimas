
<script src="<?= BASE_ASSET; ?>js/custom.js"></script>


<?= form_open('', [
    'name'    => 'form_form_kode', 
    'class'   => 'form-horizontal form_form_kode', 
    'id'      => 'form_form_kode',
    'enctype' => 'multipart/form-data', 
    'method'  => 'POST'
]); ?>
 
<div class="form-group ">
    <label for="kode" class="col-sm-2 control-label">Kode 
    <i class="required">*</i>
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="kode" id="kode" placeholder=""  >
        <small class="info help-block">
        </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="kelompok" class="col-sm-2 control-label">Kelompok 
    </label>
    <div class="col-sm-8">
        <select  class="form-control chosen chosen-select-deselect" name="kelompok" id="kelompok" data-placeholder="Select Kelompok"  >
            <option value=""></option>
            <?php foreach (db_get_all_data('form_kelompok') as $row): ?>
            <option value="<?= $row->nama_kelompok ?>"><?= $row->nama_kelompok; ?></option>
            <?php endforeach; ?>  
        </select>
        <small class="info help-block">
        </small>
    </div>
</div>

 
<div class="form-group ">
    <label for="expired" class="col-sm-2 control-label">Expired 
    <i class="required">*</i>
    </label>
    <div class="col-sm-6">
    <div class="input-group date col-sm-8">
      <input type="text" class="form-control pull-right datepicker" name="expired"  placeholder="" id="expired" >
    </div>
    <small class="info help-block">
    </small>
    </div>
</div>
 
<div class="form-group ">
    <label for="terpakai" class="col-sm-2 control-label">Terpakai 
    </label>
    <div class="col-sm-6">
        <div class="col-md-2 padding-left-0">
            <label>
                <input type="radio" class="flat-red" name="terpakai" id="terpakai"  value="1" >
                Yes
            </label>
        </div>
        <div class="col-md-14">
            <label>
                <input type="radio" class="flat-red" name="terpakai" id="terpakai"  value="0">
                No
            </label>
        </div>
        <small class="info help-block">
        </small>
    </div>
</div>


<div class="row col-sm-12 message">
</div>
<div class="col-sm-2">
</div>
<div class="col-sm-8 padding-left-0">
    <button class="btn btn-flat btn-primary btn_save" id="btn_save" data-stype='stay'>
    Submit
    </button>
    <span class="loading loading-hide">
    <img src="http://34.85.53.9:80/chatbotwa/asset//img/loading-spin-primary.svg"> 
    <i>Loading, Submitting data</i>
    </span>
</div>
</form></div>


<!-- Page script -->
<script>
    $(document).ready(function(){
          $('.form-preview').submit(function(){
        return false;
     });

     $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
     });


    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_form_kode = $('#form_form_kode');
        var data_post = form_form_kode.serializeArray();
        var save_type = $(this).attr('data-stype');
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + 'form/form_kode/submit',
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
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 1000);
        });
    
        return false;
      }); /*end btn save*/


      
             
           
    }); /*end doc ready*/
</script>