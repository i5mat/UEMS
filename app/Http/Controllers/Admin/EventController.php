<?php

namespace App\Http\Controllers\Admin;

use App\Appoint;
use App\Attendance;
use App\EventType;
use App\Role;
use App\RoleUser;
use App\Transaction;
use DateTime;
use App\Event;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Sodium\add;
use function Sodium\increment;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $users = User::all()->except(1);
        $roles = DB::table('roles')->get()->except(0, 1, 2);
        $eve = DB::table('events')->get();

        $eventList = DB::table('event_type')->get();
        $eventLevel = DB::table('event_level')->get();
        $aList = DB::table('events')
            ->join('event_type', 'event_type.id', '=', 'events.event_type_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->select('event_type.name AS event_type', 'event_level.name AS event_level', 'events.name',
                'events.description', 'events.venue', 'events.capacity', 'events.event_type_id', 'events.event_level_id',
                'events.start', 'events.end', 'events.id', 'events.user_id AS organizer')->get();

        return view('events.index', compact('events', 'eventList', 'aList', 'eventLevel', 'users', 'roles', 'eve'));
    }

    public function calendarIndex()
    {
        $sql = DB::table('events')
            ->select('name AS title', 'start', 'end')
            ->get();

        $myArray = array();
        foreach ($sql as $row) {
            $myArray[] = $row;
        }

        //return dd(json_encode($myArray))
        return view('events.calendar', compact('myArray'));
    }

    public function appointIndex()
    {
        $users = User::all()->except([1, Auth::id(), 2]);
        $roles = DB::table('roles')->get()->except(0, 1, 2);
        $eve = DB::table('events')->get();

        $appointment = DB::table('appoint')
            ->join('users', 'users.id', '=', 'appoint.user_id')
            ->join('roles', 'roles.id', '=', 'appoint.role_id')
            ->join('events', 'events.id', '=', 'appoint.event_id')
            ->select('users.name AS usrname', 'roles.name AS rolename', 'events.name AS evename', 'appoint.created_at', 'appoint.id')
            ->get();

        return view('appoint.index', compact('appointment', 'users', 'roles', 'eve'));
    }

    public function reportIndex()
    {
        $username = Auth::user()->name;

        $evecount1 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','12')
            ->get();

        $evecount2 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','11')
            ->get();

        $evecount3 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','10')
            ->get();

        $evecount4 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','9')
            ->get();

        $evecount5 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','8')
            ->get();

        $evecount6 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','7')
            ->get();

        $evecount7 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','6')
            ->get();

        $evecount8 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','5')
            ->get();

        $evecount9 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','4')
            ->get();

        $evecount10 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','3')
            ->get();

        $evecount11 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','2')
            ->get();

        $evecount12 = DB::table('EVENTS')
            ->whereMonth('CREATED_AT','=','1')
            ->get();

        // END OF EVENT COUNT FOR ADMIN

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

        // START OF USER COUNT

        $userscount = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','12')
            ->get();

        $userscount1 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','11')
            ->get();

        $userscount2 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','10')
            ->get();

        $userscount3 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','9')
            ->get();

        $userscount4 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','8')
            ->get();

        $userscount5 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','7')
            ->get();

        $userscount6 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','6')
            ->get();

        $userscount7 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','5')
            ->get();

        $userscount8 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','4')
            ->get();

        $userscount9 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','3')
            ->get();

        $userscount10 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','2')
            ->get();

        $userscount11 = DB::table('USERS')
            ->whereMonth('CREATED_AT','=','1')
            ->get();

        return view('report.index', compact( 'username','evecount1', 'evecount2', 'evecount3', 'evecount4',
            'evecount5', 'evecount6', 'evecount7', 'evecount8', 'evecount9', 'evecount10', 'evecount11', 'evecount12', 'evecount11', 'evecount22', 'evecount33', 'evecount44',
            'evecount55', 'evecount66', 'evecount77', 'evecount88', 'evecount99', 'evecount100', 'evecount111', 'evecount122',
            'userscount','userscount1','userscount2','userscount3','userscount4','userscount5','userscount6','userscount7','userscount8',
            'userscount9','userscount10','userscount11'));
    }

    public function checkQrcode(Request $request)
    {
        $msg='';
        if($request->data){
            $eve = Event::where('id',$request->data)->first();
            $att = Attendance::where('user_id', Auth::user()->id)->where('event_id', $request->data)->count();
            if($eve)
            {
                if($eve->capacity > 0 AND $att == 0 AND new DateTime() < new DateTime($eve->end))
                {
                    $user = User::findOrFail(Auth::id());
                    $data = new Attendance();
                    $data->user_id = Auth::user()->id;
                    $data->event_id = ($eve->id);
                    $data->check_in = (date('Y-m-d H:i:s', time()));
                    DB::table('events')->where('id', '=', $eve->id)->decrement('capacity', 1);

                    $data2 = new Transaction();
                    $data2->user_id = Auth::user()->id;
                    $data2->description = 'POINT ACQUIRE FROM '.$eve->name;

//                    if ($user->hasRole('PENGERUSI')) {
//                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
//                        $data2->point = 10;
//                    }
//                    else {
//                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 2);
//                        $data2->point = 2;
//                    }

                    if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 1)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
                        $data2->point = 12;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 1)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
                        $data2->point = 10;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 1)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
                        $data2->point = 9;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 1)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
                        $data2->point = 9;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 1)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 8);
                        $data2->point = 8;
                    }
                    elseif ($eve->event_level_id == 1)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 2);
                        $data2->point = 2;
                    }

                    if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 2)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
                        $data2->point = 12;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 2)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
                        $data2->point = 10;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 2)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
                        $data2->point = 9;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 2)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
                        $data2->point = 9;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 2)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 8);
                        $data2->point = 8;
                    }
                    elseif ($eve->event_level_id == 2)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 2);
                        $data2->point = 2;
                    }

                    if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 3)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 13);
                        $data2->point = 13;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 3)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 11);
                        $data2->point = 11;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 3)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
                        $data2->point = 10;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 3)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
                        $data2->point = 10;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 3)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
                        $data2->point = 9;
                    }
                    elseif ($eve->event_level_id == 3)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 3);
                        $data2->point = 3;
                    }

                    if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 4)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
                        $data2->point = 15;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 4)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 13);
                        $data2->point = 13;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 4)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
                        $data2->point = 12;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 4)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
                        $data2->point = 12;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 4)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 11);
                        $data2->point = 11;
                    }
                    elseif ($eve->event_level_id == 4)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 5);
                        $data2->point = 5;
                    }

                    if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 5)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 18);
                        $data2->point = 18;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 5)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 16);
                        $data2->point = 16;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 5)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
                        $data2->point = 15;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 5)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
                        $data2->point = 15;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 5)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 14);
                        $data2->point = 14;
                    }
                    elseif ($eve->event_level_id == 5)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 8);
                        $data2->point = 8;
                    }

                    if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 6)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 25);
                        $data2->point = 25;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 6)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 23);
                        $data2->point = 23;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 6)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 22);
                        $data2->point = 22;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 6)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 22);
                        $data2->point = 22;
                    }
                    elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $eve->id)->exists() && $eve->event_level_id == 6)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 21);
                        $data2->point = 21;
                    }
                    elseif ($eve->event_level_id == 6)
                    {
                        DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
                        $data2->point = 15;
                    }

                    $data->save();
                    $data2->save();

                    $msg=['capacity'=>$eve->capacity, 'event_name'=>$eve->name, 'status'=>'Success'];
                    $info = "ok";

                }elseif($att == 1) {
                    $msg="ACCESS DENIED";
                    $info = "ko";
                }
                elseif (new DateTime() > new DateTime($eve->end)) {
                    $msg="Event DateTime Passed";
                    $info = "passed";
                }
            }else {
                $msg='QR INVALID';
            }
        }else {
            $msg='ERROR';
        }
        return response()->json(['msg'=>$msg,'info'=>$info ?? '']);
    }

    public function viewParticipants($id)
    {
        $event = Event::findOrFail($id);
        $bList = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->select('users.name AS user_name', 'events.name AS event_name', 'users.id')
            ->where('attendances.event_id', $event->id)->get();

        return view('attendance.participant', compact('bList'));
    }

    public function viewTransactions()
    {
        $bList = DB::table('transaction')
            ->join('users', 'users.id', '=', 'transaction.user_id')
            ->select('transaction.description', 'transaction.id', 'transaction.created_at', 'transaction.point AS user_point', 'users.point')
            ->where('transaction.user_id', Auth::id())->get();

        $cList = DB::table('users')->where('id', '=', Auth::id())->first();
        $usrlist = DB::table('users')
            ->where('id', '!=', 1)
            ->where('id', '!=', 2)
            ->orderBy('point', 'DESC')
            ->paginate(1);

        return view('transactions.index', compact('bList', 'cList', 'usrlist'));
    }

    public function attendanceindex()
    {
        $event = Event::all();

        $aList = DB::table('attendances')
            ->join('events', 'events.id', '=', 'attendances.event_id')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->select('events.id', 'events.name', 'attendances.check_in', 'attendances.user_id', 'events.end',
                'events.start')
            ->where('attendances.user_id', Auth::id())->get();

        return view('attendance.index', compact('event', 'aList'));
    }

    public function appointAdd(Request $request)
    {
        $data2 = new Appoint();
        $data = new RoleUser();

        $data->role_id = $request->input('uems_roles');
        $data->user_id = $request->input('uems_users');

        $data2->role_id = $data->role_id;
        $data2->user_id = $data->user_id;
        $data2->event_id = $request->input('uems_events');

        $att = RoleUser::where('user_id', $data->user_id)->where('role_id', $data->role_id)->count();
        $att2 = Appoint::where('role_id', $data2->role_id)->where('event_id', $data2->event_id)->count();

        //$testCheck = RoleUser::where('user_id', '=', $data->user_id)->where('role_id', '=', $data->role_id)->exists();
        $testCheck = Appoint::where('role_id', '=', $data->role_id)
            ->where('event_id', '=', $data2->event_id)
            ->exists();

        if($att == 0 && $att2 == 0) {
            $data->save();
            $data2->save();
            $request->session()->flash('success',  'User Appointment has been inserted.');
        }
        elseif (!$testCheck) {
            $data2->save();
            $request->session()->flash('success',  'User Appointment to an Event has been inserted.');
        }
        elseif ($att == 1 && $att2 == 1) {
            $request->session()->flash('error', 'There was an error, probably you have assigned the role to the user.');
        }
        else {
            $request->session()->flash('error', 'There was an error, you can only hold 1 role for an event.');
        }

        return redirect('/appoint');
    }

    public function delAtt($id, Request $request, Attendance $att)
    {
        $user = User::findOrFail(Auth::id());
        $users = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('roles.name AS user_role')
            ->where('users.id', Auth::id())->skip(1)->take(2)->first();

        $event = Event::findOrFail($id);
        $att = Attendance::where('user_id', '=', Auth::user()->id)->where('event_id', '=', $event->id)->first();
        DB::table('events')->where('id', '=', $event->id)->increment('capacity', 1);

        $p = DB::table('transaction')
            ->join('users', 'users.id', '=', 'transaction.user_id')
            ->where('transaction.user_id', Auth::id())->first();

        $data2 = new Transaction();
        $data2->user_id = Auth::user()->id;

//        if ($user->hasRole('PENGERUSI') && $event->event_level_id == 1) {
//            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 12);
//            $data2->point = -12;
//        }
//        elseif ($user->hasRole('user') && $event->event_level_id == 1)
//        {
//            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 4);
//            $data2->point = 4;
//        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 12);
            $data2->point = -12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 10);
            $data2->point = -10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 9);
            $data2->point = -9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 9);
            $data2->point = -9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 8);
            $data2->point = -8;
        }
        elseif ($event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 2);
            $data2->point = -2;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 12);
            $data2->point = -12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 10);
            $data2->point = -10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 9);
            $data2->point = -9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 9);
            $data2->point = -9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 8);
            $data2->point = -8;
        }
        elseif ($event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 2);
            $data2->point = -2;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 13);
            $data2->point = -13;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 11);
            $data2->point = -11;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 10);
            $data2->point = -10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 10);
            $data2->point = -10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 9);
            $data2->point = -9;
        }
        elseif ($event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 3);
            $data2->point = -3;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 15);
            $data2->point = -15;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 13);
            $data2->point = -13;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 12);
            $data2->point = -12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 12);
            $data2->point = -12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 11);
            $data2->point = -11;
        }
        elseif ($event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 5);
            $data2->point = -5;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 18);
            $data2->point = -18;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 16);
            $data2->point = -16;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 15);
            $data2->point = -15;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 15);
            $data2->point = -15;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 14);
            $data2->point = -14;
        }
        elseif ($event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 8);
            $data2->point = -8;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 25);
            $data2->point = -25;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 23);
            $data2->point = -23;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 22);
            $data2->point = -22;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 22);
            $data2->point = -22;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 21);
            $data2->point = -21;
        }
        elseif ($event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 15);
            $data2->point = -15;
        }

        $data2->description = 'WITHDRAW FROM '.$event->name.'.';
        $data2->save();

        if($att->delete()) {
            $request->session()->flash('success',  $event->name.' deleted successfully');
        }
        else {
            $request->session()->flash('error', 'Attendance not Deleted. There was an error.');
        }

        return redirect()->route('attindex');
    }

    public function insertAtt(Request $request, $id)
    {
//        $users = DB::table('users')
//            ->join('role_user', 'role_user.user_id', '=', 'users.id')
//            ->join('roles', 'roles.id', '=', 'role_user.role_id')
//            ->select('roles.name AS user_role')
//            ->where('users.id', Auth::id())->skip(1)->take(2)->first();

        $user = User::findOrFail(Auth::id());

//        $users = DB::table('role_user')
//            ->join('users', 'users.id', '=', 'role_user.user_id')
//            ->join('roles', 'roles.id', '=', 'role_user.role_id')
//            ->select('roles.name AS user_role')
//            ->where('users.id', Auth::id())->skip(1)->take(2)->first();

        $event = Event::findOrFail($id);
        $data = new Attendance();

        $data->user_id = Auth::user()->id;
        $data->event_id = ($event->id);
        $data->check_in = (date('Y-m-d H:i:s', time()));
        DB::table('events')->where('id', '=', $event->id)->decrement('capacity', 1);

        $data2 = new Transaction();
        $data2->user_id = Auth::user()->id;
        $data2->description = 'POINT ACQUIRE FROM '.$event->name;

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
            $data2->point = 12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
            $data2->point = 10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
            $data2->point = 9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
            $data2->point = 9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 8);
            $data2->point = 8;
        }
        elseif ($event->event_level_id == 1)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 2);
            $data2->point = 2;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
            $data2->point = 12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
            $data2->point = 10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
            $data2->point = 9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
            $data2->point = 9;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 8);
            $data2->point = 8;
        }
        elseif ($event->event_level_id == 2)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 2);
            $data2->point = 2;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 13);
            $data2->point = 13;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 11);
            $data2->point = 11;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
            $data2->point = 10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
            $data2->point = 10;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 9);
            $data2->point = 9;
        }
        elseif ($event->event_level_id == 3)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 3);
            $data2->point = 3;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
            $data2->point = 15;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 13);
            $data2->point = 13;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
            $data2->point = 12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 12);
            $data2->point = 12;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 11);
            $data2->point = 11;
        }
        elseif ($event->event_level_id == 4)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 5);
            $data2->point = 5;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 18);
            $data2->point = 18;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 16);
            $data2->point = 16;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
            $data2->point = 15;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
            $data2->point = 15;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 14);
            $data2->point = 14;
        }
        elseif ($event->event_level_id == 5)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 8);
            $data2->point = 8;
        }

        if (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 25);
            $data2->point = 25;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 23);
            $data2->point = 23;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 22);
            $data2->point = 22;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 22);
            $data2->point = 22;
        }
        elseif (Appoint::where('user_id', '=', Auth::id())->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 21);
            $data2->point = 21;
        }
        elseif ($event->event_level_id == 6)
        {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 15);
            $data2->point = 15;
        }

        if($data->save() AND $data2->save()) {
            $request->session()->flash('success',  $event->name.' event has been recorded. Point is recorded.');
        }
        else {
            $request->session()->flash('error', 'Event not recorded. There was an error.');
        }

        return redirect('/attendance');
    }

    public function QR()
    {
        return view('events.qrcode');
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

    public function dateAddHour($date = null, $howManyHours = null, $format = 'Y-m-d H:i:s')
    {
        $new_date = new \DateTime($date);
        $new_date->modify('+'.$howManyHours.' hour');
        return $new_date->format($format);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $data
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start-date' => 'required|before:end-date',
            'end-date' => 'required',
            'event_types' => 'required',
            'event_levels' => 'required',
        ]);

        $event = auth()->user();

        $data = new Event();

        $data->user_id = $request->user()->id;
        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->venue = $request->input('venue');
        $data->capacity = $request->input('capacity');
        $data->start = $request->input('start-date');
        $data->status = 'in-system';
        $data->end = $request->input('end-date');
        $data->event_type_id = $request->input('event_types');
        $data->event_level_id = $request->input('event_levels');
        //$data->end = $this->dateAddHour($request->input('start-date'), 2);

        if($data->save()) {
            $request->session()->flash('success',  $data->name.' event has been inserted.');
        }
        else {
            $request->session()->flash('error', 'Event not updated. There was an error.');
        }

        return redirect('/event');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event = Event::findOrFail($request->eveid);

        $this->validate($request, [
            'startdate' => 'required|before:enddate',
            'enddate' => 'required',
        ]);

        $event->start = $request->startdate;
        $event->end = $request->enddate;
        $event->event_type_id = $request->event_types;
        $event->event_level_id = $request->event_levels;

        $event->update($request->all());

        if($event->save()) {
            $request->session()->flash('success',  $event->name.' updated successfully');
        }
        else {
            $request->session()->flash('error', 'Event not updated. There was an error.');
        }

        return redirect()->route('event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if($event->delete()) {
            $request->session()->flash('success',  $event->name.' deleted successfully');
        }
        else {
            $request->session()->flash('error', 'Event not Deleted. There was an error.');
        }

        return redirect()->route('event');
    }

    public function appointTerminate($id, Request $request)
    {
        $appoint = Appoint::findOrFail($id);

        $roleusr = DB::table('role_user')
            ->where('role_id', $appoint->role_id)
            ->where('user_id', $appoint->user_id)
            ->delete();

        if ($appoint->delete() && $roleusr)
            $request->session()->flash('success',  'Successfully terminated.');
        else
            $request->session()->flash('error', 'There was an error.');

        return redirect()->route('appoint_view');
    }

//    public function deleteEvent(Request $request)
//    {
//        $event = Event::find($request->id);
//
//        if (Auth::user() != $request->id)
//        {
//            return response()->json([
//                'success' => false,
//                'message' => 'unauthorized access'
//            ]);
//        }
//
//        $event->delete();
//
//        return response()->json([
//            'success' => true,
//            'message' => 'post deleted...'
//        ]);
//    }

//    public function updateEvent(Request $request)
//    {
//        $event = Event::find($request->id);
//
//        if (Auth::id() != $request->id)
//        {
//            return response()->json([
//                'success' => false,
//                'message' => 'unauthorized access'
//            ]);
//        }
//        $event->name = $request->name;
//        $event->update();
//        return response()->json([
//            'success' => true,
//            'message' => 'post editied'
//        ]);
//    }

    public function viewEvent()
    {
        //$events = Event::all();

        $events = DB::table('events')
            ->join('event_type', 'event_type.id', '=', 'events.event_type_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->join('users', 'users.id', '=', 'events.user_id')
            ->select('events.id', 'event_type.name AS event_type', 'event_level.name AS event_level', 'events.name', 'events.description', 'events.venue', 'events.capacity', 'events.event_type_id',
                'events.start', 'events.end', 'users.name AS organizer')
            ->get();

        return response()->json($events);
    }

//    public function createEvent(Request $request)
//    {
//
//        $data = new Event();
//
//        $data->user_id = 40;
//        $data->name = $request->name;
//        $data->description = $request->description;
//        $data->venue = $request->venue;
//        $data->capacity = $request->capacity;
//        $data->start = '2021-01-10 21:26:16';
//        $data->status = 'in-system';
//        $data->end = '2021-02-10 21:26:16';
//        $data->event_type_id = $request->event_type_id;
//        $data->event_level_id = $request->event_level_id;
//
//        $data->save();
//        return response()->json([
//            'success' => true,
//            'message' => 'inserted...',
//            'post' => $data
//        ]);
//    }

    public function createAttendanceAndroid(Request $request)
    {
        $data = new Attendance();
        $event = Event::findOrFail($request->event_id);

        $data->user_id = $request->user_id;
        $data->event_id = $request->event_id;
        $data->check_in = (date('Y-m-d H:i:s', time()));

        DB::table('events')->where('id', '=', $data->event_id)->decrement('capacity', 1);

        $data2 = new Transaction();
        $data2->user_id = $data->user_id;
        $data2->description = 'POINT ACQUIRE FROM '.$event->name;

        $user = User::findOrFail($data->user_id);

        $testCheck = Attendance::where('user_id', '=', $data->user_id)
            ->where('event_id', '=', $data->event_id)
            ->exists();

        if (!$testCheck)
        {
            if (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 12);
                $data2->point = 12;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 10);
                $data2->point = 10;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 9);
                $data2->point = 9;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 9);
                $data2->point = 9;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 1)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 8);
                $data2->point = 8;
            }
            elseif ($event->event_level_id == 1)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 2);
                $data2->point = 2;
            }

            if (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 12);
                $data2->point = 12;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 10);
                $data2->point = 10;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 9);
                $data2->point = 9;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 9);
                $data2->point = 9;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 2)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 8);
                $data2->point = 8;
            }
            elseif ($event->event_level_id == 2)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 2);
                $data2->point = 2;
            }

            if (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 13);
                $data2->point = 13;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 11);
                $data2->point = 11;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 10);
                $data2->point = 10;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 10);
                $data2->point = 10;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 3)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 9);
                $data2->point = 9;
            }
            elseif ($event->event_level_id == 3)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 3);
                $data2->point = 3;
            }

            if (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 15);
                $data2->point = 15;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 13);
                $data2->point = 13;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 12);
                $data2->point = 12;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 12);
                $data2->point = 12;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 4)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 11);
                $data2->point = 11;
            }
            elseif ($event->event_level_id == 4)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 5);
                $data2->point = 5;
            }

            if (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 18);
                $data2->point = 18;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 16);
                $data2->point = 16;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 15);
                $data2->point = 15;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 15);
                $data2->point = 15;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 5)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 14);
                $data2->point = 14;
            }
            elseif ($event->event_level_id == 5)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 8);
                $data2->point = 8;
            }

            if (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 9)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 25);
                $data2->point = 25;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 8)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 23);
                $data2->point = 23;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 7)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 22);
                $data2->point = 22;
            }
            elseif (Appoint::where('user_id', '=', $data->user_id)->where('role_id', '=', 6)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 22);
                $data2->point = 22;
            }
            elseif (Appoint::where('user_id', '=',$data->user_id)->where('role_id', '=', 5)->where('event_id', '=', $event->id)->exists() && $event->event_level_id == 6)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 21);
                $data2->point = 21;
            }
            elseif ($event->event_level_id == 6)
            {
                DB::table('users')->where('id', '=', $data->user_id)->increment('point', 15);
                $data2->point = 15;
            }

            $data->save();
            $data2->save();
            return response()->json("Attendance recorded, thank you and have a nice day.");
        }
        else {
            return response()->json("Attendance not recorded. Cannot record twice, only 1 attendance.");
        }

        //return response()->json($data);
    }
}
