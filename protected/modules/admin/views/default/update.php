<?php
/* @var $this UploadController */
/* @var $model Upload */
/* @var $form CActiveForm */
?>
<?php echo CHtml::form();

echo CHtml::label('Текст', 'input');
echo CHtml::textArea('input', $input);

echo CHtml::label('Результат', 'output');
// name и id для textarea автоматически заданы как 'output'.
echo CHtml::textArea('output', $output);

// Второй параметр пуст, значит отсылаем данные на тот же URL. Третий параметр задаёт опции запроса. Подробнее с ними можно ознакомиться в документации jQuery.
echo CHtml::ajaxSubmitButton('Обработать', '', array(
        'type' => 'POST',
        // Результат запроса записываем в элемент, найденный по CSS-селектору #output.
        'update' => '#output',
    ),
    array(
        // Меняем тип элемента на submit, чтобы у пользователей с отключенным JavaScript всё было хорошо.
        'type' => 'submit'
    ));

echo CHtml::endForm();?>