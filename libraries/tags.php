<?php

/**
 * Event Calendar TagManager
 */
class Eventcalendar_Tags
{
	/**
	 * <ion:eventcalendar>
	 *      ..........
	 * </ion:eventcalendar>
	 */
	public static function index(FTL_Binding $tag)
	{
		$str = $tag->expand();
		return $str;
	}

	/**
	 * <ion:eventcalendar>
	 *      <ion:events>
	 *          ..........
	 *      </ion:events>
	 * </ion:eventcalendar>
	 */
	public static function events(FTL_Binding $tag)
	{
		$CI =& get_instance();
		// Loading Eventcalendar Model
		if (!isset($CI->eventcalendar_model)) $CI->load->model('eventcalendar_model', '', true);

		// Loading Events
		$events = $CI->eventcalendar_model->getEvents();

		if (isset($events))
			$tag->locals->count = sizeof( $events );
		else
			$tag->locals->count = 0;

		$output = "";

		foreach ($events as $event)
		{
			$tag->locals->event  = $event;

			$tag->locals->event_lang =  $CI->eventcalendar_model->getEventLang($event['id_event'],Settings::get_lang());

			$tag->locals->event_category =  $CI->eventcalendar_model->getCategory($event['id_category']);

			$output .= $tag->expand();
		}

		return $output;
	}

	/**
	 * <ion:id_event />
	 */
	public static function id_event(FTL_Binding $tag)
	{
		return $tag->locals->event["id_event"];
	}

	/**
	 * <ion:author />
	 */
	public static function author(FTL_Binding $tag)
	{
		return $tag->locals->event["author"];
	}

	/**
	 * <ion:created />
	 */
	public static function created(FTL_Binding $tag)
	{
		return $tag->locals->event["created"];
	}

	/**
	 * <ion:start_date />
	 */
	public static function start_date(FTL_Binding $tag)
	{
		$startdate = ( ! empty($tag->locals->event["start_date"])) ? $tag->locals->event["start_date"] : '';
		return $startdate;
	}

	/**
	 * <ion:end_date />
	 */
	public static function end_date(FTL_Binding $tag)
	{
		$enddate = ( ! empty($tag->locals->event["end_date"])) ? $tag->locals->event["end_date"] : '';
		return $enddate;
	}

	/**
	 * <ion:name />
	 */
	public static function name(FTL_Binding $tag)
	{
		return $tag->locals->event["name"];
	}

	/**
	 * <ion:url />
	 */
	public static function url(FTL_Binding $tag)
	{
		return $tag->locals->event["url"];
	}

	/**
	 * <ion:title />
	 */
	public static function title($tag)
	{
		$title = ( ! empty($tag->locals->event_lang["title"])) ? $tag->locals->event_lang["title"] : '';
		return addslashes($title);
	}

	/**
	 * <ion:subtitle />
	 */
	public static function subtitle($tag)
	{
		$subtitle = ( ! empty($tag->locals->event_lang["subtitle"])) ? $tag->locals->event_lang["subtitle"] : '';
		return addslashes($subtitle);
	}

	/**
	 * <ion:description />
	 */
	public static function description($tag)
	{
		$description = ( ! empty($tag->locals->event_lang["description"])) ? $tag->locals->event_lang["description"] : '';
		// Suppression des retours à la ligne
		$search = array("\r\n", "\n", "\r");
		$description = str_replace($search, '', $description);
		return addslashes($description);
	}

	/**
	 * <ion:eventcalendar>
	 *      <ion:categories>
	 *          ..........
	 *      </ion:categories>
	 * </ion:eventcalendar>
	 */
	public static function categories(FTL_Binding $tag)
	{
		$CI =& get_instance();
		// Loading Eventcalendar Model
		if (!isset($CI->eventcalendar_model)) $CI->load->model('eventcalendar_model', '', true);
	
		// Loading Categories
		$categories = $CI->eventcalendar_model->getCategories();
	
		if (isset($categories))
			$tag->locals->count = sizeof( $categories );
		else
			$tag->locals->count = 0;
	
		$output = "";
	
		foreach ($categories as $category)
		{
			$tag->locals->event_category  = $category;
	
			$output .= $tag->expand();
		}
	
		return $output;
	}
	
	/**
	 * <ion:category_id />
	 */
	public static function category_id(FTL_Binding $tag)
	{
		return $tag->locals->event_category["id_category"];
	}

	/**
	 * <ion:category_name />
	 */
	public static function category_name($tag)
	{
		$category_name = ( ! empty($tag->locals->event_category['name'])) ? $tag->locals->event_category['name'] : '';
		return addslashes($category_name);
	}

	/**
	 * <ion:category_color />
	 */
	public static function category_color($tag)
	{
		$category_color = ( ! empty($tag->locals->event_category['color'])) ? $tag->locals->event_category['color'] : '#3366CC';
		return addslashes($category_color);
	}

	/**
	 * Number of events
	 */
	public static function count(FTL_Binding $tag)
	{
		$CI =& get_instance();
		if (!isset($CI->eventcalendar_model)) $CI->load->model('eventcalendar_model', '', true);

		$events = $CI->eventcalendar_model->getEvents();

		return sizeof( $events );
	}
}