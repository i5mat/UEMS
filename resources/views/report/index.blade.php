@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Reporting</div>

                    <div class="card-body">
                        <div id="c"></div>
                    </div>
                </div><br>

                <div class="card">
                    <div class="card-header">Reporting</div>

                    <div class="card-body">
                        <div id="userchart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            var k = @json($evecount12->count());
            var k2 = @json($evecount11->count());
            var k3 = @json($evecount10->count());
            var k4 = @json($evecount9->count());
            var k5 = @json($evecount8->count());
            var k6 = @json($evecount7->count());
            var k7 = @json($evecount6->count());
            var k8 = @json($evecount5->count());
            var k9 = @json($evecount4->count());
            var k10 = @json($evecount3->count());
            var k11 = @json($evecount2->count());
            var k12 = @json($evecount1->count());

            Highcharts.chart('c', {

                chart: {
                    styledMode: true
                },

                title: {
                    text: 'Total Events Created Per Month'
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

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            var k = @json($userscount->count());
            var k2 = @json($userscount1->count());
            var k3 = @json($userscount2->count());
            var k4 = @json($userscount3->count());
            var k5 = @json($userscount4->count());
            var k6 = @json($userscount5->count());
            var k7 = @json($userscount6->count());
            var k8 = @json($userscount7->count());
            var k9 = @json($userscount8->count());
            var k10 = @json($userscount9->count());
            var k11 = @json($userscount10->count());
            var k12 = @json($userscount11->count());

            Highcharts.chart('userchart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly Average Total Users'
                },
                subtitle: {
                    text: 'Source: UEMS'
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Users Registered with repliGram (n)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Users',
                    data: [k12, k11, k10, k9, k8, k7, k6, k5, k4, k3, k2, k]

                }]
            });
        });
    </script>

@endsection
