<?php

namespace app\models;

use Yii;
use app\models\Helper;
use app\models\Users;


class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $permission;
	public $authKey;
	
	public static $user;

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
		$user_result = Users::find()->where(['=', 'users.id', $id])->one();
		
        $id = 0;
		$username = '';
		$_password = '';
		
		
		if(isset($user_result->id)) {
			$id = $user_result->id;
			$username = $user_result->username;
			$_password = $user_result->password;
			$permission = $user_result->permission;
			
			if($id > 0) {
				self::$user = [
					'id' => $id,
					'username' => $username,
					'password' => $_password,
					'permission' => $permission,
					'authKey' => 'test101key',
				];	
				return new static(self::$user);
			}
		}
        return null;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //foreach (self::$users as $user) {
        $_username = addslashes($username);
		$user_result = Users::find()->where(['=', 'users.username', $username])->one();
		
		$id = 0;
		$username = '';
		$_password = '';
		
		if(isset($user_result->id)) {
			$id = $user_result->id;
			$username = $user_result->username;
			$_password = $user_result->password;
			$permission = $user_result->permission;
			self::$user = [
				'id' => $id,
				'username' => $username,
				'password' => $_password,
				'permission' => $permission,
				'authKey' => 'test101key',
			];
			return new static(self::$user);
			
		}
		
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

	public static function find() {
        return Users::find();
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
