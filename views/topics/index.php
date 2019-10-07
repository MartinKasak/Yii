<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Topics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= (Yii::$app->user->identity->permission == 2) ? Html::a('Create Topics', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function ($model, $key, $index, $grid) {
                return ['data-id' => $model->id];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name' => [
				'attribute' => 'name',
				'value' => function($model) { return $model->name; },
			],
            'owner_id' => [
				'attribute' => 'owner_id',
				'label'=> 'Created by',
				'value' => function($model) { return $model->getOwnerName(); },
			],
            'creation_time' => [
				'attribute' => 'creation_time',
				'label'=> 'Created at',
				'format' => ['date', 'php:Y-m-d'],
				'value' => function($model) { return $model->creation_time; },
			],

            [
                'class' => 'yii\grid\ActionColumn', 
                'visible' => (Yii::$app->user->identity->permission == 2)
			],
        ],
    ]); ?>
	
    <?php
	$this->registerJs("
		$('tbody td').css('cursor', 'pointer');
		$('tbody td').click(function (e) {
			var id = $(this).closest('tr').data('id');
			if (e.target == this)
				location.href = '" . Url::to(['posts/list']) . "?id=' + id;
		});
	"); ?>


</div>
