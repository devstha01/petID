<?php

namespace App\Domain\Front\Services\User;

use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Repositories\User\UserRepository;

/**
 * Class UserService
 * @package App\Domain\Front\Services\User
 */
class UserService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $inputs
     *
     * @return User
     */
    public function create(array $inputs): User
    {
        $userData = $this->setCreateData($inputs);

        $user = $this->repository->create($userData);

        // Update role
        $user->roles()->sync([2]);

        return $user;
    }

    /**
     * @param array $inputs
     *
     * @return array
     */
    protected function setCreateData(array $inputs): array
    {
        return [
            'first_name' => array_get($inputs, 'first_name'),
            'last_name' => array_get($inputs, 'last_name'),
            'email' => array_get($inputs, 'email'),
            'password' => bcrypt(array_get($inputs, 'password')),
            'phone' => array_get($inputs, 'full_phone') ? array_get($inputs, 'full_phone') : array_get($inputs, 'phone'),
            'phone_code' => substr(uniqid(), 0, 6),
            'account_type' => array_get($inputs, 'account_type'),
        ];
    }

    /**
     * @param $phoneCode
     * @return mixed
     */
    public function findByPhoneCode($phoneCode)
    {
        return $this->repository->findByField('phone_code', $phoneCode)->first();
    }

    /**
     * Delete user
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
