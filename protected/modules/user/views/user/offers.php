<?php

$this->breadcrumbs=array( 'Партнёры' );
$this->setPageTitle("Список лендингов");
?>

<div class='block'>

    <div class="head">
        <h5>
            Список лендингов
        </h5>
    </div>

    <table>
        <tr>
            <th>Название</th>
            <th>VIP</th>
            <th>Расширенный</th>
            <th>Стандартный</th>
            <th>Цена за переход</th>
            <th>Включить/отключить</th>
        </tr>
        <?php foreach ($offersList as $landing) { ?>
        <tr><td><?= $landing->name ?></td>
        <td><?= $landing->vip ?></td>
        <td><?= $landing->extended ?></td>
        <td><?= $landing->standard ?></td>
        <td><?= $landing->click_pay ? $landing->click_pay : $this->settingsList['click_pay']['value'] ?></td>
            <?php foreach ($usersLandings as $key=>$value)
            if ($key == $landing->land_id and $value == Yii::app()->user->id) {?>
        <td><?=CHtml::link('Отключить', array('/user/user/offOffer/id/' . $landing->land_id), array('class'=>'btn btn-primary'));?></td>
            <?php } ?>
            <?php if (!count($usersLandings) or !array_key_exists($landing->land_id, $usersLandings)) { ?>
        <td><?=CHtml::link('Включить', array('/user/user/onOffer/id/' . $landing->land_id), array('class'=>'btn btn-primary'));?></td>
            <?php }?>
        </tr>
        <?php } ?>
    </table>
</div>