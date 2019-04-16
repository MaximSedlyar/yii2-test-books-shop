<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \kartik\datecontrol\DateControl;
use app\models\Topics;
use app\models\Authors;
use app\models\Books;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map(Authors::find()->all(), 'id', 'name'), [
        'prompt' => 'Select a topic ...',
        'onchange' => '
            $.post("/web/authors/list?id=" + $(this).val(), function(data) {
                $("select#books-topic_id").html(data);
            });
        ',
    ]);
    ?>

    <?= $form->field($model, 'topic_id')->dropDownList(ArrayHelper::map($listTopics, 'id', 'name'), [
        'prompt' => 'Select a topic ...',
    ]);
    ?>

    <?= $form->field($model, 'pages')->textInput() ?>

    <?= $form->field($model, 'year')->widget(DateControl::className(), []) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
