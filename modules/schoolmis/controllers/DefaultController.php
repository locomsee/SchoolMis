<?php

namespace app\Modules\schoolmis\controllers;

use app\models\ClassTable;
use app\models\StudentTable;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;

/**
 * Default controller for the `schoolmis` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function behaviors()
    {
        return array(

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'formdata' => ['post'],
                ],
            ],
        );
    }



    public function actionIndex()
    {
        return 'hello';
    }


              /*Insert Student Into the database*/
    public function actionInsert($studentid,$studentname,$studentage,$class){
        $response = ['error' => false, 'message' => ''];
        $model=new StudentTable();
        $modelclass=new ClassTable();
        if($studentid){
            /*Begin Transcation*/
            $transaction = \Yii::$app->db->beginTransaction();

            $modelclass->class=$class;
            $modelclass->student_name=$studentname;
            $modelclass->save(false);
               if($modelclass){
                 $model->studentid=$modelclass->id;
                 $model->studentname=$studentname;
                 $model->studentage=$studentage;
                 $model->class=$class;
                 $model->date_of_enrollment=date('Y-m-d H:i:s');
                 $model->save(false);
       }
            /*Commit Transaction*/
           $transaction->commit();
            $response['error'] = false;
            $response['message'] = "Data inserted";
            return $this->asJson($response);

        }


    }

    /*Read student info*/
    public function actionRead($studentid){
        $response = ['error' => false, 'message' => '','Student Name' => '','Student age' => '', 'class' => '', 'Date Of Enrollment' => ''];
        $model=new StudentTable();

        if($studentid){
            $result=$model::find()->where(['studentid'=>$studentid])->asArray()->one();

            if($result){
                $response['error'] = false;
                $response['message'] = "Student Found";
                $response['Student Name'] = $result['studentname'];
                $response['Student Age'] = $result['studentage'];;
                $response['class'] = $result['class'];
                $response['Date Of Enrollment'] = $result['date_of_enrollment'];
            }

            return $this->asJson($response);

        }

    }

    /*List all Students*/
    public function actionListall(){
        $response = ['error' => false, 'message' => '','Students'=>''];
        $model=new StudentTable();


            $result=$model::find()->asArray()->all();

                $response['error'] = false;
                $response['message'] = "List Of Students In the Database ";
                $response['Students']= $result;



            return $this->asJson($response);



    }

    /*Testiing data via post*/
    public function actionFormdata(){

     var_dump( $request = \Yii::$app->request->post()); exit;





            return $request;




    }






}
