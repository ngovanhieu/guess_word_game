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

    //Search user by id, name, email
    public function searchUser($input)
    {
        $query = $this->model->newQuery();

        if ($input['key-word'] != '') {
            $query->where(function($query) use ($input) {
                $query->where('id', 'like', '%' . $input['key-word'] . '%')
                    ->orWhere('name', 'like', '%' . $input['key-word'] . '%')
                    ->orWhere('email', 'like', '%' . $input['key-word'] . '%');
            });
        }

        return $query;
    }
}
