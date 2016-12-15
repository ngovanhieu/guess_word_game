<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWordsRequest;
use App\Http\Requests\UpdateWordsRequest;
use App\Repositories\Contracts\WordRepositoryInterface as WordRepository;

class WordsController extends BaseController
{
    public function __construct(WordRepository $wordRepository) 
    {
        parent::__construct($wordRepository);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->only('status', 'key-word');
        $this->viewData['words'] = $this->repository->searchWord($input)->sortable()->paginate();
        //send back filter choice
        $this->viewData['key_word'] = $input['key-word'];
        $this->viewData['status'] = $input['status'];

        return view('admin.words.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.words.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWordsRequest $request)
    {
        $wordData = $request->only('content', 'status');
        $result = $this->repository->create($wordData);

        if (!$result) {
            return back()->withErrors(trans('admin/words/create.create.failed'));
        }

        return redirect()->action('Admin\WordsController@index')
            ->with('status', trans('admin/words/create.create.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->viewData['word'] = $this->repository->find($id);

        return view('admin.words.show', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWordsRequest $request, $id)
    {
        try {
            $dataUpdate = $request->only('status');
            $result = $this->repository->update($dataUpdate, $id);

            if ($result) {
                return redirect()->action('Admin\WordsController@index')
                    ->with('status', trans('admin/words/index.update.success'));
            }
        } catch (Exception $e) {
            Log::error($e);
        }

        return back()->withErrors(trans('admin/words/index.update.failed'));
    }
}
