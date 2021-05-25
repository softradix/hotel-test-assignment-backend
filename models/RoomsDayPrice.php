<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms_day_price".
 *
 * @property int $id
 * @property int|null $room_id
 * @property string|null $date
 * @property float|null $price
 * @property int|null $availability
 * @property string|null $created_at
 */
class RoomsDayPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms_day_price';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'availability','date','price'], 'required'],
            [['room_id', 'availability'], 'integer'],
            [['date', 'created_at'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room ID',
            'date' => 'Date',
            'price' => 'Price',
            'availability' => 'Availability',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }
}
