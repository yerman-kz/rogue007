<?php
/**
 * Created by PhpStorm.
 * User: Yerman
 * Date: 06.10.2016
 * Time: 12:18
 */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Типы задач';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if (Yii::$app->session->getFlash('error') !== null) {?>
    <div class="alert alert-info">
        <strong>!</strong> <?= Yii::$app->session->getFlash('error'); ?>
    </div>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'ordering',
            'dft',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>