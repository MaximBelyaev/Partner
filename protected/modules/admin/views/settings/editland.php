<?php
$this->breadcrumbs=array(
    'Настройки',
);
$this->setPageTitle("Настройки | Настройка элементов лендинга");
?>
    <div class='block full-page-block'>

    <div class="head"><h5>Ссылка в шапке лендинга</h5></div>
    <p><input type="text" name="<?= 'hrefvar1' ?>" value="<?= $config['hrefvar1'] ?>" /></p>

    <div class="head"><h3>1-й блок</h3></div>
    <div class="head"><h5>Текст</h5></div>
    <form method="post" enctype="multipart/form-data">
    <?php $elements = array_slice($config, 0, 4, true);
    foreach ($elements as $k => $v) { ?>
        <p ><input type="text" name="<?= $k ?>" value="<?= $v ?>" /></p>
    <?php }?>

    <div class="head"><h5>Картинка на фоне 1-го блока</h5></div>
    <p><input type="file" name="<?= 'imgbgvar1'; ?>" size="40"></p>
    <img src="<?= $config['imgbgvar1'] ?>" height="175" width="175">




    <div class="head"><h3>2-й блок</h3></div>
    <div class="head"><h5>Текст</h5></div>
    <?php $elements = array_slice($config, 4, 4, true);
    foreach ($elements as $k => $v) { ?>
        <p><input type="text" name="<?= $k ?>" value="<?= $v ?>" /></p>
    <?php }?>

    <div class="head"><h5>Фон</h5></div>
    <p><input type="text" name="<?= 'colorbgvar1'; ?>" value="<?= $config['colorbgvar1'] ?>" /></p>

    <div class="head"><h5>Картинки</h5></div>
    <?php $elements = array_slice($config, 47, 3, true);
    foreach ($elements as $k => $v) { ?>
    <p><input type="file" name="<?= $k ?>" size="40" /></p>
    <img src="<?= $v ?>" height="175" width="175">
    <?php }?>




    <div class="head"><h3>3-й блок</h3></div>
    <div class="head"><h5>Текст</h5></div>
    <?php $elements = array_slice($config, 8, 4, true);
    foreach ($elements as $k => $v) { ?>
        <p><input type="text" name="<?= $k ?>" value="<?= $v ?>" /></p>
    <?php }?>
    <div class="head"><h5>Фон 3-го блока</h5></div>
    <p><input type="text" name="<?= 'colorbgvar2'; ?>" value="<?= $config['colorbgvar2'] ?>" /></p>
    <input type="checkbox" id="checkbox2" name="displayvar2"
    <?php ($config['displayvar2'] === 'none') ? print '' : print 'checked="checked"'; ?> >
    <label for="checkbox2" class="checkbox-label"></label>
    <label class="required inline-block" for="checkbox2">Таблица офферов </label>
        <div class="head">
            <h5>
                Офферы
                <?= CHtml::link('Добавить', array('/admin/offers/create'), array('class'=>'btn btn-primary land-btn',)); ?>
            </h5>
        </div>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'landings-grid',
            'dataProvider' => $dataProvider,
            'summaryText' => '',
            'htmlOptions' => array('class'=>'grid-view orange'),
            'columns' => array(
                array(
                    'name' => 'name',
                    'htmlOptions' => array('class' => 'width60'),
                    'headerHtmlOptions' => array('class' => 'width60'),
                    'filterHtmlOptions' => array('class' => 'width60'),
                ),
                array(
                    'name' => 'percent',
                    'htmlOptions' => array('class' => 'width595'),
                    'headerHtmlOptions' => array('class' => 'width595'),
                    'filterHtmlOptions' => array('class' => 'width595'),
                ),
                array(
                    'name' => 'fixed_pay',
                    'htmlOptions' => array('class' => 'width595'),
                    'headerHtmlOptions' => array('class' => 'width595'),
                    'filterHtmlOptions' => array('class' => 'width595'),
                ),
                array(
                    'name' => 'click_pay',
                    'htmlOptions' => array('class' => 'width595'),
                    'headerHtmlOptions' => array('class' => 'width595'),
                    'filterHtmlOptions' => array('class' => 'width595'),
                ),
                array(
                    'header'=>'Ред',
                    'class'=>'CButtonColumn',
                    'htmlOptions' => array('class' => 'width120 actionColumn'),
                    'headerHtmlOptions' => array('class' => 'width120 actionColumn'),
                    'filterHtmlOptions' => array('class' => 'width120 actionColumn'),
                    'template'=>'<span class="icons_wrap"><span class="not_btn not_upd">{update}</span><span class="not_btn not_del">{delete}</span></span>',
                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'',
                            'url'=>'Yii::app()->createUrl("admin/offers/update/", array("id"=>$data->id))',
                            'options' => array(
                                'class' => "icon-pencil icon-white"
                            ),
                            'imageUrl'=>'',
                        ),
                        'delete' => array
                        (
                            'label'=>'',
                            'url'=>'Yii::app()->createUrl("admin/offers/delete/", array("id"=>$data->id))',
                            'options' => array(
                                'class' => "icon-trash icon-white"
                            ),
                            'imageUrl'=>'',
                        ),
                    ),
                ),
            ),
        ));
        ?>

    <div class="head"><h3>4-й блок</h3></div>
    <div class="head"><h5>Текст с 4-го блока</h5></div>
    <?php $elements = array_slice($config, 12, 8, true);
    foreach ($elements as $k => $v) { ?>
        <p><input type="text" name="<?= $k ?>" value="<?= $v ?>" /></p>
    <?php }?>
    <div class="head"><h5>Фон 4-го блока</h5></div>
    <p><input type="text" name="<?= 'colorbgvar3'; ?>" value="<?= $config['colorbgvar3'] ?>" /></p>
    <div class="head"><h5>Картинки</h5></div>
    <?php $elements = array_slice($config, 50, 1, true);
    foreach ($elements as $k => $v) { ?>
    <p><input type="file" name="<?= $k ?>" size="40" /></p>
    <img src="<?= $v ?>" height="175" width="175">
    <?php }?>



    <div class="head"><h3>5-й блок</h3></div>
    <div class="head"><h5>Текст с 5-го блока</h5></div>
    <?php $elements = array_slice($config, 20, 10, true);
    foreach ($elements as $k => $v) { ?>
        <p><input type="text" name="<?= $k ?>" value="<?= $v ?>" /></p>
    <?php }?>
    <div class="head"><h5>Фон 5-го блока</h5></div>
    <p><input type="text" name="<?= 'colorbgvar4'; ?>" value="<?= $config['colorbgvar4'] ?>" /></p>
    <div class="head"><h5>Ссылки в 5-м блоке</h5></div>
    <p><input type="text" name="<?= 'hrefvar2' ?>" value="<?= $config['hrefvar2'] ?>" /></p>
    <p><input type="text" name="<?= 'hrefvar2' ?>" value="<?= $config['hrefvar2'] ?>" /></p>
    <p><input type="text" name="<?= 'hrefvar2' ?>" value="<?= $config['hrefvar2'] ?>" /></p>
    <input type="checkbox" id="checkbox1" name="displayvar1"
    <?php ($config['displayvar1'] === 'none') ? print '' : print 'checked="checked"'; ?>>
    <label for="checkbox1" class="checkbox-label"></label>
    <label class="required inline-block" for="checkbox1">Включить/отключить отображение блока</label>
    <br>
    <div class="head"><h5>Картинки</h5></div>
    <?php $elements = array_slice($config, 51, 3, true);
    foreach ($elements as $k => $v) { ?>
    <p><input type="file" name="<?= $k ?>" size="40" /></p>
    <img src="<?= $v ?>" height="175" width="175">
    <?php }?>


    <div class="head"><h3>6-й блок</h3></div>
    <div class="head"><h5>Текст с 6-го блока</h5></div>
    <?php $elements = array_slice($config, 30, 7, true);
    foreach ($elements as $k => $v) { ?>
        <p><input type="text" name="<?= $k ?>" value="<?= $v ?>" /></p>
    <?php }?>
    <div class="head"><h5>Фон 6-го блока</h5></div>
    <p><input type="text" name="<?= 'colorbgvar5'; ?>" value="<?= $config['colorbgvar5'] ?>" /></p>


    <div class="head"><h3>7-й блок</h3></div>
    <div class="head"><h5>Текст с 7-го блока</h5></div>
    <?php $elements = array_slice($config, 37, 3, true);
    foreach ($elements as $k => $v) { ?>
        <p><input type="text" name="<?= $k ?>" value="<?= $v ?>" /></p>
    <?php }?>
    <div class="head"><h5>Картинка на фоне</h5></div>
    <p><input type="file" name="<?= 'imgbgvar2'; ?>" size="40"></p>
    <img src="<?= $config['imgbgvar2'] ?>" height="175" width="175">

    <p><input type="submit" class="btn btn-success" value="Сохранить"/></p>
    <?php echo Chtml::link(
            'Предпросмотр',
            '',
            array(
                'class'=>'btn',
                'id' => 'preview-but'
            )
    ); ?>

    </div>
</form>

<script>
    $(document).ready(function() {
        $('#preview-but').click(function(){
            $.ajax({
                url: '/admin/settings/CreatePreviewConfig',
                type: 'POST',
                dataType: 'json',
                data: {name: name},
            })
        });
    });
</script>

