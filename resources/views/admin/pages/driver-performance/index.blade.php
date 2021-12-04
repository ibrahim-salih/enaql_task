@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.drivers_perfromances')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0">
                            <a href="{{ route('admin.driver-performance.create') }}" class="btn btn-md btn-primary">
                                <i class="icon-md fas fa-plus"></i> <strong>{{__('admin.add_new_driver_performance')}}</strong>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-admin-datatable-table :columns="$columns" />
                    </div>
                </div>

            </div>
        </div>


<x-admin-delete-modal />

@endsection


@section('js')
    <x-admin-datatable-script :columns="$columns" route="{{ route('admin.driver-performance.datatable') }}"/>
    <x-admin-delete-modal-script />
@endsection