<?php 
$this->setPageTitle( $model->header . " | Партнерская программа Павлуцкого Александра"); 
?>

<div class="block news-block full-page-block">
	

    <div class="head">
        <h5>
			<?= $model->header ?>
        </h5>
    </div>

	<address><?= $model->date ?></address>

	<div class="news-text">
		<?= $model->text ?>
	</div>

</div>