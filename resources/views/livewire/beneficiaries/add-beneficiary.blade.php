<!-- Modal-->
<div wire:ignore.self class="modal fade" id="AddBeneficiary" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="AddConstLabel">بيانات المشترك</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">اسم المشترك</label>
                        <div class="col-4">
                            <input class="form-control" type="text" wire:model.defer="name"/>
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <label class="col-2 col-form-label">الجوال</label>
                        <div class="col-4">
                            <input class="form-control" type="number" wire:model.defer="phone" maxlength="10"/>
                            @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">النوع</label>
                        <div class="col-4" wire:ignore>
                            <select class="form-control select2" id="type_id">
                                <option value="">اختر</option>
                                @foreach ($constants_type as $constant_type)
                                    <option value="{{ $constant_type->id }}">{{ $constant_type->name }}</option>
                                @endforeach
                            </select>
                            @error('type_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <label class="col-2 col-form-label">حالة المشترك</label>
                        <div class="col-4" wire:ignore>
                            <select class="form-control select2" id="status_id">
                                <option value="">اختر</option>
                                @foreach ($constants_status as $constant_status)
                                    <option value="{{ $constant_status->id }}">{{ $constant_status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">سعر الكيلو</label>
                        <div class="col-4">
                            <input class="form-control" type="number" wire:model.defer="price_kilo"/>
                            @error('price_kilo') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <label class="col-2 col-form-label">الحد الأدنى</label>
                        <div class="col-4">
                            <input class="form-control" type="number" wire:model.defer="minimum" />
                            @error('minimum') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">تاريخ الإشتراك</label>
                        <div class="col-4">
                            <input class="form-control" type="date" wire:model.defer="registration_dt" max="9999-12-31"/>
                            @error('registration_dt') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <label class="col-2 col-form-label">تاريخ الإنتهاء</label>
                        <div class="col-4">
                            <input class="form-control" type="date" wire:model.defer="expiry_dt" max="9999-12-31"/>
                            @error('expiry_dt') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">المكان</label>
                        <div class="col-4">
                            <input class="form-control" type="text" wire:model.defer="place"/>
                            @error('place') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" @if ($beneficiary_id) wire:click.prevent="updateBeneficiary"
                        @else
                        wire:click.prevent="storeBeneficiary" @endif>{{ $title_btn }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#type_id').on('change', function(e) {
                var date = $('#type_id').val();
                @this.set('type_id', date);
            });

            $('#status_id').on('change', function(e) {
                var date = $('#status_id').val();
                @this.set('status_id', date);
            });
        });
        window.livewire.on('Change_select', () => {
            $('#type_id').val(@this.type_id).change();
            $('#status_id').val(@this.status_id).change();
        });
    </script>
@endpush
