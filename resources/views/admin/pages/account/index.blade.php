@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.my_account')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <form action="{{ route('admin.my-account.update') }}" method="post" id="store" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
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
                                        <label for="name">{{ __('admin.name') }}</label>
                                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('admin.email') }}</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{ __('admin.password') }}</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('admin.password') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">{{ __('admin.password_confirmation') }}</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('admin.password_confirmation') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="profile_photo">{{ __('admin.profile_photo') }}</label>
                                    <input type="file" name="profile_photo" id="profile_photo" class="d-block">
                                </div>
                                @if (!is_null($user->profile))
                                <div class="col-md-6">
                                    <label for="current_photo">{{ __('admin.current_photo') }}</label>
                                    <img src="{{ url($user->profile) }}" alt="photo" class="img-fluid d-block">
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
