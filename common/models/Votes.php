<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "votes".
 *
 * @property integer $id
 * @property string $user
 * @property integer $issue_id
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $is_deleted
 */
class Votes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'votes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'issue_id'], 'required'],
            [['issue_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'issue_id' => 'Issue ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
