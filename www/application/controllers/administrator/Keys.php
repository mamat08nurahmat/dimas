<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *| --------------------------------------------------------------------------
 *| Keys Controller
 *| --------------------------------------------------------------------------
 *| Keys site
 *|
 */
class Keys extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_keys');
    }

    /**
     * show all Keyss
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
        $this->is_allowed('keys_list');

        $filter = $this->input->get('q');
        $field  = $this->input->get('f');

        $this->data['keyss']       = $this->model_keys->get($filter, $field, $this->limit_page, $offset);
        $this->data['keys_counts'] = $this->model_keys->count_all($filter, $field);

        $config = [
            'base_url'    => 'administrator/keys/index/',
            'total_rows'  => $this->model_keys->count_all($filter, $field),
            'per_page'    => $this->limit_page,
            'uri_segment' => 4,
        ];

        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('API Keys List');
        $this->render('backend/standart/administrator/keys/keys_list', $this->data);
    }

    /**
     * Add new keyss
     *
     */
    public function add()
    {
        $this->is_allowed('keys_add');

        $this->template->title('API Keys New');
        $this->render('backend/standart/administrator/keys/keys_add', $this->data);
    }

    /**
     * Add New Keyss
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('keys_add', false)) {
            return $this->response([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access'),
            ]);
        }

        $this->form_validation->set_rules('key', 'Key', 'trim|required|max_length[40]');

        if ($this->form_validation->run()) {

            $save_data = [
                'key'            => $this->input->post('key'),
                'level'          => 0,
                'ignore_limits'  => 1,
                'is_private_key' => 0,
                'ip_addresses'   => $this->input->post('ip_addresses'),
            ];

            $save_keys = $this->model_keys->store($save_data);

            if ($save_keys) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']      = $save_keys;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/keys/edit/' . $save_keys, 'Edit Keys'),
                        anchor('administrator/keys', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                        anchor('administrator/keys/edit/' . $save_keys, 'Edit Keys')
                    ]), 'success');

                    $this->data['success']  = true;
                    $this->data['redirect'] = base_url('administrator/keys');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['message']  = cclang('data_not_change');
                    $this->data['success']  = false;
                    $this->data['redirect'] = base_url('administrator/keys');
                }
            }

        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        return $this->response($this->data);
    }

    /**
     * Update view Keyss
     *
     * @var $id String
     */
    public function edit($id)
    {
        $this->is_allowed('keys_update');

        $this->data['keys'] = $this->model_keys->find($id);

        $this->template->title('API Keys Update');
        $this->render('backend/standart/administrator/keys/keys_update', $this->data);
    }

    /**
     * Update Keyss
     *
     * @var $id String
     */
    public function edit_save($id)
    {
        if (!$this->is_allowed('keys_update', false)) {
            return $this->response([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access'),
            ]);
        }

        $this->form_validation->set_rules('key', 'Key', 'trim|required|max_length[40]');

        if ($this->form_validation->run()) {

            $save_data = [
                'key'            => $this->input->post('key'),
                'level'          => $this->input->post('level'),
                'ignore_limits'  => $this->input->post('ignore_limits'),
                'is_private_key' => $this->input->post('is_private_key'),
                'ip_addresses'   => $this->input->post('ip_addresses'),
            ];

            $save_keys = $this->model_keys->change($id, $save_data);

            if ($save_keys) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']      = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/keys', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', [
                    ]), 'success');

                    $this->data['success']  = true;
                    $this->data['redirect'] = base_url('administrator/keys');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['message']  = cclang('data_not_change');
                    $this->data['success']  = false;
                    $this->data['redirect'] = base_url('administrator/keys');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        return $this->response($this->data);
    }

    /**
     * delete Keyss
     *
     * @var $id String
     */
    public function delete($id = null)
    {
        $this->is_allowed('keys_delete');

        $this->load->helper('file');

        $arr_id = $this->input->get('id');
        $remove = false;

        if (!empty($id)) {
            $remove = $this->_remove($id);
        } elseif (count($arr_id) > 0) {
            foreach ($arr_id as $id) {
                $remove = $this->_remove($id);
            }
        }

        if ($remove) {
            set_message(cclang('has_been_deleted', 'Key'), 'success');
        } else {
            set_message(cclang('error_delete', 'Key'), 'error');
        }

        redirect('administrator/keys');
    }

    /**
     * View view Keyss
     *
     * @var $id String
     */
    public function view($id)
    {
        $this->is_allowed('keys_view');

        $this->data['keys'] = $this->model_keys->find($id);

        $this->template->title('API Keys Detail');
        $this->render('backend/standart/administrator/keys/keys_view', $this->data);
    }

    /**
     * delete Keyss
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $keys = $this->model_keys->find($id);

        return $this->model_keys->remove($id);
    }

    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('keys_export');

        $this->model_keys->export('keys', 'keys');
    }

    /**
    * Export to PDF
    *
    * @return Files PDF .pdf
    */
    public function export_pdf()
    {
        $this->is_allowed('keys_export');

        $this->model_keys->pdf('keys', 'Keys');
    }
}

/* End of file keys.php */
/* Location: ./application/controllers/administrator/Keys.php */
