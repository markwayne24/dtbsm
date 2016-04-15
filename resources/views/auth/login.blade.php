@extends('layouts.app')
@section('style')
    <style>
        .logo {
            background: rgba(0,0,0, .3);

        }
    </style>
@stop
@section('content')
    <div class="login-box">

        <div class="login-box-body">

            <h3 class="login-box-msg">DepEd Tarlac Budget and Supply Monitoring</h3>
            <div class="login-logo">
                <a href="" >
                    <img src="/assets/dist/img/logo.png" class="logo" alt="Logo">
                </a>
            </div><!-- /.login-logo -->

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="#">I forgot my password</a><br>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop
