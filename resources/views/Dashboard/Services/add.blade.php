<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة إجراء جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Service.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <label for="name">أسم الإجراء</label>
                    <input type="text" name="name" id="name" class="form-control" required><br>

                    <label for="price">سعر الإجراء</label>
                    <input type="number" name="price" id="price" class="form-control" required><br>

                    <label for="description">وصف الإجراء</label>
                    <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
