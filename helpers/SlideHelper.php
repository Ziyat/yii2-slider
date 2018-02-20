<?php

namespace abdualiym\slider\helpers;

use abdualiym\slider\entities\Slide;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class SlideHelper
{
    public static function statusList(): array
    {
        return [
            Slide::STATUS_DRAFT => \Yii::t('app', 'Draft'),
            Slide::STATUS_ACTIVE => \Yii::t('app', 'Active'),
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Slide::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Slide::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}