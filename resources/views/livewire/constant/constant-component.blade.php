<div>
    <style>
        nav svg{
            height:20px;
        }
    </style>
    @include('livewire.constant.add-constant')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-favourite text-primary"></i>
                </span>
                <h3 class="card-label">ثوابت النظام</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#AddConst"
                    wire:click="resetInputFields">
                <i class="la la-plus"></i>إضافة ثابت جديد</a>
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
                        <th>رقم الثابت</th>
                        <th>اسم الثابت</th>
                        <th>يتبع ل</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($constants as $constant)
                        <tr>
                            <td>{{$constant->id}}</td>
                            <td>{{$constant->name}}</td>
                            <td>{{$constant->constant_main->name}}</td>
                            <td>
                                <a wire:click.prevent="editConst({{ $constant->id }})"
                                    data-toggle="modal" data-target="#AddConst"
                                        class="btn btn-sm btn-clean btn-icon" title="Edit Const">
                                    <i class="la la-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon" title="Delete Const"
                                    wire:click="$emit('triggerDelete',{{ $constant->id }})">
                                    <i class="la la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$constants->links()}}
            <!--end: Datatable-->
        </div>
    </div>
</div>

<!--end::Card-->
@push('scripts')
<script>

    window.livewire.on('hideModelConst', () => {
        $('#AddConst').modal('hide');
    });
    window.livewire.on('Change_main_id', () => {
        $('#main_id').val(@this.main_id).change();
    });
    document.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerDelete', constantId => {
            Swal.fire({
                title: 'هل تريد بالتأكيد حذف الثابت ؟',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا'
            }).then((result) => {
         //if user clicks on delete
                if (result.value) {
                    @this.call('destroy',constantId)
                }
            });
        });
    });
</script>
@endpush
