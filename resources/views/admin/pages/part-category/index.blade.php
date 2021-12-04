@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.part_categories')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0">
                            <!-- Button trigger modal -->
                            @can('add_settings')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">
                                {{ __('admin.add_new_part_category') }}
                            </button>
                            @endcan

                        </div>
                    </div>
                    <div class="card-body">
                        <x-admin-datatable-table :columns="$columns" />
                    </div>
                </div>

            </div>
        </div>


<x-admin-delete-modal />


<x-admin-add-modal title="{{ __('admin.add_new_part_category') }}" action="{{ route('admin.part-category.store') }}" />
<x-admin-edit-modal title="{{ __('admin.edit_new_part_category') }}" />



@endsection


@section('js')
    <x-admin-datatable-script :columns="$columns" :route="route('admin.part-category.datatable')"/>
    <x-admin-delete-modal-script />
    <x-admin-add-modal-script />
    <x-admin-edit-modal-script />
@endsection