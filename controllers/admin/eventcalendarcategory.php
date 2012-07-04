<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventcalendarcategory extends Module_Admin {

    function construct() {
        
        // Controller URL & Controller Fodler
    	$this->controller_url = config_item('module_eventcalendar_url') . 'eventcalendarcategory/';
    	$this->controller_folder = 'admin/eventcalendarcategory/';
        
        // Load Event Calendar Model File
        $this->load->model('Eventcalendarcategory_model', 'eventcalendarcategory_model', true);
		
        // Send Controller URL to Templates
        $this->template['controller_url'] = $this->controller_url;
    }
    
    function index() {
        
        $this->output($this->controller_folder . 'index');
    }
    
    /**
     * Save Category
     */
    function save() {
        $categoryID = $this->input->post('id_category');

        // CREATION
        if (empty($categoryID)) {
            if ($this->input->post('category_name') != '' && $this->input->post('category_color') != '') {
                $data = array(
                    'name' => $this->input->post('category_name'),
                    'color' => $this->input->post('category_color'),
                );
                $categoryID = $this->eventcalendar->saveCategory($data);

                // CALLBACK
                $this->callback = array(
                    array(
                        'fn' => 'ION.updateElement',
                        'args' => array(
                            'element' => 'mainPanel',
                            'url' => 'module/eventcalendar/eventcalendar/index'
                        )
                    ),
                    array(
                        'fn' => 'ION.notification',
                        'args' => array('success', lang('module_eventcalendar_category_added'))
                    )
                );
                $this->response();
            } else {
                // CALLBACK
                $this->callback[] = array
                    (
                    'fn' => 'ION.notification',
                    'args' => array('error', lang('module_eventcalendar_category_nadded'))
                );
                $this->response();
            }
        } else {
            // UPDATE
            if ($this->input->post('category_name') != '' && $this->input->post('category_color') != '') {
                $data = array(
                    'name' => $this->input->post('category_name'),
                    'color' => $this->input->post('category_color'),
                );
                $categoryID = $this->eventcalendar->updateCategory($categoryID, $data);

                // CALLBACK
                $this->callback = array(
                    array(
                        'fn' => 'ION.updateElement',
                        'args' => array(
                            'element' => 'mainPanel',
                            'url' => 'module/eventcalendar/eventcalendar/index'
                        )
                    ),
                    array(
                        'fn' => 'ION.notification',
                        'args' => array('success', lang('module_eventcalendar_category_added'))
                    )
                );
                $this->response();
            } else {
                // CALLBACK
                $this->callback[] = array
                    (
                    'fn' => 'ION.notification',
                    'args' => array('error', lang('module_eventcalendar_category_nadded'))
                );
                $this->response();
            }
        }
    }

    /**
     * Update Category
     */
    function update($categoryID) {
        $this->eventcalendar->feed_template($categoryID, $this->template);
        $this->eventcalendar->feed_lang_template($categoryID, $this->template);

        $this->template['category'] = $this->eventcalendar->getCategory($categoryID);

        $this->output('admin/edit_category');
    }

    /**
     * Delete Category
     */
    function xhr_delete() {
        $categoryID = $this->input->post('id_event_category');

        if ($categoryID) {
            if ($categoryID != '') {
                $this->eventcalendar->deleteCategory($categoryID);

                $addon_data = array(
                    'id' => $categoryID
                );

                $this->success(lang('module_eventcalendar_category_deleted'), $addon_data);
            } else {
                $this->error(lang('module_eventcalendar_category_ndeleted'));
            }
        } else {
            $this->error(lang('module_eventcalendar_category_ndeleted'));
        }
    }

}