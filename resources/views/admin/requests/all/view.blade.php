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
                                <label>Date Approved: {{$requested->approved_at}}</label>
                            </h3>
                        </div>
                        <div class="box-header with-border">
                            <div class="box-header pull-right">
                                @if(file_exists('uploads/' .  $requested->user->id . '.jpg'))
                                    <img class="profile-user-img img-responsive img-circle" src="/uploads/{{  $requested->user->id . '.jpg'}}" alt="User profile picture">
                                @else
                                    @if($requested->user->userProfile->gender == "male")
                                        <img class="profile-user-img img-responsive img-circle" src="/assets/dist/img/avatar5.png" alt="User profile picture">
                                    @elseif($requested->user->userProfile->gender == "female")
                                        <img class="profile-user-img img-responsive img-circle" src="/assets/dist/img/avatar2.png" alt="User profile picture">
                                    @endif
                                @endif
                            </div>
                            <h4>
                                <label>Name: {{$requested->user->userProfile->lastname}}, {{$requested->user->userProfile->firstname}} {{$requested->user->userProfile->middlename}}.</label>
                            </h4>
                            <h5>
                                <label>District: {{$requested->district}}</label>
                            </h5>
                            <h5>
                                <label>School: {{$requested->school}}</label>
                            </h5>
                            <h4>
                                <label>Total Amount: P {{number_format($total_amount,2)}}</label>
                            </h4>

                            <h4>
                                <label>Amount Approved: P {{number_format($total_approved,2)}}</label>
                            </h4>
                            <label class="bg-yellow">Yellow</label>- Pending
                            <label class="bg-green">Green</label> - Approved
                            <label class="bg-red">Red</label> - Declined
                        </div><!-- /.box-body --></br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Item</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Reason</th>
                            </tr>
                            </thead>
                            <tbody id="itemRequest-list">
                            @if($requests)
                                @foreach($requests as $request )
                                    <tr id="item-{{$request->id}}">
                                        <td>{{$request->id}}</td>
                                        <td>{{$request->inventory->items->name}}</td>
                                        <td>{{$request->inventory->sku}}</td>
                                        <td>P {{number_format($request->price,2)}}</td>
                                        <td>{{$request->quantity}}</td>
                                        <td>P {{number_format($request->quantity * $request->price,2)}}</td>
                                        <td>
                                            @if($requested->approved_at)
                                                @if($request->status == 'Approved')
                                                    <label class="bg-green">Approved</label>
                                                @else($request->status == "Declined")
                                                    <label class="bg-red">Declined</label>
                                                @endif
                                            @else
                                                <div class="radio">
                                                    <label><input type="radio" class="statusApproved" name="status{{$request->id}}" id="statusApproved{{$request->id}}" value="{{$request->id}}" checked>Approve</label>
                                                    <label><input type="radio" class="statusDeclined" name="status{{$request->id}}" id="statusDeclined{{$request->id}}" value="{{$request->id}}">Decline</label>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($requested->approved_at)
                                                @if($request->status == 'Approved')

                                                @else($request->status == "Declined")
                                                    {{$request->reason}}
                                                @endif
                                            @else

                                                <input type= text class="form-control" id="reason-{{$request->id}}" name="reason" min="1" disabled>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="box-footer">
                            <div class="box-tools pull-right">
                                <td>
                                    @if($request->requests->approved_at)
                                        <a href="{{url('/admin/dashboard/requests/'.$request->requests->district)}}" class="btn btn-primary btn-flat">Back</a>
                                    @else
                                        <button type="submit" class="btn btn-primary btn-flat btn-save" value="{{$request->request_id}}" id="save">Continue</button>
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