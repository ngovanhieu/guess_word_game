<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class UsersController extends BaseController
{
    public function __construct(UserRepository $userRepository) 
    {
        parent::__construct($userRepository);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->viewData['users'] = $this->repository->paginate();

        return view('admin.users.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        $user = $request->only('name', 'email', 'role');
        $user['password'] = config('user.password.default');
        $result = $this->repository->create($user);

        if (!$result) {
            return back()->withErrors(trans('admin/users/create.create.failed'));
        }

        return redirect()->action('Admin\UsersController@index')
            ->with('status', trans('admin/users/create.create.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->viewData['user'] = $this->repository->find($id);

        return view('admin.users.show', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);

        if ($user->isMember()) {
            $this->viewData['user'] = $user;

            return view('admin.users.edit', $this->viewData);
        }

        return redirect()->action('Admin\UsersController@show', ['id' => $id])
            ->withErrors(trans('admin/users/edit.update.permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->repository->find($id);

        try {
            if ($user->isAdmin()) {
                return redirect()->action('Admin\UsersController@show', ['id' => $id])
                    ->withErrors(trans('admin/users/edit.update.permission'));
            }

            $dataUpdate = $request->only('name', 'email', 'role');
            //path to upload avatar image
            $path = config('user.avatar.upload_path') . $user->id . '/';
            if (isset($request['avatar'])) {
                $dataUpdate['avatar'] = uploadImage($request['avatar'], $path, true) ?: $user->avatar;
            }

            $result = $this->repository->update($dataUpdate, $id);

            if ($result) {
                return redirect()->action('Admin\UsersController@edit', ['id' => $id])
                    ->with('status', trans('admin/users/edit.update.success'));
            }
        } catch (Exception $e) {
            Log::error($e);

            return back()->withErrors(trans('admin/users/edit.update.failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository->find($id);
        try {
            if ($user->isMember()) {
                $this->repository->delete($id);

                return redirect()->action('Admin\UsersController@index')
                    ->with('status', trans('admin/users/index.delete.success'));
            }
            
            return redirect()->action('Admin\UsersController@index')
                ->withErrors(trans('admin/users/index.delete.permission'));
        } catch (Exception $e) {
            Log::error($e);

            return redirect()->action('Admin\UsersController@index')
                ->withErrors(trans('admin/users/index.delete.permission'));
        }
    }
}
