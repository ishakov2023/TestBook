<?php

namespace app\controllers;

use app\models\Client;
use app\models\Form\ClientForm;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class ClientController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
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
        $query = Client::find();
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

        if (isset($params['has_book']) && $params['has_book'] != '') {
            $query->andWhere(['=', 'has_book', $params['has_book']]);
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'params' => $params,
        ]);
    }

    public function actionCreate()
    {
        $model = new ClientForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $client = new Client(
                $model->getAttributes(['name', 'passport_series', 'passport_number'])
            );

            if ($client->save()) {
                return Yii::$app->response->redirect(['client/create']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}