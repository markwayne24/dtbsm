@extends('layouts.app')
@section('style')
    <style>
        .login-page{
            background-color: gainsboro;
        }

        .login-box-msg{
            color:black;
            font-family: "Arial Rounded MT Bold";
            text-shadow: 5px 10px 10px grey;
        }

        .login-box .login-box-body{
            box-shadow: 5px 10px 10px 2px grey;
            border-radius: 5px;
            border: 1px solid grey;
        }

        #bgImages{
            left: 10%;
            top: 10%;
            width: 80%;
            height: 70%;
            opacity: .3;
            position:absolute;
            background-repeat: no-repeat;
        }

    </style>
@stop
@section('content')
    <div class="container">
    <div class="login-box">
        <div class="login-box-body">
            <div class="login-logo">
                <a href="" >
                    <h3 class="login-box-msg"><strong>DepEd Tarlac Budget and Supply Monitoring</strong></h3>
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
        </div>
    </div><!-- /.login-box -->
@stop
