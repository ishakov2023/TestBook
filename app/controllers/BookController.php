<?php

namespace app\controllers;

use app\models\Book;
use app\models\Form\BookForm;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;


class BookController extends Controller
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

    public function actionIndex(): string
    {
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $params = Yii::$app->request->queryParams;

        if (isset($params['name'])) {
            $query->andWhere(['like', 'name', $params['name']]);
        }

        if (isset($params['in_stock']) && $params['in_stock'] != '') {
            $query->andWhere(['=', 'in_stock', $params['in_stock']]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'params' => $params,
        ]);
    }

    public function actionCreate()
    {
        $model = new BookForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $book = new Book(
                $model->getAttributes(['name', 'article', 'date_of_receipt', 'author_id'])
            );
            if ($book->save()) {
                return Yii::$app->response->redirect(['book/create']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSearch()
    {
        $model = new Book();
        $query = Book::find();

        if ($model->load(Yii::$app->request->post())) {
            $query->where(['like', 'name', $model->name]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$dataProvider->getCount()) {
            Yii::$app->session->setFlash('error', 'Книга не найдена');
            return Yii::$app->response->redirect(['book/create']);
        }

        return $this->render('search', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleted()
    {
        $model = Book::findOne(Yii::$app->request->post('id'));

        if ($model) {
            $model->delete();
        }

        return Yii::$app->response->redirect(['book/create']);
    }

}