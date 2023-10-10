<!-- Modal -->
<div class="modal fade" id="edit{{ $LaboratoryService->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل الفحص</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Laboratory_Services.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="name">أسم الفحص</label>
                    <input type="text" name="name" id="name" required value="{{ $LaboratoryService->name }}"
                        class="form-control">

                    <input type="hidden" name="id" value="{{ $LaboratoryService->id }}" class="form-control"><br>

                    <label for="price">سعر الفحص</label>
                    <input type="number" name="price" id="price" required value="{{ $LaboratoryService->price }}"
                        class="form-control"><br>

                    <label for="description">وصف الفحص</label>
                    <textarea class="form-control" name="description"  id="description" rows="2">{{ $LaboratoryService->description }}</textarea><br>

                    <div class="form-group">
                        <label for="status">حالة الفحص</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="{{ $LaboratoryService->status }}" selected>
                                {{ $LaboratoryService->status == 1 ? 'متوفر' : 'غير متوفرة' }}</option>
                            <option value="1">متوفرة</option>
                            <option value="0">غير متوفرة</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
