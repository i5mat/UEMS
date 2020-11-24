
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Attendance</div>
                        <button class="btn btn-outline-primary" onclick="scan()" >Scanner Mon Qrcode</button>

                    <div class="card-body">
                        <video id="preview"></video><br>
                            Total Capacity : <span id="nbre"></span>
                            <br>Event name : <span id="eve"></span>
                            <br>Status     : <span id="stats"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
