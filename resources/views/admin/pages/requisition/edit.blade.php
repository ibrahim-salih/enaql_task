@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.requisitions')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_requisition')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.requisition.update',$requisition->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="client_to">{{ __('admin.client_to') }}</label>
                                    <input type="text" value="{{ $requisition->client_to }}" name="client_to" id="client_to" placeholder="{{ __('admin.client_to') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type">{{__('admin.vehicle_type')}}</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control select2">
                                        @foreach ($vehicle_types as $vehicle_type)
                                            <option value="{{ $vehicle_type->id }}" {{ $vehicle_type->id == $requisition->vehicle_type_id ? 'selected' : '' }}>{{ $vehicle_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_from">{{__('admin.time_from')}}</label>
                                    <input type="time" name="time_from" id="time_from" value="{{ $requisition->time_from }}" class="form-control" placeholder="{{__('admin.time_from')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_to">{{__('admin.time_to')}}</label>
                                    <input type="time" name="time_to" id="time_to" value="{{ $requisition->time_to }}" class="form-control" placeholder="{{__('admin.time_to')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tolerance_duration">{{__('admin.tolerance_duration')}}</label>
                                    <input type="text" name="tolerance_duration" value="{{ $requisition->tolerance_duration }}" id="tolerance_duration" class="form-control" placeholder="{{__('admin.tolerance_duration')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_of_passengers">{{__('admin.no_of_passengers')}}</label>
                                    <input type="number" name="no_of_passengers" id="no_of_passengers" value="{{ $requisition->no_of_passengers }}" class="form-control" placeholder="{{__('admin.no_of_passengers')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driven_by">{{__('admin.driven_by')}}</label>
                                    <select name="driven_by" id="driven_by" class="form-control select2">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $driver->id == $requisition->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">{{__('admin.purpose')}}</label>
                                    <select name="purpose" id="purpose" class="form-control select2">
                                        @foreach ($purposes as $purpose)
                                        <option value="{{ $purpose->id }}" {{ $purpose->id == $requisition->purpose_id ? 'selected' : '' }}>{{ $purpose->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number_of_orders">{{__('admin.number_of_orders')}}</label>
                                    <input type="number" value="{{ $requisition->number_of_orders }}" name="number_of_orders" id="number_of_orders" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place">{{__('admin.place')}}</label>
                                    <select name="place" id="place" class="form-control select2">
                                        @foreach ($places as $place)
                                            <option {{ $requisition->price_control_id == $place->id ? 'selected' : '' }} value="{{ $place->id }}"  data-from="{{ $place->from }}" data-to="{{ $place->to }}">{{ $place->from }} => {{ $place->to }} ({{ $place->price_per_order }} SAR)</option>
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
                                    <label for="requisition_date">{{__('admin.requisition_date')}}</label>
                                    <input type="date" name="requisition_date" value="{{ $requisition->requisition_date }}" id="requisition_date" class="form-control" placeholder="{{__('admin.requisition_date')}}">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="delivery_date">{{__('admin.delivery_date')}}</label>
                                    <input type="date" value="{{ $requisition->delivery_date }}" name="delivery_date" id="delivery_date" class="form-control" required>
                                </div>
                            </div>
                        </div>




                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="received_from_date">{{ __('admin.received_from_date') }}</label>
                                <input type="date" name="received_from_date" id="received_from_date" placeholder="{{ __('admin.received_from_date') }}" value="{{ $requisition->received_from_date }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-received_to_date">
                                <label for="time_from">{{__('admin.received_to_date')}}</label>
                                <input type="date" name="received_to_date" id="received_to_date" value="{{ $requisition->received_to_date }}" class="form-control" placeholder="{{__('admin.received_to_date')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="late_days">{{__('admin.late_days')}}</label>
                                <input type="number" name="late_days" id="late_days" value="{{ $requisition->late_days  }}" class="form-control" placeholder="{{__('admin.late_days')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="late_days_price">{{__('admin.late_days_price')}}</label>
                                <input type="number" name="late_days_price" value="{{ $requisition->late_days_price }}" id="late_days_price" placeholder="{{ __('admin.late_days_price') }}" class="form-control" required>
                            </div>
                        </div>

                    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details">{{__('admin.details')}}</label>
                                    <textarea name="details" id="details" cols="30" rows="5" class="form-control">{{ $requisition->details }}</textarea>
                                </div>
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
    $(document).ready(function(){
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
    })
</script>
@endsection
