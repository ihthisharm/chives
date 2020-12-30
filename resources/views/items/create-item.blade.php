<div class="modal fade" id="create-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group d-flex flex-column justify-content-center align-items-center">
                        <label class="custom-file-upload">
                            <input class="inputfile" hidden="" type='file' id="imgInput" name="image"
                                accept="image/x-png">
                            <img class="preview" id="preview" src="https://robohash.org/placeholder.png"
                                style="width: 250px !important;" />
                        </label>
                        <small class="text-muted">PNG file less than 2MB | Click on image to change</small>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Item Name">
                    </div>
                    <div class="form-group">
                        <select name="category_id" class="custom-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Price in Laari">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="6" class="form-control"
                            placeholder="Item Description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                </div>
        </div>
    </div>
    </form>
</div>
