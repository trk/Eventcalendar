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
		
                    //editable: true,
			
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

            #external-events {
                float: left;
                width: 150px;
                padding: 0 10px;
                border: 1px solid #ccc;
                background: #eee;
                text-align: left;
            }

            #external-events h4 {
                font-size: 16px;
                margin-top: 0;
                padding-top: 1em;
            }

            .external-event { /* try to mimick the look of a real event */
                margin: 10px 0;
                padding: 2px 4px;
                background: #3366CC;
                color: #fff;
                font-size: .85em;
                cursor: pointer;
            }

            #external-events p {
                margin: 1.5em 0;
                font-size: 11px;
                color: #666;
            }

            #external-events p input {
                margin: 0;
                vertical-align: middle;
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
            <div id='external-events'>
                <h4>Draggable Events</h4>
                <div class='external-event'>My Event 1</div>
                <div class='external-event'>My Event 2</div>
                <div class='external-event'>My Event 3</div>
                <div class='external-event'>My Event 4</div>
                <div class='external-event'>My Event 5</div>
                <p>
                    <input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>
                </p>
            </div>

            <div id='calendar'></div>

            <div style='clear:both'></div>
        </div>
    </body>
</html>