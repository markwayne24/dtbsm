@extends('layouts.user')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Requests <button class="btn btn-primary btn-addRequest">Add</button>
        </h1><br>
        <label class="bg-yellow">Yellow</label>- Pending
        <label class="bg-green">Green</label> - Approved
        <label class="bg-red">Red</label> - Declined


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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Total Approved</th>
                                <th>Date Approve/Decline</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="request-list" name="request-list">
                            @if($requests)
                                @foreach($requests as $request )
                                    <tr id="item-{{$request->id}}">
                                        <td>{{$request->id}}</td>
                                        <td>{{$request->created_at->format('m/d/Y')}} - {{$request->created_at->diffForHumans()}}</td>
                                        <td>
                                            <h4><center>
                                                    @if(\App\Models\ItemRequests::where('request_id',$request->id)->count())
                                                        {{\App\Models\ItemRequests::where('request_id',$request->id)->where('status','Approved')->count()}}/{{\App\Models\ItemRequests::where('request_id',$request->id)->count()}}
                                                    @endif
                                                </center>
                                            </h4>
                                        </td>
                                        @if($request->approved_at)
                                            <td>{{$request->approved_at or ''}} </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <button class="btn btn-info btn-flat btn-view" value="{{$request->id}}"><i class="glyphicon glyphicon-eye-open"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Total Approved</th>
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
    <script src="/assets/dist/js/requests/userRequest.js"></script>
@stop