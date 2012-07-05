<div id="maincolumn">
    <h2 class="main" style="background: url('<?= config_item('module_eventcalendar_assets_folder') ?>images/icon_48_category.png') no-repeat;" id="main-title"><?= lang('module_eventcalendar_title_categories') ?></h2>
    <div class="subtitle">
        <p class="lite"><?= lang('module_eventcalendar_subtitle_categories') ?></p>
    </div>
    <hr />
    <div class="tabcontent">
        <div class="tabsidecolumn">
            <h2><?= lang('module_eventcalendar_label_add_new_category') ?></h2>
            <form name="newCategoryForm" id="newCategoryForm" action="<?= $controller_url ?>save">

                <!-- Category Name -->
                <dl class="small">
                    <dt><label for="name"><?= lang('ionize_label_name') ?></label></dt>
                    <dd>
                        <input id="name" name="name" class="inputtext" type="text" value="" />
                    </dd>
                </dl>
                
                <!-- Color -->
                <dl class="small">
                    <dt><label for="color"><?= lang('module_eventcalendar_label_color') ?></label></dt>
                    <dd>
                        <input id="color" name="color" class="inputtext" type="text" value="" />
                        <div id="cp">Color picker container</div>
                    </dd>
                </dl>
                <fieldset id="blocks">
                    <!-- Category Lang Tabs -->
                    <div id="eventCategoryTab" class="mainTabs">
                        <ul class="tab-menu">
                            <?php foreach (Settings::get_languages() as $l) : ?>
                                <li class="tab_eventCategory" rel="<?= $l['lang'] ?>"><a><span><?= ucfirst($l['name']) ?></span></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <!-- Category Content -->
                    <div id="eventCategoryTabContent">
                        <?php foreach (Settings::get_languages() as $l) : ?>
                            <?php $lang = $l['lang']; ?>
                            <div class="tabcontentec">

                                <!-- Category Title -->
                                <dl class="small">
                                    <dt><label for="title_<?= $lang ?>"><?= lang('ionize_label_title') ?></label></dt>
                                    <dd>
                                        <input id="title_<?= $lang ?>" name="title_<?= $lang ?>" class="inputtext required" type="text" value=""/>
                                    </dd>
                                </dl>
                                
                                <!-- Category Subtitle -->
                                <dl class="small">
                                    <dt><label for="subtitle_<?= $lang ?>"><?= lang('ionize_label_subtitle') ?></label></dt>
                                    <dd>
                                        <input id="subtitle_<?= $lang ?>" name="subtitle_<?= $lang ?>" class="inputtext" type="text" value=""/>
                                    </dd>
                                </dl>
                                
                                <!-- Category Description -->
                                <dl class="small">
                                    <dt><label for="description_<?= $lang ?>"><?= lang('ionize_label_description') ?></label></dt>
                                    <dd>
                                        <textarea id="description_<?= $lang ?>" name="description_<?= $lang ?>" class="tinyEventCategory" rel="<?= $lang ?>"></textarea>
                                    </dd>
                                </dl>

                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- save button -->
                    <dl class="small">
                        <dt>&#160;</dt>
                        <dd>
                            <button id="bSaveNewCategory" type="button" class="button yes"><?= lang('ionize_button_save') ?></button>
                        </dd>
                    </dl>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="tabcolumn pt15">
        <table class="list" id="categoryTable">
            <thead>
                <tr>
                    <th><?= lang('ionize_label_id') ?></th>
                    <th><?= lang('ionize_label_name') ?></th>
                    <th><?= lang('module_eventcalendar_label_color') ?></th>
                    <th style="text-align: center;"><?= lang('ionize_label_actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr class="category<?= $category['id_category'] ?>">
                        <td style="width: 30px;"><?= $category['id_category'] ?></td>
                        <td><?= ($category['title'] != '') ? $category['title'] : $category['name'] ?></td>
                        <td style="background-color: <?= $category['color'] ?>; color: #FFF; font-weight: bold;"><?= $category['color'] ?></td>
                        <td style="text-align: center; width: 50px;">
                            <a class="icon delete right" data-id="<?= $category['id_category'] ?>" title="<?= lang('ionize_label_delete'); ?>"></a>
                            <a class="icon edit right mr5" data-id="<?= $category['id_category'] ?>" title="<?= lang('ionize_label_edit'); ?>"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
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
                    "#080830", "#50468C", "#853894" 
                ]
            });
            cp.selectColor("#3366FF");
            // Display current color
            $('color').set('value', cp.getCurrentColor());
            cp.addEvent('change', function(col, box) {
                $('color').set('value', col);
            });
        }
    });
    
    
    /** Delete Event **/
    $$('.delete').each(function(item) {
        var confirmDeleteMessage = '<?php echo lang('ionize_confirm_element_delete') ?>';

        var id = item.getProperty('data-id');

        ION.initRequestEvent(item, '<?php echo $controller_url ?>delete/' + id, {'redirect':true}, {'confirm':true, 'message': confirmDeleteMessage})
    });
    
    /** Edit Category Form Window **/
    $$('.edit').each(function(item, idx)
    {
        var id = item.getProperty('data-id');
        
        item.addEvent('click', function(e)
        {
            ION.formWindow('category' + id, 'categoryForm' + id, Lang.get('ionize_label_edit'), '<?php echo $controller_url ?>edit/' + id);	
        });
    });

    /** New Event tabs (langs) **/
    new TabSwapper({
        tabsContainer: 'eventCategoryTab',
        sectionsContainer: 'eventCategoryTabContent',
        selectedClass: 'selected',
        deselectedClass: '',
        tabs: 'li',
        clickers: 'li a',
        sections: 'div.tabcontentec',
        cookieName: 'eventCategoryTab'
    });
    
    /** Submit New Category **/
    $('bSaveNewCategory').addEvent('click', function(e) {
        e.stop();
        ION.sendData('<?= $controller_url ?>save', $('newCategoryForm'));
    });

    /** TinyEditors **/
    ION.initTinyEditors('.tab_eventCategory', '#eventCategoryTabContent .tinyEventCategory', 'small');

</script>