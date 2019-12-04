<?php

namespace App\Cloudsa9\Repositories\User;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Cloudsa9\Entities\Models\User\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Cloudsa9\Repositories\User;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
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
