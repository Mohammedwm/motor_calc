<div>
    <style>
        nav svg{
            height:20px;
        }
    </style>
    @include('livewire.employee.add-employee')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-favourite text-primary"></i>
                </span>
                <h3 class="card-label">الموظفين</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#AddEmployee"
                    wire:click="resetInputFields">
                <i class="la la-plus"></i>إضافة موظف جديد</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row" >
                <div class="col-4 ">
                 <input class="form-control" wire:model="search" placeholder="بحث ..."/>
                </div>
            </div>
            <!--begin: Datatable-->
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
            @endif
            <table class="table table-bordered table-hover table-checkable"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>رقم الموظف</th>
                        <th>اسم الموظف</th>
                        <th>الوصف</th>
                        <th>حالة الموظف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{$employee->id}}</td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->description}}</td>
                            <td>{{$employee->constant->name}}</td>
                            <td>
                                <a wire:click.prevent="editEmployee({{ $employee->id }})"
                                    data-toggle="modal" data-target="#AddEmployee"
                                        class="btn btn-sm btn-clean btn-icon" title="تعديل بيانات الموظف">
                                    <i class="la la-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon" title="حذف الموظف"
                                    wire:click="$emit('triggerDelete',{{ $employee->id }})">
                                    <i class="la la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$employees->links()}}
            <!--end: Datatable-->
        </div>
    </div>
</div>

<!--end::Card-->
@push('scripts')
<script>

    window.livewire.on('hideModelEmployee', () => {
        $('#AddEmployee').modal('hide');
    });
    window.livewire.on('Change_status_id', () => {
        $('#status_id').val(@this.status_id).change();
    });
    document.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerDelete', employeeId => {
            Swal.fire({
                title: 'هل تريد بالتأكيد حذف الموظف ؟',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا'
            }).then((result) => {
         //if user clicks on delete
                if (result.value) {
                    @this.call('destroy',employeeId)
                }
            });
        });
    });
</script>
@endpush
