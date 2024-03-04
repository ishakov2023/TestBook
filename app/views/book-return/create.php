<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\models\BookReturn $model */
/** @var \app\models\Book $books */
/** @var \app\models\Employee $employees */
/** @var \app\models\BookCondition $bookConditions */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Возврат книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-client">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>
            <?= $form->field($model, 'book_id')->dropDownList($books, ['prompt' => 'Выберите книгу']) ?>
            <?= $form->field($model, 'employee_id')->dropDownList($employees, ['prompt' => 'Выберите сотрудника']) ?>
            <?= $form->field($model, 'date_of_return')->textInput([
                'type' => 'date',
                'pattern' => 'YYYY-MM-DD',
            ]) ?>
            <?= $form->field($model, 'book_condition_id')->dropDownList($bookConditions, ['prompt' => 'Выберите состояние']) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>