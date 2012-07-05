<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventcalendar extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Eventcalendar_model', 'eventcalendar_model', true);
    }
    
    function index(){
        
        echo lang('module_eventcalendar_title');
        
//    	$this->template['events'] = $this->eventcalendar_model->_get_events(FALSE, Settings::get_lang());
//        
//    	$this->output('eventcalendar_header');
    }
    
    function events() {

        if($this->eventcalendar_model->count_all() > 0) {
            
            $events = $this->eventcalendar_model->_get_events(FALSE, Settings::get_lang());

            $json_data = array();

            $id = 61;

            foreach ($events as $key => $value) {
                $json_data[$key] = array(
                    'id' => $id++,
                    'start' => $value['start_date'],
                );
                
                if($value['title'] != '')
                    $json_data[$key]['title'] = $value['title'];
                else
                    $json_data[$key]['title'] = $value['name'];
                
                if($value['description'] != '')
                   $json_data[$key]['description'] = $value['description'];
                if($value['end_date'] != '' && $value['end_date'] != '0000-00-00 00:00:00')
                    $json_data[$key]['end'] = $value['end_date'];
                if($value['url'] != '')
                   $json_data[$key]['url'] = $value['url'];
                if(!empty($value['category']))
                   $json_data[$key]['color'] = $value['category']['color'];
            }

            echo json_encode($json_data);
        }
        
        return;
    }
}