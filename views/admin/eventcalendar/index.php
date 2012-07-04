<div id="maincolumn">
    <h2 class="main" style="background: url('<?= config_item('module_eventcalendar_assets_folder') ?>images/icon_48_module.png') no-repeat;" id="main-title"><?= lang('module_eventcalendar_title') ?></h2>
    <div class="subtitle">
        <p class="lite"><?= lang('module_eventcalendar_subtitle') ?></p>
    </div>
    <div class="tabcontent">
        <div class="tabsidecolumn">
            <h2><?= lang('module_eventcalendar_label_add_new_event') ?></h2>
            <form name="newEventForm" id="newEventForm" action="<?= admin_url() ?>eventcalendar/eventcalendar/save">
                <!-- Category -->
                <dl class="small">
                    <dt>
                    <label for=id_category><?= lang('ionize_label_category') ?></label>
                    </dt>
                    <dd>
                        <?php if (count($categories) > 0): ?>
                            <select id="id_category" name="id_category" class="select">
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
                
                <!-- Event Start Date -->
                <dl class="small">
                    <dt>
                    <label for="start_date"><?= lang('module_eventcalendar_event_start_date') ?></label>
                    </dt>
                    <dd>
                        <input id="start_date" name="start_date" class="inputtext required w120 date" type="text" value="" />
                    </dd>
                </dl>
                <!-- Event End Date -->
                <dl class="small">
                    <dt>
                    <label for="end_date"><?= lang('module_eventcalendar_event_end_date') ?></label>
                    </dt>
                    <dd>
                        <input id="end_date" name="end_date" class="inputtext required w120 date" type="text" value="" />
                    </dd>
                </dl>
                <fieldset id="blocks">
                    <!-- Category Lang Tabs -->
                    <div id="eventTab" class="mainTabs">
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
                                
                                <!-- Event URL -->
                                <dl class="small">
                                    <dt><label for="url_<?= $lang ?>"><?= lang('ionize_label_url') ?></label></dt>
                                    <dd>
                                        <input id="url" name="url" class="inputtext required" type="text" value="" />
                                    </dd>
                                </dl>
                                
                                <!-- Event Title -->
                                <dl class="small">
                                    <dt><label for="title_<?= $lang ?>"><?= lang('ionize_label_title') ?></label></dt>
                                    <dd>
                                        <input id="title_<?= $lang ?>" name="title_<?= $lang ?>" class="inputtext" type="text" value=""/>
                                    </dd>
                                </dl>
                                <!-- Event Subtitle -->
                                <dl class="small">
                                    <dt><label for="subtitle_<?= $lang ?>"><?= lang('ionize_label_subtitle') ?></label></dt>
                                    <dd>
                                        <input id="subtitle_<?= $lang ?>" name="subtitle_<?= $lang ?>" class="inputtext" type="text" value=""/>
                                    </dd>
                                </dl>
                                <!-- Event Description -->
                                <dl class="small">
                                    <dt><label for="description_<?= $lang ?>"><?= lang('ionize_label_description') ?></label></dt>
                                    <dd>
                                        <textarea id="description_<?= $lang ?>" name="description_<?= $lang ?>" class="tinyEvent" rel="<?= $lang ?>"></textarea>
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
    </div>
    <div class="tabcolumn pt15">
        <table class="list" id="eventsTable">
            <thead>
                <tr>
                    <th><?= lang('ionize_label_id') ?></th>
                    <th><?= lang('module_eventcalendar_category_name') ?></th>
                    <th axis="string"><?= lang('module_eventcalendar_event_start_date') ?></th>
                    <th axis="string"><?= lang('module_eventcalendar_event_end_date') ?></th>
                    <th axis="string"><?= lang('ionize_label_author') ?></th>
                    <th axis="string"><?= lang('ionize_label_created') ?></th>
                    <th axis="string"><?= lang('ionize_label_updater') ?></th>
                    <th axis="string"><?= lang('ionize_label_updated') ?></th>
                    <th style="text-align: center;"><?= lang('ionize_label_actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event) : ?>
                    <tr class="event<?= $event['id_event'] ?>">
                        <td style="width: 30px;"><?= $event['id_event'] ?></td>
                        <td>
                            <div class="squarecolor" style="display: inline-block; width:16px; height:16px; background:<?= $event['category_color'] ?>;">&nbsp;</div>
                            <?= $event['category_name'] ?>
                        </td>
                        <td><?= $event['start_date'] ?></td>
                        <td><?= $event['end_date'] ?></td>
                        <td><?= $event['author'] ?></td>
                        <td><?= $event['created'] ?></td>
                        <td><?= $event['updater'] ?></td>
                        <td><?= $event['updated'] ?></td>
                        <td style="text-align: center; width: 50px;">
                            <a class="icon delete right" data-id="<?= $event['id_event'] ?>" title="<?= lang('ionize_label_delete'); ?>"></a>
                            <a class="icon edit right mr5" data-id="<?= $event['id_event'] ?>" title="<?= lang('ionize_label_edit'); ?>"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<script type="text/javascript">
    
    /** Module Panel toolbox **/
    ION.initModuleToolbox('<?= config_item('module_eventcalendar_folder_lowercase') ?>','<?= config_item('module_eventcalendar_folder_lowercase') ?>_toolbox');
    
    /** Calendars init **/
    ION.initDatepicker();

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
    
    /** Submit New Evet **/
    $('bSaveNewEvent').addEvent('click', function(e) {
        e.stop();
        ION.sendData('<?= $controller_url ?>save', $('newEventForm'));
    });
    
    /** Delete Event **/
    $$('.delete').each(function(item) {
        var confirmDeleteMessage = '<?php echo lang('ionize_confirm_element_delete') ?>';

        var id = item.getProperty('data-id');

        ION.initRequestEvent(item, '<?php echo $controller_url ?>delete/' + id, {'redirect':true}, {'confirm':true, 'message': confirmDeleteMessage})
    });
    
    /** Edit Event **/
    $$('.edit').each(function(item, idx)
    {
        var id = item.getProperty('data-id');

        item.addEvent('click', function(e)
        {
            ION.formWindow('event' + id, 'eventForm' + id, Lang.get('module_eventcalendar_edit_event'), '<?= $controller_url ?>edit/' + id);	
        });
    });
    
</script>