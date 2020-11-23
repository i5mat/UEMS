<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use DateTime;
use App\Event;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

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

        return view('events.index', compact('events'));
    }

    public function checkQrcode(Request $request)
    {



        //('Access-Control-Allow-Origin: *');
        $msg='';
        if($request->data){
            //$user = Event::where('id', $request->data)->first();
            $event = Event::findOrFail($request->data);
            $data = new Attendance();
            if($event){

                if($event->capacity > 0){
                    $event->capacity--;


                    $msg=['capacity'=>$event->capacity];
                    $data->user_id = Auth::user()->id;
                    $data->event_id = ($event->id);
                    $data->check_in = (date('Y-m-d H:i:s', time()));
                    DB::table('events')->where('id', '=', $event->id)->decrement('capacity', 1);


                    $info = "ok";

                }else{
                    $msg="Access refuse";


                }

                $data->save();


            }else{
                $msg='Qrcode invalid';
            }
        }else{
            $msg='err.';
        }
        return response()->json(['msg'=>$msg,'info'=>$info ?? '']);
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

    public function delAtt($id, Request $request, Attendance $att)
    {
        $event = Event::findOrFail($id);
        $att = Attendance::where('user_id', '=', Auth::user()->id)->where('event_id', '=', $event->id)->first();
        DB::table('events')->where('id', '=', $event->id)->increment('capacity', 1);

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
        $event = Event::findOrFail($id);
        $data = new Attendance();

        $data->user_id = Auth::user()->id;
        $data->event_id = ($event->id);
        $data->check_in = (date('Y-m-d H:i:s', time()));
        DB::table('events')->where('id', '=', $event->id)->decrement('capacity', 1);

        if($data->save()) {
            $request->session()->flash('success',  $event->name.' event has been recorded.');
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
        $data->status = 'on-going';
        $data->end = $request->input('end-date');
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
