<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//use shop\helpers\SliderHelper;

/* @var $this yii\web\View */
/* @var $slide abdualiym\slider\entities\Slide */

$this->title = $slide->translations[0]['name'] ?: 'Slider';
$this->params['breadcrumbs'][] = ['label' => 'Слайды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$langList = \abdualiym\languageClass\Language::langList(Yii::$app->params['languages'], true);
?>
<div class="slide-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $slide->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $slide->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => 'Вы хотите удалить?',
                'method' => 'post',
            ]
        ]) ?>
        <?php if ($slide->isActive()): ?>
            <?= Html::a(Yii::t('app', 'Draft'), ['draft', 'id' => $slide->id], ['class' => 'btn btn-default pull-right', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a(Yii::t('app', 'Activate'), ['activate', 'id' => $slide->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
    </p>

    <br>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Позиция слайда</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $slide,
                        'attributes' => [
                            'sort',
                            [
                                'attribute' => 'blank',
                                'format' => 'boolean',
                                'label' => 'Новое окно',
                            ],
                            [
                                'attribute' => 'status',
                                'value' => \abdualiym\slider\helpers\SlideHelper::statusLabel($slide->status),
                                'format' => 'raw',
                            ],
//                            [
//                                'attribute' => 'onelang',
//                                'value' => function ($data) {
//                                    return $data->onelang == 0 ? 'no' : 'yes';
//                                }
//                            ],
                            'id',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Позиция слайда</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $slide,
                        'attributes' => [
//                            'id',
                            [
                                'attribute' => 'createdBy.username',
                                'label' => Yii::t('app', 'Created by')
                            ],
                            [
                                'attribute' => 'updatedBy.username',
                                'label' => Yii::t('app', 'Updated by')
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => 'datetime',
                                'label' => Yii::t('app', 'Created At')
                            ],
                            [
                                'attribute' => 'updated_at',
                                'format' => 'datetime',
                                'label' => Yii::t('app', 'Updated At')
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-default">

        <div class="box-header with-border">Контент</div>

        <div class="box-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php
                $j = 0;
                foreach ($slide->translations as $i => $translation) {
                    if (isset($langList[$translation->lang_id])) {
                        $j++;
                        ?>
                        <li role="presentation" <?= $j === 1 ? 'class="active"' : '' ?>>
                            <a href="#<?= $langList[$translation->lang_id]['prefix'] ?>"
                               aria-controls="<?= $langList[$translation->lang_id]['prefix'] ?>"
                               role="tab" data-toggle="tab">
                                <?= '(' . $langList[$translation->lang_id]['prefix'] . ') ' . $langList[$translation->lang_id]['title'] ?>
                            </a>
                        </li>
                    <?php }
                }
                ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <br>
                <?php
                $j = 0;
                foreach ($slide->translations as $i => $translation) {
                    if (isset($langList[$translation->lang_id])) {
                        $j++;
                        ?>
                        <div role="tabpanel" class="tab-pane <?= $j == 1 ? 'active' : '' ?>"
                             id="<?= $langList[$translation->lang_id]['prefix'] ?>">
                            <div class="box">
                                <div class="box-header with-border"><?= Yii::t('app', 'Photo') ?></div>
                                <div class="box-body">
                                    <?php if ($translation->file): ?>
                                        <?= Html::a(
                                            Html::img($translation->getThumbFileUrl('file', 'thumb')),
                                            $translation->getUploadedFileUrl('file'),
                                            [
                                                'class' => 'thumbnail',
                                                'target' => '_blank'
                                            ]
                                        ) ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?= DetailView::widget([
                                'model' => $translation,
                                'attributes' => [
                                    'name',
                                    'link:url',
                                    'description:html',
                                ],
                            ]) ?>

                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>

</div>
