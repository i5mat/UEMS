@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class=cardbody>
                        <form action="/files" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="text" name="title" placeholder="title">
                            <input type="text" name="description" placeholder="description">
                            <input type="file" name="file">
                            <input type="submit" value="Submit">
                        </form>
                    </div> 
                </div>

                <div class="card-body">

                @if(session()->has('message'))
                <div class="alert alert-success">{{session()->get('message')}}</div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
                
                </div>
                <div class="card-body">
                    <table border="1">
                        <tr>
                        <th>S1</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Download</th>
                        </tr>
                        @foreach($aList as $u)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$u->title}}</td>
                            <td>{{$u->description}}</td>
                            <td><a href="/files/{{$u->id}}">View</a></td>
                            <td><a href="/file/download/{{$u->file}}">Download</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div></div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
    <script>
	    var botmanWidget = {
	        aboutText: 'ssdsd',
	        introMessage: "✋ Hi!"
	    };
    </script>
  
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
      
@endsection
