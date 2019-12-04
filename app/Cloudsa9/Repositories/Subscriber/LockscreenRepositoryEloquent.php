<?php

namespace App\Cloudsa9\Repositories\Subscriber;

use App\Cloudsa9\Entities\Models\User\Lockscreen;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class LockscreenRepositoryEloquent.
 *
 * @package namespace App\Cloudsa9\Repositories\Subscriber;
 */
class LockscreenRepositoryEloquent extends BaseRepository implements LockscreenRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lockscreen::class;
    }
}
