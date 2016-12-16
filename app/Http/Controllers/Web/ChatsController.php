<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MessageRepositoryInterface as MessageRepository;
use Auth;

class ChatsController extends BaseController
{
    public function __construct(MessageRepository $messageRepository) 
    {
        $this->repository = $messageRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataResponse['status'] = 500; // status Error
        $dataMessage = $request->only('content', 'room_id');
        $dataMessage['sender_id'] = Auth::user()->id; 
        try {
            $result = $this->repository->create($dataMessage);

            if ($result) {
                $dataResponse['status'] = 200; // status OK
                $dataResponse['content'] = $result->content;
                $dataResponse['sender_id'] = $result->sender_id;
            }
        } catch (Exception $e) {
            Log::error($e);
        }

        return response()->json($dataResponse);
    }
}
