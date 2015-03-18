<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 08.11.14
 * Time: 21:15
 */
/* @var $data Referrals*/
?>

<div class="date"><?= $data['date']; ?></div>
<div class="referrers_count"><?= $data['followers']; ?></div>
<div class="check_count"><?= $data['zakazu']; ?></div>
<div class="check_users"><?= $data['oplata']; ?></div>
<div class="referrers_site">

    <?php
    if(isset($data['sites'])):
        foreach($data['sites'] as $model) {
            echo $model->site.';&nbsp;';
        }
    endif;
    ?>
</div>
<div class="percent">
    <?php $sum = 0;
        foreach ($data['sum'] as $money):
            $sum += $money->money;
        endforeach;
    echo $sum*0.15;
    ?>
</div>