<div id="eventcalendar_article_side_top_xhrloader"></div>
<script type="text/javascript">
	var id_article = $('id_article').value;
	/** Load Map List **/
	ION.HTML('<?= $controller_url ?>_check_event', {'id_article' : id_article}, {'update': 'eventcalendar_article_side_top_xhrloader'});
</script>