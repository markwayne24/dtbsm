<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Items
        </h1>
    </section>
    <section>
        @if(\Session::has('flash_message'))
            <div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
        @endif
    </section>
    <section>
        @include('admin.items.items.form')
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lists of Items
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
                                <th>Types</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="item-list" name="item-list">
                            @foreach($items as $item)
                                <tr id="item-{{$item->id}}">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->itemTypes->name or ''}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <button class="btn btn-info btn-flat open-modal-edit" value="{{$item->id}}"><i class="fa fa-pencil-square-o"></i></button>
                                        <button class="btn btn-danger btn-flat dialog-show-button deleteModal" value="{{$item->id}}" data-show-dialog="my-confirm-dialog"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Types</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        <div id="my-confirm-dialog" class="dialog-overlay">
                            <div class="dialog-card">
                                <div class="dialog-question-sign"><i class="fa fa-question"></i></div>
                                <div class="dialog-info">
                                    <h5>Are you sure you want to delete this?</h5>
                                    <button class="dialog-confirm-button delete-item" id="deleteItem" value="{{$item->id}}">Yes</button>
                                    <button class="dialog-reject-button">No</button>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->