<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('events.index')->with('events', $events);
    }

    public function Calendar()
    {
        return view('events.calendar');
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
        $event = auth()->user();

        $data = new Event();

        $data->user_id = $request->user()->id;
        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->venue = $request->input('venue');
        $data->capacity = $request->input('capacity');
        $data->start = $request->input('start-date');
        $data->status = 'on-going';
        //$data->end = $request->input('start-date');
        $data->end = $this->dateAddHour($request->input('start-date'), 2);

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
    public function edit(Event $event)
    {
        //
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
        $event->name = $request->name;
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->capacity = $request->capacity;
        $event->start = $request->start;

        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
