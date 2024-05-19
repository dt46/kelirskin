@extends('layouts.simple.master')

@section('title', 'Titik Sebar Reseller')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/mapsjs-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css') }}">
    <style>
        #map {
            height: 500px;
            position: relative;
            z-index: 0;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Titik Sebar Reseller</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Maps</li>
    <li class="breadcrumb-item active">Location</li>
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Form pencarian --}}
        <div class="row mb-3">
            <div class="col-md-12 d-flex align-items-center">
                <form id="searchForm" class="d-flex flex-grow-1">
                    <input type="text" id="searchInput" placeholder="Cari kota atau kecamatan..." class="form-control flex-grow-1">
                    <button type="submit" class="btn btn-primary ml-2">Cari</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Titik Penyebaran Reseller</h5>
                        </div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- Skrip untuk memuat peta dan GeoJSON --}}
    <script src="{{ asset('assets/js/map-js/mapsjs-core.js') }}"></script>
    <script src="{{ asset('assets/js/map-js/mapsjs-service.js') }}"></script>
    <script src="{{ asset('assets/js/map-js/mapsjs-ui.js') }}"></script>
    <script src="{{ asset('assets/js/map-js/mapsjs-mapevents.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet/leaflet.js') }}"></script>    
    <script>
        var geojsonData = {!! $geojson !!};
        var map = L.map('map').setView([-6.200000, 106.816666], 10); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var geoJsonLayer = L.geoJSON(geojsonData, {
            pointToLayer: function (feature, latlng) {
                var marker = L.marker(latlng);
                var popupContent = '';
                for (var key in feature.properties) {
                    popupContent += key + ': ' + feature.properties[key] + '<br>';
                }
                marker.bindPopup(popupContent);
                return marker;
            }
        }).addTo(map);

        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var matchedFeatures = [];

            geoJsonLayer.eachLayer(function(layer) {
                var properties = layer.feature.properties;
                for (var key in properties) {
                    if (properties[key].toString().toLowerCase().includes(searchInput)) {
                        matchedFeatures.push(layer);
                        break;
                    }
                }
            });

            if (matchedFeatures.length > 0) {
                var group = new L.featureGroup(matchedFeatures);
                map.fitBounds(group.getBounds());
                matchedFeatures.forEach(function(layer) {
                    layer.openPopup();
                });
            } else {
                alert('No matches found');
            }
        });
    </script>
@endsection
