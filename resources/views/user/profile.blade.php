@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{ __('User Profile') }}</h1></div>
                    <div class="card-body">
                        <form action="/upload" method="post" enctype="multipart/form-data">

                            @if(Auth::user()->avatar)
                                <img src="{{asset('/storage/images/'.Auth::user()->avatar)}}" 
                                alt="avatar" width="150" height="150"/>
                            @endif
                                <span class="caret"></span>
                            <h3>
                                Name : {{Auth::user()->name}}
                            </h3>

                            <h3>
                                Email :{{Auth::user()->email}}
                            </h3>

                            <h3>
                                Matrics Number :{{Auth::user()->matrics_number}}
                            </h3>
                                
                            <h4>Choose your profile picture:</h4>
                            @csrf
                            <input type="file" name="image">
                                <input type="submit" value="Upload" >
                                </input> 
                            </input>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script type="text/javascript">
   document.title = `{{ $user['name'] }}'s profile`;
</script>
