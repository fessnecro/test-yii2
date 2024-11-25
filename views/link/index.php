<?php

use app\models\Link;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\LinkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Link'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            [
                'attribute' => 'short_link',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a(Url::base('') . '/' . $model->short_link, Url::base('') . '/' . $model->short_link);
                }
            ],
            [
                'attribute' => 'link',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->link, $model->link);
                }
            ],
            'created_at',
            [
                'attribute' => 'visits',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a(count($model->visits), '/visit/' . $model->id);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Link $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
