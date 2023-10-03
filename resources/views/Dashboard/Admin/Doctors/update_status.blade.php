<!-- Modal -->
<div class="modal fade" id="update_status{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    تغير حالة الطبيب <label style="color: blue;">{{ $doctor->name }} </label>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_status') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">الحالة</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="dsd" selected disabled>--إختر من القائمة--</option>
                            <option value="1">متوفر</option>
                            <option value="0">غير متوفر</option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تعديل حالة الطبيب</button>
                </div>
            </form>
        </div>
    </div>
</div>
