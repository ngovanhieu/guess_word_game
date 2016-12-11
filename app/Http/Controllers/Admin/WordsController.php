<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WordsRequest;
use App\Repositories\Contracts\WordRepositoryInterface as WordRepository;

class WordsController extends BaseController
{
    protected $dataSelect = ["id", "content", "created_at", "updated_at"];

    public function __construct(WordRepository $wordRepository) {
        $this->repository = $wordRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->viewData['words'] = $this->repository
            ->paginate($this->dataSelect);

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
    public function store(WordsRequest $request)
    {
        $wordData = $request->only('content');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->viewData['word'] = $this->repository->find($id);

        return view('admin.words.edit', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WordsRequest $request, $id)
    {
        try {
            $dataUpdate = $request->only('content');
            $result = $this->repository->update($dataUpdate, $id);

            if ($result) {
                return redirect()->action('Admin\WordsController@show', ['id' => $id])
                    ->with('status', trans('admin/words/edit.update.success'));
            }
        } catch (Exception $e) {
            Log::error($e);
        }

        return back()->withErrors(trans('admin/words/edit.update.failed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
