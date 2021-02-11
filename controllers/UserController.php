<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Forms\EditUser;
use app\controllers\Controller;
use app\models\Forms\CreateUser;
use yii\data\ActiveDataProvider;
use app\models\ActiveRecord\User;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->identity->is_admin) throw new NotFoundHttpException();

        $model = new CreateUser();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->email = $model->email;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->full_name = $model->full_name;
            $user->is_admin = $model->is_admin;
            $user->save();

            Yii::$app->session->setFlash('success', 'Добавлен новый пользователь');

            return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->identity->is_admin && Yii::$app->user->identity->id != $id) throw new NotFoundHttpException();

        $model = new EditUser();
        $user = User::findOne($id);
        if (!$user) throw new NotFoundHttpException();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user->email != $model->email) $user->email = $model->email;
            if ($user->full_name != $model->full_name) $user->full_name = $model->full_name;
            if ($user->is_admin != $model->is_admin) $user->is_admin = $model->is_admin;
            if ($model->password != '') $user->password = Yii::$app->security->generatePasswordHash($model->password);

            $user->save();
            Yii::$app->session->setFlash('success', 'Данные обновлены');

            return $this->redirect(['view', 'id' => $id]);
        } else {
            $model->id = $user->id;
            $model->email = $user->email;
            $model->full_name = $user->full_name;
            $model->is_admin = $user->is_admin;
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->identity->is_admin) throw new NotFoundHttpException();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
