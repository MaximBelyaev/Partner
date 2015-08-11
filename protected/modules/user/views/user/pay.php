<?php
/* @var $this StatedsController */
/* @var $model Stateds */
/* @var $form CActiveForm */
$this->setPageTitle("Вывод средств | Партнерская программа Павлуцкого Александра");
?>

<div class="block">
    
    <div class="statistics-head">
        <h5>
            Вывод средств:
        </h5>
    </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'stateds-form',
            'htmlOptions'=>array('class'=>'pay'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
        )); ?>

        <div class="row-fluid">

            <div class="span5">
                <div>
	                <?php echo $form->labelEx($model,'money'); ?>
	                <?php echo $form->textField($model,'money',array('class'=>'form-control','maxlength'=>8)); ?>
	                <?php echo $form->error($model,'money'); ?>
                </div>

		        <div>
		            <?php echo $form->labelEx($model,'pay_type'); ?>

					<?php echo $form->dropDownList(
						$model, 
						'pay_type',
						$settings,
						array('class'=>'dropdown')
					);?>
		            <?php echo $form->error($model,'pay_type'); ?>
		        </div>

                <div>
                	<?php echo $form->labelEx($model,'requisites'); ?>
		            <?php echo $form->textField($model,'requisites',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
		            <?php echo $form->error($model,'requisites'); ?>
                </div>


				<div class="buttons pay-buttons">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Отправить заявку' : 'Save', array('class'=>'btn btn-primary')); ?>
				</div>
            </div>
            <div class="span5">
                <div>
		            <?php echo $form->labelEx($model,'description'); ?>
		            <?php echo $form->textArea($model,'description',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
		            <?php echo $form->error($model,'description'); ?>
                </div>
            </div>
        </div>

        <div class="row-fluid">
        </div>


        <?php $this->endWidget(); ?>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'stateds-grid',
			'htmlOptions' 	=> array('class' => 'green grid-view'),
			'dataProvider'	=> $list,
			'summaryText'   => '',
			'pager' => array(  
				'header'        => '',
				'prevPageLabel' => 'Назад',
				'nextPageLabel' => 'Далее',    
			),
			'columns' => array(
		        array(
		        	'name' 	 => 'date',
		        	'header' => 'Дата',
					'value' => 'date("d.m.y", strtotime($data->date));',
		        ),
		        array(
		            'name' => 'pay_type',
		            'type' => 'raw',
		            'value' => function($data) use ($settings) {
		                return $settings[$data->pay_type];
		            }
		        ),
		        'requisites',
		        'money',
		        'status',
		    ),
		)); ?>



</div>