<?php

namespace abdualiym\slider\forms;

use abdualiym\languageClass\Language;
use abdualiym\slider\entities\SlideTranslation;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * @var UploadedFile[]
 */
class SlideTranslationForm extends Model
{
    public $lang_id;
    public $file;
    public $link;
    public $name;
    public $description;

    public function __construct(SlideTranslation $translation = null, $config = [])
    {
        if ($translation) {
            $this->lang_id = $translation->lang_id;
            $this->file = $translation->file;
            $this->link = $translation->link;
            $this->name = $translation->name;
            $this->description = $translation->description;
        }
        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['lang_id'], 'required'],
            ['lang_id', 'integer'],
            [['link', 'name'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['file'], 'image'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'lang_id' => 'Язык',
            'file' => 'Картинка',
            'link' => 'Линк URL',
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $langList = Language::langList(Yii::$app->params['languages'], true);
            foreach ($langList as $id => $lang) {
                if ($id == $this->lang_id) {
                    $this->file = UploadedFile::getInstance($this, 'file[' . $id . ']');
                }
            }
            return true;
        }
        return false;
    }
}