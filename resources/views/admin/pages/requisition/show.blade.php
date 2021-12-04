@extends('admin.layouts.app')

@section('css')
    <style>

    </style>
@endsection

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
                <div class="card card-custom">
                    <div class="card-header d-flex">
                        <div class="card-title">



                        </div>
                    </div>
                    <div class="card-body">
                        @if ($requisition->status == App\Models\Requisition::PENDING)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assign_driver">{{__('admin.assign_driver')}}</label>
                                    <select name="assign_driver" id="assign_driver" class="form-control select2">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $driver->id == $requisition->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-md btn-success btn__accept" style="margin-top: 28px;">
                                    <i class="fas fa-clipboard-check"></i> <strong> {{__('admin.accept')}}</strong>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_time_from">{{__('admin.time_from')}}</label>
                                    <input type="time" name="new_time_from" id="new_time_from" value="{{ $requisition->time_from }}" class="form-control" placeholder="{{__('admin.time_from')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_time_to">{{__('admin.time_to')}}</label>
                                    <input type="time" name="new_time_to" id="new_time_to" value="{{ $requisition->time_to }}" class="form-control" placeholder="{{__('admin.time_to')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-md btn-primary ask_for_edit">
                                        <i class="icon-md fas fa-edit"></i> <strong> {{__('admin.ask_for_edit')}}</strong>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @else

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><h3>{{ __("admin.status") }}</h3></label>
                                    <h4>{{ $requisition->status() }}</h4>
                                </div>
                            </div>
                            @if ($requisition->status == App\Models\Requisition::DELIVERED)
                            <div class="row">
                                <div class="col-md-6">
                                    <a target="_blank" href="{{ route('admin.requisition-print',$requisition->id) }}" class="btn btn-secondary">{{ __('admin.print') }}</a>
                                </div>
                            </div>
                            @endif
                        </div>

                        @endif




                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_to">{{__('admin.client_to')}}</label>
                                    <input type="text" readonly value="{{ $requisition->client_to }}" name="client_to" id="client_to" placeholder="{{ __('admin.client_to') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type">{{__('admin.vehicle_type')}}</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control select2" disabled>
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
                                    <input type="time" name="time_from" id="time_from" disabled value="{{ $requisition->time_from }}" class="form-control" placeholder="{{__('admin.time_from')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_to">{{__('admin.time_to')}}</label>
                                    <input type="time" name="time_to" id="time_to" disabled value="{{ $requisition->time_to }}" class="form-control" placeholder="{{__('admin.time_to')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tolerance_duration">{{__('admin.tolerance_duration')}}</label>
                                    <input type="text" name="tolerance_duration" disabled value="{{ $requisition->tolerance_duration }}" id="tolerance_duration" class="form-control" placeholder="{{__('admin.tolerance_duration')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_of_passengers">{{__('admin.no_of_passengers')}}</label>
                                    <input type="number" name="no_of_passengers" disabled id="no_of_passengers" value="{{ $requisition->no_of_passengers }}" class="form-control" placeholder="{{__('admin.no_of_passengers')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driven_by">{{__('admin.driven_by')}}</label>
                                    <select name="driven_by" id="driven_by" class="form-control select2" disabled>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $driver->id == $requisition->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">{{__('admin.purpose')}}</label>
                                    <select name="purpose" id="purpose" class="form-control select2" disabled>
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
                                    <label for="clients">{{__('admin.clients')}}</label>
                                    <input type="text" name="clients" disabled value="{{ $requisition->client->name }}" id="requisition_date" class="form-control" placeholder="{{__('admin.requisition_date')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_date">{{__('admin.requisition_date')}}</label>
                                    <input type="date" name="requisition_date" disabled value="{{ $requisition->requisition_date }}" id="requisition_date" class="form-control" placeholder="{{__('admin.requisition_date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place">{{__('admin.place')}}</label>
                                    <select name="place" id="place" class="form-control select2" disabled>
                                        @foreach ($places as $place)
                                            <option value="{{ $place->id }}" {{ $place->id == $requisition->price_control_id ? 'selected' : '' }}>{{ $place->from }} => {{ $place->to }} ({{ $place->price_per_order }} SAR)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="details">{{__('admin.details')}}</label>
                                    <textarea name="details" id="details" disabled cols="30" rows="5" class="form-control">{{ $requisition->details }}</textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
        </div>
    </div>

    <!-- Modal -->

@endsection

@section('js')

<script>
    $(function(){

        // start accept ajax
        $('.btn__accept').click(function(){
            var DriverId = $('#assign_driver').val();
            $.ajax({
                url : '{{ route("admin.requisition-admin-accept") }}',
                data:{
                    DriverId:DriverId,
                    RequisitionId : "{{ $requisition->id }}"
                },
                success : function(response){
                    toastr.success(response);
                }
            })
        })
        // start ask for edit ajax
        $('.ask_for_edit').click(function(){
            var NewFromTime = $('#new_time_from').val();
            var NewToTime = $('#new_time_to').val();
            $.ajax({
                url : "{{ route('admin.requisition-admin-ask-for-edit') }}",
                data:{
                    NewFromTime : NewFromTime,
                    NewToTime : NewToTime,
                    RequisitionId : "{{ $requisition->id }}",
                    ClientId : "{{ $requisition->client->id }}",
                    UserId : "{{ Auth::id() }}"
                },
                success : function(response){
                    toastr.success(response);
                }
            });
        })

    });
</script>

@endsection
