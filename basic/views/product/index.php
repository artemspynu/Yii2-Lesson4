<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 5000]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'value' => function (\app\models\Product $model) {
                    return Html::a('Create Product', ['product/view', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'price',
                'value' => function (\app\models\Product $model) {
                    return $model->price . 'RUR';
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => function (\app\models\Product $model) {
                    return 'datetime';
                },
                'format' => 'html',
                'contentOptions' => function (\app\models\Product $model) {
                    return ['class' => 'small'];
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
