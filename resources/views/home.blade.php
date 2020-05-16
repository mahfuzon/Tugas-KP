@extends('template.template')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Welcome {{ Auth::user()->level}}</h1>
    </div>
</div>
@endsection
