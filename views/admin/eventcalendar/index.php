<style type="text/css">
    #eventsTable {
        position: relative;
        overflow: hidden;
    }
    .strong {
        font-weight: bold;
    }
</style>
<div id="maincolumn">
    <h2 class="main" style="background: url('<?= config_item('module_eventcalendar_assets_folder') ?>images/icon_48_module.png') no-repeat;" id="main-title"><?= lang('module_eventcalendar_title') ?></h2>
    <div class="subtitle">
        <p class="lite"><?= lang('module_eventcalendar_subtitle') ?></p>
    </div>
    <hr />
    <!-- <?= trace($events) ?> -->
    <div class="tabcontent">
        <div class="tabsidecolumn">
            <h2><?= lang('module_eventcalendar_label_add_new_event') ?></h2>
            <form name="newEventForm" id="newEventForm" action="<?= admin_url() ?>eventcalendar/eventcalendar/save">
                <!-- Category -->
                <dl class="small">
                    <dt><label for=id_category><?= lang('ionize_label_category') ?></label></dt>
                    <dd>
                        <select id="id_category" name="id_category" class="select">
                            <option value="0">--</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id_category'] ?>">
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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

                                <!-- Event Title -->
                                <dl class="small">
                                    <dt><label for="title_<?= $lang ?>"><?= lang('ionize_label_title') ?></label></dt>
                                    <dd>
                                        <input id="title_<?= $lang ?>" name="title_<?= $lang ?>" class="inputtext required" type="text" value=""/>
                                    </dd>
                                </dl>
                                
                                <!-- Event URL -->
                                <dl class="small">
                                    <dt><label for="url_<?= $lang ?>"><?= lang('ionize_label_url') ?></label></dt>
                                    <dd>
                                        <input id="url_<?= $lang ?>" name="url_<?= $lang ?>" class="inputtext" type="text" value="" />
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
                    <th><?= lang('ionize_label_title') ?>
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
                        <td style="overflow:hidden;" class="title">
                            <div style="overflow:hidden;">
                                <span class="toggler left" rel="content<?= $event['id_event'] ?>">
                                    <a class="left article" rel="0.<?= $event['id_event'] ?>"><span class="flag flag"></span><?= $event['title'] ?></a>
                                </span>
                            </div>

                            <div id="content<?= $event['id_event'] ?>" class="content">

                                <div class="text">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="left strong w140"><?= lang('') ?></td>
                                                <td class="left"><img class="pr5" src="<?= theme_url() ?>images/world_flags/flag_<?= Settings::get_lang() ?>.gif" /></td>
                                            </tr>
                                            <?php if(! empty($event['article'])): ?>
                                                <tr>
                                                    <td class="left strong w140"><?= lang('module_eventcalendar_label_article') ?></td>
                                                    <td class="left">
                                                        <?= $event['article']['title'] ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(! empty($event['category'])): ?>
                                                <tr>
                                                    <td class="left strong w140"><?= lang('ionize_label_category') ?></td>
                                                    <td class="left">
                                                        <div class="squarecolor" style="display: inline-block; width:16px; height:16px; background:<?= $event['category']['color'] ?>;">&nbsp;</div>
                                                        <?= $event['category']['name'] ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td class="left strong w140"><?= lang('module_eventcalendar_event_start_date') ?></td>
                                                <td class="left"><?= $event['start_date'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left strong w140"><?= lang('module_eventcalendar_event_end_date') ?></td>
                                                <td class="left"><?= $event['end_date'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left strong w140"><?= lang('ionize_label_title') ?></td>
                                                <td class="left"><?= $event['title'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left strong w140"><?= lang('ionize_label_url') ?></td>
                                                <td class="left"><?= $event['url'] ?> <?php if($event['url'] != ''): ?><a target="_blank" href="<?= $event['url'] ?>" title="<?= $event['title'] ?>">Got To URL</a><?php endif; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left strong w140"><?= lang('ionize_label_subtitle') ?></td>
                                                <td class="left"><?= $event['subtitle'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left strong w140"><?= lang('ionize_label_description') ?></td>
                                                <td class="left"><?= $event['description'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </td>
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
    
    /**
     * Content togglers
     *
     */
    calculateTableLineSizes = function()
    {
        $$('#eventsTable tbody tr td.title').each(function(el)
        {
            var c = el.getFirst('.content');
            var toggler = el.getElement('.toggler');

            var text = c.getFirst();
            var s = text.getDimensions();

            if (s.height > 0)
            {
                toggler.store('max', s.height +10);

                if (toggler.hasClass('expand'))
                {
                    el.setStyles({'height': 20 + s.height + 'px' });
                    c.setStyles({'height': s.height + 'px' });
                }
            }
            else
            {
                toggler.store('max', s.height);
            }
        });
    }


    window.removeEvent('resize', calculateTableLineSizes);
    window.addEvent('resize', function()
    {
        calculateTableLineSizes();
    });

    window.fireEvent('resize');


    $$('#eventsTable tbody tr td .toggler').each(function(el)
    {
        el.fx = new Fx.Morph($(el.getProperty('rel')), {duration: 200, transition: Fx.Transitions.Sine.easeOut});
        el.fx2 = new Fx.Morph($(el.getParent('td')), {duration: 200, transition: Fx.Transitions.Sine.easeOut});

        $(el.getProperty('rel')).setStyles({'height':'0px'});
    });

    var toggleEvent = function(e)
    {
        e.stop();

        // this.fx.toggle();
        this.toggleClass('expand');

        var max = this.retrieve('max');
        var from = 0;
        var to = max;

        if (this.hasClass('expand') == 0)
        {
            from = max;
            to = 0;
            this.getParent('tr').removeClass('highlight');
        }
        else
        {
            this.getParent('tr').addClass('highlight');
        }

        this.fx.start({'height': [from, to]});
        this.fx2.start({'height': [from+20, to+20]});

    };

    $$('#eventsTable tbody tr td .toggler').addEvent('click', toggleEvent);    
    
</script>