<?php

/* @var $this yii\web\View */
/* @var $model domain\modules\slider\forms\SlideForm */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Слайд', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
