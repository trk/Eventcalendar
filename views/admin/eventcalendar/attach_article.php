<form name="attachEventForm<?php echo $id_article; ?>" id="attachEventForm<?php echo $id_article; ?>" action="<?php echo $controller_url ?>save">
    <table class="list">
        <thead>
            <tr>
                <th><?= lang('ionize_label_title') ?></th>
                <th style="text-align: center; width: 100px;"><?= lang('ionize_label_actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $key => $value): ?>
                <tr>
                    <td><?= ($value['title'] != '') ? $value['title'] : $value['name'] ?></td>
                    <td style="text-align: center;"><a href="#" data-id_event="<?= $value['id_event'] ?>" data-id_article="<?= $id_article; ?>" class="attach_to_article"><?= lang('module_eventcalendar_attach_event') ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    
</form>
<div class="buttons">
    <button id="bCancelattachEvent<?php echo $id_article; ?>"  type="button" class="button no right mr30"><?= lang('ionize_button_close') ?></button>
</div>

<script type="text/javascript">

    /** Window resize **/
    ION.windowResize('attachEvent<?= $id_article; ?>', {'width':450});
        
    /** Attach Event To Article **/
    $$('.attach_to_article').each(function(item) {
        
        var id_event = item.getProperty('data-id_event');
        var id_article = item.getProperty('data-id_article');

        ION.initRequestEvent(item, '<?= $controller_url ?>_attachArticle', {'id_event': id_event, 'id_article': id_article});
    });

</script>