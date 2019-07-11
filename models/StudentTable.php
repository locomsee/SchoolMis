<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_table".
 *
 * @property int $id
 * @property int $studentid
 * @property string $studentname
 * @property int $studentage
 * @property string $class
 * @property string $date_of_enrollment
 *
 * @property ClassTable $student
 */
class StudentTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['studentid', 'studentage'], 'integer'],
            [['date_of_enrollment'], 'safe'],
            [['studentname', 'class'], 'string', 'max' => 45],
            [['studentid'], 'exist', 'skipOnError' => true, 'targetClass' => ClassTable::className(), 'targetAttribute' => ['studentid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'studentid' => 'Studentid',
            'studentname' => 'Studentname',
            'studentage' => 'Studentage',
            'class' => 'Class',
            'date_of_enrollment' => 'Date Of Enrollment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ClassTable::className(), ['id' => 'studentid']);
    }
}
