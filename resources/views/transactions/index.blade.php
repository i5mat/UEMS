@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @can('student_view')
                <div class="card">
                    <div class="card-header">
                        Points Transaction (Total Point : {{ $cList->point }})
                    </div>

                    <div class="card-body table-responsive">
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
                @endcan
                <br>

                <div class="card">
                    <div class="card-header">
                        Ranking List
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Point</th>
                                <th scope="col">Rank</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($usrlist) == 0)
                                <div class="alert alert-warning">
                                    <strong>Sorry!</strong> No Transaction Found.
                                </div>
                            @else
                                @foreach($usrlist as $uL)
                                    <tr>
                                        <td>{{ $uL->id }}</td>
                                        <td>{{ $uL->name }}</td>
                                        <td>{{ $uL->point }}</td>
                                        <td>
                                            @if($uL->point > 0 && $uL->point <= 20)
                                                NOVICE
                                            @elseif($uL->point >= 21 && $uL->point <= 40)
                                                INTERMEDIATE
                                            @elseif($uL->point >=41 && $uL->point <= 80)
                                                DISTINGUISHED
                                            @elseif($uL->point > 80)
                                                ICON
                                            @elseif($uL->point == 0)
                                                NOT AVAILABLE
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>

                <div class="d-flex justify-content-center">
                    {{ $usrlist->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
