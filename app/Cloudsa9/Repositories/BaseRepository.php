<?php

namespace App\Cloudsa9\Repositories;

use Illuminate\Support\Collection;

/**
 * Class BaseRepository
 * @package App\Cloudsa9\Repositories
 */
abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    /**
     * @param       $id
     * @param array $columns
     *
     * @return Collection|array|null
     */
    public function findWithoutFail(int $id, array $columns = ['*'])
    {
        try {
            return $this->find($id, $columns);
        } catch (\Exception $e) {
            logger()->debug($e);

            return null;
        }
    }
}
