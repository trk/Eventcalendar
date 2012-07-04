<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventcalendarcategory_model extends Base_model {

    public function __construct() {
        parent::__construct();

        $this->table        = 'module_eventcalendar_category';
        $this->lang_table   = 'module_eventcalendar_category_lang';
        $this->pk_name      = 'id_category';
    }
}