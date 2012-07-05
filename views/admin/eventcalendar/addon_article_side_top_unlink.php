<style type="text/css">
    .btn-unlink {
        padding-left: 20px;
    }
</style>
<dl>
    <dt><label><strong><?= lang('module_eventcalendar_title') ?></strong></label></dt>
    <dd><a id="unlink_event_from_article" class="icon unlink btn-unlink" data-id="<?= $id_article ?>"><?= lang('module_eventcalendar_unlink_event') ?> <?= $id_article ?></a></dd>
</dl>
<script type="text/javascript">
    
    /** Unlink Event from Article **/
    $$('#unlink_event_from_article').each(function(item)
    {
        var id = item.getProperty('data-id');
        
        ION.initRequestEvent(item, '<?= $controller_url ?>unlink_article', {'id_article': id});
    });
    
</script>