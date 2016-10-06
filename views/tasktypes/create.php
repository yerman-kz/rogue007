<?php
/**
 * Created by PhpStorm.
 * User: Yerman
 * Date: 06.10.2016
 * Time: 13:33
 */

use yii\helpers\Html;

$this->title = 'Создать тип';
$this->params['breadcrumbs'][] = ['label' => 'Типы задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>