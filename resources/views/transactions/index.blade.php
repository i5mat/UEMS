@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Points Transaction (Total Point : {{ $cList->point }} )</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Description</th>
                                <th scope="col">Point</th>
                                <th scope="col">Date Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($bList) == 0)
                                <div class="alert alert-warning">
                                    <strong>Sorry!</strong> No Transaction Found.
                                </div>
                            @else
                                @foreach($bList as $bL)
                                    <tr>
                                        <td>{{ $bL->id }}</td>
                                        <td>{{ $bL->description }}</td>
                                        <td>{{ $bL->user_point }}</td>
                                        <td>{{ date('d/m/Y H:i A', strtotime($bL->created_at)) }}</td>
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
