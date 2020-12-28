@extends('layouts.app')

@section('content')
    <div class="card table-responsive">
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>

    <script type="application/javascript">

        document.addEventListener('DOMContentLoaded', function() {
            var myArr = @json($myArray);

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '2020-12-07',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: myArr
            });

            calendar.render();
        });

    </script>
@endsection
