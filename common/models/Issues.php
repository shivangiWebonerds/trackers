<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "issues".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $mobile
 * @property string $raised_by
 * @property string $raised_date
 * @property string $completion_date
 * @property string $status
 * @property string $loclat
 * @property string $loclong
 * @property string $image
 * @property string $dept
 * @property integer $vote
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $is_deleted
 */
class Issues extends \yii\db\ActiveRecord
{

    public $commentsList; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'issues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'mobile', 'raised_by', 'raised_date', 'completion_date', 'status', 'loclat', 'loclong', 'image', 'dept', 'vote'], 'required'],
            [['raised_date', 'completion_date', 'created_at', 'updated_at','image'], 'safe'],
            [['vote', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['title', 'description'], 'string', 'max' => 1024],
            [['status'], 'string', 'max' => 16],
            [['mobile'], 'match','pattern'=>'/^[0-9]{10}$/'],
            [['raised_by'], 'string', 'max' => 128],
            [['loclat', 'loclong'], 'string', 'max' => 32],
            [['image'],'file'],
            [['dept'], 'string', 'max' => 24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'mobile' => 'Mobile',
            'raised_by' => 'Raised By',
            'raised_date' => 'Raised Date',
            'completion_date' => 'Completion Date',
            'status' => 'Status',
            'loclat' => 'latitude',
            'loclong' => 'longitude',
            'image' => 'Image',
            'dept' => 'Department',
            'vote' => 'Vote',
            // 'created_at' => 'Created At',
            // 'created_by' => 'Created By',
            // 'updated_at' => 'Updated At',
            // 'updated_by' => 'Updated By',
            // 'is_deleted' => 'Is Deleted',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['issue_id' => 'id']);
    }
}
