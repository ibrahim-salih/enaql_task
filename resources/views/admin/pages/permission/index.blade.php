@extends('admin.layouts.app')


@section('content-header' , 'الصلاحيات')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-custom">
                    {{-- <div class="card-header d-flex">
                        <div class="card-toolbar">
                            <a href="{{ route('admin.permission.create') }}" class="btn btn-lg btn-light-primary">
                                <i class="icon-md fas fa-plus"></i> <strong>اضافة صلاحية جديد</strong>
                            </a>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <table class="table table-bordered table-checkable" id="kt_datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الصلاحية</th>
                                    <th>التحكم</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Delete Modal-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف صلاحية</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fas fa-times-circle text-primary"></i>
                    </button>
                </div>
                <form action="" method="post" action="" id="delete_form">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="alert alertable" role="alert">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                            </div>
                            <div class="alert-text">هل أنت منأكد من حذف هذه الصلاحية؟</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">أغلق</button>
                        <button type="submit" class="btn btn-danger font-weight-bold">تأكيد و حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(function() {
            $('#kt_datatable').DataTable({
                processing: true,
                serverSide: true,
                language: {
                 "url": "{{asset('admin/plugins/datatables/Arabic.json')}}"
                },
                ajax: '{{ route("admin.permission.datatable") }}',
                columns:[
                    {data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
                    { data:'name' , name: 'name' },
                    { data:'actions' , name: 'actions' },
                ]
            });

            $(document).on('click' , '.delete_btn' , function(){
                let route = $(this).data('route');
                $('#delete_form').attr('action' , route);
            });
        });

    </script>
@endsection