<?php

namespace app\models;

use Yii;
use app\models\RoomsDayPrice;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property string|null $room_number
 * @property string|null $created_at
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_number'], 'required'],
            [['created_at'], 'safe'],
            [['room_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_number' => 'Room Number',
            'created_at' => 'Created At',
            'price' => "Price"
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasMany(RoomsDayPrice::className(), ['room_id' => 'id']);
    }
}
