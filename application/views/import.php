<?php foreach($data as $dt){
   echo '<span> '.$dt['kode_grab'].'</span>';
} ?>
<form method="post" action="<?= base_url('administrator/tes/import2')?>" enctype="multipart/form-data">

<?= form_open(base_url('administrator/tes/import2'), [
                    'enctype' => 'multipart/form-data', 
                    'method'  => 'POST'
                  ]); ?>
<!--<form method="post" id="import_form" enctype="multipart/form-data">-->
    <p><label>Select Excel File</label><br>
    <i>expired</i>
    <input type="date" name="_expired">
    <i>active</i>
	<input type="date" name="_active">
    <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
    <br />
    <input type="submit" name="import" value="Import" class="btn btn-info" />
</form>