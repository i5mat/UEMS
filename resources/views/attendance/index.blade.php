@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Attendance</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Venue</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Attedance</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($event as $e)
                                <tr>
                                    <td>{{ $e->id }}</td>
                                    <td>{{ $e->name }}</td>
                                    <td>{{ $e->venue }}</td>
                                    <td>{{ $e->capacity }}</td>
                                    <td>
                                        @if(new DateTime() > new DateTime($e->end))
                                            <button type="button" class="btn btn-danger" disabled >Disabled</button>
                                        @elseif (App\Attendance::where('user_id', '=', Auth::user()->id)->where('event_id', '=', $e->id)->exists())
                                            <form action="/attendance/del/{{ $e->id }}" method="POST" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Out</button>
                                            </form>
                                        @elseif (new DateTime($e->start) <> new DateTime($e->end))
                                            <form action="/attendance/reg/{{ $e->id }}" method="POST" class="float-left">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Record</button>
                                            </form>
                                        @elseif (new DateTime() <= new DateTime($e->start))
                                            <button type="button" class="btn btn-warning" disabled >Disabled</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if(new DateTime() > new DateTime($e->end))
                                            Event DateTime Passed
                                        @elseif (App\Attendance::where('user_id', '=', Auth::user()->id)->where('event_id', '=', $e->id)->exists())
                                            Attendance Recorded
                                        @elseif (new DateTime($e->start) <> new DateTime($e->end))
                                            Event On-Going
                                        @else
                                            Future Event
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Attendance History</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Venue</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Attedance</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($event as $e)
                                <tr>
                                    <td>{{ $e->id }}</td>
                                    <td>{{ $e->name }}</td>
                                    <td>{{ $e->venue }}</td>
                                    <td>{{ $e->capacity }}</td>
                                    <td>
                                        @if(new DateTime() > new DateTime($e->end) OR App\Attendance::where('user_id', '=', Auth::user()->id)->where('event_id', '=', $e->id)->exists())
                                            <button type="button" class="btn btn-primary" disabled >Disabled</button>
                                        @elseif (new DateTime($e->start) <> new DateTime($e->end) OR App\Attendance::where('user_id', '!=', Auth::user()->id)->where('event_id', '!=', $e->id)->exists())
                                            <form action="/attendance/reg/{{ $e->id }}" method="POST" class="float-left">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Record</button>
                                            </form>
                                        @elseif (new DateTime() <= new DateTime($e->start) OR App\Attendance::where('user_id', '!=', Auth::user()->id)->where('event_id', '!=', $e->id)->exists())
                                            <button type="button" class="btn btn-primary" disabled >Disabled</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if(new DateTime() > new DateTime($e->end))
                                            Event DateTime Passed
                                        @elseif (new DateTime($e->start) <> new DateTime($e->end))
                                            Event On-Going
                                        @else
                                            Future Event
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
