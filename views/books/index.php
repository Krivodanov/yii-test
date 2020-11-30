<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'authorName',
                'format' => 'raw',
                'filter' =>  Authors::map('id', 'name'),
                'value' => function ($model) {
                    return  Html::a($model->author->name, ['index', 'author_id'=>$model->author_id]);
                }
            ],
            'year',
            'name',
            'rating',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
