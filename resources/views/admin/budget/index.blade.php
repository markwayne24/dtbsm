@extends('layouts.admin')
@section('requests')
        @stop
@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Inventory
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
                        <div class="box-header">
                            <h3 class="box-title">Budget History</h3>
                        </div><!-- /.box-header -->

                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Categories</th>
                                    <th>ItemTypes</th>
                                    <th>Items</th>
                                    <th>Reason if deleted</th>
                                    <th>Action</th>
                                    <th>Amount</th>
                                    <th>Budget Left</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($budgets)
                                    @foreach($budgets as $budget)
                                        <tr id="inventory-{{$budget->id}}">
                                            <td>{{$budget->id}}</td>
                                            <td>{{$budget->user->userProfile->lastname}},{{$budget->user->userProfile->firstname}} {{$budget->user->userProfile->middlename}}.</td>
                                            <td>{{$budget->inventory->itemTypes->categories or ''}}</td>
                                            <td>{{$budget->inventory->itemTypes->name or ''}}</td>
                                            <td>{{$budget->inventory->name or ''}}</td>
                                            <td>{{$budget->reason or ''}}
                                            <td>{{$budget->action}}</td>
                                            <td>{{$budget->amount}}</td>
                                            <td>{{$budget->budget_year}}</td>
                                            <td>{{$budget->created_at->format('m-d-Y')}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Categories</th>
                                    <th>ItemTypes</th>
                                    <th>Items</th>
                                    <th>Reason if deleted</th>
                                    <th>Action</th>
                                    <th>Amount</th>
                                    <th>Budget Left</th>
                                    <th>Date</th>
                                </tr>
                                </tfoot>
                            </table>
                            <!-- Confirmation modal -->
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirmBox">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <h4 class="modal-header" id="gridSystemModalLabel">Are you sure you want to delete?</h4>
                                        <div class="modal-body">
                                            <button class="btn btn-danger btn-flat delete-item" id="deleteItem" value="">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end confirmation-->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@stop

@section('script')

    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>

    <script type = "text/javascript">
        $(document).ready(function() {
            var table = $('#example1').DataTable();
            var tableTools = new $.fn.DataTable.TableTools(table, {
                'sSwfPath': '//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf',
                'aButtons':['copy','print']
            });
            $(tableTools.fnContainer()).insertBefore('#example1');
        });
    </script>
@stop