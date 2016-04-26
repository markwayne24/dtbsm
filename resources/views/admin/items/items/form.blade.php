<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmItem" name="frmItem" class="bootstrap-modal-form">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Items</h4>
                </div>
                <div class="modal-body">
                        {{csrf_field()}}
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select class="form-control select" style="width: 100%;" name="categories" id="categories">
                            <option value="Facilities">Facilities</option>
                            <option value="Equipments">Equipments</option>
                            <option value="School Supplies">School Supplies</option>
                        </select>
                    </div>
                    <div class="form-group {{ $errors->has('item_type_id') ? ' has-error' : '' }}">
                        <label>Item Type</label>
                        <select class="form-control select2" style="width: 100%;" name="item_type_id" id="item_type_id">
                        </select>
                        @if ($errors->has('item_type_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('item_type_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="exampleInputName">Item Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name of Items" name="name" id="name">
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
                    <input type="hidden" id="item_id" name="item_id">
                </div>
            </form>
        </div>
    </div>
</div>