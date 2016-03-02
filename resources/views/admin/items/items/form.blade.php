<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" method="POST" action="items" class="bootstrap-modal-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Items</h4>
                </div>
                <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group {{ $errors->has('item_type_id') ? ' has-error' : '' }}">
                            <label>Item Type</label>
                            <select class="form-control select2" style="width: 100%;" name="item_type_id">
                                @foreach($itemTypes as $itemtype)
                                    <option>{{$itemtype->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('item_type_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('item_type_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="exampleInputPassword1">Item Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name of Items" name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>