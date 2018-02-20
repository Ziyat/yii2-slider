<?php

namespace abdualiym\slider\entities\queries;

use abdualiym\slider\entities\Slide;
use yii\db\ActiveQuery;

class SlideQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'active' => Slide::STATUS_ACTIVE,
        ]);
    }
}