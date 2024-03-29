<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Event;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->except(1);
        $events = Event::all();

        return view('admin.users.index', compact('users', 'events'));
    }

    public function indexCert()
    {
        return view('admin.users.cert');
    }

    public function certificate($id)
    {
        $event = Event::findOrFail($id);

        header('content-type: image/jpeg');
        $font=realpath('public/cert/arial.ttf');
        $image=imagecreatefromjpeg("public/cert/format.jpg");
        $color=imagecolorallocate($image, 51, 51, 102);
        $date=date('d F, Y');
        imagettftext($image, 18, 0, 880, 188, $color,$font, $date);
        $test = Auth::user()->name;
        $course = $event->name;
        $profname = 'PROFESOR MADYA TS. DR. MOHD SANUSI BIN AZMI';
        $cert_id = rand(1, 1000000).'-UTeM';
        $designation = 'PENGARAH PUSAT SUKAN';
        imagettftext($image, 45, 0, 120, 520, $color,$font, $test);
        imagettftext($image, 40, 0, 120, 640, $color,$font, $course);
        imagettftext($image, 22, 0, 116, 1088, $color,$font, $profname);
        imagettftext($image, 18, 0, 260, 1190, $color,$font, $cert_id);
        imagettftext($image, 17, 0, 116, 1120, $color,$font, $designation);
        imagejpeg($image,"public/cert/$test $course.jpg");

        return redirect()->route('attindex')->with('success', ' Cert has been created. Check at Public folder.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()) {
            $request->session()->flash('success',  $user->name.' has been updated.');
        }
        else {
            $request->session()->flash('error', 'User not updated. There was an error updating the user.');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        if (Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }

        $user->roles()->detach();
        $user->delete();
        $request->session()->flash('error',  'User has been deleted.');

        return redirect()->route('admin.users.index');
    }
}
