<!-- Modal -->
<div class="modal fade" id="edit{{ $laboratorie_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات موظف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laboratorie_employee.update', $laboratorie_employee->id) }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">أسم الموظف</label>
                    <input type="text" value="{{$laboratorie_employee->name}}" name="name" class="form-control"><br>

                    <label for="exampleInputPassword1">رقم الهاتف</label>
                    <input type="text" value="{{$laboratorie_employee->phone}}" name="Phone" class="form-control"><br>

                    <label for="exampleInputPassword1">العنوان</label>
                    <textarea name="Address" id="" cols="2" rows="2"> {{$laboratorie_employee->address}}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
