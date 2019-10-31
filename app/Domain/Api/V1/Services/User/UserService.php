<?php

namespace App\Domain\Api\V1\Services\User;

use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Repositories\User\UserRepository;
use Carbon\Carbon;

/**
 * Class UserService
 * @package App\Domain\Api\V1\Services\User
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
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt(array_get($inputs, 'password')),
            'phone' => array_get($inputs, 'phone'),
            'phone_code' => substr(uniqid(), 0, 6),
            'account_type' => array_get($inputs, 'account_type'),
            'provider' => array_get($inputs, 'provider'),
            'provider_id' => array_get($inputs, 'provider_id'),
        ];
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function findByUser($userId)
    {
        return $this->repository->findByField('user_id', $userId)->first();
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
