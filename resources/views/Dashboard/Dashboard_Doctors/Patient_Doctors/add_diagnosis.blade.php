<!-- Modal -->
<div class="modal fade" id="add_diagnosis{{$Invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تشخيص حالة المريض 
                    <label style="color: blue"> {{ $Invoice->Patient->name }} </label>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('Diagnostics.store')}}" method="POST">
            @csrf
            <div class="modal-body">

                <input type="hidden" name="Invoice_id" value="{{$Invoice->id}}">
                <input type="hidden" name="Patient_id" value="{{$Invoice->patient_id}}">
                {{-- <input type="hidden" name="Doctor_id" value="{{$Invoice->doctor_id}}"> --}}

                <div class="form-group">
                    <label>التشخيص</label>
                    <textarea class="form-control" required name="Diagnosis" rows="6"></textarea>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn btn-primary">حفظ البيانات</button>
            </div>
            </form>
        </div>
    </div>
</div>
