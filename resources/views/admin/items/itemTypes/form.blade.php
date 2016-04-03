<form role="form" class="bootstrap-modal-form">
    {{ csrf_field() }}
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Item Types</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Type Name</label>
                        <input type="text" class="form-control" placeholder="Enter Type of Items" name="name" id="name">
                        @if ($errors->has('name'))
                            <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-save" value="add">Create</button>
                    <input type="hidden" id="type_id" name="type_id">
                </div>
            </div>
        </div>
    </div>
</form>