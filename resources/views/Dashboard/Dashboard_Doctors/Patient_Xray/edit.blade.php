<!-- Modal -->
<div class="modal fade" id="edit_PatientRay{{ $PatientRay->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل الأشعة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Patient_Rays.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="id" value="{{ $PatientRay->id }}" >
                    <input type="hidden" name="Patient_id" value="{{ $PatientRay->patient_id }}" >

                        <label>المطلوب</label>
                        <select name="Ray_id" class="form-control SlectBox" required>
                            @foreach ($Rays as $Ray)
                                <option value="{{ $Ray->id }}"
                                    {{ $PatientRay->ray_id == $Ray->id ? 'selected' : '' }}>
                                    {{ $Ray->name }}</option>
                            @endforeach
                        </select><br>

                    <label>الشرح</label>
                    <textarea class="form-control" name="Disc" rows="6">{{ $PatientRay->description }}</textarea>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
