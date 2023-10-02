<!-- Modal -->
<div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل إجراء</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Service.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="name">أسم الإجراء</label>
                    <input type="text" name="name" id="name" value="{{ $service->name }}"
                        class="form-control">

                    <input type="hidden" name="id" value="{{ $service->id }}" class="form-control"><br>

                    <label for="price">سعر الإجراء</label>
                    <input type="number" name="price" id="price" value="{{ $service->price }}"
                        class="form-control"><br>

                    <label for="description">وصف الإجراء</label>
                    <textarea class="form-control" name="description" id="description" rows="2">{{ $service->description }}</textarea><br>

                    <div class="form-group">
                        <label for="status">حالة الإجراء</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="{{ $service->status }}" selected>
                                {{ $service->status == 1 ? 'متوفر' : 'غير متوفرة' }}</option>
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
