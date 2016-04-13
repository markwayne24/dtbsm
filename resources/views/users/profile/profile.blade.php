<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
        </h1>
        @if(Storage::disk('local')->has(Auth()->user()->first_name . '-' . Auth()->user()->id. '.jpg'))
            <img src="{{ route('account.image',['file' =>$user->first_name. '-' . $user->id . '.jpg']) }}">
        @endif
    </section>
    @include('users.profile.form')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if(Auth::user()->userProfile->gender == "male")
                            <img class="profile-user-img img-responsive img-circle" src="/assets/dist/img/avatar5.png" alt="User profile picture">
                        @elseif(Auth::user()->userProfile->gender == "female")
                            <img class="profile-user-img img-responsive img-circle" src="/assets/dist/img/avatar2.png" alt="User profile picture">
                        @endif
                            <h3 class="profile-username text-center">{{ Auth::user()->userProfile->firstname }}</h3>
                        <p class="text-muted text-center"> {{ Auth::user()->userGroup->name }}</p>
                        <button class="btn btn-primary btn-block open-modal-edit" value="{{Auth::user()->id}}"/><b>Edit Profile</b>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i>  Education</strong>
                        <p class="text-muted">
                            B.S. in Information Technology
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                        <p class="text-muted">{{ Auth::user()->userProfile->address }}</p>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="/assets/dist/img/avatar.png" alt="user image">
                        <span class='username'>
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
                                    <span class='description'>Shared publicly - 7:30 PM today</span>
                                </div><!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>
                                <ul class="list-inline">
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
                                    <li class="pull-right"><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                            </div><!-- /.post -->

                            <!-- Post -->
                            <div class="post clearfix">
                                <div class='user-block'>
                                    <img class='img-circle img-bordered-sm' src='/assets/dist/img/avatar2.png' alt='user image'>
                        <span class='username'>
                          <a href="#">Sarah Ross</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
                                    <span class='description'>Sent you a message - 3 days ago</span>
                                </div><!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>

                                <form class='form-horizontal'>
                                    <div class='form-group margin-bottom-none'>
                                        <div class='col-sm-9'>
                                            <input class="form-control input-sm" placeholder="Response">
                                        </div>
                                        <div class='col-sm-3'>
                                            <button class='btn btn-danger pull-right btn-block btn-sm'>Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.post -->
                        </div><!-- /.nav-tabs-custom -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.0
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="#"></a>.</strong> All rights reserved.
</footer>