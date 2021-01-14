@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @can('admin_view')
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
                                <th>Download</th>
                                <th>Approve</th>
                                <th>Actions</th>
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
                                        @if($u->status == 1)
                                            <button type="button" class="btn btn-danger" disabled title="cert have already approved before" >Disabled</button>
                                        @else
                                        <form action="/upload/approve/{{ $u->doc_id }}" method="POST" class="float-left">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Approve</button>
                                        </form>
                                        @endif
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
                    @can('all_except_admin_view')
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
                                        <th>Download</th>
                                        <th>Actions</th>
                                        <th>Approve Status</th>
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
                                                @if($u->status == 0)
                                                <form method="POST" action="/files/del/{{ $u->doc_id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                @else
                                                    <button disabled type="submit" class="btn btn-danger">Delete</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($u->status == 1)
                                                    <img src="/image/check.png">
                                                @else
                                                    <img src="/image/close.png">
                                                @endif
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
                    <div class="card-header">Upload certificate here!</div>
                    <div class="card-body table-responsive">
                        <form action="/files" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="text" name="title" placeholder="Title" class="form-control @error('title') is-invalid @enderror"><br>
                            <input type="text" name="description" placeholder="Short description!" class="form-control @error('description') is-invalid @enderror"><br><br>&nbsp;
                            <input type="file" name="file" class="@error('file') is-invalid @enderror">
                            <button type="submit" value="Submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
