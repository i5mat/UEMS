@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-center">
                        <p><img src="/image/qr-code.png"></p>
                        <h3 style="font-variant: small-caps;">QR Scanner</h3>
                        <a href="/qr"><button type="button" class="btn btn-success">Go</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body text-center">
                        <p><img src="/image/immigration.png"></p>
                        <h3 style="font-variant: small-caps;">Attendance</h3>
                        <a href="/attendance"><button type="button" class="btn btn-success">Go</button></a>
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
                        <p><img src="/image/rating.png"></p>
                        <h3 style="font-variant: small-caps;">Points</h3>
                        <a href="/transaction"><button type="button" class="btn btn-success">Go</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <div id="container"></div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card text-center">
                <div class="card-header">Your QR</div>
                <div class="card-body">
                    {!! QrCode::size(150)->generate(\Auth::id()); !!}
                </div>
                <a target="_blank" href="https://api.qrserver.com/v1/create-qr-code/?data={{ \Auth::id() }}&amp;size=350x350" class="btn btn-primary">Download</a>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card text-center">
                <div class="card-header">Current Rank ({{ $usr->point }} points)</div>
                <div class="card-body">

                        @if($usr->point > 0 && $usr->point <= 20)
                            <h3 style="font-variant: small-caps;">Novice</h3>
                            <img src="/image/intermediate.png" style="width:120px;height:150px;">
                        @elseif($usr->point >= 21 && $usr->point <= 40)
                            <h3 style="font-variant: small-caps;">INTERMEDIATE</h3>
                            <img src="/image/distinguished.png" style="width:120px;height:150px;">
                        @elseif($usr->point >=41 && $usr->point <= 80)
                            <h3 style="font-variant: small-caps;">DISTINGUISHED</h3>
                            <img src="/image/icon.png" style="width:150px;height:150px;">
                        @elseif($usr->point > 80)
                            <h3 style="font-variant: small-caps;">ICON</h3>
                            <img src="/image/trophy.png" style="width:150px;height:150px;">
                        @elseif($usr->point == 0)
                            <h3 style="font-variant: small-caps;">NOT AVAILABLE</h3>
                            <img src="/image/depression.png" style="width:150px;height:150px;">
                        @endif
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            var name = @json($username);
            var queryF1 = @json($queryFaculty1->count());
            var queryF2 = @json($queryFaculty2->count());
            var queryF3 = @json($queryFaculty3->count());
            var queryF4 = @json($queryFaculty4->count());
            var queryF5 = @json($queryFaculty5->count());
            var queryF6 = @json($queryFaculty6->count());
            var queryF7 = @json($queryFaculty7->count());
            var queryF8 = @json($queryFaculty8->count());
            var queryF9 = @json($queryFaculty9->count());
            var queryF10 = @json($queryFaculty10->count());
            var queryF11 = @json($queryFaculty11->count());
            var queryF12 = @json($queryFaculty12->count());

            var queryC1 = @json($queryCollege1->count());
            var queryC2 = @json($queryCollege2->count());
            var queryC3 = @json($queryCollege3->count());
            var queryC4 = @json($queryCollege4->count());
            var queryC5 = @json($queryCollege5->count());
            var queryC6 = @json($queryCollege6->count());
            var queryC7 = @json($queryCollege7->count());
            var queryC8 = @json($queryCollege8->count());
            var queryC9 = @json($queryCollege9->count());
            var queryC10 = @json($queryCollege10->count());
            var queryC11 = @json($queryCollege11->count());
            var queryC12 = @json($queryCollege12->count());

            var queryU1 = @json($queryUtem1->count());
            var queryU2 = @json($queryUtem2->count());
            var queryU3 = @json($queryUtem3->count());
            var queryU4 = @json($queryUtem4->count());
            var queryU5 = @json($queryUtem5->count());
            var queryU6 = @json($queryUtem6->count());
            var queryU7 = @json($queryUtem7->count());
            var queryU8 = @json($queryUtem8->count());
            var queryU9 = @json($queryUtem9->count());
            var queryU10 = @json($queryUtem10->count());
            var queryU11 = @json($queryUtem11->count());
            var queryU12 = @json($queryUtem12->count());

            var queryN1 = @json($queryNegeri1->count());
            var queryN2 = @json($queryNegeri2->count());
            var queryN3 = @json($queryNegeri3->count());
            var queryN4 = @json($queryNegeri4->count());
            var queryN5 = @json($queryNegeri5->count());
            var queryN6 = @json($queryNegeri6->count());
            var queryN7 = @json($queryNegeri7->count());
            var queryN8 = @json($queryNegeri8->count());
            var queryN9 = @json($queryNegeri9->count());
            var queryN10 = @json($queryNegeri10->count());
            var queryN11 = @json($queryNegeri11->count());
            var queryN12 = @json($queryNegeri12->count());

            var queryK1 = @json($queryKebangsaan1->count());
            var queryK2 = @json($queryKebangsaan2->count());
            var queryK3 = @json($queryKebangsaan3->count());
            var queryK4 = @json($queryKebangsaan4->count());
            var queryK5 = @json($queryKebangsaan5->count());
            var queryK6 = @json($queryKebangsaan6->count());
            var queryK7 = @json($queryKebangsaan7->count());
            var queryK8 = @json($queryKebangsaan8->count());
            var queryK9 = @json($queryKebangsaan9->count());
            var queryK10 = @json($queryKebangsaan10->count());
            var queryK11 = @json($queryKebangsaan11->count());
            var queryK12 = @json($queryKebangsaan12->count());

            var queryA1 = @json($queryAntarabangsa1->count());
            var queryA2 = @json($queryAntarabangsa2->count());
            var queryA3 = @json($queryAntarabangsa3->count());
            var queryA4 = @json($queryAntarabangsa4->count());
            var queryA5 = @json($queryAntarabangsa5->count());
            var queryA6 = @json($queryAntarabangsa6->count());
            var queryA7 = @json($queryAntarabangsa7->count());
            var queryA8 = @json($queryAntarabangsa8->count());
            var queryA9 = @json($queryAntarabangsa9->count());
            var queryA10 = @json($queryAntarabangsa10->count());
            var queryA11 = @json($queryAntarabangsa11->count());
            var queryA12 = @json($queryAntarabangsa12->count());

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Frequency of Monthly Involvement ' + name
                },
                subtitle: {
                    text: 'Source: Pusat Sukan UTeM'
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
                        text: 'Total'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
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
                    name: 'FAKULTI',
                    data: [queryF1, queryF2, queryF3, queryF4, queryF5, queryF6, queryF7, queryF8, queryF9, queryF10, queryF11, queryF12]

                }, {
                    name: 'KOLEJ',
                    data: [queryC1, queryC2, queryC3, queryC4, queryC5, queryC6, queryC7, queryC8, queryC9, queryC10, queryC11, queryC12]

                }, {
                    name: 'UTeM',
                    data: [queryU1, queryU2, queryU3, queryU4, queryU5, queryU6, queryU7, queryU8, queryU9, queryU10, queryU11, queryU12]

                }, {
                    name: 'NEGERI',
                    data: [queryN1, queryN2, queryN3, queryN4, queryN5, queryN6, queryN7, queryN8, queryN9, queryN10, queryN11, queryN12]

                }, {
                    name: 'KEBANGSAAN',
                    data: [queryK1, queryK2, queryK3, queryK4, queryK5, queryK6, queryK7, queryK8, queryK9, queryK10, queryK11, queryK12]

                }, {
                    name: 'ANTARABANGSA',
                    data: [queryA1, queryA2, queryA3, queryA4, queryA5, queryA6, queryA7, queryA8, queryA9, queryA10, queryA11, queryA12]

                }]
            });
        });
    </script>

@endsection
