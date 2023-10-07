<!-- Modal -->
<div class="modal fade" id="edit{{ $ray_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات موظف الأشعة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Ray_Employee.update', $ray_employee->id) }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">الاسم</label>
                    <input type="hidden" name="id" value="{{ $ray_employee->id }}">
                    <input type="text" value="{{ $ray_employee->name }}" name="Name" class="form-control"><br>

                    <label for="exampleInputPassword1">رقم الهاتف</label>
                    <input type="text" value="{{ $ray_employee->phone }}" name="Phone" class="form-control"><br>

                    <label for="exampleInputPassword1">العنوان</label>
                    <textarea rows="5" cols="10" class="form-control" name="Address">{{ $ray_employee->address }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
