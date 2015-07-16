<?php
$this->breadcrumbs=array(
    'Порядок сортировки',
);
$this->setPageTitle("Порядок сортировки | Партнерская программа Павлуцкого Александра");
?>

<div class="block">

<div class="head">
    <h5>Порядок сортировки</h5>
</div>

<!-- Flash message -->
<?php $this->beginWidget('FlashWidget',array(
    'params'=>array(
        'model' => $model,
    )));
$this->endWidget(); ?>
<!-- End Flash message -->

<div class="form">

<?php echo CHtml::beginForm('', 'post', array(
    'class' => 'row-fluid setting-form'
)); ?>
<div class='row-fluid'>

<div class="settings-col">

    <h4 class="form-block-header">
        Выберите порядок, в котором выводятся лендинги у партнёров
    </h4>

    <?php for ($i = 0; $i<sizeof($model); $i++) { ?>
    <div class="col form-row">
        <label class="header-row">
            <?php echo $model[$i]['name']; ?>
        </label>
        <?php echo CHtml::activetextField(
            $model[$i],
            "[" . $i . "]sort_order"
        ) ?>
    </div>
    <?php } ?>
</div>

<div class="row-fluid">
    <div class="span8">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
    </div>
</div>


<?php echo CHtml::endForm(); ?>

</div>

</div>