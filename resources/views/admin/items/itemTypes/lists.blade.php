<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Item Types
        </h1>
    </section>
    <section>
        @if(\Session::has('flash_message'))
            <div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
        @endif
    </section>
    <section>
        @include('admin.items.itemTypes.form')
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List of Type of Items
                            <!-- Button trigger modal -->
                            <button type="button" class="bootstrap-modal-form-open btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-plus"></i>
                                Create
                            </button>
                        </h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Item Types</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($types as $type)
                                <tr id="type-{{$type->id}}">
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <button class="btn btn-info btn-flat open-modal-edit" value="{{$type->id}}"><i class="fa fa-pencil-square-o"></i></button>
                                        <button class="btn btn-danger btn-flat dialog-show-button deleteModal" value="{{$type->id}}" data-show-dialog="my-confirm-dialog"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Item Types</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        <div id="my-confirm-dialog" class="dialog-overlay">
                            <div class="dialog-card">
                                <div class="dialog-question-sign"><i class="fa fa-question"></i></div>
                                <div class="dialog-info">
                                    <h5>Are you sure you want to delete this?</h5>
                                    <button class="dialog-confirm-button delete-item" id="deleteItem" value="{{$type->id}}">Yes</button>
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