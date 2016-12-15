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

    public function searchWord($input)
    {
        $query = $this->model->newQuery();

        if ($input['key-word'] != '') {
            $query->where(function($query) use ($input) {
                $query->where('content', 'like', '%' . $input['key-word'] . '%')
                    ->orWhere('id', 'like', '%' . $input['key-word'] . '%');
            });
        }

        if ($input['status'] != '') {
            $query->where('status', $input['status']);
        }

        return $query;
    }
}
