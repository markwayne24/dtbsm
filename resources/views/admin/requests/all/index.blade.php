
@extends('layouts.admin')

@section('style')
    <style>
        #imgSize{
            width: 50px;
            height: 50px;
        }
    </style>
@stop

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Requests
        </h1><br>
    </section>
    <section>
        @if(\Session::has('flash_message'))
            <div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
        @endif
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h4 class="box-title">
                            <label>District: {{$district_id}} </label></br>
                            <label>Approved Amount: P{{number_format($total_price,2)}}</label>
                        </h4>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>School</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>No. of approved</th>
                                <th>Date Approve/Decline</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="request-list" name="request-list">
                            @if($requests)
                                @foreach($requests as $request )
                                    @if($request)
                                        <tr id="item-{{$request->id}}">
                                            <td>{{$request->id}}</td>
                                            <td>{{$request->user->userProfile->school}}</td>
                                            <td>
                                                @if(file_exists('uploads/' .  $request->user->id . '.jpg'))
                                                    <img class="profile-user-img img-responsive img-circle" id="imgSize" src="/uploads/{{  $request->user->id . '.jpg'}}" alt="User Image">
                                                @else
                                                    @if($request->user->userProfile->gender == "male")
                                                        <img class="profile-user-img img-responsive img-circle" id="imgSize" src="/assets/dist/img/avatar5.png" alt="User profile picture">
                                                    @elseif($request->user->userProfile->gender == "female")
                                                        <img class="profile-user-img img-responsive img-circle" id="imgSize" src="/assets/dist/img/avatar2.png" alt="User profile picture">
                                                    @endif
                                                @endif
                                                <center>{{$request->user->userProfile->lastname}},{{$request->user->userProfile->firstname}} {{$request->user->userProfile->middlename}}.</center>
                                            </td>
                                            <td>{{$request->created_at->format('m/d/Y')}} - {{$request->created_at->diffForHumans()}}</td>
                                            <th><h4><center>
                                                        @if(\App\Models\ItemRequests::where('request_id',$request->id)->count())
                                                            {{\App\Models\ItemRequests::where('request_id',$request->id)->where('status','Approved')->count()}}/{{\App\Models\ItemRequests::where('request_id',$request->id)->count()}}
                                                        @endif
                                                    </center>
                                                </h4>
                                            </th>
                                            <td>{{$request->approved_at or ''}}</td>
                                            <td>
                                                <button class="btn btn-info btn-flat btn-view" value="{{$request->id}}"><i class="glyphicon glyphicon-eye-open"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>School</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>No. of approved</th>
                                <th>Date Approve/Decline</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop


@section('scripts')
    <script src="/assets/dist/js/requests/requests.js"></script>
@stop