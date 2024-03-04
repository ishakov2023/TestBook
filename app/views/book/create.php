<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\Author;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\bootstrap5\ActiveForm $form */

$this->title = 'Создание книги';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <p>Пожалуйста, заполните поля для создания новой книги.</p>

            <?php $form = ActiveForm::begin([
                'id' => 'book-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-4 form-control'],
                    'errorOptions' => ['class' => 'col-lg-6 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Название книги']) ?>

            <?= $form->field($model, 'article')->textInput(['maxlength' => true, 'placeholder' => 'Артикул']) ?>

            <?= $form->field($model, 'date_of_receipt')->textInput([
                'type' => 'date',
                'pattern' => 'YYYY-MM-DD',
            ]) ?>

            <?= $form->field($model, 'author_id')->dropDownList(
                yii\helpers\ArrayHelper::map(Author::find()->all(), 'id', 'name'),
                ['prompt' => 'Выберите автора']
            ) ?>
            <div class="form-group">
                <div class="col-lg-12">
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'book-button']) ?>
                    <?= Html::a('Авторы', ['/author/index'], ['class' => 'btn btn-info', 'style' => 'margin-left: 10px;']); ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-6">
            <p>Поиск книги для добавления количества</p>
            <p> </p>
            <form action="/book/search" method="post">
                <div class="input-group">
                    <label>
                        <input type="text" name="Book[name]" class="form-control" placeholder="Поиск книг">
                    </label>
                    <button type="submit" class="btn btn-primary">Найти</button>
                </div>
            </form>
        </div>

    </div>

</div>