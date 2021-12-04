@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.insurances')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_insurnace')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.insurance.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="company">{{__('admin.compnay_name')}}</label>
                                    <select name="company" id="company" class="form-control select2">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="policy_number">{{ __('admin.policy_number') }}</label>
                                    <input type="number" name="policy_number" id="policy_number" placeholder="{{ __('admin.policy_number') }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge_payable">{{ __('admin.charge_payable') }}</label>
                                    <input type="number" name="charge_payable" id="charge_payable" placeholder="{{ __('admin.charge_payable') }}" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">{{ __('admin.start_date') }}</label>
                                    <input type="date" name="start_date" id="start_date" placeholder="{{ __('admin.start_date') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">{{ __('admin.end_date') }}</label>
                                    <input type="date" name="end_date" id="end_date" placeholder="{{ __('admin.end_date') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recurring_period">{{ __('admin.recurring_period') }}</label>
                                    <select name="recurring_period" id="recurring_period" class="form-control" required>
                                        <option value="1year">{{ __('admin.1year') }}</option>
                                        <option value="1month">{{ __('admin.1month') }}</option>
                                        <option value="15days">{{ __('admin.15days') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recurring_date">{{ __('admin.recurring_date') }}</label>
                                    <input type="date" name="recurring_date" id="recurring_date" placeholder="{{ __('admin.recurring_date') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remainder">{{ __('admin.remainder') }}</label>
                                    <input type="checkbox" name="remainder" id="remainder">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deductible">{{ __('admin.deductible ') }}</label>
                                    <input type="number" name="deductible" id="deductible" placeholder="{{ __('admin.deductible') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ __('admin.status') }}</label>
                                    <input type="checkbox" name="status" id="status">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="policy_document">{{ __('admin.policy_document') }}</label>
                                    <input type="file" name="policy_document" id="policy_document" required class="d-block">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="remarks">{{ __('admin.remarks') }}</label>
                                <textarea name="remarks" id="" cols="30" placeholder="{{ __('admin.remarks') }}" rows="10" class="form-control"></textarea>
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