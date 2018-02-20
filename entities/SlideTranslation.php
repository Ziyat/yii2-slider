<?php

namespace domain\modules\slider\entities;

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
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
//                'filePath' => '@staticRoot/origin/posts/[[id]].[[extension]]',
                'filePath' => '@frontend/web/app-images/slider/[[attribute_id]]/[[id]].[[extension]]', // app/static
//                'fileUrl' => '@static/origin/posts/[[id]].[[extension]]',
                'fileUrl' => '@frontendUrl/app-images/slider/[[attribute_id]]/[[id]].[[extension]]',// http://static.shop.dev
//                'thumbPath' => '@staticRoot/cache/posts/[[profile]]_[[id]].[[extension]]',
                'thumbPath' => '@frontend/web/app-temp/slider/cache/[[attribute_id]]/[[profile]]_[[id]].[[extension]]',
//                'thumbUrl' => '@static/cache/posts/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@frontendUrl/app-temp/slider/cache/[[attribute_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 220, 'height' => 70],
                    'thumb' => ['width' => 931, 'height' => 299],
//                    'category_list' => ['width' => 1000, 'height' => 150],
//                    'widget_list' => ['width' => 228, 'height' => 228],
//                    'origin' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/images/img/cbg.png'), 'process']],
                ],
            ],
        ];

    }
}
