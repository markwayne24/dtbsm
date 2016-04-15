@extends('layouts.admin')

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
                                    <a href="{{ url('/users/requests') }}"><button class="btn btn-primary btn-flat">Back</button></a>
                                </td>
                            </div>
                        </div>
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