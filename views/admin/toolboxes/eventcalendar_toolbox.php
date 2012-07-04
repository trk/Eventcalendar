<style type="text/css">
    .toolbar-button.eventcalendar {
        background: url("<?php echo config_item('module_eventcalendar_assets_folder'); ?>images/icon_16_eventcalendar.png") no-repeat scroll 4px 50% transparent;
        padding-left: 24px;
    }
    .toolbar-button.eventcalendarcategory {
        background: url("<?php echo config_item('module_eventcalendar_assets_folder'); ?>images/icon_16_category.png") no-repeat scroll 4px 50% transparent;
        padding-left: 24px;
    }
</style>
<div class="toolbox divider">
    <input id="eventcalendarcategory" type="button" class="toolbar-button eventcalendarcategory" value="<?= lang('module_eventcalendar_toolbox_categories'); ?>" />
</div>
<div class="toolbox divider">
    <input id="eventcalendar" type="button" class="toolbar-button eventcalendar" value="<?= lang('module_eventcalendar_toolbox_eventcalendar'); ?>" />
</div>
<script type="text/javascript">
    
    $('eventcalendar').addEvent('click', function(e){
        e.stop();
        MUI.Content.update({
            'element': $('mainPanel'),
            'title': "<?= lang('module_eventcalendar_toolbox_eventcalendar') ?>",
            'url': '<?= config_item('module_eventcalendar_url'); ?>eventcalendar/index'
        });
    });
    $('eventcalendarcategory').addEvent('click', function(e){
        e.stop();
        MUI.Content.update({
            'element': $('mainPanel'),
            'title': "<?= lang('module_eventcalendar_toolbox_categories') ?>",
            'url': '<?= config_item('module_eventcalendar_url'); ?>eventcalendarcategory/index'
        });
    });
    
</script>