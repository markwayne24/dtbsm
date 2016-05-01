@extends('layouts.admin')

@section('style')
    <style>
        .modal-header{
            background-color: #337ab7;
            color: white;
            font-weight: bold;
        }
    </style>
@stop

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Item Requests
        </h1>
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
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                    <label>Date: {{$requested->created_at->format('m/d/Y')}} - {{$requested->created_at->diffForHumans()}}</label>
                            </h3>
                            <h3 class="box-title pull-right">
                                <label>Status: {{$requested->status}}</label>
                            </h3>
                        </div>
                        <div class="box-header with-border">
                            <h4>
                                <label>Name: {{$requested->user->userProfile->firstname}}, {{$requested->user->userProfile->firstname}} {{$requested->user->userProfile->middlename}}.</label>
                            </h4>
                            <h5>
                                <label>District: {{$requested->district}}</label>
                            </h5>
                            <h5>
                                <label>School: {{$requested->school}}</label>
                            </h5>
                                    <label>Reason if declined: {{$requested->reason}}</label>
                        </div><!-- /.box-body --></br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Item</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody id="itemRequest-list">
                            @if($requests)
                                @foreach($requests as $request )
                                    <tr id="item-{{$request->id}}">
                                        <td>{{$request->id}}</td>
                                        <td>{{$request->inventory->items->name}}</td>
                                        <td>{{$request->inventory->sku}}</td>
                                        <td>{{$request->inventory->price}}</td>
                                        <td>{{$request->inventory->stocks}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Item</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="box-footer">
                            <div class="box-tools pull-right">
                                <td>
                                    @if($request->requests->status == 'Pending')
                                        <button class="btn btn-success btn-flat btn-approved" value="{{$request->request_id}}" name="Approved">Approve</button>
                                        <button class="btn btn-danger btn-flat btn-declined" value="{{$request->request_id}}" name="Declined">Decline</button>
                                    @else
                                        <a href="{{url('/admin/dashboard/requests/'.$request->requests->district)}}" class="btn btn-primary btn-flat">Back</a>
                                    @endif
                                </td>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reason</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            <textarea class="form-control" id="reason"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat btn-save" value="{{$request->request_id}}" id="save">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.content-wrapper -->
@stop


@section('scripts')
    <script src="/assets/dist/js/requests/requests.js"></script>
@stop