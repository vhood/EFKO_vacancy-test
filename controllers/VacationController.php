<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\controllers\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\ActiveRecord\Vacation;

/**
 * VacationController implements the CRUD actions for Vacation model.
 */
class VacationController extends Controller
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
                    'confirm' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Vacation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Vacation::find()->joinWith(['user']),
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all user vacations.
     * @return mixed
     */
    public function actionUserIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Vacation::find()->where(['user_id' => Yii::$app->user->identity->id]),
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        return $this->render('user-index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Vacation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacation();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();

            return $this->redirect(['user-index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vacation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->id != $model->user_id) throw new NotFoundHttpException();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user-index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vacation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $vacation = $this->findModel($id);
        if (Yii::$app->user->identity->id != $vacation->user_id) throw new NotFoundHttpException();

        $vacation->delete();

        return $this->redirect(['user-index']);
    }

    /**
     * Confirm the vacation.
     * @param integer $id
     * @return void
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConfirm($id)
    {
        if (!Yii::$app->user->identity->is_admin) throw new NotFoundHttpException();

        $model = $this->findModel($id);
        $model->confirmed = 1;
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vacation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
