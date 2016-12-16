<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Message';
    }

    //get all messages on room with room id
    public function getMessagesOnRoom($id)
    {
        return $messages = $this->model->with('user')->where('room_id', $id);
    }
}
