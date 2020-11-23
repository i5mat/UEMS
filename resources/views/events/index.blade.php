@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
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
                                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description">
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
                                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description">
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

                    <div class="card-body overflow-auto">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Venue</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $eve)
                            <tr>
                                <th scope="row">{{ $eve->id }}</th>
                                <td>{{ $eve->name }}</td>
                                <td>{{ $eve->description }}</td>
                                <td>{{ $eve->venue }}</td>
                                <td>{{ $eve->capacity }}</td>
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
                                    <button data-myend="{{ date('Y-m-d H:i:s', strtotime($eve->end) ) }}" data-mystart="{{ date('Y-m-d H:i:s', strtotime($eve->start)) }}" data-cap="{{ $eve->capacity }}" data-venue="{{ $eve->venue }}" data-eventid="{{ $eve->id }}" data-myname="{{ $eve->name }}" data-mydesc="{{ $eve->description }}" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter2">Edit</button>
                                </td>
                                <td>
                                    <form method="POST" action="/event/{{ $eve->id }}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-warning">Delete</button>
                                    </form>
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