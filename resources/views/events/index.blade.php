@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Events

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" style="margin:5px;" data-toggle="modal" data-target="#exampleModalCenter">
                        Create Event
                    </button>

                    </div>

                    <!-- Modal 1 -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create an Event</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form method="POST" action="{{ route('reg-event') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name-label" class="col-md-4 col-form-label text-md-right">Name</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description-label" class="col-md-4 col-form-label text-md-right">Description</label>

                                            <div class="col-md-6">
                                                <textarea class="form-control" rows="5" name="description" id="description" required autocomplete="description"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="venue-label" class="col-md-4 col-form-label text-md-right">Venue</label>

                                            <div class="col-md-6">
                                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" required autocomplete="venue">

                                                @error('venue')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Capacity</label>

                                            <div class="col-md-6">
                                                <input id="capacity" type="number" min="1" max="200" class="form-control" name="capacity" required autocomplete="capacity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Event Type</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="event_types">
                                                    <option disabled selected>Select Event Type</option>
                                                    @foreach ($eventList as $eList)
                                                        <option value="{{ $eList->id }}">
                                                            {{ $eList->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Event Level</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="event_levels">
                                                    <option disabled selected>Select Event Level</option>
                                                    @foreach ($eventLevel as $eLevel)
                                                        <option value="{{ $eLevel->id }}">
                                                            {{ $eLevel->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="start-date-label" class="col-md-4 col-form-label text-md-right">Start</label>

                                            <div class="col-md-6">
                                                <input id="start-date" class="@error('start-date') is-invalid @enderror" type="datetime-local" name="start-date" min="2020-11-01T00:00" max="2022-01-01T00:00">
                                                @error('start-date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="end-date-label" class="col-md-4 col-form-label text-md-right">End</label>

                                            <div class="col-md-6">
                                                <input id="end-date" class="@error('end-date') is-invalid @enderror" type="datetime-local" name="end-date" min="2020-11-01T00:00" max="2022-01-01T00:00">
                                                @error('end-date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal 2 -->
                    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit an Event</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <form method="POST" action="/event/" >
                                        <input type="hidden" name="eveid" id="eveid" value="">
                                        @csrf
                                        {{ method_field('PUT') }}

                                        <div class="form-group row">
                                            <label for="name-label" class="col-md-4 col-form-label text-md-right">Name</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description-label" class="col-md-4 col-form-label text-md-right">Description</label>

                                            <div class="col-md-6">
{{--                                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description">--}}
                                                <textarea class="form-control" rows="5" name="description" id="description" required autocomplete="description"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="venue-label" class="col-md-4 col-form-label text-md-right">Venue</label>

                                            <div class="col-md-6">
                                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" required autocomplete="venue">

                                                @error('venue')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Capacity</label>

                                            <div class="col-md-6">
                                                <input id="capacity" type="number" min="1" max="200" class="form-control" name="capacity" required autocomplete="capacity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Event Type</label>

                                            <div class="col-md-6">
                                                <input id="event_types" hidden>

                                                <select class="form-control" name="event_types" id="event_types">
                                                    <option>Select Event Type</option>
                                                    @foreach ($eventList as $eList)
                                                        <option value="{{ $eList->id }}">
                                                            {{ $eList->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Event Level</label>

                                            <div class="col-md-6">
                                                <input id="event_levels" hidden>

                                                <select class="form-control" name="event_levels" id="event_levels">
                                                    <option>Select Event Level</option>
                                                    @foreach ($eventLevel as $eLevel)
                                                        <option value="{{ $eLevel->id }}">
                                                            {{ $eLevel->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="start-date-label" class="col-md-4 col-form-label text-md-right">Start</label>
                                            <div class="col-md-6">
                                                <input id="start-date" class="@error('start-date') is-invalid @enderror" type="datetime-local" name="startdate" min="2020-11-01T00:00" max="2022-01-01T00:00">

                                                @error('start-date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="end-date-label" class="col-md-4 col-form-label text-md-right">End</label>
                                            <div class="col-md-6">
                                                <input id="end-date" class="@error('end-date') is-invalid @enderror" type="datetime-local" name="enddate" min="2020-11-01T00:00" max="2022-01-01T00:00">

                                                @error('end-date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for event names.." title="Type in a name">
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="myTable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Venue</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Event Type</th>
                                <th scope="col">Event Level</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($aList as $eve)
                            <tr>
                                <th scope="row">{{ $eve->id }}</th>
                                <td>{{ $eve->name }}</td>
                                <td>{{ $eve->description }}</td>
                                <td>{{ $eve->venue }}</td>
                                <td>{{ $eve->capacity }}</td>
                                <td>{{ $eve->event_type }}</td>
                                <td>{{ $eve->event_level }}</td>
                                <td>{{ date('d/m/Y H:i A', strtotime($eve->start)) }}</td>
                                <td>{{ date('d/m/Y H:i A', strtotime($eve->end)) }}</td>
                                @if(new DateTime() > new DateTime($eve->end))
                                    <td>Past</td>
                                @elseif (new DateTime($eve->start) <> new DateTime($eve->end))
                                    <td>On-Going</td>
                                @else
                                    <td>Not Past</td>
                                @endif
                                <td>
                                    @if (App\User::findOrFail(\Auth::id())->hasRole('admin'))
                                        <button data-myeventlevel="{{ $eve->event_level_id }}" data-myeventtype="{{ $eve->event_type_id }}" data-myend="{{ date('Y-m-d H:i:s', strtotime($eve->end)) }}" data-mystart="{{ date('Y-m-d H:i:s', strtotime($eve->start)) }}" data-cap="{{ $eve->capacity }}" data-venue="{{ $eve->venue }}" data-eventid="{{ $eve->id }}" data-myname="{{ $eve->name }}" data-mydesc="{{ $eve->description }}" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter2">Edit</button>
                                    @else
                                        <button data-myeventlevel="{{ $eve->event_level_id }}" data-myeventtype="{{ $eve->event_type_id }}" data-myend="{{ date('Y-m-d H:i:s', strtotime($eve->end)) }}" data-mystart="{{ date('Y-m-d H:i:s', strtotime($eve->start)) }}" data-cap="{{ $eve->capacity }}" data-venue="{{ $eve->venue }}" data-eventid="{{ $eve->id }}" data-myname="{{ $eve->name }}" data-mydesc="{{ $eve->description }}" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter2" @if(\Auth::id() != $eve->organizer) hidden @endif>Edit</button>
                                    @endif
                                </td>
                                <td>
                                    @if (App\User::findOrFail(\Auth::id())->hasRole('admin') OR \Auth::id() == $eve->organizer)
                                        <form method="POST" action="/event/{{ $eve->id }}">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-warning">Delete</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('vP', $eve->id) }}"> <button type="button" class="btn btn-success float-left">View</button> </a>
                                </td>
                                <td>
                                    {!! QrCode::size(100)->generate($eve->id); !!}
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
