<?php

namespace abdualiym\slider\forms;

use abdualiym\languageClass\Language;
use abdualiym\slider\entities\Slide;
use elisdn\compositeForm\CompositeForm;

/**
 * @property SlideTranslationForm $translations
 */
class SlideForm extends CompositeForm
{
    public $sort;
    public $blank;
    public $onelang;
    private $_slide;

    public function __construct(Slide $slide = null, $config = [])
    {
        if ($slide) {
            $this->sort = $slide->sort;
            $this->blank = $slide->blank;
            $this->onelang = $slide->onelang;
            $this->translations = array_map(function (array $language) use ($slide) {
                return new SlideTranslationForm($slide->getTranslation($language['id']));
            }, Language::langList(\Yii::$app->params['languages']));
            $this->_slide = $slide;
        } else {
            $this->translations = array_map(function () {
                return new SlideTranslationForm();
            }, Language::langList(\Yii::$app->params['languages']));
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['sort', 'blank'], 'required'],
            [['onelang'], 'default', 'value' => false],
            [['sort'], 'integer'],
            [['blank', 'onelang'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'sort' => 'Порядок',
            'blank' => 'Новая окно',
            'status' => 'Статус',
            'onelang' => 'Для всех языков',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата обновления',
            'created_by' => 'Добавил',
            'updated_by' => 'Обновил',
        ];
    }

    public function internalForms()
    {
        return ['translations'];
    }
}