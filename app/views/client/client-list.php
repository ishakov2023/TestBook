<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>ФИО</th>
        <th>Серия</th>
        <th>Номер</th>
        <th>Есть книги</th>
        <th>Книги</th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($dataProvider->getModels() as $client) : ?>
        <tr>
            <td><?= $client->name ?></td>
            <td><?= $client->passport_series ?></td>
            <td><?= $client->passport_number ?></td>
            <td><?= $client->has_book ? 'Да' : 'Нет' ?></td>
            <td>
                <?php if ($client) : ?>
                    <a href="<?= Url::toRoute(['book-checkout/books-client', 'id' => $client->id]) ?>"
                       class="btn btn-sm btn-success">Книги</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php try {
    echo LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
} catch (Throwable $e) {
    echo $e->getMessage();
} ?>
