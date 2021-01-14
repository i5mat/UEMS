
@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Attendance</div><br>
                        <button class="btn btn-outline-primary" id="openBtn" onclick="scan()" >Open QR Scanner</button>

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
