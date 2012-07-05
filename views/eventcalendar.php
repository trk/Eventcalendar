<!DOCTYPE html>
<html lang="<ion:current_lang />">
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' type='text/css' href='<?= config_item('module_eventcalendar_assets_folder') ?>css/fullcalendar.css' />
        <link rel='stylesheet' type='text/css' href='<?= config_item('module_eventcalendar_assets_folder') ?>css/fullcalendar.print.css' media='print' />
        <script type='text/javascript' src='<?= config_item('module_eventcalendar_assets_folder') ?>js/jquery-1.7.2.min.js'></script>
        <script type='text/javascript' src='<?= config_item('module_eventcalendar_assets_folder') ?>js/fullcalendar.min.js'></script>
        <script type='text/javascript' src='<?= config_item('module_eventcalendar_assets_folder') ?>js/wtooltip.min.js'></script>
        <script type='text/javascript'>
            $(document).ready(function() {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                
                $('#monthlist').change(function(){
                    var mM = 0;
                    $("#monthlist option:selected").each(function () {
                        mM = $(this).attr('value');
                    });
                    $('#calendar').fullCalendar('gotoDate', y, mM);
                });

                $('#calendar').fullCalendar({
                    editable: false,
                    height: 800,
                    disableDragging: false,
                    firstDay: 1,
                    firstHour: 12, // heure affichée par défaut
                    minTime: 9, // heure minimum
                    weekMode: 'variable',
                    titleFormat: {
                        month: 'MMMM yyyy',                             	// Mars 2012
                        week: "d[ MMMM][ yyyy]{ '&#8212;' d MMMM yyyy}", 	// 12 - 18 Mars 2012
                        day: 'dddd d MMMM yyyy'                  			// ven 16 Mars 2012
                    },
                    timeFormat: {
                        // for agendaWeek and agendaDay
                        agenda: 'H\'h\'mm{ - H\'h\'mm}', // 21h - 23h30
                        // for all other views
                        '': 'H\'h\'mm'            // 21h
                    },
                    axisFormat: 'H\'h\'{mm}',
                    columnFormat: {
                        month: 'ddd',    	// Lun
                        week: 'ddd d/MM', 	// Lun 9/07
                        day: 'dddd d/MM'  	// Lundi 9/07
                    },
                    allDayText: '<ion:translation term="module_eventcalendar_allday" />',
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
                    events: [
                        <ion:eventcalendar:events>
                            {
                                allDayDefault: false,
                                allDay: false,
                                start: $.fullCalendar.parseDate('<ion:start_date />'),
                                <?= ('<ion:end_date />' != '' && '<ion:end_date />' != '0000-00-00 00:00:00') ? "end: $.fullCalendar.parseDate('<ion:end_date />')," : '' ?>
                                url: '<ion:url />',
                                title: '<?= ('<ion:title />' != '') ? '<ion:title />' : '<ion:name />' ?>',
                                subtitle: '<ion:subtitle />',
                                description: '<ion:description />',
                                color: '<?= ('<ion:event_category_color />' != '') ? '<ion:event_category_color />' : '#3366CC' ?>',
                                textColor : '#fff'
                            },
                        </ion:eventcalendar:events>
                    ],
                    eventRender: function(event, element) {
                        var myContent = $.fullCalendar.formatDate(event.start, 'H\'h\'mm');
                        myContent += $.fullCalendar.formatDate(event.end, ' - H\'h\'mm');
                        myContent += "<h3>" + event.title + "</h3>";
                        if(event.subtitle != ''){
                            myContent += event.subtitle + "<br/><br/>";
                        }
                        myContent += event.description;
                        element.wTooltip({ 
                            content: myContent,
                            offsetY: 20,
                            offsetX: -10,
                            className: "cal_tooltip",
                            style: { //the default style rules of the tooltip 
                                border: "1px solid gray", 
                                background: event.color, 
                                color: "#fff", 
                                padding: "10px", 
                                zIndex: "100", 
                                textAlign: "left",
                                width: "200px",
                            }, 
                        });
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
        #monthlist {
            padding: 5px;
            margin-bottom: 10px;
            font-size: 1.3em;
            font-weight: 400;
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
        <select id="monthlist">
            <option value="0" <?php if(date('n')-1 == 0) echo 'selected="selected"'?>><ion:translation term="january" /></option>
            <option value="1" <?php if(date('n')-1 == 1) echo 'selected="selected"'?>><ion:translation term="february" /></option>
            <option value="2" <?php if(date('n')-1 == 2) echo 'selected="selected"'?>><ion:translation term="march" /></option>
            <option value="3" <?php if(date('n')-1 == 3) echo 'selected="selected"'?>><ion:translation term="april" /></option>
            <option value="4" <?php if(date('n')-1 == 4) echo 'selected="selected"'?>><ion:translation term="may" /></option>
            <option value="5" <?php if(date('n')-1 == 5) echo 'selected="selected"'?>><ion:translation term="june" /></option>
            <option value="6" <?php if(date('n')-1 == 6) echo 'selected="selected"'?>><ion:translation term="july" /></option>
            <option value="7" <?php if(date('n')-1 == 7) echo 'selected="selected"'?>><ion:translation term="august" /></option>
            <option value="8" <?php if(date('n')-1 == 8) echo 'selected="selected"'?>><ion:translation term="september" /></option>
            <option value="9" <?php if(date('n')-1 == 9) echo 'selected="selected"'?>><ion:translation term="october" /></option>
            <option value="10" <?php if(date('n')-1 == 10) echo 'selected="selected"'?>><ion:translation term="november" /></option>
            <option value="11" <?php if(date('n')-1 == 11) echo 'selected="selected"'?>><ion:translation term="december" /></option>
        </select>

        <div id='calendar'></div>

        <div style='clear:both'></div>
    </div>
</body>
</html>
