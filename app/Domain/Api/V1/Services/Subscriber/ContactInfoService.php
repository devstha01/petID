<?php

namespace App\Domain\Api\V1\Services\Subscriber;

use App\Cloudsa9\Entities\Models\User\ContactInfo;
use App\Cloudsa9\Repositories\Subscriber\ContactInfoRepository;

/**
 * Class ContactInfoService
 * @package App\Domain\Subscriber\Services\User
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
     * @param array $createData
     * @return ContactInfo
     */
    public function create(array $createData): ContactInfo
    {
        $contactInfoData = $this->setCreateData($createData);

        return $this->repository->create($contactInfoData);
    }

    /**
     * @param array $updateData
     * @param int $id
     * @return ContactInfo
     */
    public function update(array $updateData, int $id): ContactInfo
    {
        return $this->repository->update($updateData, $id);
    }

    /**
     * @param array $updateData
     * @return ContactInfo
     */
    public function updateOrCreate(array $updateData): ContactInfo
    {
        $contactInfoData = $this->setUpdateData($updateData);

        return $this->repository->updateOrCreate(['user_id' => $contactInfoData['user_id']], $contactInfoData);
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

    /**
     * @param array $inputs
     *
     * @return array
     */
    protected function setCreateData(array $inputs): array
    {
        return [
            'user_id' => array_get($inputs, 'user_id'),
            'name' => array_get($inputs, 'name'),
            'email' => array_get($inputs, 'email'),
            'phone1' => array_get($inputs, 'phone1'),
            'phone2' => array_get($inputs, 'phone2'),
            'phone3' => array_get($inputs, 'phone3'),
            'phone4' => array_get($inputs, 'phone4'),
            'reward' => array_get($inputs, 'reward'),
            'message' => array_get($inputs, 'message'),
        ];
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
            'name' => array_get($inputs, 'name'),
            'email' => array_get($inputs, 'email'),
            'phone1' => array_get($inputs, 'phone1'),
            'phone2' => array_get($inputs, 'phone2'),
            'phone3' => array_get($inputs, 'phone3'),
            'phone4' => array_get($inputs, 'phone4'),
            'reward' => array_get($inputs, 'reward'),
            'message' => array_get($inputs, 'message'),
        ];
    }
}
