<?php

use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<h1>Список книг</h1>

<form method="get" id="searchForm" action="<?= Url::to(['book/index']) ?>">
    <div class="row">
        <div class="col-md-6">
            <label for="name">Название книги:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($params['name']) ? $params['name'] : '' ?>">
        </div>
        <div class="col-md-6">
            <label for="in_stock">В наличии:</label>
            <select id="in_stock" name="in_stock" class="form-control">
                <option value="">Все</option>
                <option value="true" <?= isset($params['in_stock']) && $params['in_stock'] = true ? 'selected' : '' ?>>Да</option>
                <option value="false" <?= isset($params['in_stock']) && $params['in_stock'] = false ? 'selected' : '' ?>>Нет</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2" >Применить</button>
</form>
<br>
<?= $this->render('book-list', ['dataProvider' => $dataProvider]) ?>
<?php Pjax::begin(); ?>
<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(event) {
            event.preventDefault(); // Предотвращаем стандартную отправку формы

            var $form = $(this);
            var url = $form.attr('action');
            var data = $form.serialize();  // Собираем данные формы

            $.ajax({
                url: url,
                type: 'GET',
                data: data,
                dataType: 'html',
                beforeSend: function() {
                    // Отображаем индикатор загрузки перед отправкой запроса
                    $('.table-striped').hide(); // Скрываем существующую таблицу
                    $('#searchForm').after('<div class="loader-container"><div class="loader"></div></div>');
                },
                success: function(response) {
                    // Обрабатываем успешный ответ
                    $('#searchForm').next('.loader-container').remove(); // Убираем индикатор загрузки
                    var $newTable = $(response).find('.table-striped'); // Извлекаем новую таблицу из ответа
                    $('.table-striped').replaceWith($newTable); // Заменяем старую таблицу новой
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Обрабатываем ошибки
                    console.error('Ошибка Ajax-запроса:', textStatus, errorThrown);
                    alert('Произошла ошибка при выполнении запроса. Повторите попытку позже.');
                }
            });
        });
    });
</script>
<?php Pjax::end(); ?>
