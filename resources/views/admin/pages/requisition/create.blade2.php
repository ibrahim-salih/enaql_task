@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.requisitions')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_requisition')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.requisition.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                            @if (Auth::user()->hasRole('admin'))
                            <div class="col-md-6">
                                <label for="client">{{ __('admin.client') }}</label>
                                <select name="client" id="client" class="form-control select2">
                                    @foreach (App\Models\User::role('client')->get() as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_to">{{ __('admin.client_to') }}</label>
                                    <input type="text" name="client_to" id="client_to" placeholder="{{ __('admin.client_to') }}" value="{{ old('client_to') }}" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_from">{{__('admin.time_from')}}</label>
                                    <input type="time" name="time_from" id="time_from" value="{{ old('time_from') }}" class="form-control" placeholder="{{__('admin.time_from')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_to">{{__('admin.time_to')}}</label>
                                    <input type="time" name="time_to" id="time_to" value="{{ old('time_to') }}" class="form-control" placeholder="{{__('admin.time_to')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number_of_orders">{{__('admin.number_of_orders')}}</label>
                                    <input type="number" name="number_of_orders" value="{{ old('number_of_orders') }}" id="number_of_orders" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place">{{__('admin.place')}}</label>
                                    <select name="place" id="place" class="form-control select2">
                                        @foreach ($places as $place)
                                            <option value="{{ $place->id }}" data-from="{{ $place->from }}" data-to="{{ $place->to }}">{{ $place->from }} => {{ $place->to }} ({{ $place->price_per_order }} SAR)</option>
                                        @endforeach
                                    </select>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="from">{{__('admin.from')}}</label>
                                                <input type="text" id="from" value="" disabled>
                                            </div>
                                         </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                            <label for="to" >{{__('admin.to')}}</label>
                                            <input type="text" id="to" value="" disabled>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tolerance_duration">{{__('admin.tolerance_duration')}}</label>
                                    <input type="text" name="tolerance_duration" id="tolerance_duration" class="form-control" placeholder="{{__('admin.tolerance_duration')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_of_passengers">{{__('admin.no_of_passengers')}}</label>
                                    <input type="number" name="no_of_passengers" id="no_of_passengers" class="form-control" placeholder="{{__('admin.no_of_passengers')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driven_by">{{__('admin.driven_by')}}</label>
                                    <select name="driven_by" id="driven_by" class="form-control select2">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type">{{__('admin.vehicle_type')}}</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control select2">
                                        @foreach ($vehicle_types as $vehicle_type)
                                            <option value="{{ $vehicle_type->id }}">{{ $vehicle_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driven_by">{{__('admin.charge_number')}}</label>
                                    <input type="text" name="charge_number" id="charge_number" class="form-control" placeholder="{{__('admin.charge_number')}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_id">{{__('admin.vehicle_id')}}</label>
                                    <select name="vehicle_id" id="vehicle_type" class="form-control select2">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-4">
                                    <input type="checkbox" name="driver_has_account" id="driver_has_account" value="1" >
                                    <label for="driver_has_account">{{ __('admin.driver_has_account') }}</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_date">{{__('admin.requisition_date')}}</label>
                                    <input type="date" name="requisition_date" id="requisition_date" class="form-control" placeholder="{{__('admin.requisition_date')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="details">{{__('admin.details')}}</label>
                                    <textarea name="details" id="details" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">{{__('admin.purpose')}}</label>
                                    <select name="purpose" id="purpose" class="form-control select2">
                                        @foreach ($purposes as $purpose)
                                            <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="delivery_date">{{__('admin.delivery_date')}}</label>
                                    <input type="date" name="delivery_date" id="delivery_date" class="form-control" required>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin.item_name') }}</th>
                                            <th>{{ __('admin.item_number') }}</th>
                                            <th>{{ __('admin.notes') }}</th>
                                            <th>{{ __('admin.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="item_name[]">
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" value="0" name="item_number[]" class="form-control item_unit">
                                            </td>
                                            <td>
                                                <input type="text" name="notes[]" class="form-control notes">
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
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <select class="form-control d-none" id="selectable">
                @foreach ($items as $item)
                    <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(function(){
        function adder(){
            $('#add_row').click(function(){
                var selectable = $('#selectable').html();
            row = `
                <tr>
                    <td>
                        <select class="form-control select2" name="item_name[]">
                            ${selectable}
                        </select>
                    </td>
                    <td>
                        <input type="number" value="0" name="item_number[]" class="form-control item_unit">
                    </td>
                    <td>
                        <input type="text" name="notes[]" class="form-control notes">
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
                $(this).parent().parent().remove();
            })
        }

        adder();
        deleter();


        var option = $('#place').find('option:selected')
        var from = option.data('from')
        var to = option.data('to')
        $('#from').val(from)
        $('#to').val(to)
        $('#place').change(function(){
            var option = $(this).find('option:selected')
            var from = option.data('from')
            var to = option.data('to')
            $('#from').val(from)
            $('#to').val(to)

        })
    });
</script>
@endsection
