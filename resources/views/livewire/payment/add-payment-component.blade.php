<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            إضافة دفعة
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
    <!--begin::Form-->
    <form>
        <div class="card-body">
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
            @endif
            <div class="form-group row">
                <label class="col-2 col-form-label">اسم المشترك</label>
                <div class="col-4" wire:ignore>
                    <select class="form-control select2" id="beneficiary_id" >
                        <option value="">Select</option>
                        @foreach ($beneficiaries as $beneficiary)
                            <option value="{{$beneficiary->id}}">{{$beneficiary->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('beneficiary_name') <span class="text-danger error">{{ $message }}</span>@enderror
                <label class="col-2 col-form-label">الموظف المحصل</label>
                <div class="col-4" wire:ignore>
                    <select class="form-control select2" id="employee_id">
                        <option value="">Select</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('employee_name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">الشهر</label>
                <div class="col-4">
                    <input class="form-control" type="month" wire:model="month" max="9999-12" wire:change="changeMonth"/>
                    @error('month') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">المبلغ المُحصل</label>
                <div class="col-4">
                    <input class="form-control" type="number" wire:model="payment_value" />
                    @error('payment_value') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <label class="col-1 col-form-label">الاستخدام الشهري</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="monthly_use" disabled/>
                </div>
                <label class="col-1 col-form-label">متبقي سابق</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="amount_previous" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-8"></label>
                <label class="col-2 col-form-label">دفعات سابقة لنفس الشهر</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="previous_payments" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-8"></label>
                <label class="col-2 col-form-label">المبلغ المطلوب</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="amount_required" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-9"></label>
                <label class="col-1 col-form-label">الخصم</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="discount"/>
                    @error('month') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-9"></label>
                <label class="col-1 col-form-label">الباقي</label>
                <div class="col-2">
                    <input class="form-control" type="number" wire:model="the_rest" step="0.01" disabled/>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2" wire:click.prevent="storePayment">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
    <!--end::Form-->
</div>
<script>
    document.addEventListener('livewire:load', function () {
        $('#employee_id').on('change', function(e) {
            var date = $('#employee_id').val();
            @this.set('employee_id', date);
        });
        $('#beneficiary_id').on('change', function(e) {
            var date = $('#beneficiary_id').val();
            @this.set('beneficiary_id', date);
            @this.call('changeMonth');
        });
    });
    window.livewire.on('Change_select', () => {
        $('#employee_id').select2();
        $('#beneficiary_id').select2();
    });
</script>


