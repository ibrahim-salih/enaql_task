@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.drivers')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_driver')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.driver.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="name">{{__('admin.driver_name')}}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{__('admin.driver_name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">{{__('admin.mobile')}}</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control" placeholder="{{__('admin.mobile')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="health_insurance_date">{{__('admin.health_insurance_date')}}</label>
                                    <input type="date" name="health_insurance_date" id="health_insurance_date" class="form-control" placeholder="{{__('admin.health_insurance_date')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_expiration_date">{{__('admin.license_expiration_date')}}</label>
                                    <input type="date" name="license_expiration_date" id="license_expiration_date" class="form-control" placeholder="{{__('admin.license_expiration_date')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="residency_number">{{__('admin.residency_number')}}</label>
                                    <input type="number" name="residency_number" id="residency_number" class="form-control" placeholder="{{__('admin.residency_number')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="residency_expiration_date">{{__('admin.residency_expiration_date')}}</label>
                                    <input type="date" name="residency_expiration_date" id="residency_expiration_date" class="form-control" placeholder="{{__('admin.residency_expiration_date')}}">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="working_slot_from">{{__('admin.working_slot_from')}}</label>
                                    <input type="time" name="working_slot_from" id="working_slot_from" class="form-control" placeholder="{{__('admin.working_slot_from')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="working_slot_to">{{__('admin.working_slot_to')}}</label>
                                    <input type="time" name="working_slot_to" id="working_slot_to" class="form-control" placeholder="{{__('admin.working_slot_to')}}" required>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_expiration_date">{{__('admin.passport_expiration_date')}}</label>
                                    <input type="date" name="passport_expiration_date" id="passport_expiration_date" class="form-control" placeholder="{{__('admin.passport_expiration_date')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">{{__('admin.date_of_birth')}}</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="{{__('admin.date_of_birth')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_number">{{__('admin.passport_number')}}</label>
                                    <input type="number" name="passport_number" id="passport_number" class="form-control" placeholder="{{__('admin.passport_number')}}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{__('admin.email')}}</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{__('admin.email')}}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="leave_status">{{__('admin.leave_status')}}</label>
                                    <div class="d-flex">
                                        <div class="form-group">
                                            <label for="yes">{{ __('admin.yes') }}</label>
                                            <input type="radio" name="leave_status" id="yes"  value="1">
                                        </div>
                                        <div class="form-group">
                                            <label for="no">{{ __('admin.no') }}</label>
                                            <input type="radio" name="leave_status" id="no" checked value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label for="residency_number">{{ __('admin.residency_number') }}</label>
                                    <input type="number" name="residency_number" id="residency_number" placeholder="{{ __('admin.residency_number') }}" class="form-control">
                                </div> --}}
                                <div class="form-group">
                                    <label for="is_active">{{__('admin.is_active')}}</label>
                                    <input type="checkbox" name="is_active" id="is_active">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_number">{{ __('admin.license_number') }}</label>
                                    <input type="number" name="license_number" id="license_number" placeholder="{{ __('admin.license_number') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license_type_id">{{ __('admin.license_type_id') }}</label>
                                    <select name="license_type_id" id="license_type_id" class="form-control select2">
                                        @foreach (DB::table('license_types')->get() as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_account_number">{{ __('admin.bank_account_number') }}</label>
                                    <input type="number" name="bank_account_number" id="bank_account_number" placeholder="{{ __('admin.bank_account_number') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driver_photograph">{{ __('admin.driver_photograph') }}</label>
                                    <input type="file" name="driver_photograph" id="driver_photograph">
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
