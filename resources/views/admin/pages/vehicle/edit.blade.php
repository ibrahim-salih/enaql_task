@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.vehicles')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_driver')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.vehicle.update',$vehicle->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="name">{{__('admin.vehicle_name')}}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{__('admin.vehicle_name')}}" required value="{{ $vehicle->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type">{{__('admin.vehicle_type')}}</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control select2">
                                        @foreach ($vehicle_types as $type)
                                            <option value="{{ $type->id }}" {{ $type->id == $vehicle->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">{{__('admin.department')}}</label>
                                    <select name="department" id="department" class="form-control select2">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $department->id == $vehicle->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_division">{{__('admin.vehicle_division')}}</label>
                                    <select name="vehicle_division" id="vehicle_type" class="form-control select2">
                                        @foreach ($vehicle_divisions as $division)
                                            <option value="{{ $division->id }}" {{ $division->id == $vehicle->division_id ? 'selected' : '' }}>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_date">{{__('admin.registration_date')}}</label>
                                    <input type="date" name="registration_date" id="registration_date" class="form-control" value="{{ $vehicle->registration_date }}" placeholder="{{__('admin.registration_date')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="office">{{__('admin.office')}}</label>
                                    <select name="office" id="office" class="form-control select2">
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}" {{ $office->id == $vehicle->office_id ? 'selected' : '' }}>{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_plate">{{__('admin.license_plate')}}</label>
                                    <input type="text" name="license_plate" id="license_plate" class="form-control" value="{{ $vehicle->license_plate }}" placeholder="{{__('admin.license_plate')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driver">{{__('admin.driver')}}</label>
                                    <select name="driver" id="driver" class="form-control select2">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $driver->id == $vehicle->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase_date">{{__('admin.purchase_date')}}</label>
                                    <input type="date" value="{{ $vehicle->purchase_date }}" name="purchase_date" id="purchase_date" class="form-control" placeholder="{{__('admin.purchase_date')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">{{__('admin.company_name')}}</label>
                                    <input value="{{ $vehicle->company_name }}" type="text" name="company_name" placeholder="{{ __('admin.company_name') }}" id="company_name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alert_email">{{__('admin.alert_email')}}</label>
                                    <input type="email" name="alert_email" value="{{ $vehicle->alert_email }}" id="alert_email" class="form-control" placeholder="{{__('admin.alert_email')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="seat_capacity">{{__('admin.seat_capacity')}}</label>
                                    <input type="number" name="seat_capacity" value="{{ $vehicle->seat_capacity }}" id="seat_capacity" class="form-control" placeholder="{{__('admin.seat_capacity')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ownership">{{__('admin.ownership')}}</label>
                                    <select name="ownership" id="ownership" class="form-control select2">
                                        <option value="ownered_by_company" {{ $vehicle->ownership == 'ownered_by_company' ? 'selected' : '' }}>{{ __('admin.ownered_by_company') }}</option>
                                        <option value="rented" {{ $vehicle->ownership == 'rented' ? 'selected' : '' }}>{{ __('admin.rented') }}</option>
                                    </select>
                                </div>
                                <div id="result">
                                    @if ($vehicle->ownership == 'rented')
                                    <div class="form-group">
                                        <label for="rent_from">{{__('admin.rent_from')}}</label>
                                        <input type="text" value="{{ $vehicle->rent_from }}" name="rent_from" id="rent_from" placeholder="{{ __('admin.rent_from') }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="rent_price">{{__('admin.rent_price')}}</label>
                                        <input type="number" value="{{ $vehicle->rent_price }}" name="rent_price" id="rent_price" placeholder="{{ __('admin.rent_price') }}" class="form-control">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="insurance_type">{{__('admin.insurance_type')}}</label>
                                    <input type="text" value="{{ $vehicle->insurance_type }}" name="insurance_type" id="insurance_type" placeholder="{{ __('admin.insurance_type') }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="insurance_company">{{__('admin.insurance_company')}}</label>
                                    <input type="text" value="{{ $vehicle->insurance_company }}" name="insurance_company" id="insurance_company" placeholder="{{ __('admin.insurance_company') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="insurance_start_date">{{__('admin.insurance_start_date')}}</label>
                                    <input type="date" value="{{ $vehicle->insurance_start_date }}" name="insurance_start_date" id="insurance_start_date" placeholder="{{ __('admin.insurance_start_date') }}" class="form-control">
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
    $(function(){
        $('#ownership').change(function(){
            if($(this).val() == 'rented'){
                html = `
                <div class="form-group">
                    <label for="rent_from">{{__('admin.rent_from')}}</label>
                    <input type="text" name="rent_from" id="rent_from" placeholder="{{ __('admin.rent_from') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="rent_price">{{__('admin.rent_price')}}</label>
                    <input type="number" name="rent_price" id="rent_price" placeholder="{{ __('admin.rent_price') }}" class="form-control">
                </div>
                `;
                $('#result').append(html);
            }else{
                $('#result').html(' ');
            }
        })
    });
</script>
@endsection
