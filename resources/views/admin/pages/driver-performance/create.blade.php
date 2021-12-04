@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.drivers_performances')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_driver_performance')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.driver-performance.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="driver">{{__('admin.driver_name')}}</label>
                                    <select name="driver" id="driver" class="form-control select2">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penalty_amount">{{__('admin.penalty_amount')}}</label>
                                    <input type="number" name="penalty_amount" id="penalty_amount" class="form-control" placeholder="{{__('admin.penalty_amount')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="over_time_status">{{__('admin.over_time_status')}}</label>
                                    <select name="over_time_status" id="over_time_status" class="form-control">
                                        <option value="1">{{ __('admin.yes') }}</option>
                                        <option value="0">{{ __('admin.no') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="salary_status" class="mr-2">{{ __('admin.salary_status') }}</label>
                                    <input type="radio" name="salary_status" id="yes" value="1">
                                    <label for="yes">{{ __('admin.yes') }}</label>
                                    <input type="radio" name="salary_status" id="no" value="0">
                                    <label for="yes">{{ __('admin.no') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penalty_reason">{{__('admin.penalty_reason')}}</label>
                                    <textarea class="form-control" name="penalty_reason" id="penalty_reason" cols="30" rows="5" placeholder="{{__('admin.penalty_reason')}}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="overtime_payment">{{__('admin.overtime_payment')}}</label>
                                    <input type="number" name="overtime_payment" id="overtime_payment" class="form-control" placeholder="{{__('admin.overtime_payment')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penalty_date">{{__('admin.penalty_date')}}</label>
                                    <input type="date" name="penalty_date" id="penalty_date" class="form-control" placeholder="{{__('admin.penalty_date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="performance_bonus">{{__('admin.performance_bonus')}}</label>
                                    <input type="number" name="performance_bonus" id="performance_bonus" class="form-control" placeholder="{{__('admin.performance_bonus')}}" required>
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