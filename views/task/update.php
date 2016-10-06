<?php
/**
 * Created by PhpStorm.
 * User: Yerman
 * Date: 06.10.2016
 * Time: 16:19
 */

use yii\helpers\Html;

//$this->title = 'Редактировать: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="update">

    <h1><?= Html::encode($model->name) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types
    ]) ?>

</div>