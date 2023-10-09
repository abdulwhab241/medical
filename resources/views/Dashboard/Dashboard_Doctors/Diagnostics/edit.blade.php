{{-- @foreach ($Medicines as $Medicine)
<option value="{{ $Medicine->id }}"
{{ $Medicine->id == $Diagnostic['medicine_id'] ? 'selected' : '' }}>
{{ $Medicine['name'] }}</option>
@endforeach --}}
<!-- Modal -->
<div class="modal fade" id="edit{{ $Diagnostic->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    تعديل تشخيص المريض
                    <label style="color: blue"> {{ $Diagnostic->Patient->name }} </label>
            
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Diagnostics.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $Diagnostic->id }}">
                    <input type="hidden" name="Invoice_id" value="{{$Diagnostic->id}}">
                    <input type="hidden" name="Patient_id" value="{{$Diagnostic->patient_id}}">

                    <label for="description">التشخيص</label>
                    <textarea class="form-control" name="Diagnosis" rows="6">{{ $Diagnostic->diagnosis }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
