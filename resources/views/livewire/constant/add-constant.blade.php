<!-- Modal-->
<div wire:ignore.self class="modal fade show" id="AddConst" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="AddConstLabel">بيانات الثابت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">اسم الثابت</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label for="exampleFormControlInput2">يتبع ل</label>
                        <select class="form-control select2" id="main_id">
                            <option value="">اختر</option>
                            @foreach ($constant_mains as $constant_main)
                                <option value="{{ $constant_main->id }}">{{ $constant_main->name }}</option>
                            @endforeach
                        </select>
                        @error('main_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary font-weight-bold"
                    @if ($const_id) wire:click.prevent="updateConst"
                    @else
                        wire:click.prevent="storeConstant"
                    @endif>{{$title_btn}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#main_id').on('change', function(e) {
                var date = $('#main_id').val();
                @this.set('main_id', date);
            });
        });


    </script>
@endpush
