<!-- Modal -->
<div class="modal fade" id="xray_conversion{{$Invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تحويل الي قسم الاشعة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST">
            @csrf
            <div class="modal-body">

                {{-- <input type="hidden" name="Invoice_id" value="{{$Invoice->id}}"> --}}
                <input type="hidden" name="patient_id" value="{{$Invoice->patient_id}}">
                {{-- <input type="hidden" name="doctor_id" value="{{$Invoice->doctor_id}}"> --}}

                
                <div class=" col-md-12">
                    <label>المطلوب</label>
                    <select name="Ray_id[]" multiple="multiple" @required(true) class="form-control SlectBox">
                        @foreach ($Rays as $Ray)
                        {{-- <option value=""></option> --}}
                            <option value="{{ $Ray->id }}">{{ $Ray->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">شرح</label>
                    <textarea class="form-control" name="description" rows="6"></textarea>
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
