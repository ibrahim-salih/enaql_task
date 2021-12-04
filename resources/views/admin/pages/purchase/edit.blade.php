@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.purchases')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_purchase')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.purchase.update',$purchase->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="vendor">{{__('admin.vendor')}}</label>
                                    <select name="vendor" id="vendor" class="form-control select2">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" {{ $purchase->vendor_id == $vendor->id ? 'selected' : ''}}>{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">{{__('admin.date')}}</label>
                                        <input type="date" name="date" id="date" value="{{ $purchase->date }}" class="form-control" placeholder="{{__('admin.date')}}">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice">{{__('admin.invoice')}}</label>
                                    <input type="text" name="invoice" id="invoice" value="{{ $purchase->invoice }}" class="form-control" placeholder="{{__('admin.invoice')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="manual_requisition_image">{{__('admin.manual_requisition_image')}}</label>
                                        <input type="file" name="manual_requisition_image" class="d-block" id="manual_requisition_image">
                                        <div class="mt-3 w-50">
                                            <img src="{{ $manual_requisition_image }}" class="img-fluid" alt="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="work_order_image">{{__('admin.work_order_image')}}</label>
                                            <input type="file" name="work_order_image" class=" d-block" id="work_order_image">
                                            <div class="mt-3 w-50">
                                                <img src="{{ $work_order_image }}" class="img-fluid" alt="image">
                                            </div>
                                        </div>
                                    </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        @if (count($purchase_data) > 0)
                        <div class="row">
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.category_name') }}</th>
                                                <th>{{ __('admin.item_name') }}</th>
                                                <th>{{ __('admin.item_unit') }}</th>
                                                <th>{{ __('admin.unit_price') }}</th>
                                                <th>{{ __('admin.total_amount') }}</th>
                                                <th>{{ __('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchase_data as $data)
                                                <tr>
                                                    <td>
                                                        <input type="text" value="{{ $data->category_name }}" name="category_name[]" class="form-control category_name">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="item_name[]" value="{{ $data->item_name }}" class="form-control item_name">
                                                    </td>
                                                    <td>
                                                        <input type="number" value="{{ $data->item_unit }}" name="item_unit[]" class="form-control item_unit">
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
                                                    <input type="number" class="form-control" name="grand_total" id="grand_total" readonly value="{{ $purchase->grand_total }}">
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
                        <input type="text" name="category_name[]" class="form-control category_name">
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
