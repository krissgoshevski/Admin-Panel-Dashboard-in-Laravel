@extends('dashboards.layouts.user-dash-layout')

@section('title', 'User Settings')

@section('content')
<center>

<div>Settings page</div>

{{Auth::user()->name }} 

</center>
@endsection