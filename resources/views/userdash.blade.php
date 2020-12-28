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
            <div class="card">
                <div class="card-header">TEST</div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">TEST</div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            Highcharts.chart('container', {

                title: {
                    text: 'Solar Employment Growth by Sector, 2010-2016'
                },

                subtitle: {
                    text: 'Source: thesolarfoundation.com'
                },

                yAxis: {
                    title: {
                        text: 'Number of Employees'
                    }
                },

                xAxis: {
                    accessibility: {
                        rangeDescription: 'Range: 2010 to 2017'
                    }
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 2010
                    }
                },

                series: [{
                    name: 'Installation',
                    data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
                }, {
                    name: 'Manufacturing',
                    data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
                }, {
                    name: 'Sales & Distribution',
                    data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
                }, {
                    name: 'Project Development',
                    data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
                }, {
                    name: 'Other',
                    data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
        });
    </script>

@endsection