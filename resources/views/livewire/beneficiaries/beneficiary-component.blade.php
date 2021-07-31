<div>
    <style>
        nav svg{
            height:20px;
        }
    </style>
    @include('livewire.beneficiaries.add-beneficiary')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-delivery-package text-primary"></i>
                </span>
                <h3 class="card-label">خيارات البحث</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#AddBeneficiary"
                    wire:click="resetInputFields">
                    <i class="la la-plus"></i>إضافة مشترك جديد</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <form class="mb-15">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>رقم المشترك :</label>
                        <input type="num" class="form-control datatable-input" wire:model="s_numBeneficiary"/>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>اسم المشترك:</label>
                        <input type="text" class="form-control datatable-input" wire:model="s_name"
                            data-col-index="1" />
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>الجوال:</label>
                        <input type="text" class="form-control datatable-input" wire:model="s_phone"/>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>المكان:</label>
                        <input type="text" class="form-control datatable-input"/>
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>تاريخ الاشترك:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="text" class="form-control datatable-input" name="start" placeholder="From"
                                data-col-index="5" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-ellipsis-h"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control datatable-input" name="end" placeholder="To"
                                data-col-index="5" />
                        </div>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>سعر الكيلو:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="text" class="form-control datatable-input" name="start" placeholder="From"
                                data-col-index="5" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-ellipsis-h"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control datatable-input" name="end" placeholder="To"
                                data-col-index="5" />
                        </div>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>النوع:</label>
                        <select class="form-control datatable-input select2" data-col-index="6">
                            <option value="">Select</option>
                            @foreach ($constants_type as $constant_type)
                                <option value="{{$constant_type->id}}">{{$constant_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>الحالة:</label>
                        <select class="form-control datatable-input select2" data-col-index="7">
                            <option value="">Select</option>
                            @foreach ($constants_status as $constant_status)
                                <option value="{{$constant_status->id}}">{{$constant_status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-8">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-primary--icon" id="kt_search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>&#160;&#160;
                        <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
            <!--begin: Datatable-->
            <!--begin: Datatable-->
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
            @endif
            <table class="table table-bordered table-hover table-checkable" >
                <thead>
                    <tr>
                        <th>رقم المشترك</th>
                        <th>اسم المشترك</th>
                        <th>الجوال</th>
                        <th>المكان</th>
                        <th>تاريخ الاشترك</th>
                        <th>سعر الكيلو </th>
                        <th>النوع</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beneficiaries as $beneficiary)
                        <tr>
                            <td>{{$beneficiary->id}}</td>
                            <td>{{$beneficiary->name}}</td>
                            <td>{{$beneficiary->phone}}</td>
                            <td>{{$beneficiary->place}}</td>
                            <td>{{$beneficiary->registration_dt}}</td>
                            <td>{{$beneficiary->price_kilo}}</td>
                            <td>{{$beneficiary->constant_type->name}}</td>
                            <td>{{$beneficiary->constant_status->name}}</td>
                            <td>
                                <a wire:click.prevent="editBeneficiary({{ $beneficiary->id }})"
                                    data-toggle="modal" data-target="#AddBeneficiary"
                                        class="btn btn-sm btn-clean btn-icon" title="تعديل بيانات المشترك">
                                    <i class="la la-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon" title="حذف المشترك"
                                    wire:click="$emit('triggerDelete',{{ $beneficiary->id }})">
                                    <i class="la la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$beneficiaries->links()}}
            <!--end: Datatable-->
        </div>
    </div>
</div>
<!--end::Card-->
@push('scripts')
<script>
    window.livewire.on('hideModelBeneficiary', () => {
        $('#AddBeneficiary').modal('hide');
    });
    document.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerDelete', beneficiaryId => {
            Swal.fire({
                title: 'هل تريد بالتأكيد حذف المشترك ؟',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا'
            }).then((result) => {
         //if user clicks on delete
                if (result.value) {
                    @this.call('destroy',beneficiaryId)
                }
            });
        });
    });
</script>
@endpush
