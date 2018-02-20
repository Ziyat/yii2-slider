<?php

namespace abdualiym\slider\entities;

use abdualiym\slider\Slider;
use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property integer $lang_id
 * @property string $file
 * @property string $name
 * @property string $link
 * @property string $description
 *
 * @mixin ImageUploadBehavior
 */
class SlideTranslation extends ActiveRecord
{
    public static function create($lang_id, $file, $link, $name, $description): self
    {
        $translation = new static();
        $translation->lang_id = $lang_id;
        $translation->file = $file;
        $translation->link = $link;
        $translation->name = $name;
        $translation->description = $description;
        return $translation;
    }

    public static function blank($lang_id): self
    {
        $translation = new static();
        $translation->lang_id = $lang_id;
        return $translation;
    }

    public function edit($file, $link, $name, $description)
    {
        $this->file = $file;
        $this->link = $link;
        $this->name = $name;
        $this->description = $description;
    }


    ###########################

    public function isForLanguage($id): bool
    {
        return $this->lang_id == $id;
    }


    public static function tableName(): string
    {
        return '{{%slider_slide_translations}}';
    }


    public function behaviors(): array
    {
        return [
            Slider::imageLocations(),
        ];

    }
}
