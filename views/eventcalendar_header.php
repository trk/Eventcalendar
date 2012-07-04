<ion:eventcalendar>
    <!-- Start Event Calendar -->
    <link rel='stylesheet' type='text/css' href='<ion:base_url />modules/Eventcalendar/lib/styles/fullcalendar.css' />
    <link rel='stylesheet' type='text/css' href='<ion:base_url />modules/Eventcalendar/lib/styles/fullcalendar.print.css' media='print' />
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/lib/javascripts/jquery-1.6.min.js'></script>
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/lib/javascripts/jquery-ui-1.8.11.custom.min.js'></script>
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/lib/javascripts/fullcalendar.min.js'></script>
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/lib/javascripts/wtooltip.min.js'></script>
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
        		allDayText: '<ion:translation term="allday" />',
                header: {
                    left: 'title',
                    center: 'prev,next today',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                        prev:     '&nbsp;&#9668;&nbsp;',  // left triangle
                        next:     '&nbsp;&#9658;&nbsp;',  // right triangle
                        prevYear: '<ion:translation term="year" />-1', // <<
                        nextYear: '<ion:translation term="year" />+1', // >>
                        today:    '<ion:translation term="today" />',
                        month:    '<ion:translation term="month" />',
                        week:     '<ion:translation term="week" />',
                        day:      '<ion:translation term="day" />'
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
					<ion:events>
					{
						allDayDefault: false,
						allDay: false,
						start: $.fullCalendar.parseDate('<ion:start_date />'),
						<?php if('<ion:end_date />' != '' && '<ion:end_date />' != '0000-00-00 00:00:00'): ?>
							end: $.fullCalendar.parseDate('<ion:end_date />'),
						<?php endif; ?>
						<?php if('<ion:url />' != ''): ?>
							url: '<ion:url />',
						<?php endif; ?>
						title: '<ion:title />',
						subtitle: '<ion:subtitle />',
						description: '<ion:description />',
						color: '<ion:category_color />',
						textColor : '#fff'
					},
					</ion:events>
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
</ion:eventcalendar>