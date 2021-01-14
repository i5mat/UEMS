@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                    <div class="card text-center">
                        <div class="card-header">
                            Rank
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Novice</th>
                                    <th scope="col">Intermediate</th>
                                    <th scope="col">Distinguished</th>
                                    <th scope="col">Icon</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>
                                                <= 20
                                                <br><br>
                                                <img src="/image/intermediate.png" style="width:120px;height:150px;">
                                            </td>
                                            <td>
                                                <= 40
                                                <br><br>
                                                <img src="/image/distinguished.png" style="width:120px;height:150px;">
                                            </td>
                                            <td>
                                                <= 80
                                                <br><br>
                                                <img src="/image/icon.png" style="width:150px;height:150px;">
                                            </td>
                                            <td>
                                                80 and above
                                                <br><br>
                                                <img src="/image/trophy.png" style="width:150px;height:150px;">
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>

                <div class="card text-center">
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
                                                <img src="/image/intermediate.png" style="width:70px;height:90px;">
                                            @elseif($uL->point >= 21 && $uL->point <= 40)
                                                <img src="/image/distinguished.png" style="width:70px;height:90px;">
                                            @elseif($uL->point >=41 && $uL->point <= 80)
                                                <img src="/image/icon.png" style="width:80px;height:80px;">
                                            @elseif($uL->point > 80)
                                                <img src="/image/trophy.png" style="width:80px;height:80px;">
                                            @elseif($uL->point == 0)
                                                <img src="/image/depression.png" style="width:80px;height:80px;">
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

                <br>

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

            </div>
        </div>
    </div>
@endsection
