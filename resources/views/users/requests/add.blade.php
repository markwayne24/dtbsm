@extends('layouts.user')

@section('style')
    <style>
        #alertModal, #alertModal2  {
        /*   display: block;*/
        padding-right: 0px;
        background-color: rgba(4, 4, 4, 0.8);
        }

        #modal-dialog {
        top: 20%;
        width: 100%;
        position: absolute;
        }
        #modal-content {
        border-radius: 0px;
        border: none;
        top: 40%;
        }
        #duplicate{
            background-color: #E22E2E;
            color: white;
        }
        #added{
            background-color: green;
            color: white;
        }
        #null{
            background-color: deepskyblue;
            color: white;
        }

    </style>
    @stop

    @section('content')
            <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Add Request
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($inventories)
                                    @foreach($inventories as $inventory)
                                        <tr>
                                            <td class="id">{{$inventory->id}}</td>
                                            <td class="type">{{$inventory->items->itemTypes->name or ''}}</td>
                                            <td class="name">{{$inventory->items->name or ''}}</td>
                                            <td class="sku">{{$inventory->sku}}</td>
                                            <td class="price">P {{number_format($inventory->price,2)}}</td>
                                            <td class="quantity">{{$inventory->stocks}}</td>
                                            <td>
                                                <input type="number" class=" form-control maxmin" min="1" step="1.00" value="1" max="{{$inventory->stocks}}" intOnly="true" name="quantity" id="quantity"/>
                                                <button class="btn btn-info btn-flat btn-add"  value="{{$inventory->id}}">Add</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Quantity</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- Confirmation modal -->
                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirmBox">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <h4 class="modal-header" id="gridSystemModalLabel">Are you sure you want to remove?</h4>
                                        <center>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                            <button class="btn btn-danger btn-flat delete-item" id="deleteItem" value="">Yes</button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            </div>
                                            <div class="col-sm-2"></div>
                                        </center>
                                    <div class="modal-footer">
                                </div>
                                </div>
                            </div>
                        </div><!-- end confirmation-->
                        <h3 class="box-title pull-right">
                            @if(\Carbon\Carbon::now('PHT')->isWeekday())
                                @if(\Carbon\Carbon::now('PHT')->toTimeString() >= \Carbon\Carbon::createFromFormat('H:i:s', '07:00:00')->toTimeString())
                                    @if(\Carbon\Carbon::now('PHT')->toTimeString() <= \Carbon\Carbon::createFromFormat('H:i:s', '17:00:00')->toTimeString())
                                        <button class="btn btn-primary btn-send">Send</button>
                                    @endif
                                @endif
                            @endif
                        </h3>

                       {{-- <button class="btn btn-primary btn-send">Send</button>--}}
                        <!--alert message if already exists-->
                        <div class="modal fade bs-example-modal-lg" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg" id ="modal-dialog" >
                                <div class="modal-content" id="modal-content">
                                    <div class="modal-body" id="modal-body2">
                                        <div class="message">
                                            <center><H2>It is already exists on your list</H2></center>
                                            <center> <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button></center>
                                        </div>
                                    </div>
                                </div>
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