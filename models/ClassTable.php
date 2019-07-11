<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_table".
 *
 * @property int $id
 * @property string $class
 * @property string $student_name
 *
 * @property StudentTable[] $studentTables
 */
class ClassTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class', 'student_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => 'Class',
            'student_name' => 'Student Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentTables()
    {
        return $this->hasMany(StudentTable::className(), ['studentid' => 'id']);
    }
}
