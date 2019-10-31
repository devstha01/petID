<?php

namespace App\Domain\Api\V1\Services\Subscriber;

use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Repositories\Subscriber\AccountRepository;

/**
 * Class AccountService
 * @package App\Domain\Api\V1\Services\Subscriber
 */
class AccountService
{
    /**
     * @var AccountRepository
     */
    protected $repository;

    /**
     * AccountService constructor.
     *
     * @param AccountRepository $repository
     */
    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $inputs
     * @param int $subscriberId
     * @return User
     */
    public function update(array $inputs, int $subscriberId): User
    {
        $updateData = $this->setUpdateData($inputs);
        return $this->repository->update($updateData, $subscriberId);
    }

    /**
     * @param array $inputs
     *
     * @return array
     */
    protected function setUpdateData(array $inputs): array
    {
        return [
            'first_name' => array_get($inputs, 'first_name'),
            'last_name' => array_get($inputs, 'last_name'),
            'email' => array_get($inputs, 'email'),
            'phone' => array_get($inputs, 'full_phone') ? array_get($inputs, 'full_phone') : array_get($inputs, 'phone'),
        ];
    }

    /**
     * @param array $updateData
     * @param $subscriberId
     * @return User
     */
    public function updatePassword(array $updateData, $subscriberId): User
    {
        $accountData = $this->setPasswordUpdateData($updateData);

        return $this->repository->update($accountData, $subscriberId);
    }

    /**
     * @param array $inputs
     * @return array
     */
    protected function setPasswordUpdateData(array $inputs): array
    {
        return [
            'password' => bcrypt(array_get($inputs, 'password')),
        ];
    }
}
