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
        @include('admin.items.inventory.form')
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Inventory
                            <!-- Button trigger modal -->
                            <button type="button" class="bootstrap-modal-form-open btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-plus"></i>
                                Create
                            </button></h3>
                    </div><!-- /.box-header -->

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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($inventories)
                                @foreach($inventories as $inventory)
                                    <tr id="inventory-{{$inventory->id}}">
                                        <td>{{$inventory->id}}</td>
                                        <td>{{$inventory->items->itemTypes->name}}</td>
                                        <td>{{$inventory->items->name}}</td>
                                        <td>{{$inventory->sku}}</td>
                                        <td>{{$inventory->price}}</td>
                                        <td>{{$inventory->stocks}}</td>
                                        <td>
                                            <button class="btn btn-info btn-flat open-modal-edit"  value="{{$inventory->id}}"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-danger btn-flat deleteModal" data-toggle="modal" data-target=".bs-example-modal-sm" value="{{$inventory->id}}"><i class="fa fa-trash-o"></i></button>
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
                                <th>Action</th>
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