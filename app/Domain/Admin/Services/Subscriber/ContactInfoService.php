<?php

namespace App\Domain\Admin\Services\Subscriber;

use App\Cloudsa9\Entities\Models\User\ContactInfo;
use App\Cloudsa9\Repositories\Subscriber\ContactInfoRepository;

/**
 * Class ContactInfoService
 * @package App\Domain\Admin\Services\Subscriber
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
     * @param array $inputs
     * @return ContactInfo
     */
    public function updateOrCreate(array $inputs): ContactInfo
    {
        $contactInfoData = $this->setUpdateOrCreateData($inputs);

        return $this->repository->updateOrCreate(['user_id' => $contactInfoData['user_id']], $contactInfoData);
    }

    /**
     * @param array $inputs
     * @param int $id
     * @return ContactInfo
     */
    public function update(array $inputs, int $id): ContactInfo
    {
        $contactInfoData = $this->setUpdateData($inputs);

        return $this->repository->update($contactInfoData, $id);
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
     * Delete contact info
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @param array $inputs
     * @return array
     */
    protected function setUpdateOrCreateData(array $inputs): array
    {
        return [
            'id' => isset($inputs['id']) ? $inputs['id'] : null,
            'user_id' => array_get($inputs, 'user_id'),
            'name' => array_get($inputs, 'name'),
            'email' => array_get($inputs, 'email'),
            'phone1' => array_get($inputs, 'contact_full_phone1') ? array_get($inputs, 'contact_full_phone1') : array_get($inputs, 'contact_phone1'),
            'phone2' => array_get($inputs, 'contact_full_phone2') ? array_get($inputs, 'contact_full_phone2') : array_get($inputs, 'contact_phone2'),
            // 'phone3' => array_get($inputs, 'contact_full_phone3') ? array_get($inputs, 'contact_full_phone3') : array_get($inputs, 'contact_phone3'),
            // 'phone4' => array_get($inputs, 'contact_full_phone4') ? array_get($inputs, 'contact_full_phone4') : array_get($inputs, 'contact_phone4'),
//            'address1' => array_get($inputs, 'contact_address1'),
//            'address2' => array_get($inputs, 'contact_address2'),
//            'city' => array_get($inputs, 'contact_city'),
//            'state' => array_get($inputs, 'contact_state'),
//            'zip' => array_get($inputs, 'contact_zip'),
            'reward' => array_get($inputs, 'contact_reward') == '1' ? 1 : 0,
            'message' => array_get($inputs, 'contact_message'),
        ];
    }

    /**
     * @param array $inputs
     * @return array
     */
    protected function setUpdateData(array $inputs): array
    {
        return [
            'name' => array_get($inputs, 'name'),
            'email' => array_get($inputs, 'email'),
            'phone1' => array_get($inputs, 'contact_full_phone1') ? array_get($inputs, 'contact_full_phone1') : array_get($inputs, 'contact_phone1'),
            'phone2' => array_get($inputs, 'contact_full_phone2') ? array_get($inputs, 'contact_full_phone2') : array_get($inputs, 'contact_phone2'),
            // 'phone3' => array_get($inputs, 'contact_full_phone3') ? array_get($inputs, 'contact_full_phone3') : array_get($inputs, 'contact_phone3'),
            // 'phone4' => array_get($inputs, 'contact_full_phone4') ? array_get($inputs, 'contact_full_phone4') : array_get($inputs, 'contact_phone4'),
//            'address1' => array_get($inputs, 'contact_address1'),
//            'address2' => array_get($inputs, 'contact_address2'),
//            'city' => array_get($inputs, 'contact_city'),
//            'state' => array_get($inputs, 'contact_state'),
//            'zip' => array_get($inputs, 'contact_zip'),
            'reward' => array_get($inputs, 'contact_reward') == '1' ? 1 : 0,
            'message' => array_get($inputs, 'contact_message'),
        ];
    }
}
