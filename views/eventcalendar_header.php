<ion:eventcalendar>
    <!-- Start Event Calendar -->
    <link rel='stylesheet' type='text/css' href='<ion:base_url />modules/Eventcalendar/assets/css/fullcalendar.css' />
    <link rel='stylesheet' type='text/css' href='<ion:base_url />modules/Eventcalendar/assets/css/fullcalendar.print.css' media='print' />
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/assets/js/jquery-1.6.min.js'></script>
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/assets/js/jquery-ui-1.8.11.custom.min.js'></script>
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/assets/js/fullcalendar.min.js'></script>
    <script type='text/javascript' src='<ion:base_url />modules/Eventcalendar/assets/js/wtooltip.min.js'></script>
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
<!-- End Event Calendar -->
<div id="legend_calendar" style="border: 1px solid #CCCCCC; border-radius: 5px; padding: 10px; margin-bottom: 20px;">
	<ion:eventcalendar>
		<ion:categories>
			<div id="category_<ion:category_id/>" style="display: inline-block; padding: 0 10px;">
			<div class="squarecolor" style="display: inline-block; width:16px; height:16px; background:<ion:category_color/>;">&nbsp;</div>
			<ion:category_name/>
			</div>
		</ion:categories>
	</ion:eventcalendar>
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
<div id="calendar"></div>