<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" class="bootstrap-modal-form">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Users</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                        <!-- Select2-->
                        <label>User Type</label>
                        <select class="form-control" style="width: 100%;" name="group_id" id="group_id">
                            @foreach ($usertypes as $usertype)
                                <option value="{{$usertype->id}}">{{ $usertype->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('group_id'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('group_id') }}</strong>
                                </span>
                        @endif
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
                    <div class="form-group {{ $errors->has('school') ? ' has-error' : '' }}">
                        <label>School</label>
                        <select class="form-control select" style="width: 100%;" name="school" id="school">
                            {{--District 1--}}
                            <option value="1">Sto. Cristo Integrated School</option>
                            <option value="1">Binauganan Elem. School</option>
                            <option value="1">San Nicolas Elem. School</option>
                            <option value="1">San Sebastian Elem. School</option>
                            <option value="1">San Rafael Elem. School</option>
                            {{--District 2--}}
                            <option value="2">Matatalaib Buno Elem. School</option>
                            <option value="2">Trinidad Elem. School</option>
                            <option value="2">Natividad De Leon Elem. School</option>
                            <option value="2">Panampunan Elem. School</option>
                            <option value="2">Buhilit</option>
                            {{--District 3--}}
                            <option value="3">Sta. Cruz Elem. School</option>
                            <option value="3">Aguso Central School</option>
                            <option value="3">Dalayap Elem. School</option>
                            <option value="3">Tarisi Elem. School</option>
                            <option value="3">Banaba Elem. School</option>
                            {{--District 4--}}
                            <option value="4">Sta. Marie Elem. School</option>
                            <option value="4">Mapalad Elem. School</option>
                            <option value="4">Sto. Nino Elem. School</option>
                            <option value="4">Baras-Baras Central</option>
                            <option value="4">Sto. Domingo Elem. School</option>
                            {{--District 5--}}
                            <option value="5">Suizo Bliss Elem. School</option>
                            <option value="5">Paraiso Elem. School</option>
                            <option value="5">Camp Aquino</option>
                            <option value="5">Maligaya Elem. School</option>
                            <option value="5">Ungot Elem. School</option>
                            {{--District 6--}}
                            <option value="6">San Pablo Elem. School</option>
                            <option value="6">Carangian Elem. School</option>
                            <option value="6">Balanti Elem. School</option>
                            <option value="6">San Vicente Elem. School</option>
                            <option value="6">Apalan Elem. School</option>
                            {{--District 7--}}
                            <option value="7">Care Elem. School</option>
                            <option value="7">Tibagan Elem. School</option>
                            <option value="7">Sapang Maragul Elem. School</option>
                            <option value="7">Tibag Elem. School</option>
                            <option value="7">San Isidro Central School</option>
                            {{--District 8--}}
                            <option value="8">Burot Elem. School</option>
                            <option value="8">Sapang Tagalog </option>
                            <option value="8">San Miguel Central School</option>
                            <option value="8">San Carlos Elem. School</option>
                            <option value="8">San Francisco</option>
                            {{--District 9--}}
                            <option value="9">Balete Integrated</option>
                            <option value="9">Asturias Elem. School</option>
                            <option value="9">Capehan Elem. School</option>
                            <option value="9">Buenavista Elem. School</option>
                            <option value="9">Lourdes Elem. School</option>
                            {{--District 10--}}
                            <option value="10">Amucao Elem. School</option>
                        </select>
                        @if ($errors->has('school'))
                            <span class="help-block">
                                <strong>{{ $errors->first('school') }}</strong>
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
                    {{--@if($user->has('user_id'))--}}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword1">Password</label>

                            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword1">Confirm Password</label>

                            <input type="password" class="form-control" placeholder="Re-type Password" name="password_confirmation" id="password">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('password_confirmation') }}</strong>
                                 </span>
                            @endif
                        </div>
                    {{--@endif--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-save">Create</button>
                    <input type="hidden" id="user_id" name="user_id" value="0">
                </div>
            </form>
        </div>
    </div>
</div>