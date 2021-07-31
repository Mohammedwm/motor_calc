<!-- Modal-->
<div wire:ignore.self class="modal fade show" id="AddEmployee" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="AddConstLabel">بيانات الموظف</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">اسم الموظف</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" wire:model.defer="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">الوصف</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" wire:model.defer="description">
                        @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label for="exampleFormControlInput2">حالة الموظف</label>
                        <select class="form-control select2" id="status_id">
                            <option value="">اختر</option>
                            @foreach ($constants as $constant)
                                <option value="{{ $constant->id }}">{{ $constant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('status_id') <span class="text-danger error">{{ $message }}</span>@enderror

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary font-weight-bold"
                    @if ($employee_id) wire:click.prevent="updateEmployee"
                    @else
                        wire:click.prevent="storeEmployee"
                    @endif>{{$title_btn}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#status_id').on('change', function(e) {
                var date = $('#status_id').val();
                @this.set('status_id', date);
            });
        });
    </script>
@endpush
