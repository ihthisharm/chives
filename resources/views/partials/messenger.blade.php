@if ($message = Session::get('success'))
    <div class="toast alert alert-success">
        <button type="button" class="close ml-5" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <button type="button" class="close ml-5" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close ml-5" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info">
        <button type="button" class="close ml-5" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close ml-5" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif
