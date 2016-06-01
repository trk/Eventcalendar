<?php $config = Modules()->get_module_config('Eventcalendar'); ?>
    <link rel='stylesheet' type='text/css' href='<ion:base_url />modules/Eventcalendar/assets/css/fullcalendar.css' />
    <link rel='stylesheet' type='text/css' href='<ion:base_url />modules/Eventcalendar/assets/css/fullcalendar.print.css' media='print' />
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/assets/js/fullcalendar.min.js'></script>
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/assets/js/wtooltip.min.js'></script>
        <script type='text/javascript'>

            $(document).ready(function() {
	
                $('#calendar').fullCalendar({
                    header: {
                        left: 'title',
                        center: 'prev,next today',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        prev:     '&nbsp;&#9668;&nbsp;',  // left triangle
                        next:     '&nbsp;&#9658;&nbsp;',  // right triangle
                        prevYear: '<ion:lang key="module_eventcalendar_year" />-1', // <<
                        nextYear: '<ion:lang key="module_eventcalendar_year" />+1', // >>
                        today:    '<ion:lang key="module_eventcalendar_today" />',
                        month:    '<ion:lang key="module_eventcalendar_month" />',
                        week:     '<ion:lang key="module_eventcalendar_week" />',
                        day:      '<ion:lang key="module_eventcalendar_day" />'
                    },
                    monthNames:[
                        '<ion:lang key="january" />',
                        '<ion:lang key="february" />',
                        '<ion:lang key="march" />',
                        '<ion:lang key="april" />',
                        '<ion:lang key="may" />',
                        '<ion:lang key="june" />',
                        '<ion:lang key="july" />',
                        '<ion:lang key="august" />',
                        '<ion:lang key="september" />',
                        '<ion:lang key="october" />',
                        '<ion:lang key="november" />',
                        '<ion:lang key="december" />'
                    ],
                    monthNamesShort: [
                        '<ion:lang key="jan" />',
                        '<ion:lang key="feb" />',
                        '<ion:lang key="mar" />',
                        '<ion:lang key="apr" />',
                        '<ion:lang key="may" />',
                        '<ion:lang key="jun" />',
                        '<ion:lang key="jul" />',
                        '<ion:lang key="aug" />',
                        '<ion:lang key="sep" />',
                        '<ion:lang key="oct" />',
                        '<ion:lang key="nov" />',
                        '<ion:lang key="dec" />'
                    ],
                    dayNames: [
                        '<ion:lang key="sunday" />',
                        '<ion:lang key="monday" />',
                        '<ion:lang key="tuesday" />',
                        '<ion:lang key="wednesday" />',
                        '<ion:lang key="thursday" />',
                        '<ion:lang key="friday" />',
                        '<ion:lang key="saturday" />',
                    ],
                    dayNamesShort: [
                        '<ion:lang key="sun" />',
                        '<ion:lang key="mon" />',
                        '<ion:lang key="tue" />',
                        '<ion:lang key="wed" />',
                        '<ion:lang key="thu" />',
                        '<ion:lang key="fri" />',
                        '<ion:lang key="sat" />',
                    ],
                    events: "<ion:base_url /><ion:current_lang />/eventcalendar/events",
			
                    loading: function(bool) {
                        if (bool) $('#loading').show();
                        else $('#loading').hide();
                    }
			
                });
		
            });

        </script>
        <style type='text/css'>
            #calendar {
                width: 100%;
                margin: 0 auto;
            }

        </style>
        <div id='wrap'>
            <div id='loading' style='display:none'><ion:lang key="module_eventcalendar_loading" /></div>
            <div id='eventcalendar-categories'>
                <h4><ion:lang key="module_eventcalendar_title_categories" /></h4>
                <ion:eventcalendar:categories>
                    <div class='eventcalendar-category' style="background-color: <ion:category_color />;">
                        <?= ('<ion:category_title />' != '') ? '<ion:category_title />' : '<ion:category_name />' ?>
                    </div>
                </ion:eventcalendar:categories>
                <div class='eventcalendar-category' style="background-color: #3366CC;">
                    <ion:lang key="module_eventcalendar_uncategorized" />
                </div>
            </div>
        <div class="container">
            <h1>Date</h1>
            
            <div id='calendar'></div>
        </div>
        </div>
