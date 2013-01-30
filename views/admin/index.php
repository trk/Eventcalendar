<div id="maincolumn">
    <h2 class="main" style="background: url('<?= base_url() ?>modules/Eventcalendar/lib/images/titleBG.png') no-repeat;" id="main-title"><?= lang('module_eventcalendar_title') ?></h2>
    <!-- Categories -->
    <div class="tabcontent">

        <div class="tabsidecolumn">
            <!-- Informations -->
            <div class="info"></div>

            <div id="options">
                <!-- <?= lang('module_eventcalendar_new') ?> -->
                <h3 class="toggler"><?= lang('module_eventcalendar_new') ?></h3>
                <div class="element">
                    <form name="newEventForm" id="newEventForm" action="<?= admin_url() ?>eventcalendar/eventcalendar/save">
                        <!-- Event Name -->
                        <dl class="small">
                            <dt>
                            <label for="event_name"><?= lang('module_eventcalendar_event_name') ?></label>
                            </dt>
                            <dd>
                                <input id="name" name="event_name" class="inputtext required" type="text" value="" />
                            </dd>
                        </dl>
                        <!-- Category -->
                        <dl class="small">
                            <dt>
                            <label for=id_category><?= lang('module_eventcalendar_event_category') ?></label>
                            </dt>
                            <dd>
                                <?php if (count($categories) > 0): ?>
                                    <select id="id_category" name="id_category">
                                        <option value="0">--</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?php echo $category['id_category']; ?>">
                                                <?php echo $category['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            </dd>
                        </dl>
                        <!-- URL -->
                        <dl class="small">
                            <dt>
                            <label for="url"><?= lang('ionize_label_url') ?></label>
                            </dt>
                            <dd>
                                <input id="url" name="url" class="inputtext required" type="text" value="" />
                            </dd>
                        </dl>
                        <!-- Event Start Date -->
                        <dl class="small">
                            <dt>
                            <label for="event_start_date"><?= lang('module_eventcalendar_event_start_date') ?></label>
                            </dt>
                            <dd>
                                <input id="event_start_date" name="event_start_date" class="inputtext required w120 date" type="text" value="" />
                            </dd>
                        </dl>
                        <!-- Event End Date -->
                        <dl class="small">
                            <dt>
                            <label for="event_end_date"><?= lang('module_eventcalendar_event_end_date') ?></label>
                            </dt>
                            <dd>
                                <input id="event_end_date" name="event_end_date" class="inputtext required w120 date" type="text" value="" />
                            </dd>
                        </dl>
                        <fieldset id="blocks">
                            <!-- Category Lang Tabs -->
                            <div id="eventTab" class="mainTabs gray">
                                <ul class="tab-menu">
                                    <?php foreach (Settings::get_languages() as $l) : ?>
                                        <li class="tab_event" rel="<?= $l['lang'] ?>"><a><span><?= ucfirst($l['name']) ?></span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <!-- Event Content -->
                            <div id="eventTabContent">
                                <?php foreach (Settings::get_languages() as $l) : ?>
                                    <?php $lang = $l['lang']; ?>
                                    <div class="tabcontentcat">
                                        <!-- event_title -->
                                        <dl class="small">
                                            <dt>
                                            <label for="event_title_<?= $lang ?>"><?= lang('module_eventcalendar_event_title') ?></label>
                                            </dt>
                                            <dd>
                                                <input id="event_title_<?= $lang ?>" name="event_title_<?= $lang ?>" class="inputtext" type="text" value=""/>
                                            </dd>
                                        </dl>
                                        <!-- event_subtitle -->
                                        <dl class="small">
                                            <dt>
                                            <label for="event_subtitle_<?= $lang ?>"><?= lang('module_eventcalendar_event_subtitle') ?></label>
                                            </dt>
                                            <dd>
                                                <input id="event_subtitle_<?= $lang ?>" name="event_subtitle_<?= $lang ?>" class="inputtext" type="text" value=""/>
                                            </dd>
                                        </dl>
                                        <!-- event_description -->
                                        <dl class="small">
                                            <dt>
                                            <label for="event_description_<?= $lang ?>"><?= lang('module_eventcalendar_event_description') ?></label>
                                            </dt>
                                            <dd>
                                                <textarea id="event_description_<?= $lang ?>" name="event_description_<?= $lang ?>" class="tinyEvent" rel="<?= $lang ?>"></textarea>
                                            </dd>
                                        </dl>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- save button -->
                            <dl class="small">
                                <dt>&#160;</dt>
                                <dd>
                                    <button id="bSaveNewEvent" type="button" class="button yes"><?= lang('module_eventcalendar_save_event') ?></button>
                                </dd>
                            </dl>
                        </fieldset>
                    </form>
                </div>

                <!-- Catégories d'évenement -->
                <h3 class="toggler">Catégories d'évenement</h3>
                <div class="element">
                    <form name="newCategoryForm" id="newCategoryForm" action="<?= admin_url() ?>eventcalendar/categorycalendar/save">
                        <!-- Category Name -->
                        <dl class="small">
                            <dt>
                            <label for="category_name">Nom de la catégorie</label>
                            </dt>
                            <dd>
                                <input id="name" name="category_name" class="inputtext required" type="text" value="" />
                            </dd>
                        </dl>
                        <!-- Category Color -->
                        <dl class="small">
                            <dt>
                            <label for="category_color">Couleur de la catégorie</label>
                            </dt>
                            <dd>
                                <input name="category_color" class="inputtext required w120" id="current_color" type="text" value="No color selected" />
                                <div id="cp">Color picker container</div>
                            </dd>
                        </dl>
                        <!-- save button -->
                        <dl class="small">
                            <dt>&#160;</dt>
                            <dd>
                                <button id="bSaveNewCategory" type="button" class="button yes"><?= lang('module_eventcalendar_save_category') ?></button>
                            </dd>
                        </dl>
                    </form>
                </div>
            </div>
        </div>

        <div class="tabcolumn pt15">
            <h3 class="toggler1"><?= lang('module_eventcalendar_event_list') ?></h3>
            <div class="element1">
                <table class="list" id="eventsTable">
                    <thead>
                        <tr>
                            <th><?= lang('ionize_label_id') ?></th>
                            <th><?= lang('module_eventcalendar_event_name') ?></th>
                            <th><?= lang('module_eventcalendar_category_name') ?></th>
                            <th axis="string"><?= lang('module_eventcalendar_event_start_date') ?></th>
                            <th axis="string"><?= lang('module_eventcalendar_event_end_date') ?></th>
                            <th axis="string"><?= lang('ionize_label_author') ?></th>
                            <th axis="string"><?= lang('ionize_label_created') ?></th>
                            <th axis="string"><?= lang('ionize_label_updater') ?></th>
                            <th axis="string"><?= lang('ionize_label_updated') ?></th>
                            <th><?= lang('ionize_label_actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event) : ?>
                            <tr class="event<?= $event['id_event'] ?>">
                                <td style="width: 30px;">
                                    <?= $event['id_event'] ?>
                                </td>
                                <td style="overflow:hidden;" class="title">
                                    <?= $event['name'] ?>
                                </td>
                                <td>
                                    <div class="squarecolor" style="display: inline-block; width:16px; height:16px; background:<?= $event['category_color'] ?>;">&nbsp;</div>
                                    <?= $event['category_name'] ?>
                                </td>
                                <td>
                                    <?= $event['start_date'] ?>
                                </td>
                                <td>
                                    <?= $event['end_date'] ?>
                                </td>
                                <td>
                                    <?= $event['author'] ?>
                                </td>
                                <td>
                                    <?= $event['created'] ?>
                                </td>
                                <td>
                                    <?= $event['updater'] ?>
                                </td>
                                <td>
                                    <?= $event['updated'] ?>
                                </td>
                                <td style="width: 40px">
                                    <img class="icon right" onclick="javascript:deleteEvent('<?= $event['id_event'] ?>')" title="<?= $event['name'] ?>" src="<?= base_url() ?>/themes/admin/images/icon_16_delete.png" />
                                    <a class="icon right edit mr5" rel="<?= $event['id_event'] ?>" title="<?= $event['name'] ?>"></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (count($categories) > 0): ?>
                <h3 class="toggler1"><?= lang('module_eventcalendar_category_list') ?></h3>
                <div class="element1">
                    <table class="list" id="categoriesTable">
                        <thead>
                            <tr>
                                <th><?= lang('ionize_label_id') ?></th>
                                <th><?= lang('module_eventcalendar_category_name') ?></th>
                                <th><?= lang('module_eventcalendar_category_color') ?></th>
                                <th><?= lang('ionize_label_actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category) : ?>
                                <tr class="category<?= $category['id_category'] ?>">
                                    <td style="width: 30px;">
                                        <?= $category['id_category'] ?>
                                    </td>
                                    <td>
                                        <?= $category['name'] ?>
                                    </td>
                                    <td>
                                        <div class="squarecolor" style="display: inline-block; width:16px; height:16px; background:<?= $category['color'] ?>;">&nbsp;</div>
                                        <?= $category['color'] ?>
                                    </td>
                                    <td style="width: 40px">
                                        <img class="icon right" onclick="javascript:deleteCategory('<?= $category['id_category'] ?>')" title="<?= $category['name'] ?>" src="<?= base_url() ?>/themes/admin/images/icon_16_delete.png" />
                                        <a class="icon right edit mr5" rel="<?= $category['id_category'] ?>" title="<?= $category['name'] ?>"></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Make all categories editable
    $$('#eventsTable .edit').each(function(item, idx)
    {
        var rel = item.getProperty('rel');

        item.addEvent('click', function(e)
        {
            ION.formWindow('event' + rel, 'eventForm' + rel, Lang.get('module_eventcalendar_edit_event'), admin_url + 'module/eventcalendar/eventcalendar/update/' + rel);	
        });
    });

    $$('#categoriesTable .edit').each(function(item, idx)
    {
        var rel = item.getProperty('rel');

        item.addEvent('click', function(e)
        {
            ION.formWindow('category' + rel, 'categoryForm' + rel, Lang.get('module_eventcalendar_edit_category'), admin_url + 'module/eventcalendar/categorycalendar/update/' + rel);	
        });
    });

    /**
     * XHR DELETE
     **/
    var deleteEvent = function(id)
    {
        // Callback definition
        var callback = deleteEventConfirm.pass(id);
        // Confirmation modal window
        ION.confirmation('deluser' + id, callback, Lang.get('ionize_confirm_element_delete'));
    }

    var deleteEventConfirm = function(id)
    {
        // Delete URL
        var url = '<?= admin_url() ?>module/eventcalendar/eventcalendar/xhr_delete';		
        // JSON Request
        var xhr = new Request.JSON(
        {
            url: url,
            method: 'post',
            data: 'id=' + id,
            onSuccess: function(responseJSON, responseText)
            {
                if (responseJSON.id)
                {
                    // Remove all HTML elements with the classe corresponding to the element type and ID
                    $$('.event' + responseJSON.id).each(function(item, idx)
                    {
                        item.dispose();
                    });
                }
                // User message
                ION.notification(responseJSON.message_type, responseJSON.message);		
            }
        }).post();
    }

    /**
     *  Module Panel toolbox
     *  MUI.initModuleToolbox('module_name','module_name_toolbox');
     */
    ION.initToolbox();
    /**
     * Calendars init
     *
     */
    ION.initDatepicker();

    // Accordion
    ION.initAccordion('.toggler', 'div.element', true, 'menuAccordion');
    ION.initAccordion('.toggler1', 'div.element1', true, 'menuAccordion1');

    // Color Picker
    // Create the color picker with some colors
    var cp = new MooColorPicker($('cp'), {
        colors: ["#6D071A", "#FF0000", "#FF5900", "#FF9300", "#E8CC06", 
            "#FFFF33", "#CDDE47", "#84D41D", "#05966D", 
            "#4EA9A0", "#006D80", "#5EB6DD", "#3366FF", "#000099", 
            "#080830", "#50468C", "#853894", 
        ]
    });
    cp.selectColor("#3366FF");
    // Display current color
    $('current_color').set('value', cp.getCurrentColor());
    cp.addEvent('change', function(col, box) {
        $('current_color').set('value', col);
    });
	
    // New Event Form submit
    $('bSaveNewEvent').addEvent('click', function(e) {
        e.stop();
        ION.sendData(admin_url + 'module/eventcalendar/eventcalendar/save', $('newEventForm'));
    });

    // New Category Form submit
    $('bSaveNewCategory').addEvent('click', function(e) {
        e.stop();
        ION.sendData(admin_url + 'module/eventcalendar/categorycalendar/save', $('newCategoryForm'));
    });

    /** 
     * New Event tabs (langs)
     */
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

    /**
     * TinyEditors
     * Must be called after tabs init.
     *
     */
    ION.initTinyEditors('.tab_event', '#eventTabContent .tinyEvent', 'small');


	
    /**
     * XHR DELETE
     **/
    var deleteCategory = function(id)
    {
        // Callback definition
        var callback = deleteCategoryConfirm.pass(id);
        // Confirmation modal window
        ION.confirmation('deluser' + id, callback, Lang.get('ionize_confirm_element_delete'));
    }

    var deleteCategoryConfirm = function(id)
    {
        // Delete URL
        var url = '<?= admin_url() ?>module/eventcalendar/categorycalendar/xhr_delete';		
        // JSON Request
        var xhr = new Request.JSON(
        {
            url: url,
            method: 'post',
            data: 'id=' + id,
            onSuccess: function(responseJSON, responseText)
            {
                if (responseJSON.id)
                {
                    // Remove all HTML elements with the classe corresponding to the element type and ID
                    $$('.category' + responseJSON.id).each(function(item, idx)
                    {
                        item.dispose();
                    });
                }
                // User message
                ION.notification(responseJSON.message_type, responseJSON.message);		
            }
        }).post();
    }
</script>