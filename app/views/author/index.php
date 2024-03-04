<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\bootstrap5\ActiveForm $form */

$this->title = 'Добавление автора';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <p>Заполните поля для добавления нового автора.</p>

            <?php $authorForm = ActiveForm::begin([
                'id' => 'author-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-4 form-control'],
                    'errorOptions' => ['class' => 'col-lg-6 invalid-feedback'],
                ],
            ]); ?>

            <?= $authorForm->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Имя автора']) ?>

            <div class="form-group">
                <div class="col-lg-12">
                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success', 'name' => 'author-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
