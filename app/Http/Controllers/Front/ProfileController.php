<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('front.users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        if (!$request->file('avatar')) {
            $request->session()->flash('error', 'Please upload the picture.');
            return redirect()->back();
        }

        $path = $request->file('avatar')->store('avatars');

        auth()->user()->update([
            'avatar' => $path,
        ]);

        $request->session()->flash('message', 'Profile Updated Successfully!');
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (! Hash::check($request->current_password, auth()->user()->password)) {
            $request->session()->flash('error', 'Your current password did not matched');
            return redirect()->back();
        }

        auth()->user()->update([
            'password' => bcrypt(request('password')),
        ]);
        $request->session()->flash('message', 'Your password changed successfully!');
        return redirect()->back();
    }
}
