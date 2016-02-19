@extends('layouts.admin')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User's Page
        </h1>
    </section>
    <section class="content-header">
    </section>

    <div class="container">
        <section>
            <div class="row">
                <!-- left column -->
                <div class="col-md-7">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Users</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px"></th>
                                    <th style="width: 10px">Name</th>
                                    <th style="width: 40px">Role</th>
                                    <th style="width: 10px">Actions</th>
                                </tr>

                                @foreach ($users as $user)

                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->userProfile->firstname }}</td>
                                        <td>{{$user->userGroup->name}}</td>
                                        <td>
                                            <button class="btn btn-success btn-flat"><a href="#"><i class="fa fa-pencil-square-o"></i></a></button>
                                            <button class="btn btn-info btn-flat"><a href="#"><i class="fa fa-pencil-square-o"></i></a></button>
                                            <button class="btn btn-danger btn-flat"><a href="#"><i class="fa fa-trash-o"></i></a></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li>{!! $users->render() !!}</li>
                            </ul>
                        </div>
                    </div><!-- /.box -->
                </div>

                <!-- right column -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registration Form</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif

                        <form role="form" method="POST" action="users">
                            {{ csrf_field() }}

                            <div class="box-body">
                                <!-- select -->
                                <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                                    <label>User Type</label>
                                    <select class="form-control"  name="group_id">

                                        @foreach ($usertypes as $usertype)
                                            <option>{{ $usertype->name }}</option>
                                        @endforeach

                                    </select>

                                    @if ($errors->has('group_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('group_id') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Firstname" name="firstname">

                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Middlename" name="middlename">

                                    @if ($errors->has('middlename'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('middlename') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Lastname" name="lastname">

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Address" name="address">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                    @endif

                                </div>

                                <!-- select -->
                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label>Select Gender</label>
                                    <select class="form-control"  name="gender">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>

                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">Contact Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Contact No." name="contact_number">

                                    @if ($errors->has('contact_number'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('contact_number') }}</strong>
                                            </span>
                                    @endif
                                </div>


                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">Password</label>

                                        <input type="password" class="form-control" placeholder="Enter Password" name="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">Confirm Password</label>

                                    <input type="password" class="form-control" placeholder="Re-type Password" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div><!-- /.box -->
                </div> <!-- end of right pane-->
            </div>
        </section>
    </div>
</div>
@stop

