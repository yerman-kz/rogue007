<?php
/**
 * Created by PhpStorm.
 * User: Yerman
 * Date: 06.10.2016
 * Time: 16:19
 */
?>

<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Новая задача
            </div>

            <div class="panel-body">
                <form action="/task/create" method="POST" class="form-horizontal">

                    <!-- Task Name -->
                    <div class="form-group">
                        <div class="row">
                            <label for="task-name" class="col-sm-3 control-label">Задача</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="">
                                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                            </div>
                        </div>

                        <div  class="row" style="margin-top: 10px">
                        <label for="task-name" class="col-sm-3 control-label">Тип</label>

                        <div class="col-sm-6">
                            <select id="type" name="type" class="form-control" style="width: 250px;">
                                <?php
                                foreach($types as $type) {
                                ?>
                                    <option value="<?=$type->id?>" <?= ($type->dft == 1)? 'selected' : ''; ?>>
                                        <?=$type->name?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        </div>
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Создать
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php

        ?>

        <!-- Current Tasks -->

        <div class="panel panel-default">
            <div class="panel-heading">
                <div  class="row" style="margin-top: 10px">
                    <label for="task-name" class="col-sm-1 control-label">Задачи:</label>

                    <div class="col-sm-6" style="margin-top:-7px">
                        <form action="/task/index" method="POST" class="form-horizontal">
                            <select id="type" name="type" class="form-control" style="width: 250px;" onchange="this.form.submit()">
                                <option value="0">
                                    Все
                                </option>
                                <?php
                                echo $selected;
                                foreach($types as $type) {
                                    ?>
                                    <option value="<?=$type->id?>" <?= ($type->id == $selected)? 'selected' : ''; ?>>
                                        <?=$type->name?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        </form>
                    </div>
                </div>

            </div>
            <?php if (count($tasks) > 0) { ?>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                    <th width="70%">Task</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                    <?php foreach ($tasks as $task) { ?>
                    <tr>
                        <td class="table-text" width="70%"><div><?= $task->name ?></div></td>

                        <td>
                            <a href="/task/update/<?=$task->id?>" class="btn btn-danger">
                                Редактировать
                            </a>
                        </td>

                        <!-- Task Delete Button -->
                        <td>
                            <form action="/task/delete/<?=$task->id?>" method="POST">
                                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
        </div>

    </div>
</div>
