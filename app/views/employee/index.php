<?php

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\Form\EmployeeForm $model */

$this->title = 'Добавить сотрудника';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="site-employee">
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
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'position') ?>
<?= $form->field($model, 'user_id')->dropDownList(
    yii\helpers\ArrayHelper::map(User::find()->all(), 'id', 'username'),
    ['prompt' => 'Выберите пользователя']
) ?>

    <button type="submit">Добавить</button>

<?php ActiveForm::end(); ?>