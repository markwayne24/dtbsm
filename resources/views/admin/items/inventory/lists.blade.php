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

    <section>
        @if(\Session::has('flash_message2'))
            <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove"></span><em> {!! session('flash_message2') !!}</em></div>
        @endif
    </section>
    <section>
        @include('admin.items.inventory.form')
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <!-- Button trigger modal -->
                            <button type="button" class="bootstrap-modal-form-open btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="modalFormOpen">
                                <i class="glyphicon glyphicon-plus"></i>
                                Create
                            </button>
                            </h3>

                    </div><!-- /.box-header -->
                    <h3 class="budget-left"><center>Budget Left: P {{number_format($budgetLeft->amount,2)}}</center></h3>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered .table-condensed">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($inventories)
                                @foreach($inventories as $inventory)
                                    <tr id="inventory-{{$inventory->id}}">
                                        <td>{{$inventory->id}}</td>
                                        <td>{{$inventory->items->itemTypes->categories or ''}}</td>
                                        <td>{{$inventory->items->itemTypes->name or ''}}</td>
                                        <td>{{$inventory->items->name or ''}}</td>
                                        <td>{{$inventory->sku}}</td>
                                        <td>P {{number_format($inventory->price,2)}}</td>
                                        <td>{{$inventory->stocks}}</td>
                                        <td>
                                            <button class="btn btn-info btn-flat open-modal-edit" value="{{$inventory->id}}"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-danger btn-flat btn-remove" data-toggle="modal" data-target=".bs-example-modal-sm" value="{{$inventory->id}}"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- Modal for delete -->
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="confirmBox">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Reason</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group {{ $errors->has('reason') ? ' has-error' : '' }}">
                                                <label for="message-text" class="control-label">Message:</label>
                                                <textarea class="form-control" id="reason"></textarea>
                                                @if ($errors->has('reason'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('reason') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-flat delete-item" value="" id="save">Continue</button>
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