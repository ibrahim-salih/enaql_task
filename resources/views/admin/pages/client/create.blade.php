@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.clients')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.add_new_client')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.client.store') }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="name">{{__('admin.name')}}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{__('admin.name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="has_account" id="has_account" value="1">
                                    <label for="has_account">{{ __('admin.has_account') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_account_number">{{ __('admin.bank_account_number') }}</label>
                                    <input type="number" name="bank_account_number" id="bank_account_number" placeholder="{{ __('admin.bank_account_number') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">{{ __('admin.company_name') }}</label>
                                    <input type="text" name="company_name" id="company_name" placeholder="{{ __('admin.company_name') }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">{{ __('admin.mobile') }}</label>
                                    <input type="number" name="mobile" id="mobile" placeholder="{{ __('admin.mobile') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ __('admin.phone') }}</label>
                                    <input type="number" name="phone" id="phone" placeholder="{{ __('admin.phone') }}" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="commercial_number">{{ __('admin.commercial_number') }}</label>
                                    <input type="number" name="commercial_number" id="commercial_number" placeholder="{{ __('admin.commercial_number') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ __('admin.address') }}</label>
                                    <input type="text" name="address" id="address" placeholder="{{ __('admin.address') }}" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="account d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{__('admin.email')}}</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="{{__('admin.email')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{__('admin.password')}}</label>
                                        <input type="password" name="password" id="password" value=" " class="form-control" placeholder="{{__('admin.password')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">{{__('admin.password_confirmation')}}</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" value=" " class="form-control" placeholder="{{__('admin.password_confirmation')}}">
                                    </div>
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
    <script>
        $(function(){
            $('#has_account').click(function(){
                console.log(1);
                $('.account').removeClass('d-none')
            })
        })
    </script>
@endsection
