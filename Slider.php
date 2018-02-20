<?php

namespace abdualiym\slider;

use Yii;

/**
 * slider module definition class
 */
class Slider extends \yii\base\Module
{
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
