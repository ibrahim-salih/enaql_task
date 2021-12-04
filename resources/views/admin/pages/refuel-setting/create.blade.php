@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.fuel_settings')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_fuel_setting')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.refuel-setting.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="driver">{{__('admin.driver')}}</label>
                                    <select name="driver" id="driver" class="form-control select2">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fuel_type">{{__('admin.fuel_type')}}</label>
                                    <select name="fuel_type" id="fuel_type" class="form-control select2">
                                        @foreach ($fuel_types as $fuel_type)
                                            <option value="{{ $fuel_type->id }}">{{ $fuel_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="station">{{__('admin.station')}}</label>
                                    <select name="station" id="station" class="form-control select2">
                                        @foreach ($stations as $station)
                                            <option value="{{ $station->id }}">{{ $station->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driver_mobile">{{__('admin.driver_mobile')}}</label>
                                    <input type="number" name="driver_mobile" id="driver_mobile" required class="form-control" placeholder="{{ __('admin.driver_mobile') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="refueled_date">{{__('admin.refueled_date')}}</label>
                                    <input type="date" name="refueled_date" id="refueled_date" class="form-control" placeholder="{{ __('admin.refueled_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="refuel_limit_type">{{__('admin.refuel_limit_type')}}</label>
                                    <input type="text" name="refuel_limit_type" id="refuel_limit_type" class="form-control" placeholder="{{ __('admin.refuel_limit_type') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_unit">{{__('admin.max_unit')}}</label>
                                    <input type="number" name="max_unit" id="max_unit" required class="form-control" placeholder="{{ __('admin.max_unit') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="budget_given">{{__('admin.budget_given')}}</label>
                                    <input type="number" name="budget_given" id="budget_given" class="form-control" placeholder="{{ __('admin.budget_given') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="consumption_percent">{{__('admin.consumption_percent')}}</label>
                                    <input type="number" name="consumption_percent" id="consumption_percent" required class="form-control" placeholder="{{ __('admin.consumption_percent') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place">{{__('admin.place')}}</label>
                                    <input type="text" name="place" id="place" class="form-control" placeholder="{{ __('admin.place') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="odometer_km">{{__('admin.odometer_km')}}</label>
                                    <input type="number" name="odometer_km" id="odometer_km" class="form-control" placeholder="{{ __('admin.odometer_km') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kilometer_per_unit">{{__('admin.kilometer_per_unit')}}</label>
                                    <input type="number" name="kilometer_per_unit" id="kilometer_per_unit" class="form-control" placeholder="{{ __('admin.kilometer_per_unit') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="odometer_at_time">{{__('admin.odometer_at_time')}}</label>
                                    <input type="number" name="odometer_at_time" id="odometer_at_time" class="form-control" placeholder="{{ __('admin.odometer_at_time') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_reading">{{__('admin.last_reading')}}</label>
                                    <input type="number" name="last_reading" id="last_reading" class="form-control" placeholder="{{ __('admin.last_reading') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_unit">{{__('admin.last_unit')}}</label>
                                    <input type="number" name="last_unit" id="last_unit" class="form-control" placeholder="{{ __('admin.last_unit') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit_taken">{{__('admin.unit_taken')}}</label>
                                    <input type="number" name="unit_taken" id="unit_taken" class="form-control" placeholder="{{ __('admin.unit_taken') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fuel_slip_scan_copy">{{ __('admin.fuel_slip_scan_copy') }}</label>
                                    <input type="file" name="fuel_slip_scan_copy" id="fuel_slip_scan_copy" class="d-block">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="strict_consumption" id="strict_consumption" value="1">
                                    <label for="strict_consumption">{{__('admin.strict_consumption')}}</label>
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
