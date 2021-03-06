<?php

namespace App\Domain\Subscriber\Services\User;

use App\Cloudsa9\Entities\Models\User\Lockscreen;
use App\Cloudsa9\Repositories\Subscriber\LockscreenRepository;

/**
 * Class LockscreenService
 * @package App\Domain\Subscriber\Services\User
 */
class LockscreenService
{
    /**
     * @var LockscreenRepository
     */
    private $repository;

    /**
     * LockscreenService constructor.
     * @param LockscreenRepository $repository
     */
    public function __construct(LockscreenRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $inputs
     * @param int $id
     * @return Lockscreen
     */
    public function update(array $inputs, int $id): Lockscreen
    {
        return $this->repository->update($inputs, $id);
    }

    /**
     * @param array $inputs
     * @return Lockscreen
     */
    public function updateOrCreate(array $inputs): Lockscreen
    {
        $contactInfoData = $this->setUpdateData($inputs);

        return $this->repository->updateOrCreate(['user_id' => $contactInfoData['user_id']], $contactInfoData);
    }

    /**
     * @param array $inputs
     *
     * @return array
     */
    protected function setUpdateData(array $inputs): array
    {
        return [
            'id' => isset($inputs['id']) ? $inputs['id'] : null,
            'user_id' => currentUser()->id,
            'device' => array_get($inputs, 'device'),
            'lockscreen_color' => array_get($inputs, 'lockscreen_color'),
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param $subscriberId
     * @return mixed
     */
    public function findBySubscriber($subscriberId)
    {
        return $this->repository->findByField('user_id', $subscriberId)->first();
    }
}
