<?php

namespace app\controllers;

use app\models\Employee;
use app\models\Form\EmployeeForm;
use app\models\User;
use Yii;
use yii\base\Controller;
use yii\base\InvalidRouteException;
use yii\console\Response;
use yii\filters\AccessControl;

class EmployeeController extends Controller
{
    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'search', 'update', 'deleted'],
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
        $model = new EmployeeForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $employee = new Employee(
                $model->getAttributes(['name', 'position', 'user_id'])
            );
            if ($employee->save()) {
                return Yii::$app->response->redirect(['employee/index']);
            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}