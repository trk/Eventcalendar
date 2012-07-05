<!DOCTYPE html>
<html lang="<ion:current_lang />">
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' type='text/css' href='<?= config_item('module_eventcalendar_assets_folder') ?>css/fullcalendar.css' />
        <link rel='stylesheet' type='text/css' href='<?= config_item('module_eventcalendar_assets_folder') ?>css/fullcalendar.print.css' media='print' />
        <script type='text/javascript' src='<?= config_item('module_eventcalendar_assets_folder') ?>js/jquery-1.7.2.min.js'></script>
        <script type='text/javascript' src='<?= config_item('module_eventcalendar_assets_folder') ?>js/fullcalendar.min.js'></script>
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
                        prevYear: '<ion:translation term="module_eventcalendar_year" />-1', // <<
                        nextYear: '<ion:translation term="module_eventcalendar_year" />+1', // >>
                        today:    '<ion:translation term="module_eventcalendar_today" />',
                        month:    '<ion:translation term="module_eventcalendar_month" />',
                        week:     '<ion:translation term="module_eventcalendar_week" />',
                        day:      '<ion:translation term="module_eventcalendar_day" />'
                    },
                    monthNames:[
                        '<ion:translation term="january" />',
                        '<ion:translation term="february" />',
                        '<ion:translation term="march" />',
                        '<ion:translation term="april" />',
                        '<ion:translation term="may" />',
                        '<ion:translation term="june" />',
                        '<ion:translation term="july" />',
                        '<ion:translation term="august" />',
                        '<ion:translation term="september" />',
                        '<ion:translation term="october" />',
                        '<ion:translation term="november" />',
                        '<ion:translation term="december" />'
                    ],
                    monthNamesShort: [
                        '<ion:translation term="jan" />',
                        '<ion:translation term="feb" />',
                        '<ion:translation term="mar" />',
                        '<ion:translation term="apr" />',
                        '<ion:translation term="may" />',
                        '<ion:translation term="jun" />',
                        '<ion:translation term="jul" />',
                        '<ion:translation term="aug" />',
                        '<ion:translation term="sep" />',
                        '<ion:translation term="oct" />',
                        '<ion:translation term="nov" />',
                        '<ion:translation term="dec" />'
                    ],
                    dayNames: [
                        '<ion:translation term="sunday" />',
                        '<ion:translation term="monday" />',
                        '<ion:translation term="tuesday" />',
                        '<ion:translation term="wednesday" />',
                        '<ion:translation term="thursday" />',
                        '<ion:translation term="friday" />',
                        '<ion:translation term="saturday" />',
                    ],
                    dayNamesShort: [
                        '<ion:translation term="sun" />',
                        '<ion:translation term="mon" />',
                        '<ion:translation term="tue" />',
                        '<ion:translation term="wed" />',
                        '<ion:translation term="thu" />',
                        '<ion:translation term="fri" />',
                        '<ion:translation term="sat" />',
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

            body {
                margin-top: 40px;
                text-align: center;
                font-size: 14px;
                font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            }

            #loading {
                position: absolute;
                top: 5px;
                right: 5px;
            }

            #wrap {
                width: 1100px;
                margin: 0 auto;
            }

            #eventcalendar-categories {
                float: left;
                width: 150px;
                padding: 0 10px;
                border: 1px solid #ccc;
                background: #eee;
                text-align: left;
            }

            #eventcalendar-categories h4 {
                font-size: 16px;
                margin-top: 0;
                padding-top: 1em;
            }

            .eventcalendar-category { /* try to mimick the look of a real event */
                margin: 10px 0;
                padding: 4px 6px;
                color: #fff;
                font-weight: bold;
                font-size: .85em;
            }

            #calendar {
                float: right;
                width: 900px;
            }

        </style>
    </head>
    <body>
        <div id='wrap'>
            <div id='loading' style='display:none'><ion:translation term="module_eventcalendar_loading" /></div>
            <div id='eventcalendar-categories'>
                <h4><ion:translation term="module_eventcalendar_title_categories" /></h4>
                <ion:eventcalendar:categories>
                    <div class='eventcalendar-category' style="background-color: <ion:category_color />;">
                        <?= ('<ion:category_title />' != '') ? '<ion:category_title />' : '<ion:category_name />' ?>
                    </div>
                </ion:eventcalendar:categories>
                <div class='eventcalendar-category' style="background-color: #3366CC;">
                    <ion:translation term="module_eventcalendar_uncategorized" />
                </div>                
            </div>

            <div id='calendar'></div>

            <div style='clear:both'></div>
        </div>
    </body>
</html>