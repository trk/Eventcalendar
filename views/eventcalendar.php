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