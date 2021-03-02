<!-- Modal -->
<div class="modal fade itemclass" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="item-name" class="col-form-label">Item:</label>
                        <input type="text" class="form-control" id="item_name">
                    </div>
                    <div class="form-group">
                        <label for="item-price" class="col-form-label">Price:</label>
                        <input type="number" class="form-control" id="item_price">
                    </div>
                    <input type="hidden" class="form-control" id="item_row" value="{{$data['rowid']}}">
                    <input type="hidden" class="form-control" id="item_col" value="{{$data['colid']}}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveItem()">Save changes</button>
            </div>
        </div>
    </div>
</div>