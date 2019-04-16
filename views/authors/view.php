<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Authors */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="authors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date_of_birth',
            [
                'attribute' => 'topics_column',
                'value' => function($model){
                    $str = '';
                    $con = ', ';
                    $total = count($model->topics);
                    $i = 1;
                    foreach ($model->topics as $topic) {
                        if ($total == $i) {
                            $str .= $topic->name;
                        } else {
                            $str .= $topic->name.$con;
                        }
                        $i++;
                    }
                    return $str;
                }
            ],
        ],
    ]) ?>

</div>
