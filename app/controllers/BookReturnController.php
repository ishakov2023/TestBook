<?php

namespace app\controllers;

use app\models\Book;
use app\models\BookCheckout;
use app\models\BookCondition;
use app\models\BookReturn;
use app\models\Client;
use app\models\Employee;
use Yii;
use yii\base\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class BookReturnController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'search', 'create', 'update', 'deleted'],
                        'allow' => true,
                        'matchCallback' => function () {
                            if (!Yii::$app->user->isGuest) {
                                return true;
                            } else {
                                return Yii::$app->response->redirect(['site/index']);
                            }
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new BookReturn();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $checkout = BookCheckout::findOne(['book_id' => $model->book_id]);
            $checkout->return_date = $model->date_of_return;
            $checkout->save();
            $checkClient = BookCheckout::findAll(['client_id' => $checkout->client_id, 'return_date' => null]);
            if (empty($checkClient)) {
                $client = Client::findOne(['id' => $checkout->client_id]);
                $client->has_book = false;
                $client->save();
            }
            $book = Book::findOne($model->book_id);
            $book->in_stock = true;
            $book->save();

            Yii::$app->session->setFlash('success', 'Книга успешно возвращена');
            return Yii::$app->response->redirect('\book-return\create');
        }
        $books = ArrayHelper::map(Book::find()
            ->innerJoin('book_checkouts', 'books.id = book_checkouts.book_id')
            ->where(['book_checkouts.return_date' => null])
            ->all(), 'id', 'name');
        $clients = ArrayHelper::map(Client::find()->all(), 'id', 'name');
        $employees = ArrayHelper::map(Employee::find()->all(), 'id', 'name');
        $bookConditions = ArrayHelper::map(BookCondition::find()->all(), 'id', 'condition');;
        return $this->render('create', [
            'books' => $books,
            'employees' => $employees,
            'clients' => $clients,
            'bookConditions' => $bookConditions,
            'model' => $model,
        ]);
    }

}