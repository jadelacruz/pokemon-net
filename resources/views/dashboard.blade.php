@extends('layouts.main')

@section('head')
    <meta name="jwt-token" content="{{ session('jwtToken') }}" />
@endsection

@section('content')
    <div id="app"></div>
    @vite(['resources/js/dashboard.js'])
@endsection
