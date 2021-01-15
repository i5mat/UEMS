@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card table-responsive">
        <div class="card-body">
            <img src="/image/logo_utem_2.png" style="width:1190px;height:225px;">
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">Appointment
                    <button type="button" class="btn btn-primary float-right" style="margin:5px;" data-toggle="modal" data-target="#exampleModalCenter3">
                        Assign Role
                    </button>

                    <!-- Modal for Assign Role -->
                    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add an Assignation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <form method="POST" action="/appoint/reg" >
                                        @csrf
                                        {{ method_field('POST') }}

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">User</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="uems_users" id="uems_users">
                                                    <option disabled selected>Select Which User</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Role</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="uems_roles" id="uems_roles">
                                                    <option disabled selected>Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="capacity-label" class="col-md-4 col-form-label text-md-right">Event</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="uems_events" id="uems_events">
                                                    <option disabled selected>Select Event</option>
                                                    @foreach ($eve as $e)
                                                        <option value="{{ $e->id }}">
                                                            {{ $e->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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

                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Event</th>
                            <th scope="col">Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointment as $app)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $app->usrname }}</td>
                                <td>{{ $app->rolename }}</td>
                                <td>{{ $app->evename }}</td>
                                <td>{{ date('d-m-Y H:i A', strtotime($app->created_at)) }}</td>
                                <td>
                                    <form action="{{ route('appoint_del', $app->id) }}" method="POST" class="float-left">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-warning">Terminate</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
