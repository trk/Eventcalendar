<dl>
    <dt><label><strong><?= lang('module_eventcalendar_title') ?></strong></label></dt>
    <dd><a class="attach_event_to_article" data-id="<?= $id_article ?>"><?= lang('module_eventcalendar_attach_event') ?></a></dd>
</dl>
<script type="text/javascript">
    
    $$('.attach_event_to_article').each(function(item, idx) {
        item.addEvent('click', function(e)
        {
            var itemID = item.getProperty('data-id');;

            ION.formWindow('attachEvent' + itemID, 'attachEventForm' + itemID, '<?= lang('module_eventcalendar_attach_event') ?>', '<?= $controller_url ?>attach_article/' + itemID);	
        });
    });

</script>