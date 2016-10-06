<?php
/**
 * Created by PhpStorm.
 * User: Yerman
 * Date: 05.10.2016
 * Time: 12:39
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Task;
use app\models\Tasktypes;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $query = Task::find()->all();

        $selected = 0;
        if (Yii::$app->request->isPost) {
            $type = $selected = $_POST["type"];
            if ($type != 0) {
                $query = Task::find()->where(['type' => $type])->all();
            }
        }

        $types = Tasktypes::find()->all();

        return $this->render('index', [
            'tasks' => $query,
            'types' => $types,
            'selected' => $selected
        ]);
    }

    public function actionCreate()
    {
        $name = $_POST["name"];
        $type = $_POST["type"];

        if (Yii::$app->request->isPost) {
            $model = new Task();

            $model->name = $name;
            $model->type = $type;
            $model->insert();

            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $types=ArrayHelper::map(Tasktypes::find()->all(),'id','name');

        if (Yii::$app->request->isPost) {

        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'types' => $types
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}