<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel abdualiym\slider\forms\SlideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'value' => function (\abdualiym\slider\entities\Slide $model) {
                    return $model->translations[1]->file ? Html::img($model->translations[1]->getThumbFileUrl('file', 'admin')) : null;
                },
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 100px'],
            ],
            [
                    'attribute' => 'id',
                'value' => function (\abdualiym\slider\entities\Slide $model) {
                    return $model->translations[1]->name;
                },
                'label' => 'Название',
            ],
            'sort',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
