<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" class="bootstrap-modal-form">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                        <!-- Select2-->
                        <label>User Type</label>
                        <label class="form-control">{{Auth::user()->userGroup->name}}</label>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="exampleInputPassword1">First Name</label>
                                <input type="text" class="form-control" placeholder="Enter Firstname" name="firstname" id="firstname">
                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                                <label for="exampleInputPassword1">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Enter Middlename" name="middlename" id="middlename">
                                @if ($errors->has('middlename'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('middlename') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter Lastname" name="lastname" id="lastname">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div><!--end of the row-->
                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" placeholder="Enter Address" name="address" id="address">

                        @if ($errors->has('address'))
                            <span class="help-block">
                                 <strong>{{ $errors->first('address') }}</strong>
                             </span>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- select -->
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label>Select Gender</label>
                                <select class="form-control"  name="gender" id="gender">
                                    <option>male</option>
                                    <option>female</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                                <label for="exampleInputPassword1">Contact Number</label>
                                <input type="number" class="form-control" placeholder="Enter Contact No." name="contact_number" id="contact_number">

                                @if ($errors->has('contact_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!--end of row-->
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Email</label>
                        <label class="form-control">{{Auth::user()->email}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save">Update</button>
                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                </div>
            </form>
        </div>
    </div>
</div>