<?php

namespace App\Cloudsa9\Repositories\Subscriber;

use App\Cloudsa9\Entities\Models\User\ContactInfo;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ContactInfoRepositoryEloquent.
 *
 * @package namespace App\Cloudsa9\Repositories\Subscriber;
 */
class ContactInfoRepositoryEloquent extends BaseRepository implements ContactInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactInfo::class;
    }
}
