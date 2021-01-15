<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="/image/Logo_UTeM_kecil.png"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">

    {{-- FullCalendar --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>

    {{-- HighCharts --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        #preview{
            width:890px;
            height: 500px;
            margin:0px auto;
        }

        #myInput {
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        /*body {*/
        /*    background: rgb(0,255,255);*/
        /*    background: linear-gradient(90deg, rgba(0,255,255,0.8239670868347339) 0%, rgba(255,255,255,1) 50%, rgba(0,212,255,0.6671043417366946) 100%);*/
        /*}*/
    </style>

    <style>
        @import 'https://code.highcharts.com/css/highcharts.css';

        .highcharts-pie-series .highcharts-point {
            stroke: #EDE;
            stroke-width: 2px;
        }
        .highcharts-pie-series .highcharts-data-label-connector {
            stroke: silver;
            stroke-dasharray: 2, 2;
            stroke-width: 2px;
        }

        .highcharts-figure, .highcharts-data-table table {
            min-width: 320px;
            max-width: 600px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        /* LOL */

        .highcharts-figure, .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                @guest
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="/image/logo_utem_kecil.png" width="50" height="50">
                </a>
                @endguest

                @if (Auth::check())
                    @if (Auth::user()->hasAnyRoles(['admin']))
                        <a class="navbar-brand" href="{{ url('/admin/users') }}">
                            <img src="/image/logo_utem_kecil.png" width="50" height="50">
                        </a>
                    @elseif (Auth::user()->hasAnyRoles(['organizer']))
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <img src="/image/logo_utem_kecil.png" width="50" height="50">
                        </a>
                    @elseif (Auth::user()->hasAnyRoles(['user']))
                        <a class="navbar-brand" href="{{ url('/user/dashboard') }}">
                            <img src="/image/logo_utem_kecil.png" width="50" height="50">
                        </a>
                    @endif
                @endif

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @can('student_view')
                                        <a class="dropdown-item" href="{{ route('user_profile') }}">
                                            Profile
                                        </a>
                                    @endcan

                                    @can('admin_view')
                                        <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                            User Management
                                        </a>
                                    @endcan

                                    @can('admin_organizer_view')
                                    <a class="dropdown-item" href="{{ route('event') }}">
                                        Event
                                    </a>
                                    @endcan

                                    @can('student_view')
                                    <a class="dropdown-item" href="{{ route('attindex') }}">
                                        Attendance
                                    </a>
                                    @endcan

                                    @can('student_view')
                                    <a class="dropdown-item" href="{{ route('qrscanner') }}" onclick="scan()">
                                        QR Attendance
                                    </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('vT') }}">
                                        Points
                                    </a>

                                    @can('admin_view')
                                    <a class="dropdown-item" href="{{ route('reporting') }}">
                                        System Reporting
                                    </a>
                                    @endcan

                                    @can('admin_user_view')
                                    <a class="dropdown-item" href="{{ route('show_cert') }}">
                                        Certificate
                                    </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('show_calendar') }}">
                                        Calendar
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid w-50">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>

<script src="{{asset('js/app.js')}}"></script>
<script>
    $('#exampleModalCenter2').on('show.bs.modal', function (event) {

        console.log('Modal Open')
        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('myname') // Extract info from data-* attributes
        var desc = button.data('mydesc') // Extract info from data-* attributes
        var eveid = button.data('eventid') // Extract info from data-* attributes

        var venue = button.data('venue') // Extract info from data-* attributes
        var cap = button.data('cap') // Extract info from data-* attributes
        var start = button.data('mystart') // Extract info from data-* attributes
        var end = button.data('myend') // Extract info from data-* attributes
        var event_type = button.data('myeventtype') // Extract info from data-* attributes
        var event_level = button.data('myeventlevel') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)

        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #description').val(desc);
        modal.find('.modal-body #eveid').val(eveid);

        modal.find('.modal-body #venue').val(venue);
        modal.find('.modal-body #capacity').val(cap);
        modal.find('.modal-body #startdate').val(start);
        modal.find('.modal-body #enddate').val(end);
        modal.find('.modal-body #event_types').val(event_type);
        modal.find('.modal-body #event_levels').val(event_level);

        document.cookie = 'name='.concat(event_type);
    })
</script>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
        function scan() {
        document.getElementById("openBtn").disabled = true;
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            console.log(content);
            if(content!=''){
                $.post('https://uems.test/api/scan',{data:content, "_token": "{{ csrf_token() }}",},function(response){
                    if(response.info=='ok'){
                        scanner.stop()
                        $('#nbre').html(response.msg.capacity)
                        $('#eve').html(response.msg.event_name)
                        $('#stats').html(response.msg.status)
                        alert("ATTENDANCE RECORDED");
                        scan();

                    }else if(response.info=='ko'){
                        alert("ATTENDANCE HAVE ALREADY BEEN RECORDED. PLEASE TRY AGAIN");
                    }else if(response.info=='passed'){
                        alert("Event DateTime Passed. Please SCAN for a VALID event.");
                    }
                    else
                        alert("QR IS INVALID. PLEASE TRY AGAIN");
                    console.log(response.msg)
                })
            }
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
        }
    </script>

</body>
</html>
