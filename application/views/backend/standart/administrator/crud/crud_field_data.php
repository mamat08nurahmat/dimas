
 <div class="table-wrapper">
 <table class="table table-responsive table table-bordered table-striped"  id="diagnosis_list">
   <thead>
      <tr>
                           <th width="20" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;"><?= cclang('no') ?></th>
                           <th width="120" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;"><?= cclang('field'); ?></th>
                           <th width="80" colspan="4" style="text-align: center;"><?= cclang('show_in'); ?></th>
                           <th width="100" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;"><?= cclang('input_type'); ?></th>
                           <th width="200" rowspan="2" valign="midle" style="vertical-align: middle; text-align: center;"><?= cclang('validation'); ?></th>
                        </tr>
                        <tr>
                           <th width="60" class="module-page-list column" style="vertical-align: middle; text-align: center;"><?= cclang('column'); ?></th>
                           <th width="60" class="module-page-add add_form" style="vertical-align: middle; text-align: center;"><?= cclang('add_form'); ?></th>
                           <th width="60" class="module-page-update update_form" style="vertical-align: middle; text-align: center;"><?= cclang('update_form'); ?></th>
                           <th width="60" class="detail_page" style="vertical-align: middle; text-align: center;"><?= cclang('detail_page'); ?></th>
                        </tr> 
   </thead>
   <tbody>
      <?php $i=0; foreach ($this->db->field_data($table) as $row):  $i++; ?>
      <tr>
         <td  class="dragable">
            <i class="fa fa-bars fa-lg text-muted"></i>
            <input type="hidden" name="crud[<?=$i; ?>][<?=$row->name; ?>][sort]" class="priority" value="<?= $i; ?>" >
            <?php if ($row->primary_key == 1) { ?>
            <input type="hidden" name="primary_key" value="<?= $row->primary_key == 1? $row->name : ''; ?>" >
            <?php } ?>
            <input type="hidden" class="crud-id" id="crud-id" value="<?= $i; ?>" >
            <input type="hidden" class="crud-name" id="crud-name" value="<?= $row->name; ?>" >
            <input type="hidden" class="crud-data-type" id="crud-data-type" value="<?= $row->type; ?>" >
            <input type="hidden" class="crud-primarykey" id="crud-primarykey" value="<?= $row->primary_key; ?>" >
            <input type="hidden" class="crud-max-length" id="crud-max-length" value="<?= $row->max_length; ?>" >
         </td>
         <td>
         <input type="text" class="crud-input-initial" name="crud[<?=$i; ?>][<?=$row->name; ?>][label]" placeholder="<?= $row->name; ?>" value="<?= $row->name; ?>">
               
         </td>
         <td class="column">
            <input class="flat-red check" type="checkbox" <?= $row->primary_key ? '' : 'checked'; ?> name="crud[<?=$i; ?>][<?=$row->name; ?>][show_in_column]" value="yes">
         </td>
         <td class="add_form">
            <input class="flat-red check" type="checkbox" <?= $row->primary_key ? '' : 'checked'; ?> name="crud[<?=$i; ?>][<?=$row->name; ?>][show_in_add_form]" value="yes">
         </td>
         <td class="update_form">
            <input class="flat-red check" type="checkbox" <?= $row->primary_key ? '' : 'checked'; ?> name="crud[<?=$i; ?>][<?=$row->name; ?>][show_in_update_form]" value="yes">
         </td>
         <td class="detail_page">
            <input class="flat-red check" type="checkbox" checked name="crud[<?=$i; ?>][<?=$row->name; ?>][show_in_detail_page]" value="yes">
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <select  class="form-control chosen chosen-select input_type" name="crud[<?=$i; ?>][<?=$row->name; ?>][input_type]" id="input_type" tabi-ndex="5" data-placeholder="Select Type" >
                     <option value="" class="<?= $this->model_crud->get_input_type(); ?>"></option>
                     <?php foreach (db_get_all_data('crud_input_type') as $input): 
                        if (preg_match('/image|photo|img|file/', $row->name) AND $input->type == 'file') {
                           $selected = 'selected';
                        } elseif ($row->type == $input->type OR ($row->type == 'timestamp' AND $input->type == 'timestamp')) {
                           $selected = 'selected';
                        } elseif ($row->type == 'int' AND $input->type == 'number') {
                           $selected = 'selected';
                        } elseif ($row->type == 'text' AND $input->type == 'editor_wysiwyg') {
                           $selected = 'selected';
                        } elseif ($row->type == 'tinytext' AND $input->type == 'textarea') {
                           $selected = 'selected';
                        } elseif (($row->type == 'varchar' OR $row->type == 'tinyint') AND $input->type == 'input') {
                           $selected = 'selected';
                        } elseif (($row->type == 'decimal') AND $input->type == 'input') {
                           $selected = 'selected';
                        } elseif ($input->type == 'input') {
                           $selected = 'selected';
                        } else {
                           $selected = '';
                        }
                     ?>
                     <option value="<?= $input->type; ?>" class="<?= $input->type; ?>" title="<?= $input->validation_group; ?>" relation="<?= $input->relation; ?>" custom-value="<?= $input->custom_value; ?>" <?= _ent($selected); ?>><?= _ent(ucwords(clean_snake_case($input->type))); ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
            <div class="custom-option-container display-none">
               <div class="custom-option-contain">
                  <div class="custom-option-item">
                     <div class="box-custom-option padding-left-0 box-top"> 
                        <div class="col-md-3"><?= cclang('value') ?></div>  <input type="text" name="crud[<?=$i; ?>][<?= $row->name; ?>][custom_option][0][value]"></label>
                     </div>
                     <div class="box-custom-option padding-left-0 box-bottom"> 
                        <div class="col-md-3"><?= cclang('label') ?></div>  <input type="text" name="crud[<?=$i; ?>][<?= $row->name; ?>][custom_option][0][label]">
                     </div>
                     <a class="text-red delete-option fa fa-trash" data-original-title="" title=""></a> 
                  </div>
               </div>
                <a class="box-custom-option input btn btn-flat btn-block bg-black  add-option"> 
                <i class="fa fa-plus-circle"></i> <?= cclang('add_new_option') ?>
               </a>
            </div>

            <div class="col-md-12" style="margin:0px !important">
               <div class="form-group display-none ">
                  <label><small class="text-muted"><?= cclang('table_reff') ?></small></label>
                  <select  class="form-control chosen chosen-select relation_table relation_field" name="crud[<?=$i; ?>][<?=$row->name; ?>][relation_table]" id="relation_table" tabi-ndex="5" data-placeholder="Select Table" >
                     <option value=""></option>
                      <?php foreach ($this->db->list_tables() as $table): ?>
                     <option value="<?= $table; ?>"><?= $table; ?></option>
                     <?php endforeach; ?>  
                  </select>
               </div>
            </div>
            <div class="col-md-12" style="margin:0px !important">
               <div class="form-group display-none ">
                  <label><small class="text-muted"><?= cclang('value_field_reff') ?></small></label>
                  <select  class="form-control chosen chosen-select relation_value relation_field" name="crud[<?=$i; ?>][<?=$row->name; ?>][relation_value]" id="relation_value" tabi-ndex="5" data-placeholder="Select ID" >
                     <option value=""></option>
                  </select>
               </div>
            </div>
            <div class="col-md-12" style="margin:0px !important">
               <div class="form-group display-none ">
                  <label><small class="text-muted"><?= cclang('label_field_reff') ?></small></label>
                  <select  class="form-control chosen chosen-select relation_label relation_field" name="crud[<?=$i; ?>][<?=$row->name; ?>][relation_label]" id="relation_label" tabi-ndex="5" data-placeholder="Select Label" >
                     <option value=""></option>
                  </select>
               </div>
            </div>
         </td>
         <td>
            <div class="col-md-12">
               <div class="form-group ">
                  <select  class="form-control chosen chosen-select validation" name="crud[<?=$i; ?>][<?=$row->name; ?>][validation]" id="validation" tabi-ndex="5" data-placeholder="+ Add Rules">
                      <option value="" class="input file number text datetime select"></option>
                      <?php 
                      foreach (db_get_all_data('crud_input_validation') as $input): 
                      ?>
                        <option value="<?= $input->validation; ?>" class="<?= str_replace(',', ' ', $input->group_input); ?>" data-group-validation="<?= str_replace(',', ' ', $input->group_input); ?>" data-placeholder="<?= $input->input_placeholder; ?>" title="<?= $input->input_able; ?>"><?= ucwords(clean_snake_case($input->validation)); ?></option>
                       <?php endforeach; ?> 
                  </select>
               </div>
            </div>
         </td>
      </tr>
      <?php endforeach; ?>
   </tbody>
</table>
</div>