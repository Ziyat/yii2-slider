<?php

/* @var $this yii\web\View */
/* @var $slide domain\modules\slider\entities\Slide */
/* @var $model domain\modules\slider\forms\SlideForm */

$this->title = 'Обновить: ' . $slide->translations[0]['name'];
$this->params['breadcrumbs'][] = ['label' => 'Слайды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $slide->translations[0]['name'], 'url' => ['view', 'id' => $slide->id]];
$this->params['breadcrumbs'][] = 'Слайды';
?>
<div class="text-update">

    <?= $this->render('_form', [
        'model' => $model,
        'slide' => $slide,
    ]) ?>

</div>
