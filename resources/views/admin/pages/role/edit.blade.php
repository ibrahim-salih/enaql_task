@extends('admin.layouts.app')


@section('content')
  <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.roles')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_role')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.role.update' , $Role->id) }}" method="post" id="store">
                @csrf
                @method('PUT')
                <div class="card card-custom">
                    <div class="card-header d-flex">
                        <div class="card-title">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="icon-md fas fa-edit"></i> <strong>{{__('admin.edit')}}</strong>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{__('admin.role_name')}}</label>
                                    <input disabled value="{{ $Role->name }}" type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permissions">{{__('admin.choose_permissions')}}</label>
                                    <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                                        @foreach ($Permissions as $Permission)
                                            <option value="{{ $Permission->id }}" {{ $Role->hasPermissionTo($Permission->name) ? 'selected' : '' }}>{{ __('admin.' . $Permission->name)  }}</option>
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
