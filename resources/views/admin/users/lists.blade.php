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
        @include('admin.users.form')
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lists of Users
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
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->userGroup->name}}</td>
                                    <td>{{$user->userProfile->lastname}}, {{$user->userProfile->firstname}} {{$user->userProfile->middlename}}. </td>
                                    <td>{{$user->email}} </td>
                                    <td>
                                        <button class="btn btn-success btn-flat"><a href="#"><i class="fa fa-pencil-square-o"></i></a></button>
                                        <button class="btn btn-info btn-flat"><a href="#"><i class="fa fa-pencil-square-o"></i></a></button>
                                        <button class="btn btn-danger btn-flat"><a href="#"><i class="fa fa-trash-o"></i></a></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
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