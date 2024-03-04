<?php

/** @var \yii\data\ActiveDataProvider $dataProvider */

?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Название</th>
        <th>Артикул</th>
        <th>Автор</th>
        <th>В наличии</th>
        <th>Выдать</th>
    </tr>
    </thead>
    <tbody>
    <?php use yii\helpers\Url;
    use yii\widgets\LinkPager;
    foreach ($dataProvider->getModels() as $book) : ?>
        <tr>
            <td><?= $book->name ?></td>
            <td><?= $book->article ?></td>
            <td><?= $book->author->name ?></td>
            <td><?= $book->in_stock ? 'Да' : 'Нет' ?></td>
            <td>
                <?php if ($book->in_stock) : ?>
                    <a href="<?= Url::to(['book-checkout/index', 'id' => $book->id]) ?>" class="btn btn-sm btn-success">Выдать</a>
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
