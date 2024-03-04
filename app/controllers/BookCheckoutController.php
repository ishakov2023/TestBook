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
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class BookCheckoutController extends Controller
{

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'search', 'books-client', 'deleted'], // Укажите конкретное действие
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

    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');

        $book = Book::findOne($id);
        if (!$book) {
            throw new NotFoundHttpException('Книга не найдена');
        }

        $model = new BookCheckout([
            'book_id' => $book->id,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $client = $model->client; // Получить связанного клиента напрямую через отношение
            $client->has_book = true;
            $client->save();
            $checkout = BookCheckout::find()->where(['book_id' => $model->book_id])
                ->andWhere(['IS NOT', 'return_date', null]) // Условие для незавершенных выдач
                ->one();

            if ($checkout) {
                $checkout->date_of_checkout = $model->date_of_checkout;
                $checkout->return_date = null;
                $checkout->save();
            } else {
                $model->save(); // Сохранить новую выдачу, если существующая не найдена
            }

            if ($model->books->in_stock) { // Условие на наличие книги в наличии
                $model->books->in_stock = false;
                $model->books->save();
                Yii::$app->session->setFlash('success', 'Книга успешно выдана');
            } else {
                Yii::$app->session->setFlash('error', 'Книги нет в наличии');
            }

            return Yii::$app->response->redirect(['/book/index']);
        }
        $clients = ArrayHelper::map(Client::find()->all(), 'id', 'name');
        $employees = ArrayHelper::map(Employee::find()->all(), 'id', 'name');;

        return $this->render('index', [
            'model' => $model,
            'book' => $book,
            'clients' => $clients,
            'employees' => $employees,
        ]);
    }

    public function actionBooksClient()
    {

        $clientId = Yii::$app->request->get('id'); // Get client ID from URL
        $client = Client::findOne($clientId);
        $books = [];
        if ($client) {
            $books = BookCheckout::find()
                ->where(['client_id' => $clientId])
                ->joinWith('books')
                ->joinWith('bookReturn')
                ->joinWith('bookReturn.bookCondition')
                ->all();
        }
        return $this->render('books-client', [
            'client' => $client,
            'books' => $books,
        ]);
    }
}
