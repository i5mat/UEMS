@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card">

                    <div class="card-header">Attendance</div>

                    <div class="card-body table-responsive">
                        <table class="table text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Venue</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Attedance</th>
                                <th scope="col">Status</th>
                                <th scope="col">QR</th>
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
                                        @if(new DateTime(now()) > new DateTime($e->end))
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
                                        @endif
                                    </td>
                                    <td>
                                        @if(new DateTime() > new DateTime($e->end))
                                            Event DateTime Passed
                                        @elseif (App\Attendance::where('user_id', '=', Auth::user()->id)->where('event_id', '=', $e->id)->exists())
                                            Attendance Recorded
                                        @elseif (new DateTime(now()) <> new DateTime($e->start) AND new DateTime($e->end))
                                            Event On-Going
                                        @else
                                            Future Event
                                        @endif
                                    </td>
                                    <td>
                                        {!! QrCode::size(150)->generate($e->id); !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="card table-responsive">
                    <div class="card-header">Attendance History</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Event ID</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Name</th>
                                <th scope="col">DateTime</th>
                                <th scope="col">Status</th>
                                <th scope="col">Cert</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($aList as $aL)
                                <tr>
                                    <td>{{ $aL->id }}</td>
                                    <td>{{ $aL->name }}</td>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($aL->check_in)) }}</td>
                                    <td><img src="/image/check.png"></td>
                                    <td>
                                        @if(new DateTime() > new DateTime($aL->end))
                                            <form action="/cert/{{ $aL->id }}" method="POST" class="float-left">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-info">Cert</button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-danger" disabled >Disabled</button>
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
