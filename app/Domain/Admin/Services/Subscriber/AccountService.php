<?php

namespace App\Domain\Admin\Services\Subscriber;

use App\Cloudsa9\Constants\Config;
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Repositories\User\UserRepository;
use Carbon\Carbon;

/**
 * Class AccountService
 * @package App\Domain\Admin\Services\User
 */
class AccountService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * AccountService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->repository->whereHas('roles', function ($query) {
            $query->where('name', '=', 'subscriber');
        })->paginate(Config::PAGINATE_MEDIUM);
    }

    /**
     * @param array $inputs
     *
     * @return User
     */
    public function create(array $inputs): User
    {
        $subscriberData = $this->setCreateData($inputs);

        $user = $this->repository->create($subscriberData);

        // Update role
        $user->roles()->sync([2]);

        return $user;
    }

    /**
     * @param array $inputs
     * @param int $id
     * @return mixed
     */
    public function update(array $inputs, int $id): User
    {
        $subscriberData = $this->setUpdateData($inputs);

        return $this->repository->update($subscriberData, $id);
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

    /**
     * @param array $inputs
     * @return array
     */
    protected function setCreateData(array $inputs): array
    {
        return [
            'name' => array_get($inputs, 'name'),
            'email' => array_get($inputs, 'email'),
            'email_verified_at' => array_get($inputs, 'email_verified') == 'yes' ? Carbon::now() : null,
            'password' => bcrypt(array_get($inputs, 'password')),
            // 'phone' => array_get($inputs, 'full_phone') ? array_get($inputs, 'full_phone') : array_get($inputs, 'phone'),
            // 'phone_code' => substr(uniqid(), 0, 6),
            'account_type' => 'paid',
            'status' => 'active',
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
            // 'last_name' => array_get($inputs, 'last_name'),
            'email' => array_get($inputs, 'email'),
            'email_verified_at' => array_get($inputs, 'email_verified') == 'yes' ? Carbon::now() : null,
            // 'phone' => array_get($inputs, 'full_phone') ? array_get($inputs, 'full_phone') : array_get($inputs, 'phone'),
            // 'account_type' => array_get($inputs, 'account_type'),
            // 'status' => array_get($inputs, 'status'),
            'account_type' => 'paid',
            'status' => 'active',
        ];
    }
}
