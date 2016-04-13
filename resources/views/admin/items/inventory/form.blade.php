<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frmInventory" name="frmInventory" class="bootstrap-modal-form">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Items</h4>
                </div>
                <div class="modal-body">
                        {{csrf_field()}}
                    <div class="form-group {{ $errors->has('item_id') ? ' has-error' : '' }}">
                        <label>Choose items</label>
                        <select class="form-control select2" style="width: 100%;" name="item_id" id="item_id">
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->itemTypes->name}} - {{$item->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('item_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('item_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="number" class="form-control" min="1" step="0.25" value="0.00" name="price" id="price">
                        @if ($errors->has('price'))
                            <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('stocks') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Stocks</label>
                        <input type="number" class="form-control" min="1" step="1.00" value="1" name="stocks" id="stocks">
                        @if ($errors->has('stocks'))
                            <span class="help-block">
                            <strong>{{ $errors->first('stocks') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-save" value="add">Create</button>
                    <input type="hidden" id="inventory_id" name="inventory_id">
                </div>
            </form>
        </div>
    </div>
</div>