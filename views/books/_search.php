<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <div class="row">
        <div class="col-md-2">
            <?php
            $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]);
            ?>

            <?= Html::a('Reset filters', ['index'], ['class' => 'btn btn-info']) ?>
        </div>
        <div class="col-md-3 col-md-offset-7 float-right">
            <?php
            ?>

            <div class="pull-right">
                <?= Html::label('Page size: ', 'numberPages', array( 'style' => 'margin-left:10px; margin-top:8px;' ) ) ?>
                <?= Html::dropDownList(
                    'numberPages',
                    ( isset($_GET['numberPages']) ? $_GET['numberPages'] : 10 ),
                    [10 => 10, 20 => 20, 50 => 50, 100 => 100],
                    [
                        'id' => 'numberPages',
                        'style' => 'margin-left:5px; margin-top:8px;',
                        'onchange' => '
                            $("#w0").submit();
                        ',
                    ]
                )
                ?>
            </div>
            <?= Html::submitButton('Show', ['hidden' => true]); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>