<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventcalendarcategory extends Module_Admin {
    
    public $data = '';
    public $lang_data = '';
    
    function construct() {
        
        // Controller URL & Controller Fodler
    	$this->controller_url = config_item('module_eventcalendar_url') . 'eventcalendarcategory/';
    	$this->controller_folder = 'admin/eventcalendarcategory/';
        
        // Load Event Calendar Model File
        $this->load->model('Eventcalendar_model', 'eventcalendar_model', true);
        $this->load->model('Eventcalendarcategory_model', 'eventcalendarcategory_model', true);
        
        // Controller Database Tables
        $this->table        = 'module_eventcalendar_category';
        $this->lang_table   = 'module_eventcalendar_category_lang';
        $this->pk_name      = 'id_category';
		
        // Send Controller URL to Templates
        $this->template['controller_url'] = $this->controller_url;
    }
    
    function index() {
        
        $this->template['categories'] = $this->eventcalendarcategory_model->get_lang_list(FALSE, Settings::get_lang());
        
        $this->output($this->controller_folder . 'index');
    }
    
    function save() {

        $id_category = ($this->input->post('id_category')) ? $this->input->post('id_category') : '';

        $id_article = ($this->input->post('id_article')) ? $this->input->post('id_article') : '';

        $this->_prepare_data();
        // trace($this->lang_data);
        if ($this->eventcalendarcategory_model->save($this->data, $this->lang_data)) {
            
            $this->callback[] = array(
                'fn' => 'ION.updateElement',
                'args' => array(
                    'element'=> 'mainPanel',
                    'url' => $this->controller_url . 'index'
                )
            );

            $this->callback[] = array(
                'fn' => 'ION.notification',
                'args' => array('success', lang('module_eventcalendar_callback_event_category_saved'))
            );

            $this->response();
            
        } else {

            $this->callback[] = array(
                'fn' => 'ION.notification',
                'args' => array('error', lang('module_eventcalendar_callback_event_category_nsaved'))
            );

            $this->response();
        }
    }
    
    function edit($id = NULL) {

        $id = (!is_null($id)) ? $id : $this->input->post('id_category');

        $this->eventcalendarcategory_model->feed_template($id, $this->template);
        $this->eventcalendarcategory_model->feed_lang_template($id, $this->template);

        $this->template['category'] = $this->eventcalendarcategory_model->get_row_array($id);

        $this->output($this->controller_folder . 'edit');
    }
    
    function delete($id) {

        Cache()->clear_cache();

        if ($id != '') {
            
            if(count($this->eventcalendar_model->get_list(array('id_category' => $id))) === 0) {
                // Delete Data
                if ($this->eventcalendarcategory_model->delete($id)) {

                    // Delete lang data
                    $this->eventcalendarcategory_model->delete(array($this->pk_name => $id), $this->lang_table);

                    /** Remove deleted items from DOM * */
                    $this->callback[] = array(
                        'fn' => 'ION.deleteDomElements',
                        'args' => array('.category' . $id)
                    );

                    $this->success(lang('module_eventcalendar_callback_event_category_deleted'));

                    $this->response();
                } else {
                    // Send Error Message
                    $this->callback[] = array
                        (
                        'fn' => 'ION.notification',
                        'args' => array('error', lang('module_eventcalendar_callback_event_category_ndeleted'))
                    );

                    $this->response();
                }
            } else {
                // Send Error Message
                    $this->callback[] = array
                        (
                        'fn' => 'ION.notification',
                        'args' => array('error', lang('module_eventcalendar_callback_event_category_in_use'))
                    );

                    $this->response();
            }
        } else {

            // Send Error Message
            $this->callback[] = array
                (
                'fn' => 'ION.notification',
                'args' => array('error', lang('module_eventcalendar_callback_event_category_ndeleted'))
            );

            $this->response();
        }
    }
    
    /**
     * Prepare data before saving
     **/
    function _prepare_data($xhr = FALSE) {
        // Standard fields
        $fields = $this->db->list_fields($this->table);

        // Set the data to the posted value.
        foreach ($fields as $field)
            $this->data[$field] = $this->input->post($field);

        // Lang data
        $this->lang_data = array();

        $fields = $this->db->list_fields($this->lang_table);

        foreach (Settings::get_languages() as $language) {
            foreach ($fields as $field) {
                if ($this->input->post($field . '_' . $language['lang']) !== false) 
                    $this->lang_data[$language['lang']][$field] = $this->input->post($field . '_' . $language['lang']);
                
            }
        }
    }
}