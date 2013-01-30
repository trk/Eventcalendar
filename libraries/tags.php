<?php

/**
 * Event Calendar TagManager
 */
class Eventcalendar_Tags extends TagManager {
    
    /**
     * Tags declaration
     * To be available, each tag must be declared in this static array.
     *
     * @var array
     *
     * @usage   "<tag scope>" => "<method_in_this_class>"
     *          Examples :
     *          "articles:hello" => "my_hello_method" : The tag "hello" will be usable as child of "articles"
     *          "demo:authors" => "my_authors_method"
     */
    public static $tag_definitions = array
    (
        "eventcalendar:count_all" =>                            "count_all",
        "eventcalendar:event" =>                                "event",
        "eventcalendar:event:field_event" =>                    "field_event",
        "eventcalendar:events" =>                               "events",
        "eventcalendar:events:id_event" =>                      "id_event",
        "eventcalendar:events:name" =>                          "name",
        "eventcalendar:events:title" =>                         "title",
        "eventcalendar:events:subtitle" =>                      "subtitle",
        "eventcalendar:events:description" =>                   "description",
        "eventcalendar:events:url" =>                           "url",
        "eventcalendar:events:start_date" =>                    "start_date",
        "eventcalendar:events:end_date" =>                      "end_date",
        "eventcalendar:events:author" =>                        "author",
        "eventcalendar:events:updater" =>                       "updater",
        "eventcalendar:events:created" =>                       "created",
        "eventcalendar:events:updated" =>                       "updated",
        "eventcalendar:events:event_id_category" =>             "event_id_category",
        "eventcalendar:events:event_id_article" =>              "event_id_category",
        "eventcalendar:events:event_category_title" =>          "event_id_category",
        "eventcalendar:events:event_category_subtitle" =>       "event_id_category",
        "eventcalendar:events:event_category_description" =>    "event_id_category",
        "eventcalendar:events:event_category_name" =>           "event_id_category",
        "eventcalendar:events:event_category_color" =>          "event_id_category",
        
        "eventcalendar:categories" =>                       "categories",
        "eventcalendar:categories:id_category" =>           "id_category",
        "eventcalendar:categories:category_title" =>        "category_title",
        "eventcalendar:categories:category_subtitle" =>     "category_subtitle",
        "eventcalendar:categories:category_description" =>  "category_description",
        "eventcalendar:categories:category_name" =>         "category_name",
        "eventcalendar:categories:category_color" =>        "category_color",
    );

    /**
     * @usage	<ion:eventcalendar>
     *              ...
     * 		</ion:eventcalendar>
     */
    public static function index(FTL_Binding $tag) {
        self::$ci = &get_instance();

        return $tag->expand();
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:count_all />
     */
    public static function count_all($tag) {
        self::load_model('Eventcalendar_model', 'eventcalendar_model');

        $output = self::$ci->eventcalendar_model->count_all();

        return $output;
    }
    
    /**
     * @usage :
     * 		<ion:eventcalendar:event>
     * 			.................
     *          </ion:eventcalendar:event>
     */
    public static function event(FTL_Binding $tag) {
        
        self::load_model('Eventcalendar_model', 'eventcalendar_model');

        $output = '';

        $event = self::$ci->eventcalendar_model->_get_events(array('id_article' => $tag->locals->article['id_article']), Settings::get_lang());
        
        if (count($event) > 0) {

            $tag->locals->event_info = $event[0];

            $output .= $tag->expand();
        }

        return $output;
    }
    
    /**
     * @usage	<ion:eventcalendar:event>
     *              <ion:field_event field="your_field_name" />
     *              for get category values
     *                  <ion:field_event field="your_field_name" from="category" />
     *          </ion:eventcalendar:event>
     */
    public static function field_event(FTL_Binding $tag) {
        
        $field = (isset($tag->attr['field']) ) ? $tag->attr['field'] : FALSE;

        if ($field) {
            
            $value = (isset($tag->attr['from']) && $tag->attr['from'] === 'category') ? $tag->locals->event_info['category'][$field] : $tag->locals->event_info[$field];
            
            if (! empty($value)){
                return self::wrap($tag, $value);
            }
        }

        return '';
    }
    
    /**
     * @usage :
     * 		<ion:eventcalendar:events>
     * 			.................
     *          </ion:eventcalendar:events>
     */
    public static function events(FTL_Binding $tag) {
        
        self::load_model('Eventcalendar_model', 'eventcalendar_model');

        $output = '';

        $events = self::$ci->eventcalendar_model->_get_events(FALSE, Settings::get_lang());

        if (count($events) > 0) {

            foreach ($events as $key => $value) {

                $tag->locals->event = $value;

                $output .= $tag->expand();
            }
        }

        return $output;
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:id_event /> </ion:eventcalendar:events>
     */
    public static function id_event($tag) {
        return self::wrap($tag, $tag->locals->event['id_event']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:name /> </ion:eventcalendar:events>
     */
    public static function name($tag) {
        return self::wrap($tag, $tag->locals->event['name']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:title /> </ion:eventcalendar:events>
     */
    public static function title($tag) {
        return self::wrap($tag, $tag->locals->event['title']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:subtitle /> </ion:eventcalendar:events>
     */
    public static function subtitle($tag) {
        return self::wrap($tag, $tag->locals->event['subtitle']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:description /> </ion:eventcalendar:events>
     */
    public static function description($tag) {
        return self::wrap($tag, $tag->locals->event['description']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:url /> </ion:eventcalendar:events>
     */
    public static function url($tag) {
        return self::wrap($tag, $tag->locals->event['url']);
    }

    /**
     * @usage :
     *     	<ion:eventcalendar:events> <ion:start_date format="D-M-Y" /> </ion:eventcalendar:events>
     */
    public static function start_date($tag) {
        return self::wrap($tag, self::format_date($tag, $tag->locals->event['start_date']));
    //  return self::wrap($tag, $tag->locals->event['start_date']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:end_date format="D-M-Y" /> </ion:eventcalendar:events>
     */
    public static function end_date($tag) {
        return self::wrap($tag, self::format_date($tag, $tag->locals->event['end_date']));
    //  return self::wrap($tag, $tag->locals->event['end_date']);
    }



    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:author /> </ion:eventcalendar:events>
     */
    public static function author($tag) {
        return self::wrap($tag, $tag->locals->event['author']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:updater /> </ion:eventcalendar:events>
     */
    public static function updater($tag) {
        return self::wrap($tag, $tag->locals->event['updater']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:created /> </ion:eventcalendar:events>
     */
    public static function created($tag) {
        return self::wrap($tag, $tag->locals->event['created']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:updated /> </ion:eventcalendar:events>
     */
    public static function updated($tag) {
        return self::wrap($tag, $tag->locals->event['updated']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:event_id_category /> </ion:eventcalendar:events>
     */
    public static function event_id_category($tag) {
        return self::wrap($tag, $tag->locals->event['id_category']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:event_id_article /> </ion:eventcalendar:events>
     */
    public static function event_id_article($tag) {
        return self::wrap($tag, $tag->locals->event['id_article']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:event_category_title /> </ion:eventcalendar:events>
     */
    public static function event_category_title($tag) {
        if (!empty($tag->locals->event['category']))
            return self::wrap($tag, $tag->locals->event['category']['title']);
        return '';
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:event_category_subtitle /> </ion:eventcalendar:events>
     */
    public static function event_category_subtitle($tag) {
        if (!empty($tag->locals->event['category']))
            return self::wrap($tag, $tag->locals->event['category']['subtitle']);
        return '';
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:event_category_description /> </ion:eventcalendar:events>
     */
    public static function event_category_description($tag) {
        if (!empty($tag->locals->event['category']))
            return self::wrap($tag, $tag->locals->event['category']['description']);
        return '';
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:event_category_name /> </ion:eventcalendar:events>
     */
    public static function event_category_name($tag) {
        if (!empty($tag->locals->event['category']))
            return self::wrap($tag, $tag->locals->event['category']['name']);
        return '';
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:events> <ion:event_category_color /> </ion:eventcalendar:events>
     */
    public static function event_category_color($tag) {
        if (!empty($tag->locals->event['category']))
            return self::wrap($tag, $tag->locals->event['category']['color']);
        return '';
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:categories>
     * 			.................
     *          </ion:eventcalendar:categories>
     */
    public static function categories(FTL_Binding $tag) {
        self::load_model('Eventcalendarcategory_model', 'eventcalendarcategory_model');

        $output = '';

        $categories = self::$ci->eventcalendarcategory_model->get_lang_list(FALSE, Settings::get_lang());

        if (count($categories) > 0) {

            foreach ($categories as $key => $value) {

                $tag->locals->event_category = $value;

                $output .= $tag->expand();
            }
        }

        return $output;
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:categories> <ion:id_category /> </ion:eventcalendar:categories>
     */
    public static function id_category($tag) {
        return self::wrap($tag, $tag->locals->event_category['id_category']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:categories> <ion:category_title /> </ion:eventcalendar:categories>
     */
    public static function category_title($tag) {
        return self::wrap($tag, $tag->locals->event_category['title']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:categories> <ion:category_subtitle /> </ion:eventcalendar:categories>
     */
    public static function category_subtitle($tag) {
        return self::wrap($tag, $tag->locals->event_category['subtitle']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:categories> <ion:category_description /> </ion:eventcalendar:categories>
     */
    public static function category_description($tag) {
        return self::wrap($tag, $tag->locals->event_category['description']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:categories> <ion:category_name /> </ion:eventcalendar:categories>
     */
    public static function category_name($tag) {
        return self::wrap($tag, $tag->locals->event_category['name']);
    }

    /**
     * @usage :
     * 		<ion:eventcalendar:categories> <ion:category_color /> </ion:eventcalendar:categories>
     */
    public static function category_color($tag) {
        return self::wrap($tag, $tag->locals->event_category['color']);
    }

}