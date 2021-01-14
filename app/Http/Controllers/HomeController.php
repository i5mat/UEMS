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
        $username = Auth::user()->name;

        // THIS IS FOR FACULTY ~
        $queryFaculty1 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '1')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty2 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '2')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty3 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '3')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty4 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '4')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty5 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '5')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty6 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '6')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty7 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '7')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty8 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '8')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty9 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '9')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty10 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '10')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty11 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '11')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();

        $queryFaculty12 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '12')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'FAKULTI')
            ->get();
        // END OF FACULTY ~

        // THIS IS FOR College ~
        $queryCollege1 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '1')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege2 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '2')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege3 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '3')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege4 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '4')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege5 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '5')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege6 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '6')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege7 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '7')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege8 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '8')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege9 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '9')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege10 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '10')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege11 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '11')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();

        $queryCollege12 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '12')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KOLEJ')
            ->get();
        // END OF College ~

        // THIS IS FOR UTEM ~
        $queryUtem1 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '1')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem2 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '2')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem3 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '3')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem4 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '4')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem5 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '5')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem6 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '6')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem7 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '7')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem8 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '8')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem9 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '9')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem10 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '10')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem11 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '11')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();

        $queryUtem12 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '12')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'UTEM')
            ->get();
        // END OF UTEM ~

        // THIS IS FOR NEGERI ~
        $queryNegeri1 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '1')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri2 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '2')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri3 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '3')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri4 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '4')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri5 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '5')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri6 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '6')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri7 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '7')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri8 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '8')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri9 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '9')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri10 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '10')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri11 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '11')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();

        $queryNegeri12 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '12')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'NEGERI')
            ->get();
        // END OF NEGERI ~

        // THIS IS FOR KEBANGSAAN ~
        $queryKebangsaan1 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '1')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan2 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '2')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan3 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '3')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan4 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '4')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan5 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '5')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan6 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '6')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan7 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '7')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan8 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '8')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan9 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '9')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan10 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '10')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan11 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '11')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();

        $queryKebangsaan12 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '12')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'KEBANGSAAN')
            ->get();
        // END OF KEBANGSAAN ~

        // THIS IS FOR ANTARABANGSA ~
        $queryAntarabangsa1 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '1')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa2 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '2')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa3 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '3')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa4 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '4')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa5 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '5')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa6 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '6')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa7 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '7')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa8 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '8')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa9 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '9')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa10 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '10')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa11 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '11')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();

        $queryAntarabangsa12 = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->whereMonth('attendances.check_in', '=', '12')
            ->where('attendances.user_id', '=', Auth::id())
            ->where('event_level.name', '=', 'ANTARABANGSA')
            ->get();
        // END OF ANTARABANGSA ~

        return view('userdash', compact('usr', 'username',
            'queryFaculty1', 'queryFaculty2', 'queryFaculty3', 'queryFaculty4', 'queryFaculty5', 'queryFaculty6',
            'queryFaculty7', 'queryFaculty8', 'queryFaculty9', 'queryFaculty10', 'queryFaculty11', 'queryFaculty12',
            'queryCollege1', 'queryCollege2', 'queryCollege3', 'queryCollege4', 'queryCollege5', 'queryCollege6',
            'queryCollege7', 'queryCollege8', 'queryCollege9', 'queryCollege10', 'queryCollege11', 'queryCollege12',
            'queryUtem1', 'queryUtem2', 'queryUtem3', 'queryUtem4', 'queryUtem5', 'queryUtem6',
            'queryUtem7', 'queryUtem8', 'queryUtem9', 'queryUtem10', 'queryUtem11', 'queryUtem12',
            'queryNegeri1', 'queryNegeri2', 'queryNegeri3', 'queryNegeri4', 'queryNegeri5', 'queryNegeri6',
            'queryNegeri7', 'queryNegeri8', 'queryNegeri9', 'queryNegeri10', 'queryNegeri11', 'queryNegeri12',
            'queryKebangsaan1', 'queryKebangsaan2', 'queryKebangsaan3', 'queryKebangsaan4', 'queryKebangsaan5', 'queryKebangsaan6',
            'queryKebangsaan7', 'queryKebangsaan8', 'queryKebangsaan9', 'queryKebangsaan10', 'queryKebangsaan11', 'queryKebangsaan12',
            'queryAntarabangsa1', 'queryAntarabangsa2', 'queryAntarabangsa3', 'queryAntarabangsa4', 'queryAntarabangsa5', 'queryAntarabangsa6',
            'queryAntarabangsa7', 'queryAntarabangsa8', 'queryAntarabangsa9', 'queryAntarabangsa10', 'queryAntarabangsa11', 'queryAntarabangsa12'));
    }
}
