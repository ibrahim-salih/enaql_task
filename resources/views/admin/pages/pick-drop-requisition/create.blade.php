@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.pick_drop_requisition')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_pick_drop_requisition')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.pick-drop-requisition.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="route">{{__('admin.route')}}</label>
                                    <select name="route" id="route" class="form-control select2" required>
                                        @foreach ($routes as $route)
                                            <option value="{{ $route->id }}">{{ $route->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_for">{{__('admin.requisition_for')}}</label>
                                    <select name="requisition_for" id="requisition_for" class="form-control select2" required>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_point">{{__('admin.start_point')}}</label>
                                    <input type="text" name="start_point" id="start_point" class="form-control" placeholder="{{__('admin.start_point')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_point">{{__('admin.end_point')}}</label>
                                    <input type="text" name="end_point" id="end_point" class="form-control" placeholder="{{ __('admin.end_point') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="request_type">{{__('admin.request_type')}}</label>
                                    <div class="d-flex justifiy-content-between">
                                        <div class="item">
                                            <input type="radio" name="request_type" id="regular" checked value="regular">
                                            <label for="regular">{{ __('admin.regular') }}</label>
                                        </div>
                                        <div class="item">
                                            <input type="radio" name="request_type" id="specific_day" value="specific_day">
                                            <label for="specific_day">{{ __('admin.specific_day') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_type">{{__('admin.requisition_type')}}</label>
                                    <select name="requisition_type" id="requisition_type" class="form-control select2" required>
                                        @foreach ($requisition_types as $requisition_type)
                                            <option value="{{ $requisition_type->id }}">{{ $requisition_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="effective_date">{{ __('admin.effective_date') }}</label>
                                    <input type="date" name="effective_date" id="effective_date" class="form-control">
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