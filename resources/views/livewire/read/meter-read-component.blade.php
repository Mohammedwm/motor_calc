@if ($type_page == 2)
<div>
    @livewire('add-meter-read-component')
</div>
@endif
<div>
    <style>
        nav svg{
            height:20px;
        }
    </style>
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
                <a wire:click="ChangeType(2)" class="btn btn-primary btn-shadow font-weight-bold mr-2 btn-block">إضافة قراءة جديدة</a>
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
                        <input type="text" class="form-control datatable-input" wire:model="s_nameBeneficiary"
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
                    <div class="col-lg-4 mb-lg-0 mb-6">
                        <label>تاريخ الاشترك:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="month" class="form-control datatable-input" wire:model="from_month" name="start" placeholder="From"
                                data-col-index="5" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-ellipsis-h"></i>
                                </span>
                            </div>
                            <input type="month" class="form-control datatable-input" wire:model="to_month" name="end" placeholder="To"
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

                        </select>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>الحالة:</label>
                        <select class="form-control datatable-input select2" data-col-index="7">
                            <option value="">Select</option>

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
                        <th>اسم المشترك</th>
                        <th>الشهر</th>
                        <th>القراءة الحالية</th>
                        <th>سحب الشهر(بالكيلو)</th>
                        <th>سعر الكيلو </th>
                        <th>سحب الشهر(بالشيكل)</th>
                        <th>الحد الأدنى</th>
                        <th>المبلغ المطلوب</th>
                        <th>الموظف القارئ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($readings as $reading)
                        <tr>
                            <td>{{$reading->beneficiary->name}}</td>
                            <td>{{$reading->month}}</td>
                            <td>{{$reading->current_reading}}</td>
                            <td>{{$reading->monthly_use}}</td>
                            <td>{{$reading->price_kilo}}</td>
                            <td>{{$reading->monthly_draw}}</td>
                            <td>{{$reading->minimum}}</td>
                            <td>{{$reading->amount_required}}</td>
                            <td>{{$reading->employee->name}}</td>
                            <td>
                                <a wire:click.prevent="editBeneficiary({{ $reading->id }})"
                                    data-toggle="modal" data-target="#AddBeneficiary"
                                        class="btn btn-sm btn-clean btn-icon" title="تعديل بيانات المشترك">
                                    <i class="la la-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon" title="حذف المشترك"
                                    wire:click="$emit('triggerDelete',{{ $reading->id }})">
                                    <i class="la la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$readings->links()}}
            <!--end: Datatable-->
        </div>
    </div>
</div>
