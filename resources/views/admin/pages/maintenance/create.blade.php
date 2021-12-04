@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.maintenance')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_maintenance')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.maintenance.store') }}" method="post" id="store" enctype="multipart/form-data">
                @csrf
                <div class="card card-custom">
                    <div class="card-header d-flex">
                        <div class="card-title">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="icon-md fas fa-plus"></i> <strong> {{__('admin.add')}}</strong>
                            </button>
                            <button type="reset" class="btn btn-md btn-secondary">
                                <i class="icon-md fas fa-recycle"> </i> <strong>{{ __('admin.reset') }}</strong>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_type">{{__('admin.requisition_type')}}</label>
                                    <div class="form-group">
                                        <div class="d-flex justifiy-content-between">
                                            <div class="item">
                                                <input type="radio" name="requisition_type" id="maintenance" value="maintenance">
                                                <label for="maintenance">{{ __('admin.maintenance') }}</label>
                                            </div>
                                            <div class="item">
                                                <input type="radio" name="requisition_type" id="general" value="general">
                                                <label for="general">{{ __('admin.general') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_for">{{__('admin.requisition_for')}}</label>
                                    <select name="requisition_for" id="requisition_for" class="form-control select2">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle">{{__('admin.vehicle')}}</label>
                                    <select name="vehicle" id="vehicle" class="form-control select2">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maintenance_type">{{__('admin.maintenance_type')}}</label>
                                    <select name="maintenance_type" id="maintenance_type" class="form-control select2">
                                        @foreach ($maintenance_types as $maintenance_typ)
                                            <option value="{{ $maintenance_typ->id }}">{{ $maintenance_typ->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge">{{__('admin.charge')}}</label>
                                    <input type="number" name="charge" id="charge" class="form-control" placeholder="{{__('admin.charge')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge_bear">{{__('admin.charge_bear')}}</label>
                                    <input type="text" name="charge_bear" id="charge_bear" class="form-control" placeholder="{{__('admin.charge_bear')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_name">{{__('admin.service_name')}}</label>
                                    <input type="text" name="service_name" id="service_name" class="form-control" placeholder="{{__('admin.service_name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="priority">{{__('admin.priority')}}</label>
                                    <select name="priority" id="priority" class="form-control">
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority }}">{{ __('admin.' . $priority) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge">{{__('admin.service_date')}}</label>
                                    <input type="date" name="service_date" id="service_date" class="form-control" placeholder="{{__('admin.service_date')}}">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="is_add_schedule" id="is_add_schedule" value="1">
                                    <label for="is_add_schedule">{{ __('admin.is_add_schedule') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remarks">{{__('admin.remarks')}}</label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin.item_type_name') }}</th>
                                            <th>{{ __('admin.item_name') }}</th>
                                            <th>{{ __('admin.item_unit') }}</th>
                                            <th>{{ __('admin.unit_price') }}</th>
                                            <th>{{ __('admin.total_amount') }}</th>
                                            <th>{{ __('admin.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="item_type_name[]" class="form-control item_type_name">
                                            </td>
                                            <td>
                                                <input type="text" name="item_name[]" class="form-control item_name">
                                            </td>
                                            <td>
                                                <input type="number" value="0" name="item_unit[]" class="form-control item_unit">
                                            </td>
                                            <td>
                                                <input type="number" value="0" name="unit_price[]" class="form-control unit_price">
                                            </td>
                                            <td>
                                                <input type="text" name="total_amount[]" class="form-control total_amount" readonly  value="0">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete_row">{{ __('admin.delete') }}</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-success" id="add_row">{{ __('admin.add_more_item') }}</button>
                                            </td>
                                            <td>
                                                <label for="grand_total">{{ __('admin.grand_total') }}</label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="grand_total" id="grand_total" readonly value="0">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(function(){

        function tracker(){
            $(document).on('keyup','.item_unit',function(){
                var ItemUnit = $(this).val();
                var UnitPrice = $(this).parent().parent().find('td').find('.unit_price').val();
                var TotalAmount = $(this).parent().parent().find('td').find('.total_amount');
                TotalAmount.val(ItemUnit*UnitPrice);

                // grand total
                var TotalAmountInputs = $('.total_amount');
                var GrandTotal = 0;
                TotalAmountInputs.each(function(index,value){
                    GrandTotal += parseInt($(value).val());
                })
                $('#grand_total').val(GrandTotal);
            })
            $(document).on('keyup','.unit_price',function(){
                var UnitPrice = $(this).val();
                var ItemUnit = $(this).parent().parent().find('td').find('.item_unit').val();
                var TotalAmount = $(this).parent().parent().find('td').find('.total_amount');
                TotalAmount.val(ItemUnit*UnitPrice);

                // grand total
                var TotalAmountInputs = $('.total_amount');
                var GrandTotal = 0;
                TotalAmountInputs.each(function(index,value){
                    GrandTotal += parseInt($(value).val());
                })
                $('#grand_total').val(GrandTotal);
            })
        }


        function adder(){
            $('#add_row').click(function(){
            row = `
                <tr>
                    <td>
                        <input type="text" name="item_type_name[]" class="form-control item_type_name">
                    </td>
                    <td>
                        <input type="text" name="item_name[]" class="form-control item_name">
                    </td>
                    <td>
                        <input type="number" value="0" name="item_unit[]" class="form-control item_unit">
                    </td>
                    <td>
                        <input type="number" value="0" name="unit_price[]" class="form-control unit_price">
                    </td>
                    <td>
                        <input type="text" name="total_amount[]" class="form-control total_amount" readonly  value="0">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger delete_row">{{ __('admin.delete') }}</button>
                    </td>
                </tr>
            `;
            $('table tbody').append(row);
            });
        }

        function deleter(){
            $(document).on('click','.delete_row',function(){
                var TotalAmount = $(this).parent().parent().find('td').find('.total_amount').val();
                var OldGrandTotal = $('#grand_total').val();
                var NewGrandTotal = OldGrandTotal  - TotalAmount;
                console.log(NewGrandTotal);
                $('#grand_total').val(NewGrandTotal);
                $(this).parent().parent().remove();
            })
        }

        tracker();
        adder();
        deleter();
    });
</script>
@endsection