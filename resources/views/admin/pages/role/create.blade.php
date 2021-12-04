@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.roles')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_role')}} </span>
            </div>
        </div>
    </div>
    @include('admin.includes.validation')
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.role.store') }}" method="post" id="store">
                @csrf
                <div class="card card-custom">
                    <div class="card-header d-flex">
                        <div class="card-title">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="icon-md fas fa-plus"></i> <strong> {{__('admin.add')}}</strong>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{__('admin.role_name')}}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{__('admin.role_name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permissions">{{__('admin.choose_permissions')}}</label>
                                    <select name="permissions[]" id="permissions" class="form-control select2" multiple required>
                                        @foreach ($Permissions as $Permission)
                                            <option value="{{ $Permission->id }}">{{ __('admin.' . $Permission->name)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
