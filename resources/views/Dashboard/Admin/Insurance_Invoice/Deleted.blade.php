<!-- Deleted Insurance -->
<div class="modal fade" id="Deleted{{ $Insurance->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف فاتورة تأمين</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('InsuranceInvoice.destroy', 'test') }}" method="post">
                    @method('DELETE')
                    @csrf

                    <input type="hidden" name="id" value="{{ $Insurance->id }}">

                    <div class="row">
                        <div class="col">
                            <h5>هل انت متأكد من عمليه حذف فاتورة التأمين للمريض ؟
                                <label style="color: red;"> {{ $Insurance->Patient->name }}</label>
                            </h5>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
