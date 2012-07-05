<form name="categoryForm<?= $id_category ?>" id="categoryForm<?= $id_category ?>" action="<?= $controller_url ?>save">

    <!-- Hidden fields -->
    <input name="id_category" type="hidden" value="<?= $id_category ?>" />

    <!-- Category Name -->
    <dl class="small">
        <dt><label for="name"><?= lang('ionize_label_name') ?></label></dt>
        <dd>
            <input id="name" name="name" class="inputtext" type="text" value="<?= $name ?>" />
        </dd>
    </dl>

    <!-- Color -->
    <dl class="small">
        <dt><label for="color"><?= lang('module_eventcalendar_label_color') ?></label></dt>
        <dd>
            <input id="editColor" name="color" class="inputtext" type="text" value="<?= $color ?>" />
            <div id="editCP">Color picker container</div>
        </dd>
    </dl>
    <fieldset id="blocks">
        <!-- Tabs -->
        <div id="editEventCategoryTab<?= $id_category ?>" class="mainTabs">
            <ul class="tab-menu">
                <?php foreach (Settings::get_languages() as $l) : ?>
                    <li class="tab_editEventCategory<?= $id_category ?>" rel="<?= $l['lang'] ?>"><a><?= ucfirst($l['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div id="editEventCategoryTabContent<?= $id_category ?>">
            <!-- Text block -->
            <?php foreach (Settings::get_languages() as $l) : ?>
                <?php $lang = $l['lang']; ?>
                <div class="tabcontent<?= $id_category ?>">

                    <!-- Title -->
                    <dl class="small">
                        <dt><label for="title<?= $lang ?><?= $id_category ?>"><?= lang('ionize_label_title') ?></label></dt>
                        <dd>
                            <input id="title_<?= $lang ?>$id_category" name="title_<?= $lang ?>" class="inputtext" type="text" value="<?= ${$lang}['title'] ?>"/>
                        </dd>
                    </dl>

                    <!-- Subtitle -->
                    <dl class="small">
                        <dt><label for="subtitle<?= $lang ?><?= $id_category ?>"><?= lang('ionize_label_subtitle') ?></label></dt>
                        <dd>
                            <input id="subtitle_<?= $lang ?><?= $id_category ?>" name="subtitle_<?= $lang ?>" class="inputtext" type="text" value="<?= ${$lang}['subtitle'] ?>"/>
                        </dd>
                    </dl>

                    <!-- Description -->
                    <dl class="small">
                        <dt><label for="description_<?= $lang ?><?= $id_category ?>"><?= lang('ionize_label_description') ?></label></dt>
                        <dd>
                            <textarea id="description_<?= $lang ?><?= $id_category ?>" name="description_<?= $lang ?>" class="tinyeditEventCategory w220 h120" rel="<?= $lang ?>"><?= ${$lang}['description'] ?></textarea>
                        </dd>
                    </dl>

                </div>
            <?php endforeach; ?>
        </div>
    </fieldset>
</form>

<div class="buttons">
    <button id="bSavecategory<?= $id_category ?>" type="button" class="button yes right mr30"><?= lang('ionize_button_save_close') ?></button>
    <button id="bCancelcategory<?= $id_category ?>"  type="button" class="button no right"><?= lang('ionize_button_cancel') ?></button>
</div>

<script type="text/javascript">
    
    // Assets for Color Picker Loaded in Category Container No need to load it again   
    var editCP = new MooColorPicker($('editCP'), {
        colors: ["#6D071A", "#FF0000", "#FF5900", "#FF9300", "#E8CC06", 
                "#FFFF33", "#CDDE47", "#84D41D", "#05966D", 
                "#4EA9A0", "#006D80", "#5EB6DD", "#3366FF", "#000099", 
                "#080830", "#50468C", "#853894"
        ]
    });
    editCP.selectColor("<?= $color ?>");
    editCP.addEvent('change', function(col, box) {
        $('editColor').set('value', col);
    });
    
    /** Tabs init **/
    new TabSwapper({
        tabsContainer: 'editEventCategoryTab<?= $id_category ?>',
        sectionsContainer: 'editEventCategoryTabContent<?= $id_category ?>',
        selectedClass: 'selected',
        deselectedClass: '',
        tabs: 'li',
        clickers: 'li a',
        sections: 'div.tabcontent<?= $id_category ?>'
    });
    
    /** TinyEditors Must be called after tabs init. **/
    ION.initTinyEditors(
        '.tab_editEventCategory<?= $id_category ?>', '#editEventCategoryTabContent<?= $id_category ?> .tinyeditEventCategory', 'small', {'height':120}
    );
        
    /** Window resize **/
    ION.windowResize('category<?= $id_category ?>', {'width':480,'height':425});
</script>