<!-- Deleted Medicine -->
<div class="modal fade" id="Deleted{{ $Medicine->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف الدواء</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Medicine.destroy', 'test') }}" method="post">
                    @method('DELETE')
                    @csrf

                    <input type="hidden" name="id" value="{{ $Medicine->id }}">

                    <div class="row">
                        <div class="col">
                            <h5>هل انت متأكد من عمليه حذف الدواء  ؟
                                <label style="color: red;"> {{ $Medicine->name }}</label>
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
