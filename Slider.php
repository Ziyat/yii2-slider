<?php

namespace abdualiym\slider;

use Yii;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * slider module definition class
 */
class Slider extends \yii\base\Module
{
    public $filePath = '@frontend/web/app-images/slider/[[attribute_id]]/[[id]].[[extension]]';
    public $fileUrl = '@frontendUrl/app-images/slider/[[attribute_id]]/[[id]].[[extension]]';
    public $thumbPath = '@frontend/web/app-temp/slider/cache/[[attribute_id]]/[[profile]]_[[id]].[[extension]]';
    public $thumbUrl = '@frontendUrl/app-temp/slider/cache/[[attribute_id]]/[[profile]]_[[id]].[[extension]]';
    public $thumbs = [
        'admin' => ['width' => 220, 'height' => 70],
        'thumb' => ['width' => 931, 'height' => 299],
//                    'category_list' => ['width' => 1000, 'height' => 150],
//                    'widget_list' => ['width' => 228, 'height' => 228],
//                    'origin' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/images/img/cbg.png'), 'process']],
    ];

//
    public function imageLocations()
    {
        return [
            'class' => ImageUploadBehavior::className(),
            'attribute' => 'file',
            'createThumbsOnRequest' => true,
            'filePath' => $this->filePath,
            'fileUrl' => $this->fileUrl,
            'thumbPath' => $this->thumbPath,
            'thumbUrl' => $this->thumbUrl,
            'thumbs' => $this->thumbs,
        ];
    }


    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'abdualiym\slider\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['abdualiym/slider/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@abdualiym/slider/messages',
            'fileMap' => [
                'abdualiym/slider/slider' => 'text.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('abdualiym/slider/' . $category, $message, $params, $language);
    }
}
