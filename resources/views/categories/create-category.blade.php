<div class="modal fade" id="create-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group d-flex flex-column justify-content-center align-items-center">
                        <label class="custom-file-upload">
                            <input class="inputfile" hidden="" type='file' id="imgInput" name="image"
                                accept="image/x-png">
                            <img class="preview" id="preview" src="https://robohash.org/image.png"
                                style="width: 250px !important;" />
                        </label>
                        <small class="text-muted">PNG file less than 2MB | Click on image to change</small>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="" rows="6" class="form-control"></textarea>
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
