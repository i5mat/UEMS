@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description-label" class="col-md-4 col-form-label text-md-right">Description</label>

                                            <div class="col-md-6">
                                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="venue-label" class="col-md-4 col-form-label text-md-right">Venue</label>

                                            <div class="col-md-6">
                                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" required autocomplete="venue">

                                                @error('venue')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Capacity</label>

                                            <div class="col-md-6">
                                                <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" name="capacity" required autocomplete="capacity">

                                                @error('capacity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="start-date-label" class="col-md-4 col-form-label text-md-right">Start</label>

                                            <div class="col-md-6">
                                                <input id="start-date" type="datetime-local" name="start-date" value="2020-11-01T08:30" min="2020-11-01T00:00" max="2022-01-01T00:00">
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
                                    <form method="POST" action="{{ 'edit-event' }}">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group row">
                                            <label for="name-label" class="col-md-4 col-form-label text-md-right">Name</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description-label" class="col-md-4 col-form-label text-md-right">Description</label>

                                            <div class="col-md-6">
                                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="venue-label" class="col-md-4 col-form-label text-md-right">Venue</label>

                                            <div class="col-md-6">
                                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" required autocomplete="venue">

                                                @error('venue')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Capacity</label>

                                            <div class="col-md-6">
                                                <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" name="capacity" required autocomplete="capacity">

                                                @error('capacity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="start-date-label" class="col-md-4 col-form-label text-md-right">Start</label>

                                            <div class="col-md-6">
                                                <input id="start-date" type="datetime-local" name="start-date" value="2020-11-01T08:30" min="2020-11-01T00:00" max="2022-01-01T00:00">
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
                                <th scope="col">Actions</th>
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
                                <td>{{ $eve->start }}</td>
                                <td>{{ $eve->end }}</td>
                                @if(new DateTime() > new DateTime($eve->end))
                                    <td>Past</td>
                                @elseif (new DateTime($eve->start) <> new DateTime($eve->end))
                                    <td>{{ $eve->status }}</td>
                                @else
                                    <td>Not Past</td>
                                @endif
                                <td>
                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter2">Edit</button>
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
