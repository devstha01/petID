<?php

namespace App\Domain\Api\V1\Services\Front;

use App\Cloudsa9\Repositories\User\UserRepository;

/**
 * Class UserService
 * @package App\Domain\Api\V1\Services\Front
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
     * @param $userId
     * @return mixed
     */
    public function findByUser($userId)
    {
        return $this->repository->findByField('user_id', $userId)->first();
    }
}
