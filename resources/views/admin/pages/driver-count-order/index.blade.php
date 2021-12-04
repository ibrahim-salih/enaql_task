@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.driver_count_order')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0">

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver-count-order.data') }}" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="driver_id">{{ __('admin.driver') }}</label>
                                        <select name="driver_id" id="driver_id" class="form-control select2">
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date1">{{ __('admin.start_date') }}</label>
                                        <input type="date" name="start_date" id="date1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date2">{{ __('admin.end_date') }}</label>
                                        <input type="date" name="end_date" id="date2" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">{{ __('admin.show') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>



@endsection


@section('js')

@endsection
