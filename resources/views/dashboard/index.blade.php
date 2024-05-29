@extends('layouts.simple.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
<style>
    .apexcharts-legend {
        padding-top: 1rem !important;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col-xxl-4 col-sm-6 box-col-6">
            <div class="card profile-box">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <div class="greeting-user">
                                <h4 class="f-w-600">Selamat Datang di Admin Kelirskin</h4>
                                <p>Yuk monitoring produkmu</p>
                            </div>
                        </div>
                        <div>
                            <div class="clockbox">
                                <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                                    <g id="face">
                                        <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                                        <path class="hour-marks"
                                            d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6">
                                        </path>
                                        <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                                    </g>
                                    <g id="hour">
                                        <path class="hour-hand" d="M300.5 298V142"></path>
                                        <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                    </g>
                                    <g id="minute">
                                        <path class="minute-hand" d="M300.5 298V67"></path>
                                        <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                    </g>
                                    <g id="second">
                                        <path class="second-hand" d="M300.5 350V55"></path>
                                        <circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
                                    </g>
                                </svg>
                            </div>
                            <div class="badge f-10 p-0" id="txt"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-auto col-xl-6 col-sm-10 box-col-10">
            <div class="row">
                <div class="col-6">
                    <div class="card small-widget">
                        <div class="card-body primary"> <span class="f-light">Pesanan</span>
                            <div class="d-flex align-items-end gap-1">
                                <h4>{{ $countOrder }}</h4><span class="font-primary f-12 f-w-500"></span>
                            </div>
                            <div class="bg-gradient">
                                <svg class="stroke-icon svg-fill">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#new-order') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card small-widget">
                        <div class="card-body warning"><span class="f-light">Reseller</span>
                            <div class="d-flex align-items-end gap-1">
                                <h4>{{ $countReseller }}</h4><span class="font-warning f-12 f-w-500"></span>
                            </div>
                            <div class="bg-gradient">
                                <svg class="stroke-icon svg-fill">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#customers') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card small-widget">
                        <div class="card-body success"><span class="f-light">Profit</span>
                            <div class="d-flex align-items-end gap-1">
                                <h4>Rp{{ number_format($totalHarga, 0, ',', '.') }}</h4><span class="font-success f-12 f-w-500"></span>
                            </div>
                            <div class="bg-gradient">
                                <svg class="stroke-icon svg-fill">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#profit') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-lg-12 box-col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="row justify-content-between gap-3 mb-3">
                        <div class="col-auto">
                            <h5>Profit Tahunan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row m-0 overall-card">
                        <div class="col-12 p-0">
                            <div class="chart-right">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card-body p-0">
                                            <div class="current-sale-container">
                                                <div id="baganTahunan"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

@section('script')
<script src="{{ asset('assets/js/clock.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/notify/index.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var options = {
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        },
        yaxis: {
            title: {
                text: 'Profit (Rp)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "Rp" + val.toLocaleString("id-ID")
                }
            }
        },
        series: [{
            name: 'Profit',
            data: @json(array_values($monthlyProfits))
        }]
    };

    var chart = new ApexCharts(document.querySelector("#baganTahunan"), options);
    chart.render();
});
</script>
@endsection