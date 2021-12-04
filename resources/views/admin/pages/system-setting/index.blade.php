@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.system_settings')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <form action="{{ route('admin.system-setting.update') }}" method="post" id="store" enctype="multipart/form-data">
                    @csrf
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
                                        <label for="system_name">{{ __('admin.system_name') }}</label>
                                        <input type="text" name="system_name" id="system_name" value="{{ $system_setting->system_name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="value_added_tax">{{ __('admin.value_added_tax') }}</label>
                                        <input type="number" name="value_added_tax" id="value_added_tax" value="{{ $system_setting->value_added_tax }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{ __('admin.address') }}</label>
                                        <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{ $system_setting->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tax_number">{{ __('admin.tax_number') }}</label>
                                        <input type="number" name="tax_number" id="tax_number" class="form-control" placeholder="{{ __('admin.tax_number') }}" value="{{ $system_setting->tax_number }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_account_number">{{ __('admin.bank_account_number') }}</label>
                                        <input type="number" name="bank_account_number" id="bank_account_number" class="form-control" placeholder="{{ __('admin.bank_account_number') }}" value="{{ $system_setting->bank_account_number }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo">{{ __('admin.logo') }}</label>
                                        <input type="file" name="logo" id="logo" class="d-block">
                                    </div>
                                </div>
                                @if (!is_null($system_setting->logo))
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <img src="{{ url($system_setting->logo) }}" alt="">

                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="banner">Banner Login</label>
                                        <input type="file" name="banner_login" id="banner_login" class="d-block">
                                    </div>
                                </div>
                                @if (!is_null($system_setting->banner_login))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img src="{{ url($system_setting->banner_login) }}" alt="">

                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="invoice_header">{{ __('admin.invoice_header') }}</label>
                                        <input type="file" name="invoice_header" class="d-block" id="invoice_header">
                                    </div>
                                </div>
                                @if (!is_null($system_setting->invoice_header))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img src="{{ url($system_setting->invoice_header) }}" alt="">

                                            </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="invoice_footer">{{ __('admin.invoice_footer') }}</label>
                                        <input type="file" name="invoice_footer" class="d-block" id="invoice_footer">
                                    </div>
                                </div>
                                @if (!is_null($system_setting->invoice_footer))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="{{ url($system_setting->invoice_footer) }}" alt="">

                                        </div>
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
