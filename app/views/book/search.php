
<?php

use yii\bootstrap5\Html;

/** @var yii\bootstrap5\ActiveForm $form */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Удаление книги';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="author-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($dataProvider->getModels() as $model) : ?>
                <tr>
                    <td><?= $model->name ?></td>
                    <td><?= $model->article ?></td>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-5 d-flex justify-content-between">
                                <form action="/book/deleted" method="post">
                                    <input type="hidden" name="id" value="<?= $model->id ?>">
                                    <button type="submit" class="btn btn-danger ms-2">Удалить</button>
                                </form>
                            </div>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
        </div>
    </div>

</div>



