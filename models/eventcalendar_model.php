<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventcalendar_model extends Base_model {

    public function __construct() {
        
        parent::__construct();
        
        // Event Calendar Tables
        $this->table        = 'module_eventcalendar';
        $this->lang_table   = 'module_eventcalendar_lang';
        $this->pk_name      = 'id_event';
        
        // Event Calendar Category Tables
        $this->category_table        = 'module_eventcalendar_category';
        $this->category_lang_table   = 'module_eventcalendar_category_lang';
        $this->category_pk_name      = 'id_category';
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
    
}