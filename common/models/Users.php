<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $user
 * @property string $pass
 * @property string $dept
 * @property string $name
 * @property string $mobile
 * @property string $address
 * @property string $email
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property integer $is_deleted
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'pass', 'dept', 'name', 'mobile', 'address', 'email'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['user', 'name'], 'string', 'max' => 32],
            [['email'], 'email'],
            [['mobile'], 'match','pattern'=>'/^[0-9]{10}$/'],
            [['pass', 'dept'], 'string', 'max' => 16],
            [['mobile'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 256],
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
            'pass' => 'Pass',
            'dept' => 'Dept',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'email' => 'Email',
            // 'created_at' => 'Created At',
            // 'created_by' => 'Created By',
            // 'updated_at' => 'Updated At',
            // 'updated_by' => 'Updated By',
            // 'is_deleted' => 'Is Deleted',
        ];
    }
}
