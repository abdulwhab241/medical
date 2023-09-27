<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة موظف جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laboratorie_employee.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">أسم الموظف</label>
                    <input type="text" name="name" class="form-control"><br>

                    <label for="exampleInputPassword1">رقم الهاتف</label>
                    <input type="text" name="Phone" class="form-control"><br>

                    <label for="exampleInputPassword1">العنوان</label>
                    {{-- <input type="text" name="Address" class="form-control"> --}}
                    <textarea name="Address" id="" cols="2" rows="2"></textarea>
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
