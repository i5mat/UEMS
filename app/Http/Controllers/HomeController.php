<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $username = Auth::user()->name;

        // START OF EVENT COUNT FOR SPECIFIC USER

        $evecount11 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','12')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount22 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','11')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount33 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','10')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount44 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','9')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount55 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','8')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount66 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','7')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount77 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','6')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount88 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','5')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount99 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','4')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount100 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','3')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount111 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','2')
            ->where('user_id', '=', Auth::id())
            ->get();

        $evecount122 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','1')
            ->where('user_id', '=', Auth::id())
            ->get();

        // END OF EVENT COUNT FOR SPECIFIC USER

        return view('home', compact(  'username','evecount11', 'evecount22', 'evecount33', 'evecount44',
            'evecount55', 'evecount66', 'evecount77', 'evecount88', 'evecount99', 'evecount100', 'evecount111', 'evecount122'));
    }

    public function userDash()
    {
        $usr = DB::table('users')->where('id', '=', Auth::id())->first();

        return view('userdash', compact('usr'));
    }
}
