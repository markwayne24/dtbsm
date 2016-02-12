@extends('layouts.admin')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users Page
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <div class="container">
        <section>
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registration Form</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="dashboard/users">
                            {{ csrf_field() }}

                            <div class="box-body">
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

                                    @if ($errors->has('middlename'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
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

                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="email" class="form-control" placeholder="Enter Address" name="address">

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

                                <div class="form-group{{ $errors->has('mobilenum') ? ' has-error' : '' }}">
                                    <label for="exampleInputPassword1">Mobile No.</label>
                                    <input type="password" class="form-control" placeholder="Password" name="mobilenum">

                                    @if ($errors->has('mobilenum'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mobilenum') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Upload picture</label>
                                    <input type="file" id="exampleInputFile">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div><!-- /.box -->
                </div> <!-- end of right pane-->

                <!-- right column -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">List of Users</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px"></th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th style="width: 40px">Access Rights</th>
                                </tr>

                                @foreach ($users as $user)

                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>
                                        <span class="badge bg-blue">{{ $user->mobilenum }}</span>
                                    </td>
                                    <td>
                                        {{$user->userGroup->name}}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div><!-- /.box -->
                </div>
            </div>
        </section>
    </div>
</div>
@stop

