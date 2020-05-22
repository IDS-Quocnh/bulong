<?php

namespace App\Bulong\Users\Repositories\Interfaces;

use App\Bulong\Users\User;
use Jsdecena\Baserepo\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function createUser(array $params) : User;
}
