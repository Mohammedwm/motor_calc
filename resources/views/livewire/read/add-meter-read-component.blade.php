@if ($type_page == 1)
<div>
    @livewire('read.meter-read-component')
</div>
@endif

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            إضافة قراءة عداد
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a class="btn btn-primary font-weight-bolder" wire:click="ChangeType(1)">

            <i class="la la-search"></i>بحث في القراءات</a>
            <!--end::Button-->
        </div>
    </div>
    <!--begin::Form-->
    <form>
        <div class="card-body">
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
            @endif
            <div class="form-group row">
                <label class="col-2 col-form-label">الشهر</label>
                <div class="col-4">
                    <input class="form-control" type="month" wire:model="month" max="9999-12" wire:change="changeMonth"/>
                    @error('month') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">الموظف القارئ</label>
                <div class="col-4" wire:ignore>
                    <select class="form-control select2" id="employee_id">
                        <option value="">Select</option>
                        @foreach ($employees as $employee)
                           <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">اسم المشترك</label>
                <div class="col-4" wire:ignore>
                    <select class="form-control select2" id="beneficiary_id">
                        <option value="">Select</option>
                        @foreach ($beneficiaries as $beneficiary)
                            <option value="{{$beneficiary->id}}">{{$beneficiary->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('beneficiary_id') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">القراءة الحالية</label>
                <div class="col-4">
                    <input class="form-control" type="number" wire:model="current_reading"/>
                    @error('current_reading') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <label class="col-1 col-form-label">القراءة السابقة</label>
                <div class="col-2">
                    <input class="form-control" type="text" wire:model="previous_reading" disabled/>
                </div>
                <label class="col-1 col-form-label">فرق القراءة</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="monthly_use" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-9"></label>
                <label class="col-1 col-form-label">سعر الكيلو</label>
                <div class="col-2">
                    <input class="form-control" type="text" wire:model="price_kilo" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-9"></label>
                <label class="col-1 col-form-label">السحب الشهري</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="monthly_draw" step="0.01" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-9"></label>
                <label class="col-1 col-form-label">الحد الأدنى</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="minimum" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-9"></label>
                <label class="col-1 col-form-label">المبلغ المطلوب</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="amount_required" disabled/>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2" wire:click.prevent="storeReading">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
    <!--end::Form-->
</div>
<script>
    $(document).ready(function () {
        $('.select2').select2();
        $('#employee_id').on('change', function(e) {
            var date = $('#employee_id').val();
            @this.set('employee_id', date);
        });
        $('#beneficiary_id').on('change', function(e) {
            var date = $('#beneficiary_id').val();
            @this.set('beneficiary_id', date);
            @this.call('changeBeneficiary');
        });

    });
    window.livewire.on('Change_select', () => {
        $('#employee_id').select2();
        $('#beneficiary_id').select2();
        $('#beneficiary_id').val(@this.beneficiary_id).change();
    });

</script>

