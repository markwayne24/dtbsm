@section('style')

@stop

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    @include('users.profile.form')
    <!-- Main content -->
    <section class="content">
        <img class="contentBg" src="/assets/dist/img/profileBg.png">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if(file_exists('uploads/' .  Auth::user()->id . '.jpg'))
                                <img class="profile-user-img img-responsive img-circle" src="/uploads/{{ Auth::user()->id . '.jpg'}}" alt="User profile picture">
                        @else
                            @if(Auth::user()->userProfile->gender == "male")
                                <img class="profile-user-img img-responsive img-circle" src="/assets/dist/img/avatar5.png" alt="User profile picture">
                            @elseif(Auth::user()->userProfile->gender == "female")
                                <img class="profile-user-img img-responsive img-circle" src="/assets/dist/img/avatar2.png" alt="User profile picture">
                            @endif
                        @endif
                            <h3 class="profile-username text-center">{{ Auth::user()->userProfile->firstname }}</h3>
                        <p class="text-muted text-center"> {{ Auth::user()->userGroup->name }}</p>
                        <button class="btn btn-primary btn-block open-modal-edit" value="{{Auth::user()->id}}"/><b>Edit Profile</b>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <form action="upload" id="upload" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="box-header">Upload image</label>
                                <input type="file" name="file" multiple><br/>
                                <input type="submit" class="btn btn-primary" value="Upload" id="clickUpload">
                            </div>
                        </div>
                    </form>
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                        <p class="text-muted">
                            B.S. in Information Technology
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                        <p class="text-muted">{{ Auth::user()->userProfile->address }}</p>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            </div>

        {{-- <button class="btn btn-primary btn-send">Send</button>--}}
        <!--alert message if already exists-->
        <div class="modal fade bs-example-modal-lg" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" id ="modal-dialog" >
                <div class="modal-content" id="modal-content">
                    <div class="modal-body" id="modal-body">
                        <div class="message">
                            <center><H2>Successfully Updated your picture</H2></center>
                            <center> <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="#"></a>.</strong> All rights reserved.
</footer>
