<?php

namespace abdualiym\slider\entities;

use abdualiym\languageClass\Language;
use backend\entities\User;
use abdualiym\slider\entities\queries\SlideQuery;
use abdualiym\slider\forms\SlideForm;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "slider_slides".
 *
 * @property integer $id
 * @property integer $sort
 * @property boolean $blank
 * @property boolean $status
 * @property boolean $onelang
 * @property SlideTranslation[] $translations
 */
class Slide extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function create($sort, $blank, $onelang): self
    {
        $slide = new static();
        $slide->sort = $sort;
        $slide->blank = $blank;
        $slide->onelang = $onelang;
        $slide->status = self::STATUS_ACTIVE;
        return $slide;
    }

    public function edit($sort, $blank, $onelang)
    {
        $this->sort = $sort;
        $this->blank = $blank;
        $this->onelang = $onelang;
    }

    // Status

    public function activate()
    {
        if ($this->isActive()) {
            throw new \DomainException('Slide is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft()
    {
        if ($this->isDraft()) {
            throw new \DomainException('Slide is already draft.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }


    // Translations

    public function setTranslation($lang_id, $file, $link, $name, $description)
    {
        $translations = $this->translations;
        foreach ($translations as $tr) {
            if ($tr->isForLanguage($lang_id)) {
                $tr->edit($file, $link, $name, $description);
                $this->translations = $translations;
                return;
            }
        }
        $translations[] = SlideTranslation::create($lang_id, $file, $link, $name, $description);
        $this->translations = $translations;
    }

    public function getTranslation($id): SlideTranslation
    {
        $translations = $this->translations;
        foreach ($translations as $tr) {
            if ($tr->isForLanguage($id)) {
                return $tr;
            }
        }
        return SlideTranslation::blank($id);
    }


    ####################################

    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }


    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }


    public function getTranslations(): ActiveQuery
    {
        return $this->hasMany(SlideTranslation::class, ['slide_id' => 'id']);
    }

    ##########################


    public static function tableName()
    {
        return 'slider_slides';
    }


    public function behaviors(): array
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['translations'],
            ],
        ];
    }


    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    public static function find(): SlideQuery
    {
        return new SlideQuery(static::class);
    }
}
