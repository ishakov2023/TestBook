<?php

/* @var $books app\models\Book */
/* @var $client app\models\Client */

$this->title = 'Выдача книги';
$this->params['breadcrumbs'][] = ['label' => 'Выдача книг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Книги читателя <?= $client->name ?></h1>

<?php if ($books) : ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Название</th>
        <th>Артикул</th>
        <th>Дата взатия</th>
        <th>Дата возврата</th>
        <th>Состояние</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($books as $book) : ?>
        <tr>
            <td><?= $book->books->name ?></td>
            <td><?= $book->books->article ?></td>
            <td><?= $book->date_of_checkout ?></td>
            <td><?= $book->return_date ?></td>
            <td> <?= $book->bookReturn ? $book->bookReturn->bookCondition->condition: ''  ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>