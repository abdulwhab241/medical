<!-- Modal -->
<div class="modal fade" id="add_diagnosis{{$Invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تشخيص حالة مريض</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('Diagnostics.store')}}" method="POST">
            @csrf
            <div class="modal-body">

                <input type="hidden" name="Invoice_id" value="{{$Invoice->id}}">
                <input type="hidden" name="patient_id" value="{{$Invoice->patient_id}}">
                <input type="hidden" name="doctor_id" value="{{$Invoice->doctor_id}}">

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">التشخيص</label>
                    <textarea class="form-control" name="diagnosis" rows="6"></textarea>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <label>الدواء</label>
                        <select name="Insurance_id" class="form-control select2">
                            @foreach ($Insurances as $Insurance)
                            <option value=""></option>
                                <option value="{{ $Insurance->id }}">{{ $Insurance->name }}</option>
                            @endforeach
                        </select>
                        @error('Insurance_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">الادوية</label>
                    <textarea class="form-control" name="medicine" rows="6"></textarea>
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
