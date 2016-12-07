<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UpdateProfile;
use App\Http\Requests\UpdatePassword;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use Hash;
use Auth;

class UsersController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->viewData['user'] = $this->userRepository->find($id);

        return view('front-end.profile.show', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = $this->userRepository->find($id);

       if ($user->isCurrent()) {
            $this->viewData['user'] = $user;

            return view('front-end.profile.update', $this->viewData);
        }

        return redirect()->action('Web\UsersController@show', ['id' => $id])
            ->withErrors(trans('front-end/profile/show.labels.edit-permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, $id)
    {
        try {
            $dataUpdate = $request->only('name', 'email');
            $user = $this->userRepository->find($id);
            //path to upload avatar image
            $path = config('user.avatar.upload_path') . $user->id . '/';

            if (!$user->isCurrent()) {
                return redirect()->action('Web\UsersController@edit', ['id' => $id])
                    ->withErrors(trans('front-end/profile/update.labels.update-permission'));
            }

            if (isset($request['image'])) {
                $dataUpdate['avatar'] = uploadImage($request['image'], $path, true) ?: $user->avatar;
            }

            $result = $this->userRepository->update($dataUpdate, $id);

            if (!$result) {
                return back()->withErrors(trans('front-end/profile/update.update.failed'));
            }

            return redirect()->action('Web\UsersController@edit', ['id' => $id])
                ->with('status', trans('front-end/profile/update.update.success'));
        } catch (Exception $e) {
            Log::error($e);

            return back()->withErrors(trans('front-end/profile/update.update.failed'));
        }
    }

    //edit password form
    public function editPassword()
    {
        return view('front-end.profile.update_password');
    }

    //update password
    public function updatePassword(UpdatePassword $request)
    {
        try {
            $currentPassword = $request['current_password'];
            $newPassword = $request->only('password');

            if (!Hash::check($currentPassword, Auth::user()->password)) {
                return redirect()->back()
                    ->withErrors(trans('front-end/profile/update_password.errors.wrong-current-password'));
            }

            $result = $this->userRepository->update($newPassword, Auth::user()->id);

            if (!$result) {
                return back()->withErrors(trans('front-end/profile/update_password.update.failed'));
            }

            return redirect()->action('Web\UsersController@editPassword')
                ->with('status', trans('front-end/profile/update.update.success'));
        } catch (Exception $e) {
            Log::error($e);

            return back()->withErrors(trans('front-end/profile/update_password.update.failed'));
        }
    }
}
