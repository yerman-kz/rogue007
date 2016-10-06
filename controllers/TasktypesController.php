<?php
/**
 * Created by PhpStorm.
 * User: Yerman
 * Date: 06.10.2016
 * Time: 11:58
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Tasktypes;
use app\models\Task;
use yii\data\ActiveDataProvider;

class TasktypesController extends Controller
{
    public function actionIndex()
    {
        $query = Tasktypes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Tasktypes();

        if (Yii::$app->request->isPost) {
            $dft = Yii::$app->request->post('Tasktypes')['dft'];

            if ($dft == 1) {
                $old = Tasktypes::find()
                ->where(['dft' => 1])
                ->one();

                $old->dft = 0;
                $old->save();
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $dft = Yii::$app->request->post('Tasktypes')['dft'];

            if ($dft == 1) {
                $old = Tasktypes::find()
                    ->where(['dft' => 1])
                    ->one();

                $old->dft = 0;
                $old->save();
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->dft == 1) {
            \Yii::$app->getSession()->setFlash('error', 'Тип по умолчанию не может быть удален.');
        } else {
            $dft = Tasktypes::find()
                ->where(['dft' => 1])
                ->one();

            $tasks = Task::find()
                ->where(['type' => $id])
                ->all();

            foreach($tasks as $task) {
                $task->type = $dft->id;
                $task->save();
            }

            $model->delete();
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Tasktypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}