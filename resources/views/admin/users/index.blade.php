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

                        @include('admin.users.form');
                    </div><!-- /.box -->
                </div> <!-- end of right pane-->
            </div>
        </section>
    </div>
</div>
@stop

