<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\RoleUser;
use App\Transaction;
use DateTime;
use App\Event;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
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
        $eventList = DB::table('event_type')->get();
        $eventLevel = DB::table('event_level')->get();
        $aList = DB::table('events')
            ->join('event_type', 'event_type.id', '=', 'events.event_type_id')
            ->join('event_level', 'event_level.id', '=', 'events.event_level_id')
            ->select('event_type.name AS event_type', 'event_level.name AS event_level', 'events.name', 'events.description', 'events.venue', 'events.capacity',
                'events.start', 'events.end', 'events.id')->get();

        return view('events.index', compact('events', 'eventList', 'aList', 'eventLevel', 'users', 'roles'));
    }

    public function reportIndex()
    {
//        $kira = DB::table('EVENTS')
//            ->join('USERS','EVENTS.USER_ID','=','USERS.ID')
//            ->where('EVENTS.USER_ID','=','1')
//            ->get();
//
//        $kira2 = DB::table('EVENTS')
//            ->join('USERS','EVENTS.USER_ID','=','USERS.ID')
//            ->where('EVENTS.USER_ID','=','2')
//            ->get();
//
//        $kira3 = DB::table('EVENTS')
//            ->join('USERS','EVENTS.USER_ID','=','USERS.ID')
//            ->where('EVENTS.USER_ID','=','3')
//            ->get();

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

        return view('report.index', compact('evecount1', 'evecount2', 'evecount3', 'evecount4',
            'evecount5', 'evecount6', 'evecount7', 'evecount8', 'evecount9', 'evecount10', 'evecount11', 'evecount12',
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
                    $data = new Attendance();
                    $data->user_id = Auth::user()->id;
                    $data->event_id = ($eve->id);
                    $data->check_in = (date('Y-m-d H:i:s', time()));
                    DB::table('events')->where('id', '=', $eve->id)->decrement('capacity', 1);
                    DB::table('users')->where('id', '=', $data->user_id)->increment('point', 3);

                    $data2 = new Transaction();
                    $data2->user_id = Auth::user()->id;
                    $data2->description = 'POINT ACQUIRE FROM '.$eve->name;
                    $data2->point = 3;

                    $data->save();
                    $data2->save();

                    $msg=['capacity'=>$eve->capacity, 'event_desc'=>$eve->description, 'status'=>'Success'];
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

        return view('transactions.index', compact('bList', 'cList'));
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
        $data = new RoleUser();
        $data->role_id = $request->input('uems_roles');
        $data->user_id = $request->input('uems_users');
        $att = RoleUser::where('user_id', $data->user_id)->where('role_id', $data->role_id)->count();

        if($att == 0) {
            $data->save();
            $request->session()->flash('success',  'User Appointment has been inserted.');
        }
        elseif ($att == 1) {
            $request->session()->flash('error', 'There was an error, probably you have assigned the role to the user.');
        }

        return redirect('/admin/users');
    }

    public function delAtt($id, Request $request, Attendance $att)
    {
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

        if ($users->user_role == 'PENGERUSI') {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 10);
            $data2->point = '-10';
        }
        elseif ($users->user_role == 'PESERTA') {
            DB::table('users')->where('id', '=', Auth::id())->decrement('point', 2);
            $data2->point = '-2';
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
        $users = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('roles.name AS user_role')
            ->where('users.id', Auth::id())->skip(1)->take(2)->first();

        $event = Event::findOrFail($id);
        $data = new Attendance();

        $data->user_id = Auth::user()->id;
        $data->event_id = ($event->id);
        $data->check_in = (date('Y-m-d H:i:s', time()));
        DB::table('events')->where('id', '=', $event->id)->decrement('capacity', 1);

        $data2 = new Transaction();
        $data2->user_id = Auth::user()->id;
        $data2->description = 'POINT ACQUIRE FROM '.$event->name;

        if ($users->user_role == 'PENGERUSI') {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 10);
            $data2->point = 10;
        }
        elseif ($users->user_role == 'PESERTA') {
            DB::table('users')->where('id', '=', Auth::id())->increment('point', 2);
            $data2->point = 2;
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
}
