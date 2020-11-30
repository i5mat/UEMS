@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Event Participant</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Participant Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($bList) == 0)
                                <div class="alert alert-warning">
                                    <strong>Sorry!</strong> No User Found.
                                </div>
                            @else
                                @foreach($bList as $bL)
                                    <tr>
                                        <td>{{ $bL->id }}</td>
                                        <td>{{ $bL->event_name }}</td>
                                        <td>{{ $bL->user_name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
