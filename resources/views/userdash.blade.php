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
                    {!! QrCode::size(250)->generate(\Auth::id()); !!}
                </div>
                <a href="https://api.qrserver.com/v1/create-qr-code/?data={{ \Auth::id() }}&amp;size=250x250" class="btn btn-primary">Download</a>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card text-center">
                <div class="card-header">Current Rank ({{ $usr->point }} points)</div>
                <div class="card-body">
                    @if($usr->point > 0 && $usr->point <= 20)
                        <h3 style="font-variant: small-caps;">Novice</h3>
                    @elseif($usr->point >= 21 && $usr->point <= 40)
                        <h3 style="font-variant: small-caps;">INTERMEDIATE</h3>
                    @elseif($usr->point >=41 && $usr->point <= 80)
                        <h3 style="font-variant: small-caps;">DISTINGUISHED</h3>
                    @elseif($usr->point > 80)
                        <h3 style="font-variant: small-caps;">ICON</h3>
                    @elseif($usr->point == 0)
                        <h3 style="font-variant: small-caps;">NOT AVAILABLE</h3>
                    @endif
                        <img src="/image/trophy.png" style="width: 250px; height: 250px;">
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            var name = @json($username);

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
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
                    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

                }, {
                    name: 'KOLEJ',
                    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

                }, {
                    name: 'UTeM',
                    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                }, {
                    name: 'NEGERI',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                }, {
                    name: 'KEBANGSAAN',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                }, {
                    name: 'ANTARABANGSA',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                }]
            });
        });
    </script>

@endsection
