<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookCheckout */
/* @var $book app\models\Book */
/* @var $clients app\models\Client[] */
/* @var $employees app\models\Employee[] */

$this->title = 'Выдача книги';
$this->params['breadcrumbs'][] = ['label' => 'Выдача книг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'client_id')->dropDownList($clients, ['prompt' => 'Выберите читателя']) ?>

        <?= $form->field($model, 'employee_id')->dropDownList($employees, ['prompt' => 'Выберите Сотрудника']) ?>

        <?= $form->field($model, 'date_of_checkout')->textInput([
            'type' => 'date',
            'pattern' => 'YYYY-MM-DD',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Выдать', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<p>
    <strong>Книга:</strong> <?= $book->name ?>
</p>
<p>
    <strong>Артикул:</strong> <?= $book->article ?>
</p>