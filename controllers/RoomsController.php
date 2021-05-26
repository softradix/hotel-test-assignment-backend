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
            $room->attributes = $params;
            $now = date("Y-m-d H:i:s");
            $room->created_at = $now;
            if (!$room->validate()) {
                $errors = $room->errors;
                return array('success' => false, 'errors' => $errors, 'data' => []);
            }
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
            if($model){
                $params['date'] = $model->date;
                $params['room_id'] = $model->room_id;
                $model->attributes=$params;
                if (!$model->validate()) {
                    $errors = $model->errors;
                    return array('success' => false, 'errors' => $errors, 'data' => []);
                }
                if ($model->save()) {
                    return array('success' => true,'message'=> 'Update successfuly.');
                }else{
                    return array('success' => false,'message'=> 'Something went wrong please try again!');
                }
            }else{
                return array('success' => false,'message'=> 'No data found');
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