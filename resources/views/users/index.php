@extends('layouts.user')

@section('content')
    Welcome home {{ Auth::user()->userProfile->firstname }}
@stop