Cotegories For Event Calendar
<script type="text/javascript">
    
    /** Module Panel toolbox **/
    ION.initModuleToolbox('<?= config_item('module_eventcalendar_folder_lowercase') ?>','<?= config_item('module_eventcalendar_folder_lowercase') ?>_toolbox');
        
    var moocolorpickerCSS = Asset.css('<?= config_item('module_eventcalendar_assets_folder') ?>css/moocolorpicker.css');
    var moocolorpickerJS = Asset.javascript('<?= config_item('module_eventcalendar_assets_folder') ?>js/moocolorpicker.js', {
        id: 'moocolorpickerJS',
        onLoad: function()
        {
            // Color Picker
            // Create the color picker with some colors
            var cp = new MooColorPicker($('cp'), {
                colors: ["#6D071A", "#FF0000", "#FF5900", "#FF9300", "#E8CC06", 
                    "#FFFF33", "#CDDE47", "#84D41D", "#05966D", 
                    "#4EA9A0", "#006D80", "#5EB6DD", "#3366FF", "#000099", 
                    "#080830", "#50468C", "#853894", 
                ],
            });
            cp.selectColor("#3366FF");
            // Display current color
            $('current_color').set('value', cp.getCurrentColor());
            cp.addEvent('change', function(col, box) {
                $('current_color').set('value', col);
            });
        }
    });
    
    
    /** Delete Event **/
    $$('.delete').each(function(item) {
        var confirmDeleteMessage = '<?php echo lang('ionize_confirm_element_delete') ?>';

        var id = item.getProperty('data-id');

        ION.initRequestEvent(item, '<?php echo $controller_url ?>delete/' + id, {'redirect':true}, {'confirm':true, 'message': confirmDeleteMessage})
    });
    
    // Make all categories editable
    $$('.edit').each(function(item, idx)
    {
        var rel = item.getProperty('rel');

        item.addEvent('click', function(e)
        {
            ION.formWindow('event' + rel, 'eventForm' + rel, Lang.get('module_eventcalendar_edit_event'), admin_url + 'module/eventcalendar/eventcalendar/update/' + rel);	
        });
    });

    /** New Event tabs (langs) **/
    new TabSwapper({
        tabsContainer: 'eventTab',
        sectionsContainer: 'eventTabContent',
        selectedClass: 'selected',
        deselectedClass: '',
        tabs: 'li',
        clickers: 'li a',
        sections: 'div.tabcontentcat',
        cookieName: 'eventTab'
    });

    /** TinyEditors **/
    ION.initTinyEditors('.tab_event', '#eventTabContent .tinyEvent', 'small');

</script>