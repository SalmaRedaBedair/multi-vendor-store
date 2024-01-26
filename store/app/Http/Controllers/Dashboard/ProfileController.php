<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries'=>Countries::getNames('ar'),
            'locales'=>Languages::getNames('ar')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male, female'],
            'country' => ['required', 'string', 'size:2']
        ]);
        $user = $request->user(); // same as Auth::user

        $user->profile->fill($request->all())->save();
        // that save will create new profile if not exist, or update it if already exist
        // is equal to all under it

        // $profile = $user->profile;
        // if ($profile->first_name) {
        //     $profile->update($request->all());
        // } else {
        //     $user->profile()->create($request->all());
        //     // is equal to

        //     $request->merge([
        //         'user_id'=>$user->id
        //     ]);
        //     Profile::create($request->all());
        // }

        return redirect()->view('dahsboard.profile.edit')->with('success', 'Profile Updated!');

    }
}
