<?php

namespace app\models\user\dao;

use app\models\user\entities\UserEntity;
use app\core\database\dao\AbstractDao;
/**
 * @extends AbstractDao<UserEntity>
 */
class UserDao extends AbstractDao
{
    protected string $table = 'users';
    protected string $entity = UserEntity::class;
}
