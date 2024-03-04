<?php

namespace app\controllers;

use app\models\Form\LoginForm;
use app\models\Form\Registration;
use app\models\User;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::findIdentity(Yii::$app->user->id);
            $user->is_active = true;
            $user->save();
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        $user = User::findIdentity(Yii::$app->user->id);
        $user->is_active = false;
        $user->save();
        Yii::$app->user->logout();
        return $this->goHome();
    }


    /**
     * @return string|Response
     * @throws Exception
     */
    public function actionRegistration()
    {
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }
            $model = new Registration();
            if ($model->load(Yii::$app->request->post()) && $model->validate()){
                $user = new User();
                $user->username = $model->username;
                $user->password = Yii::$app->security->generatePasswordHash($model->password);
                if ($user->save()){
                    return $this->redirect('/site/login');
                }
            }
        return $this->render('registration', ['model' => $model]);
    }
}
