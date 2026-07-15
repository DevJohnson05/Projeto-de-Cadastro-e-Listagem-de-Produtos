<?php

namespace app\models\user;

use app\models\user\dao\UserDao;

class UserModel
{
    protected UserDao $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDao;
    }

    public function create_user(array $datas)
    {
        return $this->userDAO->insert($datas);
    }

    public function register_login(array $data)
    {
        $user = $this->userDAO->FindBy('email', $data['email']);
        if (!$user) {
            return false;
        }

        if (!password_verify($data['password'] ?? '', $user->password ?? '')) {
            return false;
        }

        return $user;
    }
}
