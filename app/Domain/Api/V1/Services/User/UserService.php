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
            'name' => array_get($inputs, 'name'),
            'email' => array_get($inputs, 'email'),
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt(array_get($inputs, 'password')),
            'phone' => array_get($inputs, 'phone'),
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
    public function findByPetCode($petCode)
    {
        return $this->repository->findByField('pet_code', $petCode)->first();
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
