<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Topics;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Books */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'author_id',
                'value' => function($model){
                    return $model->author->name;
                }
            ],
            [
                'attribute' => 'topic_id',
                'headerOptions' => ['style' => 'width:150px'],
                'filter' => Html::activeDropDownList($searchModel, 'topic_id',
                    ArrayHelper::map(Topics::find()->all(), 'id', 'name'),
                    [
                        'prompt' => '',
                        'class' => 'form-control',
                    ]
                ),
                'value' => function($model){
                    return $model->topic->name;
                }
            ],
            'pages',
            [
                'attribute' => 'year',
                'value' => function ($model, $index, $widget) {
                    return $model->year;
                },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'options' => ['width' => '100px'],
                    'attribute' => 'year',

                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]),
            ],
//            'year',
            'price',
            'isbn',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
