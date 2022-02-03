<?php

namespace App\Http\Controllers\Frontend\User;

use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;


/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @param  UpdateProfileRequest  $request
     * @param  UserService  $userService
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request, UserService $userService)
    {
        $user = \Auth::user();

        $validated = $request->validated();        

        if(isset($request->avatar_location)){
            $request->avatar_location = $request->file('avatar_location');
            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar_location->getClientOriginalExtension();
            $path = $request->avatar_location->storeAs('avatars',$avatarName);            
            $validated['avatar_location'] = $path;  
        }                
        
        $userService->updateProfile($request->user(),  $validated);        

        if (session()->has('resent')) {
            return redirect()->route('frontend.auth.verification.notice')->withFlashInfo(__('You must confirm your new e-mail address before you can go any further.'));
        }

        return redirect()->route('frontend.user.account', ['#information'])->withFlashSuccess(__('Profile successfully updated.'));
    }
}
