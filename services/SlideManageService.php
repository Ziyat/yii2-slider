<?php

namespace abdualiym\slider\services;


use abdualiym\slider\entities\Slide;
use abdualiym\slider\forms\SlideForm;
use abdualiym\slider\repositories\SlideRepository;
use abdualiym\slider\repositories\SlideTranslationRepository;

class SlideManageService
{
    private $slides;
    private $transaction;

    public function __construct(
        SlideRepository $slides,
        TransactionManager $transaction
    )
    {
        $this->slides = $slides;
        $this->transaction = $transaction;
    }

    /**
     * @param SlideForm $form
     * @return Slide
     */
    public function create(SlideForm $form): Slide
    {
        $slide = Slide::create($form->sort, $form->blank, $form->onelang);

        foreach ($form->translations as $translation) {
            $slide->setTranslation($translation->lang_id, $translation->file, $translation->link, $translation->name, $translation->description);
        }

        $this->slides->save($slide);

        return $slide;
    }

    public function edit($id, SlideForm $form)
    {
        $slide = $this->slides->get($id);

        $slide->edit(
            $form->sort,
            $form->blank,
            $form->onelang
        );

        foreach ($form->translations as $translation) {
            $slide->setTranslation($translation->lang_id, $translation->file, $translation->link, $translation->name, $translation->description);
        }

        $this->slides->save($slide);
    }

    public function activate($id)
    {
        $slide = $this->slides->get($id);
        $slide->activate();
        $this->slides->save($slide);
    }

    public function draft($id)
    {
        $slide = $this->slides->get($id);
        $slide->draft();
        $this->slides->save($slide);
    }

    public function remove($id)
    {
        $slide = $this->slides->get($id);
        $this->slides->remove($slide);
    }
}