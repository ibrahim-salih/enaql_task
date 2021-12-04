@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.expenses')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_expense')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.expense.update',$Expense->id) }}" method="post" id="store" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-custom">
                    <div class="card-header d-flex">
                        <div class="card-title">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="icon-md fas fa-edit"></i> <strong> {{__('admin.edit')}}</strong>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expense_category">{{__('admin.expense_category')}}</label>
                                    <div class="form-group">
                                        <div class="d-flex justifiy-content-between">
                                            <div class="item">
                                                <input type="radio" name="expense_category" id="maintenance" value="maintenance" {{ $Expense->expense_category == 'maintenance' ? 'checked' : '' }}>
                                                <label for="maintenance">{{ __('admin.maintenance') }}</label>
                                            </div>
                                            <div class="item">
                                                <input type="radio" name="expense_category" id="fuel" value="fuel" {{ $Expense->expense_category == 'fuel' ? 'checked' : '' }}>
                                                <label for="fuel">{{ __('admin.fuel') }}</label>
                                            </div>
                                            <div class="item">
                                                <input type="radio" name="expense_category" id="other" value="other" {{ $Expense->expense_category == 'other' ? 'checked' : '' }}>
                                                <label for="other">{{ __('admin.other') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="by_whom">{{__('admin.by_whom')}}</label>
                                    <input type="text" value="{{ $Expense->employee }}" name="by_whom" id="by_whom" placeholder="{{ __('admin.by_whom') }}" class="form-control">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle">{{__('admin.vehicle')}}</label>
                                    <select name="vehicle" id="vehicle" class="form-control select2">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ $Expense->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vendor">{{__('admin.vendor')}}</label>
                                    <select name="vendor" id="vendor" class="form-control select2">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" {{ $Expense->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trip_number">{{__('admin.trip_number')}}</label>
                                    <input type="number" name="trip_number" value="{{ $Expense->trip_number }}" id="trip_number" class="form-control" placeholder="{{__('admin.trip_number')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trip_type">{{__('admin.trip_type')}}</label>
                                    <input type="text" value="{{ $Expense->trip_type }}" placeholder="{{ __('admin.trip_type') }}" name="trip_type" id="trip_type"  class="form-control">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="odometer">{{__('admin.odometer')}}</label>
                                        <input type="number" name="odometer" value="{{ $Expense->odometer }}" id="odometer" class="form-control" placeholder="{{__('admin.odometer')}}">
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expense_date">{{__('admin.expense_date')}}</label>
                                    <input type="date" name="expense_date" value="{{ $Expense->expense_date }}" id="expense_date" class="form-control" placeholder="{{__('admin.expense_date')}}" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="charge">{{__('admin.invoice')}}</label>
                                        <input type="text" name="invoice" value="{{ $Expense->invoice }}" id="invoice" class="form-control" placeholder="{{__('admin.invoice')}}">
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rent_vehicle_cost">{{__('admin.rent_vehicle_cost')}}</label>
                                    <input type="number" value="{{ $Expense->rent_vehicle_cost }}" name="rent_vehicle_cost" id="rent_vehicle_cost" class="form-control" placeholder="{{__('admin.rent_vehicle_cost')}}">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remarks">{{__('admin.remarks')}}</label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="5" class="form-control">{{ $Expense->remarks }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        @if (count($ExpenseData)>0)
                        <div class="row">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.expense_name') }}</th>
                                                <th>{{ __('admin.measurement_unit') }}</th>
                                                <th>{{ __('admin.unit_price') }}</th>
                                                <th>{{ __('admin.total_amount') }}</th>
                                                <th>{{ __('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ExpenseData as $data)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="expense_name[]" class="form-control expense_name" value="{{ $data->name }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" value="{{ $data->measurement_unit }}" name="measurement_unit[]" class="form-control measurement_unit">
                                                    </td>
                                                    <td>
                                                        <input type="number" value="{{ $data->unit_price }}" name="unit_price[]" class="form-control unit_price">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="total_amount[]" class="form-control total_amount" readonly  value="{{ $data->total_amount }}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger delete_row">{{ __('admin.delete') }}</button>
                                                    </td>
                                                </tr>
                                            @endforeach

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
                                                    <input type="number" class="form-control" name="grand_total" id="grand_total" readonly value="{{ $Expense->grand_total }}">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        @endif

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
            $(document).on('keyup','.measurement_unit',function(){
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
                var ItemUnit = $(this).parent().parent().find('td').find('.measurement_unit').val();
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
                        <input type="text" name="expense_name[]" class="form-control expense_name">
                    </td>
                    <td>
                        <input type="number" value="0" name="measurement_unit[]" class="form-control measurement_unit">
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
