<?php

namespace App\Cloudsa9\Repositories\Subscriber;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Cloudsa9\Entities\Models\User\User;

/**
 * Class AccountRepositoryEloquent.
 *
 * @package namespace App\Cloudsa9\Repositories\Subscriber;
 */
class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
