@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.routes')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_route')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.route.update',$route->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="name">{{__('admin.name')}}</label>
                                    <input type="text" name="name" id="name" value="{{ $route->name }}" class="form-control" placeholder="{{__('admin.name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_point">{{__('admin.start_point')}}</label>
                                    <input type="text" name="start_point" value="{{ $route->start_point }}" id="start_point" class="form-control" placeholder="{{__('admin.start_point')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="destination">{{__('admin.destination')}}</label>
                                    <input type="text" name="destination" value="{{ $route->destination }}" id="destination" class="form-control" placeholder="{{__('admin.destination')}}" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $route->is_active == 1 ? 'checked' : '' }}> 
                                        <label for="is_active">{{ __('admin.is_active') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" name="pick_drop_point" id="pick_drop_point" value="1" {{ $route->pick_drop_point == 1 ? 'checked' : '' }}>
                                        <label for="pick_drop_point">{{ __('admin.pick_drop_point') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">{{__('admin.description')}}</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="{{ __('admin.description') }}" required>{{ $route->description }}</textarea>
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