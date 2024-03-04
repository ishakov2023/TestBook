<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Библиотека';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <?php if (Yii::$app->user->isGuest): ?>
            <h1 class="display-4">Добро пожаловать!</h1>
        <?php else: ?>
            <div class="body-content">
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <h2>Список книг</h2>
                        <h4>Название книг, состояние, есть в наличие или нет</h4>
                        <p><?= Html::a('Список книг', ['/book/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <h2>Клиенты</h2>
                        <h4>Клиенты с книгами и без, ФИО</h4>
                        <p><?= Html::a('Клиенты', ['client/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
