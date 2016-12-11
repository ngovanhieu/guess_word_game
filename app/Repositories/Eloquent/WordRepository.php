<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\WordRepository;
use App\Repositories\Contracts\WordRepositoryInterface;

class WordRepository extends BaseRepository implements WordRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Word';
    }
}
