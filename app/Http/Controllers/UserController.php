<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function edit(Request $request){
        if (Auth::user()){
            $user = User::find(Auth::user()->id);

            if ($user)
            {
                return view('user.edit')->withUser($user);
            } else
            {
                $request->session()->flash('error','Whoops, Something went wrong!');
                return redirect()->route('home');
            }
        }else{
            $request->session()->flash('error','Whoops, this page is only for authenticated users!');
            return redirect()->back();
        }
        
    }

    public function update(Request $request){
        $user = User::find(Auth::user()->id);

        if ($user){
            $validate = null;
            if (Auth::User()->email === $request['email']){
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email'
                ]);
            }else
            { 
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email|unique:users'
                ]);
            }

            if ($validate)
            {
                $user->name = $request['name'];
                $user->email = $request['email'];

                $user->save();

                $request->session()->flash('success','Your details have now been updated!');
                return redirect()->back();
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function passwordEdit(Request $request){
        if (Auth::user()){

            return view('user.password');
        } else{
            $request->session()->flash('error','Whoops,This page is only for authenticated user!');
            return redirect()->back();
        }
    }

    public function passwordUpdate(Request $request){
        $validate = $request->validate([
            'oldPassword' => 'required|min:7',
            'password' => 'required|min:7|required_with:password_confirmation'
        ]);

        $user = User::find(Auth::user()->id);

        if ($user){
            if (Hash::check($request['oldPassword'], $user->password) && $validate){
                $user->password = Hash::make($request['password']);

                $user->save();

                $request->session()->flash('success','password updated!');
                return redirect()->back();
            }else{
                $request->session()->flash('error','Your password did not match your current password!');
                return redirect()->route('password.edit');
            }
        }
    }

    public function profile($id, Request $request){
        $user = User::find($id);

        if ($user){
            return view('user.profile')->withUser($user);
        }else{
            $request->session()->flash('danger','Whoops, this profile does not exist!');
            return redirect()-> back();
        }
    }

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('image')){
            User::uploadAvatar($request->image);
            return redirect()->back()->with('message', 'Image uploaded!'); //successfully uploaded
        } 
        return redirect()->back()->with('error', 'Image not uploaded!'); //false
    }

  


}
