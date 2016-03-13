<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" method="POST" action="inventory" class="bootstrap-modal-form">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Items</h4>
                </div>
                <div class="modal-body">
                        {{csrf_field()}}
                    <div class="form-group {{ $errors->has('item_id') ? ' has-error' : '' }}">
                        <label>Choose items</label>
                        <select class="form-control select2" style="width: 100%;" name="item_id">
                            @foreach($items as $item)
                                <option>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('item_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('item_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">SKU</label>
                        <input type="text" class="form-control" placeholder="Enter Name of Items" name="sku">
                        @if ($errors->has('sku'))
                            <span class="help-block">
                        <strong>{{ $errors->first('sku') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="text" class="form-control" placeholder="Enter Price" name="price">
                        @if ($errors->has('price'))
                            <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('stocks') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Stocks</label>
                        <input type="text" class="form-control" placeholder="Enter Stocks" name="stocks">
                        @if ($errors->has('stocks'))
                            <span class="help-block">
                            <strong>{{ $errors->first('stocks') }}</strong>
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