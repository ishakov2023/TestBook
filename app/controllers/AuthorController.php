<?php

namespace app\controllers;

use app\models\Author;
use app\models\Form\AuthorForm;
use app\models\User;
use Yii;
use yii\base\Controller;
use yii\base\InvalidRouteException;
use yii\filters\AccessControl;

class AuthorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'matchCallback' => function () {
                            if (!Yii::$app->user->isGuest){
                                return true;
                            }else {
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
        $model = new AuthorForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $author = new Author();
            $author->name = $model->name;
            $author->save();
            return Yii::$app->response->redirect(['author/index']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}