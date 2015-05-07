<section class="header">
    <div class="center">
        <div class="title" onclick="window.location = 'http://partner.alexpavlutskiy.com/'">
            <div>
                Партнерская программа<br>
                <span>Павлуцкого Александра</span>
            </div>
        </div>
        <div class="login">
            <button class="reg" data-toggle="modal" data-target="#regModal">Зарегистрироваться</button>
            <button class="log" data-toggle="modal" data-target="#logModal">Войти</button>
        </div>
    </div>
</section>
<section class="head">
    <div class="center">
        <div class="left">
            <div class="text">
                Приведите ко мне клиента на составление семантического ядра и <b>получите 15%</b> от стоимости его заказа
            </div>
            <div class="arrow"></div>
        </div>
        <div class="right">
            <h4 style="font-size: 24px;">Мгновенная регистрация</h4>
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

            <button type="submit" class="">Зарегистрироваться</button>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</section>
<section class="work">
    <div class="center">
        <h4 class="title">Схема работы</h4>
        <div class="img"></div>
        <div class="caption">
            У вас есть клиент на составление семантического ядра
        </div>
        <div class="caption">
            Вы рекомендуете заказать
            семантическое ядро у меня
        </div>
        <div class="caption" style="margin-right: 0;">
            Я делаю для клиента семантическое ядро, <b>вы получаете % от заказа</b>
        </div>
    </div>
</section>
<section class="partners">
    <div class="center">
        <h4 class="title">С партнеркой работают</h4>
        <div class="part">
            <img src="/img/photo_partner_1.jpg" class="photo">
            <h3>Сергей Кокшаров</h3>
            <div class="text">
                Советую Александра своим коллегам и читателям. Приятно иметь с ним дело
            </div>
        </div>
        <div class="part">
            <img src="/img/photo_partner_2.jpg" class="photo">
            <h3>Дмитрий Шахов</h3>
            <div class="text">
                Постоянно рекомендую Сашу тем, кто обращается ко мне по услуге семантических ядер
            </div>
        </div>
        <div class="part3" style="margin-right: 0;">
            <img src="/img/photo_partner_3.jpg" class="photo">
            <h3>Антон Волик</h3>
            <div class="text">
                Работа с Сашей это только положительные эмоции. К тому же неплохой заработок с процентов
            </div>
        </div>
    </div>
</section>
<section class="faq">
    <div class="center">
        <h4 class="title">Вопросы и ответы</h4>
        <div class="que close">
            <div class="text">
                <h2>Какой процент от заказа я получу?</h2>
                Вы получите 15% от суммы заказа. Средний чек заказа - 200$. 
            </div>
            <div class="arrow"></div>
        </div>
        <div class="que" style="height:80px;">
            <div class="text">
            <h2>В каком виде и когда происходят выплаты?</h2>
            Выплаты происходят в любое удобное для вебмастера время, любая сумма и без холда
            </div>
            <div class="arrow"></div>
        </div>
        <div class="big close">
            <div class="text">
                <h2>Какой трафик принимается?</h2>
                Принимается любой трафик, главное - чтобы он был конверсионным, 
                приводил мне клиентов, а партнерам в итоге - прибыль
            </div>
            <div class="arrow"></div>
        </div>
        <div class="large close">
            <div class="text">
                <h2>Как происходит привязка клиента к партнеру?</h2>
                Вы приводите клиента используя вашу уникальную партнерскую ссылку (переход по ней) или промокод (который клиент укажет при заказе). 
                Именно по ним мы отслеживаем что клиент пришел конкретно от вас
            </div>
            <div class="arrow"></div>
        </div>
        <div class="last close">
            <div class="text">
                <h2>Как происходит процесс начисления?</h2>
                Вы даёте на меня ссылку (или промокод, который клиент должен указать при заказе). 
                Клиент кликает, привязывается к вашему аккаунту в партнерке. Связывается со мной, 
                обсуждаем сумму, сроки, детали. Высылаю клиенту ядро, а вам -в аккаунт зачисляется % от заказа.
                Средний срок сделки - 3 дня
            </div>
            <div class="arrow"></div>
        </div>
    </div>
</section>
<section class="register">
    <div class="center">
        <h4 class="title">Зарегистрируйтесь прямо сейчас!</h4>
        <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>array('user/user/registration'),
                'id'=>'registration-form',
                'enableClientValidation'=>true,
                'enableAjaxValidation' => true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
                <?php echo $form->textField($register,'username', array('placeholder'=>'Введите е-mail', 'style'=>'margin-right: 15px; height: 45px;')); ?>
                <?php echo $form->error($register,'username'); ?>

                <?php echo $form->passwordField($register,'password', array('placeholder'=>'Введите пароль', 'style'=>'margin-right: 20px; height: 45px;')); ?>
                <?php echo $form->error($register,'password'); ?>

            <button type="submit" class="">Зарегистрироваться</button>

            <?php $this->endWidget(); ?>
    </div>
</section>

<section class="footer">
    <div class="center">
        <div>© Партнерская программа Павлуцкого Александра</div>
        <div style="float: right;">Разработано в <a target="_blank" style="color: #889096;" href="http://shvets.net">“Shvets Studio”</a></div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>array('user/user/registration'),
            'id'=>'registration-form',
            'enableClientValidation'=>false,
            'enableAjaxValidation' => true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        <h4 class="modal-title">Регистрация</h4>
        <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <div class="form-group">
                <?php echo $form->textField($register,'username', array('placeholder'=>'Введите е-mail', 'class'=>'form-input')); ?>
                <?php echo $form->error($register,'username'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->passwordField($register,'password', array('placeholder'=>'Введите пароль', 'class'=>'form-input')); ?>
                <?php echo $form->error($register,'password'); ?>
            </div>
            <button type="submit" class="reg-button">Зарегистрироваться</button>

            <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
  <div class="modal-dialog">
    <div class="modal-content">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>array('user/user/login'),
            'id'=>'login-form',
            'enableClientValidation'=>false,
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        <h4 class="modal-title">Вход</h4>
        <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="form-group">
            <?php echo $form->textField($model,'username', array('class'=>'form-input', 'placeholder'=>'Введите e-mail')); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->passwordField($model,'password', array('class'=>'form-input', 'placeholder'=>'Введите пароль')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>

        <button type="submit" class="log-button">Войти</button>
        <?= CHtml::link('Забыли пароль?', array('/user/user/foget'), array('class'=>'text-center log-link')) ?>

        <?php $this->endWidget(); ?>
    </div>
  </div>
</div>