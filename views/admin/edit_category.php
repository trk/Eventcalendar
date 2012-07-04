<!-- Category edit view - Modal window -->
<form name="categoryForm<?= $category['id_category'] ?>" id="categoryForm<?= $category['id_category'] ?>" action="module/eventcalendar/categorycalendar/save">

    <!-- Hidden fields -->
    <input id="id_category" name="id_category" type="hidden" value="<?= $category['id_category'] ?>" />

    <!-- Category Name -->
    <dl class="small">
        <dt>
            <label for="category_name"><?=lang('module_eventcalendar_category_name')?></label>
        </dt>
        <dd>
            <input id="category_name" name="category_name" class="inputtext required" type="text" value="<?= $category['name'] ?>" />
        </dd>
    </dl>
    <!-- Category Color -->
    <dl class="small">
        <dt>
            <label for="category_color"><?=lang('ionize_label_url')?></label>
        </dt>
        <dd>
            <input id="current_color1" name="category_color" class="inputtext required" type="text" value="<?= $category['color'] ?>" />
			<div id="cp1">Color picker container</div>
        </dd>
    </dl>
</form>


<!-- Save / Cancel buttons
	 Must be named bSave[windows_id] where 'window_id' is the used ID for the window opening through ION.formWindow()
-->
<div class="buttons">
    <button id="bSavecategory<?= $category['id_category'] ?>" type="button" class="button yes right mr40"><?= lang('ionize_button_save_close') ?></button>
    <button id="bCancelcategory<?= $category['id_category'] ?>" type="button" class="button no right"><?= lang('ionize_button_cancel') ?></button>
</div>

<script type="text/javascript">
	//Color Picker
	// Create the color picker with some colors
	var cp1 = new MooColorPicker($('cp1'), {
	    colors: ["#6D071A", "#FF0000", "#FF5900", "#FF9300", "#E8CC06", 
				"#FFFF33", "#CDDE47", "#84D41D", "#05966D", 
				"#4EA9A0", "#006D80", "#5EB6DD", "#3366FF", "#000099", 
				"#080830", "#50468C", "#853894", 
	             ],
    });
    cp1.selectColor("<?= $category['color'] ?>");
    // Display current color
    cp1.addEvent('change', function(col, box) {
	    $('current_color1').set('value', col);
	});


	    
    /**
     * Window resize
     *
     */
    ION.windowResize('category<?= $category['id_category'] ?>', {width:420});
</script>