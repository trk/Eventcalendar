<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventcalendar extends Base_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Eventcalendar_model', 'eventcalendar', true);
    }
    
    function index(){
    	$this->template['events'] = $this->eventcalendar->getEvents();
    	$this->output('eventcalendar_header');
    }
}