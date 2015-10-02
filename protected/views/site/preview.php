<?php $config = json_decode(file_get_contents('preview.json')); ?>
<!DOCTYPE html>

<html data-wf-site="55b09812272abb90718af74b" data-wf-page="55b09812272abb90718af74c" data-wf-status="1" class="w-mod-js w-mod-no-touch w-mod-video w-mod-no-ios wf-opensans-n3-active wf-opensans-i3-active wf-opensans-n4-active wf-opensans-i4-active wf-opensans-n6-active wf-opensans-i6-active wf-opensans-n7-active wf-opensans-i7-active wf-opensans-n8-active wf-opensans-i8-active wf-active">
<head>
    <meta charset="utf-8">
    <title>NewPartner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="generator" content="">
    <link rel="stylesheet" type="text/css" href="/css/altland/style.css">
    <script src="/css/altland/webfont.js"></script>
    <link rel="stylesheet" href="/css/altland/css">
    <script>WebFont.load({
            google: {
                families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]
            }
        });
    </script>
    <script type="text/javascript" src="/css/altland/modernizr-2.7.1.js"></script>
    <link rel="apple-touch-icon" href="https://daks2k3a4ib2z.cloudfront.net/img/webclip.png">
</head>

<body>
<div class="modal modal-fade" data-modal="modal1">
    <div class="modal-window">
        <span class="close-modal b-close">&times;</span>
        <div class="modal-content">
            <div class="modal-title title-line">Регистрация</div>
            <div class="auth-form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'action'=>array('user/user/registration'),
                    'id'=>'registration-form',
                    'enableClientValidation'=>true,
                    'enableAjaxValidation' => true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <?php echo $form->textField($register,'username', array('placeholder'=>'Введите е-mail', 'class'=>'')); ?>
                <?php echo $form->error($register,'username'); ?>

                <?php echo $form->passwordField($register,'password', array('placeholder'=>'Введите пароль', 'class'=>'')); ?>
                <?php echo $form->error($register,'password'); ?>

                <button type="submit" class="log-button blue-button">Зарегистрироваться</button>

                <?php $this->endWidget(); ?>
            </div>
            <div class="modal-text">
                <a href="#modal2" class="modal-button-child">Войти</a> если уже есть аккаунт
            </div>
        </div>
    </div>
</div>


<div class="modal modal-fade" data-modal="modal2">
    <div class="modal-window">
        <span class="close-modal b-close">&times;</span>
        <div class="modal-content">
            <div class="modal-title">Вход в партнерку</div>
            <div class="auth-form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'action'=>array('user/user/login'),
                    'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="form-group">
                    <?php echo $form->textField($model,'username', array('class'=>'form-input', 'placeholder'=>'Введите e-mail')); ?>
                    <?php echo $form->error($model,'username'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->passwordField($model,'password', array('class'=>'form-input', 'placeholder'=>'Введите пароль')); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>

                <button type="submit" class="log-button green-button">Войти</button>
                <?= CHtml::link('Забыли пароль?', array('/user/user/forget'), array('class'=>'text-center log-link', 'style'=>'margin-left: 0')) ?>

                <?php $this->endWidget(); ?>
            </div>
            <div class="modal-text" style="margin-top: 9px;">
                Нет аккаунта? - <a href="#modal1" class="modal-button-child">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</div>


<div class="w-section header_section" style="background: url(<?= $config->imgbgvar1; ?>);">
    <div class="w-nav navbar" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1" data-ix="load-down">
        <div class="w-container navigation_grid" style="max-width: 1000px;">
            <a class="w-nav-brand w-hidden-small w-hidden-tiny" href="<?= $config->hrefvar1; ?>">
                <h1 class="logo _2" data-type="changeable_txt" data-var="textvar1"><?= $config->textvar1; ?></h1><h1 class="logo2" data-type="changeable_txt" data-var="textvar2"><?= $config->textvar2; ?></h1>
            </a>
            <div class="w-clearfix navigation_buttons">
                <a class="button enter modal-button" href="#modal2">Вход</a>
                <a class="button reg modal-button" href="#modal1">Зарегистрироваться</a>
            </div>
        </div>
        <div class="w-nav-overlay" data-wf-ignore=""></div>
    </div>
    <div class="w-container header_grid" style="max-width: 1000px;">
        <h1 class="heading_text1" data-type="changeable_txt" data-var="textvar3"
            data-ix="load-down2"><?= $config->textvar3; ?></h1>
        <h1 class="header_text2" data-type="changeable_txt" data-var="textvar4"
            data-ix="load-up"><?= $config->textvar4; ?></h1>
        <div class="w-clearfix form_line" data-ix="load-fog">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>array('user/user/registration'),
                'id'=>'registration-form',
                'enableClientValidation'=>true,
                'enableAjaxValidation' => true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
            <div class="email_form _2">
                <?php echo $form->textField($register,'username', array('placeholder'=>'Введите е-mail', 'class'=>'form_text')); ?>
                <?php echo $form->error($register,'username'); ?>
            </div>
            <div class="email_form pass">
                <?php echo $form->passwordField($register,'password', array('placeholder'=>'Введите пароль', 'class'=>'form_text')); ?>
                <?php echo $form->error($register,'password'); ?>
            </div>
            <div class="w-clearfix form">
                <button type="submit" class="button form_button">Зарегистрироваться</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<div class="w-section work_section" data-type="changeable_colorbg" data-var="colorbgvar1" style="background-color: <?= $config->colorbgvar1; ?>">
    <div class="w-container work_grid" style="max-width: 1000px;">
        <h1 class="blocks_heading_text" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar5"><?= $config->textvar5; ?></h1>
        <div class="blocks_line" data-ix="scroll-up"></div>
        <div class="w-row work_row">
            <div class="w-col w-col-3">
                <img class="work_img" src="<?= $config->imgvar1; ?>" data-ix="right-2">
                <p class="work_paragraph" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar6"><?= $config->textvar6; ?></p>
            </div>
            <div class="w-col w-col-1">
                <img class="work_arrow" src="/css/altland/55b0ccfc272abb90718afcb8_Arrow.svg" width="70" data-ix="right-3">
            </div>
            <div class="w-col w-col-4">
                <img class="work_img" src="<?= $config->imgvar2; ?>" data-ix="right-3">
                <p class="work_paragraph" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar7"><?= $config->textvar7; ?></p>
            </div>
            <div class="w-col w-col-1">
                <img class="work_arrow" src="/css/altland/55b0ccfc272abb90718afcb8_Arrow.svg" width="70" data-ix="right">
            </div>
            <div class="w-col w-col-3">
                <img class="work_img" src="<?= $config->imgvar3; ?>" data-ix="right">
                <p class="work_paragraph" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar8"><?= $config->textvar8; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="w-section calcul_section" data-type="changeable_colorbg" data-var="colorbgvar2" style="background-color: <?= $config->colorbgvar2; ?>">
    <div class="w-container" style="max-width: 1000px;">
        <h1 class="blocks_heading_text" data-ix="fog-scroll-2" data-type="changeable_txt" data-var="textvar9"
            style="opacity: 1; transform: scale(1); transition: opacity 1400ms, transform 1400ms;"><?= $config->textvar9; ?></h1>
        <div class="blocks_line" data-ix="scroll-up-2"></div>
        <div class="w-clearfix quastion_block" data-ix="scroll-right">
            <div style="display:<?= $config->displayvar2; ?>">
                <div class="quastion_line offer headr">
                    <div class="offers_text"><div class="quastion_line_text _1">Оффер</div></div><div class="offers_line _1"></div><div class="offers_text _2"><div class="quastion_line_text _1">Процент с продаж</div></div><div class="offers_line _1"></div><div class="offers_text _2"><div class="quastion_line_text _1">Фиксированная оплата</div></div><div class="offers_line _1"></div><div class="offers_text _2"><div class="quastion_line_text _1">Цена перехода</div></div><div class="offers_line _1"></div><div class="offers_text"><div class="quastion_line_text _1">Действие</div></div></div> <?php foreach ($offers as $offer) { ?><a class="button reg _2 modal-button" href="#modal2">Взять в работу</a>
                    <div class="quastion_line offer"><div class="offers_text"><div class="quastion_line_text _2"><?= $offer->name; ?>&nbsp;</div></div><div class="offers_line"></div><div class="offers_text _4"><div class="quastion_line_text _4"><?= $offer->percent; ?></div></div><div class="offers_line"></div><div class="offers_text _4"><div class="quastion_line_text _4 _3"><?= $offer->fixed_pay; ?></div></div><div class="offers_line"></div><div class="offers_text _4 _3"><div class="quastion_line_text _4 _5"><?= $offer->click_pay; ?></div></div></div><?php } ?>
            </div>
            <div class="w-row calc_row">
                <div class="w-col w-col-7">
                    <div class="calc_block" style="height: 353px;" data-ix="scroll-right">
                        <div class="w-clearfix calc_1">
                            <h1 class="calc_text_1"><?= $config->textvar10; ?></h1>

                            <div class="w-clearfix calc_scale"  style="margin-bottom: 5px;">
                                <div class="calc_line_default">
                                    <input id="clientvalue" type="range" min="1" max="100" step="1" value="<?= $config->valuevar1; ?>"  data-rangeslider>
                                </div>
                                <output id="client-output" class="calc_text_2" style="margin-right: -6px;"><?= $config->valuevar1; ?></output>
                            </div>

                            <div class="calc_cifr">1</div>
                            <div class="calc_cifr _2">100</div>
                        </div>

                        <div class="w-clearfix calc_1">
                            <h1 class="calc_text_1"><?= $config->textvar11; ?></h1>
                            <div class="w-clearfix calc_scale" style="margin-bottom: 5px;">
                                <div class="calc_line_default">
                                    <input id="moneyvalue" type="range" min="30" max="1000" step="1" value="<?= $config->valuevar2; ?>" data-rangeslider>
                                </div>
                                <output id="money-output" class="calc_text_2" style="margin-right: -12px;"><?= $config->valuevar2; ?></output>
                            </div>
                            <div class="calc_cifr">30$</div>
                            <div class="calc_cifr _2">1000$</div>
                        </div>

                        <div class="w-clearfix calc_1">
                            <h1 class="calc_text_1"><?= $config->textvar41; ?></h1>
                            <div class="w-clearfix calc_scale" style="margin-bottom: 5px;">
                                <div class="calc_line_default">
                                    <input id="percentvalue" type="range" min="1"  max="100" step="1" value="<?= $config->valuevar3; ?>" data-rangeslider>
                                </div>
                                <output id="percent-output" class="calc_text_2" style="margin-right: -12px;"><?= $config->valuevar3; ?></output>
                            </div>
                            <div class="calc_cifr">1%</div>
                            <div class="calc_cifr _2">100%</div>
                        </div>
                    </div>
                </div>
                <div class="w-col w-col-5">
                    <div class="calc_block _2" style="height: 353px;" data-ix="scroll-left">
                        <h1 class="calc_text_1 _2" data-type="changeable_txt" data-var="textvar12"><?= $config->textvar12; ?></h1>
                        <div class="calc_pay_oval">
                            <div id="calcresult" class="calc_pay_oval_cift"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="w-section oppo_section" data-type="changeable_colorbg" data-var="colorbgvar3" style="background-color: <?= $config->colorbgvar3; ?>">
    <div class="w-container oppo_grid" style="max-width: 1000px;">
        <h1 class="blocks_heading_text" data-ix="fog-scroll-2" data-type="changeable_txt" data-var="textvar13"
            style="opacity: 1; transform: scale(1); transition: opacity 1400ms, transform 1400ms;"><?= $config->textvar13; ?></h1>
        <div class="blocks_line" data-ix="scroll-up-2"></div>
        <div class="oppo_block1">
            <div class="w-row">
                <div class="w-col w-col-7">
                    <div class="oppo_img_block" data-ix="scroll-right" style="background: url(<?= $config->imgvar4; ?>);"></div>
                </div>
                <div class="w-col w-col-5">
                    <h1 class="oppo_text1" data-ix="scroll-left" data-type="changeable_txt" data-var="textvar14"><?= $config->textvar14; ?></h1>
                    <div class="oppo_text" data-ix="scroll-left">
                        <img class="oppo_check" src="/css/altland/55b22fa884805b0a573b2f43_check.svg" width="22">
                        <div class="oppo_text2" data-type="changeable_txt" data-var="textvar15"><?= $config->textvar15; ?></div>
                    </div>
                    <div class="oppo_text _2" data-ix="scroll-left">
                        <img class="oppo_check" src="/css/altland/55b22fa884805b0a573b2f43_check.svg" width="22">
                        <div class="oppo_text2" data-type="changeable_txt" data-var="textvar16"><?= $config->textvar16; ?></div>
                    </div>
                    <div class="oppo_text _2" data-ix="scroll-left">
                        <img class="oppo_check" src="/css/altland/55b22fa884805b0a573b2f43_check.svg" width="22">
                        <div class="oppo_text2" data-type="changeable_txt" data-var="textvar17"><?= $config->textvar17; ?></div>
                    </div>
                    <div class="oppo_text _2" data-ix="scroll-left">
                        <img class="oppo_check" src="/css/altland/55b22fa884805b0a573b2f43_check.svg" width="22">
                        <div class="oppo_text2" data-type="changeable_txt" data-var="textvar18"><?= $config->textvar18; ?></div>
                    </div>
                    <div class="oppo_text _2" data-ix="scroll-left">
                        <img class="oppo_check" src="/css/altland/55b22fa884805b0a573b2f43_check.svg" width="22">
                        <div class="oppo_text2" data-type="changeable_txt" data-var="textvar19"><?= $config->textvar19; ?></div>
                    </div>
                    <div class="oppo_text _2" data-ix="scroll-left">
                        <img class="oppo_check" src="/css/altland/55b22fa884805b0a573b2f43_check.svg" width="22">
                        <div class="oppo_text2" data-type="changeable_txt" data-var="textvar20"><?= $config->textvar20; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="line"></div>
<div class="w-section work_section _2" data-type="changeable_colorbg" data-var="colorbgvar4" style="display: <?= $config->displayvar1; ?>; background-color: <?= $config->colorbgvar4; ?>">
    <div class="w-container" style="max-width: 1000px;">
        <h1 class="blocks_heading_text" data-ix="fog-scroll-2" style="opacity: 0; transform: scale(0.95);" data-type="changeable_txt" data-var="textvar31"><?= $config->textvar31; ?></h1>
        <div class="blocks_line" data-ix="scroll-up-2" style="opacity: 0; transform: translateX(0px) translateY(20px);"></div><br>

        <div class="w-clearfix quastion_block _2 open-answ" data-ix="scroll-right" style="opacity: 0; transform: translateX(-70px) translateY(0px);">
            <div class="he-quest">
                <div class="quastion_line dark focus-line">
                    <div class="quastion_line_text dark" data-type="changeable_txt" data-var="textvar32"><?= $config->textvar32; ?></div>
                </div>
                <div class="quastion_line _2 dark">
                    <img class="quastion_line_img" src="/css/altland/55d5a6a5b4ce9258656a0823_55b1fa5c84805b0a573b2ae3_Pluis.svg" height="28">
                </div>
            </div>
            <div class="quastion_line _3 _padd">
                <p class="quastion_line_text _2 _3" data-type="changeable_txt" data-var="textvar33"><?= $config->textvar33; ?></p>
            </div>
        </div>
        <div class="w-clearfix quastion_block _2" data-ix="scroll-right" style="opacity: 0; transform: translateX(-70px) translateY(0px);">
            <div class="he-quest">
                <div class="quastion_line focus-line">
                    <div class="quastion_line_text dark close" data-type="changeable_txt" data-var="textvar34"><?= $config->textvar34; ?></div>
                </div>
                <div class="quastion_line _2 focus-quest">
                    <img class="quastion_line_img" src="/css/altland/55b1fa5c84805b0a573b2ae3_Pluis.svg" height="28">
                </div>
            </div>
            <div class="quastion_line _3 _padd">
                <p class="quastion_line_text _2 _3" data-type="changeable_txt" data-var="textvar35"><?= $config->textvar35; ?></p>
            </div>
        </div>
        <div class="w-clearfix quastion_block _2" data-ix="scroll-right" style="opacity: 0; transform: translateX(-70px) translateY(0px);">
            <div class="he-quest">
                <div class="quastion_line focus-line">
                    <div class="quastion_line_text dark close" data-type="changeable_txt" data-var="textvar36"><?= $config->textvar36; ?></div>
                </div>
                <div class="quastion_line _2">
                    <img class="quastion_line_img" src="/css/altland/55b1fa5c84805b0a573b2ae3_Pluis.svg" height="28">
                </div>
            </div>
            <div class="quastion_line _3 _padd">
                <p class="quastion_line_text _2 _3" data-type="changeable_txt" data-var="textvar37"><?= $config->textvar37; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="w-section quastion_section" data-type="changeable_colorbg" data-var="colorbgvar5" style="background-color: <?= $config->colorbgvar5; ?>">
    <div class="w-container work_grid" style="max-width: 1000px;">
        <h1 class="blocks_heading_text" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar21"
            style="opacity: 1; transform: scale(1); transition: opacity 1400ms, transform 1400ms;"><?= $config->textvar21; ?></h1>
        <div class="blocks_line" data-ix="scroll-up" style="opacity: 1; transform: translateX(0px) translateY(0px); transition: opacity 1400ms, transform 1400ms;"></div>
        <div class="w-row work_row">
            <div class="w-col w-col-4">
                <div class="ava" data-ix="right-2" style="background: url(<?= $config->imgvar5; ?>); opacity: 0; transform: translateX(-200px) translateY(0px);"></div>
                <div class="partner_name" data-ix="scroll-up" data-type="changeable_txt" data-var="textvar22"
                     style="opacity: 0; transform: translateX(0px) translateY(20px);"><?= $config->textvar22; ?></div>
                <p class="work_paragraph partner" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar23"
                   style="opacity: 0; transform: scale(0.95);"><?= $config->textvar23; ?></p>
                <a target="_blank" href="<?= $config->hrefvar2; ?>" data-ix="scroll-up"
                   style="opacity: 0; transform: translateX(0px) translateY(20px);" data-type="changeable_txt" data-var="textvar24" id="a1"><?= $config->textvar24; ?></a>
            </div>
            <div class="w-col w-col-4">
                <div class="ava" data-ix="right-3" style="background: url(<?= $config->imgvar6; ?>); opacity: 0; transform: translateX(-200px) translateY(0px);"></div>
                <div class="partner_name" data-ix="scroll-up" data-type="changeable_txt" data-var="textvar25"
                     style="opacity: 0; transform: translateX(0px) translateY(20px);"><?= $config->textvar25; ?></div>
                <p class="work_paragraph partner" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar26" style="opacity: 0; transform: scale(0.95);"><?= $config->textvar26; ?></p>
                <a target="_blank" href="<?= $config->hrefvar3; ?>" data-ix="scroll-up" data-type="changeable_txt" data-var="textvar27"
                   style="opacity: 0; transform: translateX(0px) translateY(20px);"><?= $config->textvar27; ?></a>
            </div>
            <div class="w-col w-col-4">
                <div class="ava" data-ix="right" style="background: url(<?= $config->imgvar7; ?>); opacity: 0; transform: translateX(-160px) translateY(0px);"></div>
                <div class="partner_name" data-ix="scroll-up" data-type="changeable_txt" data-var="textvar28"
                     style="opacity: 0; transform: translateX(0px) translateY(20px);"><?= $config->textvar28; ?></div>
                <p class="work_paragraph partner" data-ix="fog-scroll" data-type="changeable_txt" data-var="textvar29" style="opacity: 0; transform: scale(0.95);"><?= $config->textvar29; ?></p>
                <a target="_blank" href="<?= $config->hrefvar4; ?>" data-ix="scroll-up" data-type="changeable_txt" data-var="textvar30"
                   style="opacity: 0; transform: translateX(0px) translateY(20px);"><?= $config->textvar30; ?></a>
            </div>
        </div>
    </div>
</div>
<div class="w-section footer_section" style="background: url(<?= $config->imgbgvar2; ?>);">
    <div class="w-container header_grid" style="max-width: 1000px;">
        <h1 class="blocks_heading_text _2" data-ix="fog-scroll-2" data-type="changeable_txt" data-var="textvar38" style="opacity: 0; transform: scale(0.95);"><?= $config->textvar38; ?></h1>
        <div class="blocks_line" data-ix="scroll-up-2" style="opacity: 0; transform: translateX(0px) translateY(20px);"></div>
        <h1 class="header_text2" data-ix="scroll-right" data-type="changeable_txt" data-var="textvar39"
            style="opacity: 0; transform: translateX(-70px) translateY(0px);"><?= $config->textvar39; ?></h1>
        <div class="form_line" data-ix="fog-scroll-2" style="opacity: 0; transform: scale(0.95);">
            <div class="w-clearfix form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'action'=>array('user/user/registration'),
                    'id'=>'registration-form',
                    'enableClientValidation'=>true,
                    'enableAjaxValidation' => true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="email_form _2">
                    <?php echo $form->textField($register,'username', array('placeholder'=>'Введите е-mail', 'class'=>'form_text')); ?>
                    <?php echo $form->error($register,'username'); ?>
                </div>
                <div class="email_form pass">
                    <?php echo $form->passwordField($register,'password', array('placeholder'=>'Введите пароль', 'class'=>'form_text')); ?>
                    <?php echo $form->error($register,'password'); ?>
                </div>
                <div class="w-clearfix form">
                    <button type="submit" class="button form_button">Зарегистрироваться</button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="w-container footer_grid" style="max-width: 1000px;">
            <div class="footer_text"><?= $config->textvar40; ?></div>
            <div class="footer_text _2">Работает на платформе <a href="http://getpartner.pro/" style="display: inline;">GetPartner</a></div>
        </div>
    </div>
</div>
<div class="w-embed w-script">
    <script type="text/javascript" src="/css/altland/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bPopup/0.11.0/jquery.bpopup.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.0.2/rangeslider.min.js"></script>
    <script>
        var cont = document.querySelectorAll('.w-container');
        console.log(cont);
        for(var i=0; i<cont.length;i++){
            cont[i].style.maxWidth = '1000px';
        }
    </script>
</div>
<div class="w-embed w-script">
    <script>
        $(function() {

            var $document = $(document);
            var selector = '[data-rangeslider]';
            var $element = $(selector);

            // For ie8 support
            var textContent = ('textContent' in document) ? 'textContent' : 'innerText';

            // Example functionality to demonstrate a value feedback
            function valueOutput(element) {
                var value = element.value;
                var output = element.parentNode.getElementsByTagName('output')[0] || element.parentNode.parentNode.getElementsByTagName('output')[0];
                output[textContent] = value;
            }

            $document.on('input', selector, function(e) {
                valueOutput(e.target);
            });

            // Basic rangeslider initialization
            $element.rangeslider({

                // Deactivate the feature detection
                polyfill: false,

                // Callback function
                onInit: function() {
                    valueOutput(this.$element[0]);
                    $("#client-output").text($("#clientvalue").val())
                    $("#money-output").text($("#moneyvalue").val() + '$')
                    $("#percent-output").text($("#percentvalue").val() + '%')
                    $("#calcresult").text(($("#clientvalue").val() * $("#moneyvalue").val() * ($("#percentvalue").val()/100)).toFixed() + '$')
                },
                onSlide: function(position, value) {
                    $("#client-output").text($("#clientvalue").val())
                    $("#money-output").text($("#moneyvalue").val() + '$')
                    $("#percent-output").text($("#percentvalue").val() + '%')
                    $("#calcresult").text(($("#clientvalue").val() * $("#moneyvalue").val() * ($("#percentvalue").val()/100)).toFixed() + '$');
                }
            });

        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(".modal-button[href=\"#modal1\"]").on("click", function(event) {
                event.preventDefault();
                $("[data-modal=\"modal1\"]").bPopup({
                    fadeSpeed: 200
                });
            });

            $(".modal-button[href=\"#modal2\"]").on("click", function(event) {
                event.preventDefault();
                $("[data-modal=\"modal2\"]").bPopup({
                    fadeSpeed: 200
                });
            });

            $(".modal-button-child[href=\"#modal1\"]").on("click", function(event) {
                event.preventDefault();
                var bp2 = $("[data-modal=\"modal2\"]").bPopup();
                $("[data-modal=\"modal1\"]").bPopup({
                    fadeSpeed: 200,
                    onOpen: function() { bp2.close(); }
                });
            });

            $(".modal-button-child[href=\"#modal2\"]").on("click", function(event) {
                event.preventDefault();
                var bp1 = $("[data-modal=\"modal1\"]").bPopup();

                $("[data-modal=\"modal2\"]").bPopup({
                    fadeSpeed: 200,
                    onOpen: function() { bp1.close(); }
                });
            });

            $(".he-quest").click(function() {
                $(this).parent().toggleClass("open-answ");
                $(this).children(".focus-line").toggleClass("dark");
                $(this).children(".focus-line").children(".quastion_line_text").toggleClass("close");
                $(this).children("._2").toggleClass("dark");

                if ($(this).children(".focus-line").children(".quastion_line_text").hasClass("close")) {
                    $(this).children("._2").children(".quastion_line_img").attr("src", "/css/altland/55b1fa5c84805b0a573b2ae3_Pluis.svg");
                } else {
                    $(this).children("._2").children(".quastion_line_img").attr("src", "/css/altland/55d5a6a5b4ce9258656a0823_55b1fa5c84805b0a573b2ae3_Pluis.svg");
                }
            });

            $("._2").hover(function () {
                $(this).children(".quastion_line_img").attr("src", "/css/altland/55d5a6a5b4ce9258656a0823_55b1fa5c84805b0a573b2ae3_Pluis.svg");

            }, function (){

                if (!$(this).parent().children(".focus-line").children(".quastion_line_text").hasClass("close")) {
                    $(this).children("._2").children(".quastion_line_img").attr("src", "/css/altland/55b1fa5c84805b0a573b2ae3_Pluis.svg");
                } else {
                    $(this).children(".quastion_line_img").attr("src", "/css/altland/55b1fa5c84805b0a573b2ae3_Pluis.svg");
                }
            });
        });
    </script>
</div>

<script type="text/javascript" src="/css/altland/webload.js"></script>
<!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->

</body>
</html>