<?php

use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<h1>Пользователи</h1>

<form method="get" id="searchForm" action="<?= Url::to(['client/index']) ?>">
    <div class="row">
        <div class="col-md-6">
            <label for="name">Пользователь:</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?= isset($params['name']) ? $params['name'] : '' ?>">
        </div>
        <div class="col-md-6">
            <label for="in_stock">Присутсвуют книги:</label>
            <select id="has_book" name="has_book" class="form-control">
                <option value="">Все</option>
                <option value="true" <?= isset($params['has_book']) && $params['nas_book'] = true ? 'selected' : '' ?>>
                    Да
                </option>
                <option value="false" <?= isset($params['has_book']) && $params['has_book'] = false ? 'selected' : '' ?>>
                    Нет
                </option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Применить</button>
</form>
<br>
<?= $this->render('client-list', ['dataProvider' => $dataProvider]) ?>
<?php Pjax::begin(); ?>
<script>
    $(document).ready(function () {
        $('#searchForm').on('submit', function (event) {
            event.preventDefault();

            var $form = $(this);
            var url = $form.attr('action');
            var data = $form.serialize();

            $.ajax({
                url: url,
                type: 'GET',
                data: data,
                dataType: 'html',
                beforeSend: function () {
                    $('.table-striped').hide();
                    $('#searchForm').after('<div class="loader-container"><div class="loader"></div></div>');
                },
                success: function (response) {
                    $('#searchForm').next('.loader-container').remove();
                    var $newTable = $(response).find('.table-striped');
                    $('.table-striped').replaceWith($newTable);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Ошибка Ajax-запроса:', textStatus, errorThrown);
                    alert('Произошла ошибка при выполнении запроса. Повторите попытку позже.');
                }
            });
        });
    });
</script>
<?php Pjax::end(); ?>

