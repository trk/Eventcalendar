<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventcalendar_model extends Base_model {

    public function __construct() {
        parent::__construct();

        $this->table        = 'module_eventcalendar';
        $this->lang_table   = 'module_eventcalendar_lang';
        $this->pk_name      = 'id_event';
    }
    
   /**
    * Saves the Event
    *
    * @param 	array	Standard data table
    * @param 	array	Lang depending data table
    *
    * @return	int	Event saved ID
    *
    **/
    function save($data, $lang_data) 
    {
        $user = $this->connect->get_current_user();
        
        if( ! $data[$this->pk_name] OR $data[$this->pk_name] == '') {
            $data['created'] = $data['updated'] = date('Y-m-d H:i:s');
            $data['author']  = $data['updater'] = $user['screen_name'];
        } else {
            $data['updater'] = $user['screen_name'];
            $data['updated'] = date('Y-m-d H:i:s');
        }

        // Dates
        $data['start_date'] = ($data['start_date']) ? getMysqlDatetime($data['start_date'], '%d.%m.%Y') : '0000-00-00';
        $data['end_date'] = ($data['end_date']) ? getMysqlDatetime($data['end_date'], '%d.%m.%Y') : '0000-00-00';

        return parent::save($data, $lang_data);
    }
        
    /**
     * Get All Events
     */
    function getEvents() {
        $this->db->select('module_eventcalendar.*, module_eventcalendar_category.name AS category_name, module_eventcalendar_category.color AS category_color');
        $this->db->from('module_eventcalendar');
        $this->db->join('module_eventcalendar_category', 'module_eventcalendar.id_category = module_eventcalendar_category.id_category', 'left');
        $events = $this->db->get();

        return $events->result_array();
    }

    /**
     * Get A Single Event Informations
     */
    function getEvent($eventID) {
        $event = $this->db->get_where('module_eventcalendar', array('id_event' => $eventID));
        return $event->row_array();
    }

    /**
     * Get Event Translations
     */
    function getEventLang($eventID, $lang) {
        $eventLang = $this->db->get_where('module_eventcalendar_lang', array('id_event' => $eventID, 'lang' => $lang));
        return $eventLang->row_array();
    }

    /**
     * Save Event
     */
    function saveEvent($data) {
        $this->db->insert('module_eventcalendar', $data);
        $eventID = $this->db->insert_id();
        return $eventID;
    }

    /**
     * Update Event
     */
    function updateEvent($eventID, $data) {
        $this->db->where('id_event', $eventID);
        $this->db->update('module_eventcalendar', $data);

        return $eventID;
    }

    /**
     * Save Event Translations
     */
    function saveEventLang($dataLang) {
        $this->db->insert('module_eventcalendar_lang', $dataLang);
        return;
    }

    /**
     * Update Event Translations
     */
    function updateEventLang($eventID, $lang, $dataLang) {
        $this->db->where(array('id_event' => $eventID, 'lang' => $lang));
        $this->db->update('module_eventcalendar_lang', $dataLang);
        return;
    }

    /**
     * Delete Event And Event Translations
     */
    function deleteEvent($eventID) {
        $this->db->delete('module_eventcalendar', array('id_event' => $eventID));
        $this->db->delete('module_eventcalendar_lang', array('id_event' => $eventID));

        return;
    }

    /**
     * Get All Categories
     */
    function getCategories() {
        $categories = $this->db->get('module_eventcalendar_category');
        return $categories->result_array();
    }

    /**
     * Get A Single Category Informations
     */
    function getCategory($categoryID) {
        $category = $this->db->get_where('module_eventcalendar_category', array('id_category' => $categoryID));
        return $category->row_array();
    }

    /**
     * Save Category
     */
    function saveCategory($data) {
        $this->db->insert('module_eventcalendar_category', $data);
        $categoryID = $this->db->insert_id();
        return $categoryID;
    }

    /**
     * Update Category
     */
    function updateCategory($categoryID, $data) {
        $this->db->where('id_category', $categoryID);
        $this->db->update('module_eventcalendar_category', $data);

        return $categoryID;
    }

    /**
     * Delete Category
     */
    function deleteCategory($categoryID) {
        $this->db->delete('module_eventcalendar_category', array('id_category' => $categoryID));

        return;
    }

    /**
     * This Will Check Translation For Events
     */
    function _checkLangs($eventID) {
        // TODO
        /* foreach(Settings::get_languages() as $l){

          } */
    }

}