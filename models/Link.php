<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property int $user_id User ID
 * @property string $short_link Short link
 * @property string $link Original link
 * @property int $created_at Created at time
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'short_link', 'link', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['short_link', 'link'], 'string', 'max' => 255],
            [['link'], 'url'],
            [['short_link'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'short_link' => Yii::t('app', 'Short link'),
            'link' => Yii::t('app', 'Original link'),
            'created_at' => Yii::t('app', 'Created at time'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LinkQuery the active query used by this AR class.
     */
    public static function find(): LinkQuery
    {
        return new LinkQuery(get_called_class());
    }

    /**
     * @param $length
     * @return string
     */
    public static function generateShortLink($length = 5): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        for ($i = 0; $i < $length; $i++) {
            $randString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randString;
    }

    /**
     * @return ActiveQuery
     */
    public function getVisits(): ActiveQuery
    {
        return $this->hasMany(Visit::class, ['link_id' => 'id']);
    }
}
