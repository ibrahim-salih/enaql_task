@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.refueling_requisitions')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_refueling_requisition')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.refueling-requisition.update',$RefuelingRequisition->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="vehicle">{{__('admin.vehicle')}}</label>
                                    <select name="vehicle" id="vehicle" class="form-control select2">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ $RefuelingRequisition->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fuel_type">{{__('admin.fuel_type')}}</label>
                                    <select name="fuel_type" id="fuel_type" class="form-control select2">
                                        @foreach ($fuel_types as $fuel_type)
                                            <option value="{{ $fuel_type->id }}" {{ $RefuelingRequisition->fuel_type_id == $fuel_type->id ? 'selected' : '' }}>{{ $fuel_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="station">{{__('admin.station')}}</label>
                                    <select name="station" id="station" class="form-control select2">
                                        @foreach ($stations as $station)
                                            <option value="{{ $station->id }}" {{ $RefuelingRequisition->station_id == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">{{__('admin.quantity')}}</label>
                                    <input type="number" name="quantity" id="quantity" value="{{ $RefuelingRequisition->quantity }}" required class="form-control" placeholder="{{ __('admin.quantity') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="current_odometer">{{__('admin.current_odometer')}}</label>
                                    <input type="number" name="current_odometer" value="{{ $RefuelingRequisition->current_odometer }}" id="current_odometer" required class="form-control" placeholder="{{ __('admin.current_odometer') }}">
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
@endsection
