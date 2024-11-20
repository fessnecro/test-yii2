<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property int $link_id
 * @property int $created_at
 */
class Visit extends \yii\db\ActiveRecord
{

    public int $visits_count = 0;
    public ?string $current_date = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link_id', 'created_at'], 'required'],
            [['link_id', 'created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'link_id' => Yii::t('app', 'Link ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VisitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VisitQuery(get_called_class());
    }
}
