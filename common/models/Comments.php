<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $issue_id
 * @property string $type
 * @property string $user
 * @property string $comment_date
 * @property string $msg
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $is_deleted
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg'], 'required'],
            [['issue_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['comment_date', 'created_at', 'updated_at'], 'safe'],
            [['type'], 'string', 'max' => 16],
            [['user'], 'string', 'max' => 128],
            [['msg'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'issue_id' => 'Issue ID',
            'type' => 'Type',
            'user' => 'User',
            'comment_date' => 'Comment Date',
            'msg' => 'Message',
            // 'created_at' => 'Created At',
            // 'created_by' => 'Created By',
            // 'updated_at' => 'Updated At',
            // 'updated_by' => 'Updated By',
            // 'is_deleted' => 'Is Deleted',
        ];
    }

    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
}
