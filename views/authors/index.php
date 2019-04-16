<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Authors;
use yii\helpers\ArrayHelper;
use app\models\Topics;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsSearch */
/* @var $model app\models\Authors */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Authors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date_of_birth',
            [
                'attribute' => 'topics_column',
                'filter'=> Html::activeDropDownList($searchModel, 'topics_column', ArrayHelper::map(Topics::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Topic']),
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
