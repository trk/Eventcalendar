
<!-- Event edit view - Modal window -->

<form name="eventForm<?= $event['id_event'] ?>" id="eventForm<?= $event['id_event'] ?>" action="module/eventcalendar/eventcalendar/save">

	<!-- Hidden fields -->
	<input id="id_event" name="id_event" type="hidden" value="<?= $event['id_event'] ?>" />

	<!-- Event Name -->
	<dl class="small">
            <dt>
                <label for="event_name"><?=lang('module_eventcalendar_event_name')?></label>
            </dt>
            <dd>
                <input id="event_name" name="event_name" class="inputtext required" type="text" value="<?= $name ?>" />
            </dd>
	</dl>
		<!-- Category -->
		<dl class="small">
			<dt>
				<label for=id_category><?=lang('module_eventcalendar_event_category')?></label>
			</dt>
			<dd>
				<?php if(count($categories) > 0):?>
				<select id="id_category" name="id_category">
					<?php
					$selected = '';
					if($event['id_category'] == 0){
						$selected = 'selected="selected"';
					}
					echo '<option value="0" '.$selected.'>--</option>';
					
					foreach ($categories as $category){
						$selected = '';
						if($category['id_category'] == $event['id_category']){
							$selected = 'selected="selected"';
						}
						echo '<option value="'.$category['id_category'].'" '.$selected.'>';
						echo $category['name'];
						echo '</option>';
					}
					?>
				</select>
				<?php endif;?>
			</dd>
		</dl>
        <!-- URL -->
        <dl class="small">
            <dt>
                <label for="url"><?=lang('ionize_label_url')?></label>
            </dt>
            <dd>
                <input id="url" name="url" class="inputtext required" type="text" value="<?= $url ?>" />
            </dd>
        </dl>
        <!-- Event Start Date -->
        <dl class="small">
            <dt>
                <label for="event_start_date"><?=lang('module_eventcalendar_event_start_date')?></label>
            </dt>
            <dd>
                <input id="event_start_date" name="event_start_date" class="inputtext required w120 date" type="text" value="<?= humanize_mdate($start_date, '%d.%m.%Y %H:%i:%s') ?>" />
            </dd>
        </dl>
        <!-- Event End Date -->
        <dl class="small">
            <dt>
                <label for="event_end_date"><?=lang('module_eventcalendar_event_end_date')?></label>
            </dt>
            <dd>
                <input id="event_end_date" name="event_end_date" class="inputtext required w120 date" type="text" value="<?= humanize_mdate($end_date, '%d.%m.%Y %H:%i:%s') ?>" />
            </dd>
        </dl>
	<fieldset id="blocks">
            <!-- Tabs -->
            <div id="eventTab<?= $event['id_event'] ?>" class="mainTabs">
                <ul class="tab-menu">
                    <?php foreach(Settings::get_languages() as $l) :?>
                        <li class="tab_edit_event<?= $event['id_event'] ?>" rel="<?= $l['lang'] ?>"><a><?= ucfirst($l['name']) ?></a></li>
                    <?php endforeach ;?>
                </ul>
                <div class="clear"></div>
            </div>
            <div id="eventTabContent<?= $event['id_event'] ?>">
                <!-- Text block -->
                <?php foreach(Settings::get_languages() as $l) :?>
                        <?php $lang = $l['lang']; ?>
                        <div class="tabcontent<?= $event['id_event'] ?>">
                            <!-- title -->
                            <dl class="small">
                                <dt>
                                    <label for="event_title"><?= lang('module_eventcalendar_event_title') ?></label>
                                </dt>
                                <dd>
                                    <input id="event_title_<?= $lang ?>" name="event_title_<?= $lang ?>" class="inputtext w180" type="text" value="<?= ${$lang}['title'] ?>"/>
                                </dd>
                            </dl>
                            <!-- subtitle -->
                            <dl class="small">
                                <dt>
                                    <label for="event_subtitle<?= $lang ?><?= $event['id_event'] ?>"><?= lang('module_eventcalendar_event_subtitle') ?></label>
                                </dt>
                                <dd>
                                    <input id="event_subtitle_<?= $lang ?><?= $event['id_event'] ?>" name="event_subtitle_<?= $lang ?>" class="inputtext" type="text" value="<?= ${$lang}['subtitle'] ?>"/>
                                </dd>
                            </dl>

                            <!-- description -->
                            <dl class="small">
                                <dt>
                                    <label for="event_description_<?= $lang ?><?= $event['id_event'] ?>"><?= lang('module_eventcalendar_event_description') ?></label>
                                </dt>
                                <dd>
                                    <textarea id="event_description_<?= $lang ?><?= $event['id_event'] ?>" name="event_description_<?= $lang ?>" class="tinyEvent w220 h120" rel="<?= $lang ?>"><?= ${$lang}['description'] ?></textarea>
                                </dd>
                            </dl>
                        </div>
                <?php endforeach ;?>
            </div>
	</fieldset>
</form>


<!-- Save / Cancel buttons
	 Must be named bSave[windows_id] where 'window_id' is the used ID for the window opening through ION.formWindow()
--> 
<div class="buttons">
	<button id="bSaveevent<?= $event['id_event'] ?>" type="button" class="button yes right mr40"><?= lang('ionize_button_save_close') ?></button>
	<button id="bCancelevent<?= $event['id_event'] ?>"  type="button" class="button no right"><?= lang('ionize_button_cancel') ?></button>
</div>

<script type="text/javascript">
    /**
     * Calendars init
     */
    ION.initDatepicker();
    /** 
     * Tabs init
     */
    new TabSwapper({
        tabsContainer: 'eventTab<?= $event['id_event'] ?>',
        sectionsContainer: 'eventTabContent<?= $event['id_event'] ?>',
        selectedClass: 'selected',
        deselectedClass: '',
        tabs: 'li',
        clickers: 'li a',
        sections: 'div.tabcontent<?= $event['id_event'] ?>'
    });
	ION.initLabelHelpLinks('#eventForm<?= $event['id_event'] ?>');
    /**
     * TinyEditors
     * Must be called after tabs init.
     */
    ION.initTinyEditors(
        '.tab_edit_event<?= $event['id_event'] ?>',
        '#eventTabContent<?= $event['id_event'] ?> .tinyEvent',
        'small',
        {'height':120}
    );
    /**
     * Window resize
     *
     */
    ION.windowResize('event<?= $event['id_event'] ?>', {width:420});
</script>