@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.price_settings')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0">
                            <!-- Button trigger modal -->
                            @can('add_settings')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">
                                {{ __('admin.add_new_price_setting') }}
                            </button>
                            @endcan

                        </div>
                    </div>
                    <div class="card-body">
                        <x-admin-datatable-table :columns="$columns" />
                    </div>
                </div>

            </div>
        </div>


<x-admin-delete-modal />


<!-- Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.add_new_price_setting') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.price-control.store') }}" method="post" id="add_form">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="from">{{ __('admin.from') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="from" id="from" class="form-control">
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-2">
                        <label for="to">{{ __('admin.to') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="to" id="to" class="form-control">
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-2">
                        <label for="price_per_order">{{ __('admin.price_per_order') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="number" name="price_per_order" id="price_per_order" class="form-control">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('admin.add') }}</button>
              </div>
        </form>

      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.edit_new_price_setting') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" id="update_form">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="from">{{ __('admin.from') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="from" id="from" class="form-control">
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-2">
                        <label for="to">{{ __('admin.to') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="to" id="to" class="form-control">
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-2">
                        <label for="price_per_order">{{ __('admin.price_per_order') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="number" name="price_per_order" id="price_per_order" class="form-control">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('admin.edit') }}</button>
              </div>
        </form>

      </div>
    </div>
  </div>



@endsection


@section('js')
    <x-admin-datatable-script :columns="$columns" :route="route('admin.price-control.datatable')"/>
    <x-admin-delete-modal-script />
    <script>
        $(function(){
            $('#add_form').on('submit',function(e){
                e.preventDefault();
                var from = $(this).find('input[name="from"]').val();
                var to = $(this).find('input[name="to"]').val();
                var price_per_order = $(this).find('input[name="price_per_order"]').val();
                var action = $(this).attr('action');
                console.log(action);
                $.ajax({
                    method:"POST",
                    url : action,
                    data:{
                        '_token' : '{{ csrf_token() }}',
                        'from' : from,
                        'to' : to,
                        'price_per_order' : price_per_order,
                    },
                    success : function(response){
                        $('.modal').modal('hide');
                        toastr.success(response);
                        $('table').DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            toastr.error(value);
                        });
                    },
                })
            })
        })
    </script>
   <script>
    $(document).on('click' , '.edit_btn' , function(){
        let EditRoute = $(this).data('edit');
        $.ajax({
            'method':"GET",
            'url' : EditRoute,
            success : function(response){
                $('#update_form').find('input[name="from"]').val(response['from']);
                $('#update_form').find('input[name="to"]').val(response['to']);
                $('#update_form').find('input[name="price_per_order"]').val(response['price_per_order']);
            }
        });
        let UpdateRoute = $(this).data('update');
        $('#update_form').attr('action' , UpdateRoute);

    });
    $(document).on('submit','#update_form' , function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url: $('#update_form').attr('action'),
            data:{
                '_token' : '{{ csrf_token() }}',
                '_method' : 'PUT',
                'from' : $('#update_form').find('input[name="from"]').val(),
                'to' : $('#update_form').find('input[name="to"]').val(),
                'price_per_order' : $('#update_form').find('input[name="price_per_order"]').val(),
            },
            success : function(response){
                $('.modal').modal('hide');
                toastr.success(response);
                $('table').DataTable().ajax.reload();
            },
            error: function (xhr) {
                $.each(xhr.responseJSON.errors, function(key,value) {
                    toastr.error(value);
                });
            },
        })
    })

</script>
@endsection
