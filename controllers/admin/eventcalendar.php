<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Eventcalendar extends Module_Admin {

    public $data = '';
    public $lang_data = '';

    function construct() {

        // Controller URL & Controller Fodler
        $this->controller_url = config_item('module_eventcalendar_url') . 'eventcalendar/';
        $this->controller_folder = 'admin/eventcalendar/';

        // Load Event Calendar Model File
        $this->load->model('Eventcalendar_model', 'eventcalendar_model', true);
        $this->load->model('Eventcalendarcategory_model', 'eventcalendarcategory_model', true);
        $this->load->model('Article_model', 'article_model', true);

        // Controller Database Tables
        $this->table = 'module_eventcalendar';
        $this->lang_table = 'module_eventcalendar_lang';
        $this->pk_name = 'id_event';

        // Send Controller URL to Templates
        $this->template['controller_url'] = $this->controller_url;
    }

    function index() {

        $this->template['events'] = $this->eventcalendar_model->_get_events(FALSE, Settings::get_lang());
        // $this->template['events'] = self::_get_events();
        $this->template['categories'] = $this->eventcalendarcategory_model->get_lang_list(FALSE, Settings::get_lang());

        $this->output($this->controller_folder . 'index');
    }

// Function added to Model file for Glabal Use
//    function _get_events() {
//        
//        $data = array();
//        
//        $events     = $this->eventcalendar_model->get_lang_list(FALSE, Settings::get_lang());
//        $categories = $this->eventcalendarcategory_model->get_lang_list(FALSE, Settings::get_lang());
//        $articles   = $this->article_model->get_lang_list(FALSE, Settings::get_lang());
//        
//        foreach ($events as $Ekey => $Evalue) {
//            if($Evalue['id_category'] != 0 && $Evalue['id_category'] != '')
//                foreach ($categories as $Ckey => $Cvalue)
//                    if($Cvalue['id_category'] == $Evalue['id_category'] && $Cvalue['lang'] == $Evalue['lang'])
//                        $events[$Ekey]['category'] = $Cvalue;
//            if($Evalue['id_article'] != 0 && $Evalue['id_article'] != '')
//                foreach ($articles as $Akey => $Avalue)
//                    if($Avalue['id_article'] == $Evalue['id_article'] && $Avalue['lang'] == $Evalue['lang'])
//                        $events[$Ekey]['article'] = $Cvalue;
//        }
//        
//        return $events;
//    }

    function save() {

        $id_facility = ($this->input->post('id_facility')) ? $this->input->post('id_facility') : '';

        $id_article = ($this->input->post('id_article')) ? $this->input->post('id_article') : '';

        $this->_prepare_data();

        if ($this->eventcalendar_model->save($this->data, $this->lang_data)) {

            $this->callback[] = array(
                'fn' => 'ION.updateElement',
                'args' => array(
                    'element' => 'mainPanel',
                    'url' => $this->controller_url . 'index'
                )
            );

            $this->callback[] = array(
                'fn' => 'ION.notification',
                'args' => array('success', lang('module_eventcalendar_callback_event_saved'))
            );

            $this->response();
        } else {

            $this->callback[] = array(
                'fn' => 'ION.notification',
                'args' => array('error', lang('module_eventcalendar_callback_event_nsaved'))
            );

            $this->response();
        }
    }

    function edit($id = NULL) {

        $id = (!is_null($id)) ? $id : $this->input->post('id_event');

        $this->eventcalendar_model->feed_template($id, $this->template);
        $this->eventcalendar_model->feed_lang_template($id, $this->template);

        $this->template['event'] = $this->eventcalendar_model->get_row_array($id);
        $this->template['categories'] = $this->eventcalendarcategory_model->get_list();

        $this->output($this->controller_folder . 'edit');
    }

    function delete($id) {

        Cache()->clear_cache();

        if ($id != '') {

            // Delete Data
            if ($this->eventcalendar_model->delete($id)) {

                // Delete lang data
                $this->eventcalendar_model->delete(array($this->pk_name => $id), $this->lang_table);

                /** Remove deleted items from DOM * */
                $this->callback[] = array(
                    'fn' => 'ION.deleteDomElements',
                    'args' => array('.event' . $id)
                );

                $this->success(lang('module_eventcalendar_callback_event_deleted'));

                $this->response();
            } else {
                // Send Error Message
                $this->callback[] = array
                    (
                    'fn' => 'ION.notification',
                    'args' => array('error', lang('module_eventcalendar_callback_event_ndeleted'))
                );

                $this->response();
            }
        } else {

            // Send Error Message
            $this->callback[] = array
                (
                'fn' => 'ION.notification',
                'args' => array('error', lang('module_eventcalendar_callback_event_ndeleted'))
            );

            $this->response();
        }
    }

    /**
     * Prepare data before saving
     * */
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

    /**
     * Adds "Addons" to core panels
     * When set, this function will be automatically called for each core panel.
     *
     * One addon is a view from the module which will be displayed in a core panel,
     * to add some interaction with the current edited element (page, article)
     *
     * 
     * @param	String		Core Element to add the addon to. Can be 'page', 'article', 'media'
     * @param	String		Placeholder which will display the addon
     *  					- 'side_top' : Side Column, Top
     *  					- 'side_bottom' : Side Column, Bottom
     *  					- 'main_top' : Main Column, Top
     *  					- 'main_bottom' : Main Column, Top
     *  					- 'toolbar' : Top toolbar
     * 
     *
     */
function _addons($object = array()) {
        $CI = & get_instance();
        $data['article'] = $object;
                                  
        $data['controller_url'] = admin_url() . 'module/' . 'eventcalendar' . '/eventcalendar/';
               $CI->load_addon_view(
                'eventcalendar',
                'article',
                'options_top',
                'admin/eventcalendar_addons/addon_article_side_top',
                $data
                );
    }

    function _check_event($id_article = NULL) {

        $id_article = (!is_null($id_article)) ? $id_article : $this->input->post('id_article');

        $this->template['id_article'] = $id_article;

        if (count($this->eventcalendar_model->get_row_array($id_article, 'id_article')) > 0)
            $this->output($this->controller_folder . 'addon_article_side_top_unlink');
        else
            $this->output($this->controller_folder . 'addon_article_side_top');
    }

    function attach_article($id_article = NULL) {

        $id_article = (!is_null($id_article)) ? $id_article : $this->input->post('id_article');

        $this->template['id_article'] = $id_article;

        $this->template['events'] = $this->eventcalendar_model->_get_events(FALSE, Settings::get_lang());

        $this->output($this->controller_folder . 'attach_article');
    }

    function _attachArticle($id_event = NULL, $id_article = NULL) {

        $id_event = (!is_null($id_event)) ? $id_event : $this->input->post('id_event');
        $id_article = (!is_null($id_article)) ? $id_article : $this->input->post('id_article');

        if (count($this->eventcalendar_model->get_row_array($id_event)) > 0) {

            $data = array(
                'id_event' => $id_event,
                'id_article' => $id_article
            );

            if ($this->eventcalendar_model->update($id_event, $data)) {

                // Send Success Message
                $this->callback = array(
                    array(
                        'fn' => 'ION.HTML',
                        'args' => array(
                            $this->controller_url . '_check_event',
                            array(
                                'id_article' => $id_article
                            ),
                            array(
                                'update' => 'eventcalendar_article_side_top_xhrloader'
                            )
                        ),
                    ),
                    array(
                        'fn' => 'ION.notification',
                        'args' => array('success', lang('module_eventcalendar_callback_event_attached'))
                    )
                );
                
                $this->callback[] = array
                (
                    'fn' => "ION.closeWindow",
                    'args' => array(
                            'wattachEvent' . $id_article
                        )
                );
                
                $this->response();
                
            } else {

                // Send Error Message
                $this->callback[] = array
                    (
                    'fn' => 'ION.notification',
                    'args' => array('error', lang('module_eventcalendar_callback_event_nattached'))
                );

                $this->response();
            }
        } else {

            // Send Error Message
            $this->callback[] = array
                (
                'fn' => 'ION.notification',
                'args' => array('error', lang('module_eventcalendar_callback_event_nattached'))
            );

            $this->response();
        }
    }

    function unlink_article($id_article = NULL) {

        $id_article = (!is_null($id_article)) ? $id_article : $this->input->post('id_article');

        $event = $this->eventcalendar_model->get_row_array($id_article, 'id_article');
        
        if (count($event) > 0) {
            $data = array(
                'id_event' => $event['id_event'],
                'id_article' => 0
            );

            if ($this->eventcalendar_model->update($event['id_event'], $data)) {

                // Send Success Message
                $this->callback = array(
                    array(
                        'fn' => 'ION.HTML',
                        'args' => array(
                            $this->controller_url . '_check_event',
                            array(
                                'id_article' => $id_article
                            ),
                            array(
                                'update' => 'eventcalendar_article_side_top_xhrloader'
                            )
                        ),
                    ),
                    array(
                        'fn' => 'ION.notification',
                        'args' => array('success', lang('module_eventcalendar_callback_event_unlinked'))
                    )
                );
                $this->response();
            } else {

                // Send Error Message
                $this->callback[] = array
                    (
                    'fn' => 'ION.notification',
                    'args' => array('error', lang('module_eventcalendar_callback_event_nunlinked'))
                );

                $this->response();
            }
        } else {
            // Send Error Message
            $this->callback[] = array
                (
                'fn' => 'ION.notification',
                'args' => array('error', lang('module_eventcalendar_callback_event_nunlinked'))
            );

            $this->response();
        }
    }

}
