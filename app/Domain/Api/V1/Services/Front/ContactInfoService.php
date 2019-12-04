<?php

namespace App\Domain\Api\V1\Services\Front;

use App\Cloudsa9\Repositories\Subscriber\ContactInfoRepository;

/**
 * Class ContactInfoService
 * @package App\Domain\Api\V1\Services\Front
 */
class ContactInfoService
{
    /**
     * @var ContactInfoRepository
     */
    protected $repository;

    /**
     * ContactInfoService constructor.
     *
     * @param ContactInfoRepository $repository
     */
    public function __construct(ContactInfoRepository $repository)
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
