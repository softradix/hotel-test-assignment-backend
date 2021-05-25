<?php
   namespace app\controllers;
   use yii\rest\ActiveController;
   use app\models\Rooms;
   use yii\filters\VerbFilter;
   use app\models\RoomsDayPrice;
   use yii\filters\ContentNegotiator;
   use yii\web\Response;

   class RoomsController extends ActiveController {
        public $modelClass = 'app\models\Rooms';
        public function behaviors(){
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'store' => ['post'],
                        'list' => ['get'],
                        'update'=>['post']
                    ]
                ],
                'contentNegotiator' => [
                    'class' => ContentNegotiator::className(),
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON,
                    ],
                ]
            ];
        }
        public function actionStore(){
            $params = \yii::$app->request->post();
            $room = new Rooms();
            $now = date("Y-m-d H:i:s");
            $room->room_number = $params['room_number'];
            $room->created_at = $now;
            if ($room->save()) {
                for ($i=1; $i <= 30; $i++) { 
                    $nowDate = date("Y-m-d H:i:s");
                    $d=strtotime("May ".$i." 2021");
                    $roomsDayPrice = new RoomsDayPrice();
                    $roomsDayPrice->room_id = $room->id;
                    $roomsDayPrice->date = date("Y-m-d", $d);
                    $roomsDayPrice->price = rand(10,100);
                    $roomsDayPrice->availability = rand(0,1);
                    $roomsDayPrice->created_at = $nowDate;
                    $roomsDayPrice->save();
                }
                return array('success' => true);
            }
        }
        /**
        * Updates an existing RoomsDayPrice model.
        * @return json
        */
        public function actionEdit(){
            $params=\yii::$app->request->post();
            $model = RoomsDayPrice::findOne($params['id']);
            $model->attributes=$params;
            if ($model->save()) {
                return array('success' => true,'message'=> 'Update successfuly.');
            }else{
                return array('success' => false,'message'=> 'Something went wrong please try again!');
            }
        }
        public function actionList(){
            $rooms = Rooms::find()->with(['price'])->asArray()->all();
            return [
                'success' => true,
                'data' => $rooms
            ];
        }
   }
?>