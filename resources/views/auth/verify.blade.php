@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="box-body">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Hi, {{ Auth::user()->firstname }} .Please enter your security code.</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('login/verify') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Enter Code</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="code">

                                    @if ($errors->has('code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-security"></i>Verify
                                    </button>

                                    <a class="btn btn-link" href="{{ url('#') }}">Regenerate code?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
