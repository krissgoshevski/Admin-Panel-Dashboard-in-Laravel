@extends('dashboards.layouts.admin-dash-layout')

@section('title', 'Settings')

@section('content')
<center>

<div>Settings page</div>

{{Auth::user()->name }} 

</center>
@endsection