@extends('layouts.admin')

@section('title', 'Home')

@section('content')
    @if(Auth::check())
        <div class="spacer-50"></div>
        <h2 class="center-text">Dashboard</h2>
        <hr class="my-1">
        <div class="spacer-50"></div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Centres and Attendance
                </div>
                <div class="card-block">
                    <div id="map"></div>
                    <div id="legend"><h3>Legend</h3></div>
                </div>
            </div>
        </div>
        <div class="spacer-50"></div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Western Cape
                    </div>
                    <div class="card-block">
                        <div class="col-sm-6">
                            <div>
                                <h3 class="dash_card_main">{{$children}}</h3>
                                <p class="dash_card_sub">Children</p>
                            </div>
                            <div>
                                <h3 class="dash_card_main">{{round($attendanceToday, 2)}}%</h3>
                                <p class="dash_card_sub">Att Today</p>
                            </div>
                            <div>
                                <h3 class="dash_card_main">{{$staff}}</h3>
                                <p class="dash_card_sub">Practitioners</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <h3 class="dash_card_main">{{round($attendanceThisWeek, 2)}}%</h3>
                                <p class="dash_card_sub">Att This Week</p>
                            </div>
                            <div>
                                <h3 class="dash_card_main">{{$centres}}</h3>
                                <p class="dash_card_sub">Centres</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    @if(Auth::check())
        <script src="{{ elixir('js/gmaps.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&callback=initMap"></script>
    @endif
@endsection
