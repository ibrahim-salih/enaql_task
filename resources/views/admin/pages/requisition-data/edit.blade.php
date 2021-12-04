@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.items')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_item')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.requisition-data.update' , $RequisitionData->id) }}" method="post" id="store" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $RequisitionData->id }}">
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
                                    <label for="item_name">{{__('admin.item_name')}}</label>
                                    <input type="text" value="{{ $RequisitionData->item_name }}" name="item_name" placeholder="{{__('admin.item_name')}}" id="item_name" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="item_number">{{__('admin.item_number')}}</label>
                                    <input type="number" value="{{ $RequisitionData->item_number }}" name="item_number" placeholder="{{__('admin.item_number')}}" id="item_number" class="form-control">
                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
