<form name="eventForm<?= $id_event ?>" id="eventForm<?= $id_event ?>" action="<?= $controller_url ?>save">

    <!-- Hidden fields -->
    <input name="id_event" type="hidden" value="<?= $id_event ?>" />
    <input name="author" type="hidden" value="<?= $author ?>" />
    <input name="created" type="hidden" value="<?= $created ?>" />

    <!-- Category -->
    <dl class="small">
        <dt><label for=id_category><?= lang('ionize_label_category') ?></label></dt>
        <dd>
            <?php if (count($categories) > 0): ?>
                <select id="id_category" name="id_category" class="select">
                    <?php
                    $selected = '';
                    if ($id_category == 0) {
                        $selected = 'selected="selected"';
                    }
                    echo '<option value="0" ' . $selected . '>--</option>';

                    foreach ($categories as $category) {
                        $selected = '';
                        if ($category['id_category'] == $id_category) {
                            $selected = 'selected="selected"';
                        }
                        echo '<option value="' . $category['id_category'] . '" ' . $selected . '>';
                        echo $category['name'];
                        echo '</option>';
                    }
                    ?>
                </select>
            <?php endif; ?>
        </dd>
    </dl>

    <!-- Event Start Date -->
    <dl class="small">
        <dt><label for="start_date"><?= lang('module_eventcalendar_event_start_date') ?></label></dt>
        <dd>
            <input id="start_date" name="start_date" class="inputtext required w120 date" type="text" value="<?= humanize_mdate($start_date, '%d.%m.%Y %H:%i:%s') ?>" />
        </dd>
    </dl>
    <!-- Event End Date -->
    <dl class="small">
        <dt><label for="end_date"><?= lang('module_eventcalendar_event_end_date') ?></label></dt>
        <dd>
            <input id="end_date" name="end_date" class="inputtext required w120 date" type="text" value="<?= humanize_mdate($end_date, '%d.%m.%Y %H:%i:%s') ?>" />
        </dd>
    </dl>
    <fieldset id="blocks">
        <!-- Tabs -->
        <div id="eventTab<?= $id_event ?>" class="mainTabs">
            <ul class="tab-menu">
                <?php foreach (Settings::get_languages() as $l) : ?>
                    <li class="tab_edit_event<?= $id_event ?>" rel="<?= $l['lang'] ?>"><a><?= ucfirst($l['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div id="eventTabContent<?= $id_event ?>">
            <!-- Text block -->
            <?php foreach (Settings::get_languages() as $l) : ?>
                <?php $lang = $l['lang']; ?>
                <div class="tabcontent<?= $id_event ?>">

                    <!-- URL -->
                    <dl class="small">
                        <dt><label for="url_<?= $lang ?><?= $id_event ?>"><?= lang('ionize_label_url') ?></label></dt>
                        <dd>
                            <input id="url_<?= $lang ?><?= $id_event ?>" name="url_<?= $lang ?>" class="inputtext" type="text" value="<?= ${$lang}['url'] ?>"/>
                        </dd>
                    </dl>

                    <!-- Title -->
                    <dl class="small">
                        <dt><label for="title<?= $lang ?><?= $id_event ?>"><?= lang('ionize_label_title') ?></label></dt>
                        <dd>
                            <input id="title_<?= $lang ?>$id_event" name="title_<?= $lang ?>" class="inputtext" type="text" value="<?= ${$lang}['title'] ?>"/>
                        </dd>
                    </dl>

                    <!-- Subtitle -->
                    <dl class="small">
                        <dt><label for="subtitle<?= $lang ?><?= $id_event ?>"><?= lang('ionize_label_subtitle') ?></label></dt>
                        <dd>
                            <input id="subtitle_<?= $lang ?><?= $id_event ?>" name="subtitle_<?= $lang ?>" class="inputtext" type="text" value="<?= ${$lang}['subtitle'] ?>"/>
                        </dd>
                    </dl>

                    <!-- Description -->
                    <dl class="small">
                        <dt><label for="description_<?= $lang ?><?= $id_event ?>"><?= lang('ionize_label_description') ?></label></dt>
                        <dd>
                            <textarea id="description_<?= $lang ?><?= $id_event ?>" name="description_<?= $lang ?>" class="tinyEvent w220 h120" rel="<?= $lang ?>"><?= ${$lang}['description'] ?></textarea>
                        </dd>
                    </dl>

                </div>
            <?php endforeach; ?>
        </div>
    </fieldset>
</form>

<div class="buttons">
    <button id="bSaveevent<?= $id_event ?>" type="button" class="button yes right mr30"><?= lang('ionize_button_save_close') ?></button>
    <button id="bCancelevent<?= $id_event ?>"  type="button" class="button no right"><?= lang('ionize_button_cancel') ?></button>
</div>

<script type="text/javascript">
    /** Calendars init **/
    ION.initDatepicker();
    
    /** Tabs init **/
    new TabSwapper({
        tabsContainer: 'eventTab<?= $id_event ?>',
        sectionsContainer: 'eventTabContent<?= $id_event ?>',
        selectedClass: 'selected',
        deselectedClass: '',
        tabs: 'li',
        clickers: 'li a',
        sections: 'div.tabcontent<?= $id_event ?>'
    });
    
    /** Help Links **/
    ION.initLabelHelpLinks('#eventForm<?= $id_event ?>');
    
    /** TinyEditors Must be called after tabs init. **/
    ION.initTinyEditors(
        '.tab_edit_event<?= $id_event ?>', '#eventTabContent<?= $id_event ?> .tinyEvent', 'small', {'height':120}
    );
        
    /** Window resize **/
    ION.windowResize('event<?= $id_event ?>', {'width':480,'height':415});
</script>