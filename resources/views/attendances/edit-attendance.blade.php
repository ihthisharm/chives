<div class="modal fade" id="edit-attendance-{{ $attendance->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Attendance Record of {{ $attendance->user->name }}
                    on {{ date('l, d F Y', strtotime($attendance->date)) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('attendances.update', $attendance) }}">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $attendance->user_id }}">
                    <input type="date" hidden max='{{ date('Y-m-d') }}' name="date" value="{{ $attendance->date }}">
                    <div class="form-group">
                        <label for="">Present</label>
                        <input type="checkbox" name="present" {{ $attendance->present ? 'checked' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="">Remarks</label>
                        <input type="text" name="remarks" class="form-control" value="{{ $attendance->remarks }}">
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
