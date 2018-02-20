<?php

namespace abdualiym\slider\repositories;


use abdualiym\slider\entities\Slide;

class SlideRepository
{
    public function get($id): Slide
    {
        if (!$slide = Slide::findOne($id)) {
            throw new NotFoundException('Слайд не найден.');
        }
        return $slide;
    }


    public function save(Slide $slide)
    {
        if (!$slide->save()) {
            throw new \RuntimeException('Сохранние Слайда не выполнено.');
        }
    }


    public function remove(Slide $slide)
    {
        if (!$slide->delete()) {
            throw new \RuntimeException('Удаление Слайда не выполнено.');
        }
    }
}