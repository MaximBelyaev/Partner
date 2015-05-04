<?php
/**
 * @var $this defaultController
 */

$this->breadcrumbs=array(
    'Общая информация',
);
$this->setPageTitle("Главное меню | Партнерская программа Павлуцкого Александра");
?>

<div class="head">
    <h5>Новые клиенты</h5>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $referralModel,
    'columns' => array(
        'date',
        'email',
        array(
            'name' => 'user',
            'type' => 'email',
            'value' => '((isset($data->user->username))?$data->user->username:"");',
        ),
        array(
            'name' => 'status',
            'type' => 'email',
            'value' => '$data->status',
        )
    ))); ?>

<div class="head">
    <h5>Новые партнёры</h5>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $userModel,
    'columns' => array(
        'reg_date',
        'username',
        'requests_count',
        'referrals_payed_count',
    ))); ?>

<div class="head">
    <h5>Последние заявки</h5>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $statedsModel,
    'columns' => array(
        'date',
        array(
            'name' => 'user',
            'type' => 'email',
            'value' => '$data->user->username',
        ),
        'money',
        'status',
    ))); ?>

<div class="head">
    <h5>Лучшие партнёры</h5>
</div>