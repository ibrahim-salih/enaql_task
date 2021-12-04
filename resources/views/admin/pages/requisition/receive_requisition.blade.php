@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.requisitions')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_requisition')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.requisition.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                            @if (Auth::user()->hasRole('admin'))
                            <div class="col-md-6">
                                <label for="client">{{ __('admin.client') }}</label>
                                <select name="client" id="client" class="form-control select2">
                                    @foreach (App\Models\User::role('client')->get() as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="received_from_date">{{ __('admin.received_from_date') }}</label>
                                    <input type="date" name="received_from_date" id="received_from_date" placeholder="{{ __('admin.received_from_date') }}" value="{{ old('received_from_date') }}" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-received_to_date">
                                    <label for="time_from">{{__('admin.received_to_date')}}</label>
                                    <input type="date" name="received_to_date" id="received_to_date" value="{{ old('received_to_date') }}" class="form-control" placeholder="{{__('admin.received_to_date')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="late_days">{{__('admin.late_days')}}</label>
                                    <input type="number" name="late_days" id="late_days" value="{{ old('late_days') }}" class="form-control" placeholder="{{__('admin.late_days')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="late_days_price">{{__('admin.late_days_price')}}</label>
                                    <input type="number" name="late_days_price" value="{{ old('late_days_price') }}" id="late_days_price" placeholder="{{ __('admin.late_days_price') }}" class="form-control" required>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection


