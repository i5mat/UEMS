@extends('layouts.app')

@section('content')
    <div class="card table-responsive">
        <div class="card-body">
            <img src="/image/logo_utem_2.png" style="width:1024px;height:206px;">
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-center">
                        <p><img src="/image/schedule.png"></p>
                        <h3 style="font-variant: small-caps;">Calendar</h3>
                        <a href="/calendar"><button type="button" class="btn btn-success">Go</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-center">
                        <p><img src="/image/sports-stadium.png"></p>
                        <h3 style="font-variant: small-caps;">Events</h3>
                        <a href="/event"><button type="button" class="btn btn-success">Go</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-center">
                        <p><img src="/image/certificate.png"></p>
                        <h3 style="font-variant: small-caps;">Certificate</h3>
                        <a href="/upload"><button type="button" class="btn btn-success">Go</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-center">
                        <p><img src="/image/rotation.png"></p>
                        <h3 style="font-variant: small-caps;">Appointment</h3>
                        <a href="/appoint"><button type="button" class="btn btn-success">Go</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <div id="d"></div>
        </div>
    </div>

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            var k = @json($evecount122->count());
            var k2 = @json($evecount111->count());
            var k3 = @json($evecount100->count());
            var k4 = @json($evecount99->count());
            var k5 = @json($evecount88->count());
            var k6 = @json($evecount77->count());
            var k7 = @json($evecount66->count());
            var k8 = @json($evecount55->count());
            var k9 = @json($evecount44->count());
            var k10 = @json($evecount33->count());
            var k11 = @json($evecount22->count());
            var k12 = @json($evecount11->count());
            var name = @json($username);

            Highcharts.chart('d', {

                chart: {
                    styledMode: true
                },

                title: {
                    text: 'Total Events Created Per Month ' + name
                },

                xAxis: {
                    categories: [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'
                    ]
                },

                series: [{
                    type: 'pie',
                    allowPointSelect: true,
                    keys: ['name', 'y', 'selected', 'sliced'],
                    data: [
                        ['January', k, false],
                        ['February', k2, false],
                        ['March', k3, false],
                        ['April', k4, false],
                        ['May', k5, false],
                        ['June', k6, false],
                        ['July', k7, false],
                        ['August', k8, false],
                        ['September', k9, false],
                        ['October', k10, false],
                        ['November', k11, false],
                        ['December', k12, false]
                    ],
                    showInLegend: true
                }]
            });
        });
    </script>
@endsection
