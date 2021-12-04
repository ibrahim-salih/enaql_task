@extends('admin.layouts.app')

@section('css')
    <style>
        .pdf{
            font-size: 40px
        }
    </style>
@endsection

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.insurances')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_insurnace')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.insurance.update',$insurance->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="company">{{__('admin.compnay_name')}}</label>
                                    <select name="company" id="company" class="form-control select2">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}" {{ $company->id == $insurance->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle">{{__('admin.vehicle')}}</label>
                                    <select name="vehicle" id="vehicle" class="form-control select2">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" {{ $vehicle->id == $insurance->vehicle_id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="policy_number">{{ __('admin.policy_number') }}</label>
                                    <input type="number" name="policy_number" id="policy_number" value="{{ $insurance->policy_number }}" placeholder="{{ __('admin.policy_number') }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge_payable">{{ __('admin.charge_payable') }}</label>
                                    <input type="number" name="charge_payable" id="charge_payable" value="{{ $insurance->charge_payable }}" placeholder="{{ __('admin.charge_payable') }}" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">{{ __('admin.start_date') }}</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ $insurance->start_date }}" placeholder="{{ __('admin.start_date') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">{{ __('admin.end_date') }}</label>
                                    <input type="date" name="end_date" id="end_date" value="{{ $insurance->end_date }}" placeholder="{{ __('admin.end_date') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recurring_period">{{ __('admin.recurring_period') }}</label>
                                    <select name="recurring_period" id="recurring_period" class="form-control" required>
                                        <option value="1year" {{ $insurance->recurring_period == '1year' ? 'selected' : '' }}>{{ __('admin.1year') }}</option>
                                        <option value="1month" {{ $insurance->recurring_period == '1month' ? 'selected' : '' }}>{{ __('admin.1month') }}</option>
                                        <option value="15days" {{ $insurance->recurring_period == '15days' ? 'selected' : '' }}>{{ __('admin.15days') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recurring_date">{{ __('admin.recurring_date') }}</label>
                                    <input type="date" name="recurring_date" value="{{ $insurance->recurring_date }}" id="recurring_date" placeholder="{{ __('admin.recurring_date') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remainder">{{ __('admin.remainder') }}</label>
                                    <input type="checkbox" name="remainder" id="remainder" {{ $insurance->remainder == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deductible">{{ __('admin.deductible ') }}</label>
                                    <input type="number" name="deductible" id="deductible" value="{{ $insurance->deductible}}" placeholder="{{ __('admin.deductible') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{ __('admin.status') }}</label>
                                    <input type="checkbox" name="status" id="status" {{ $insurance->status == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="policy_document">{{ __('admin.policy_document') }}</label>
                                    <input type="file" name="policy_document" id="policy_document" class="d-block">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="remarks">{{ __('admin.remarks') }}</label>
                                <textarea name="remarks" id="remarks" cols="30" placeholder="{{ __('admin.remarks') }}" rows="10" class="form-control">{{ $insurance->remarks }}</textarea>
                            </div>
                            @if (!is_null($document))
                            <div class="col-md-6">
                                <label for="current_document">{{ __('admin.current_document') }}</label>
                                <a href="{{ $document }}" class="pdf d-block" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection