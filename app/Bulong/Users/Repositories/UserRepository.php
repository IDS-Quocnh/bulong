<?php

namespace App\Bulong\Users\Repositories;

use App\Bulong\Users\User;
use Jsdecena\Baserepo\BaseRepository;
use Illuminate\Database\QueryException;
use App\Bulong\Users\Exceptions\CreateUserInvalidArgumentException;
use App\Bulong\Users\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }

    /**
     * List all the users
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function listUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * Create the user
     *
     * @param array $params
     * @return User
     * @throws CreateUserInvalidArgumentException
     */
    public function createUser(array $params) : User
    {
        try {
            $data = collect($params)->except('password')->all();

            $user = new User($data);
            if (isset($params['password'])) {
                $user->password = bcrypt($params['password']);
            }

            $user->save();

            return $user;
        } catch (QueryException $e) {
            throw new CreateUserInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }
}
