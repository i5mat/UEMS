@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @can('manage-users')
                <div class="card">

                    <div class="card-header">Show uploaded certificate</div>

                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>By</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($aList as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $u->title }}</td>
                                    <td>{{ $u->description }}</td>
                                    <td>{{ $u->stud_name }}</td>
                                    <td>
                                        <a href="/file/download/{{ $u->file }}">
                                            <button class="btn btn-primary">Download</button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="" method="POST" class="float-left">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Approve</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="/files/del/{{ $u->doc_id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @endcan
                <br>
                    @can('student_view')
                        <div class="card">

                            <div class="card-header">Show uploaded certificate</div>

                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>By</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($bList as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $u->title }}</td>
                                            <td>{{ $u->description }}</td>
                                            <td>{{ $u->stud_name }}</td>
                                            <td>
                                                <a href="/file/download/{{ $u->file }}">
                                                    <button class="btn btn-primary">Download</button>
                                                </a>
                                            </td>
                                            <td>
                                                <form method="POST" action="/files/del/{{ $u->doc_id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    @endcan
                <br>
                <div class="card">

                    <div class="card-header">Upload your certificate here!</div>

                    <div class="card-body table-responsive">
                        <form action="/files" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="text" name="title" placeholder="Title" class="form-control"><br>
                            <input type="text" name="description" placeholder="Short description!" class="form-control"><br><br>&nbsp;
                            <input type="file" name="file">
                            <button type="submit" value="Submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
