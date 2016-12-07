<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\User';
    }
}
