@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.approval_authorities')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_approval_authority')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.approval-authority.update',$ApprovelAuthority->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                    <label for="requisition_type">{{__('admin.requisition_type')}}</label>
                                    <select name="requisition_type" id="requisition_type" class="form-control select2">
                                        @foreach ($requisition_types as $requisition_type)
                                            <option value="{{ $requisition_type->id }}" {{ $ApprovelAuthority->requisition_type_id == $requisition_type->id ? 'selected' : '' }}>{{ $requisition_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">{{__('admin.department')}}</label>
                                    <select name="department" id="department" class="form-control select2">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $ApprovelAuthority->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_phase">{{__('admin.requisition_phase')}}</label>
                                    <div class="d-flex justifiy-content-between">
                                        <div class="item">
                                            <input type="radio" name="requisition_phase" id="pending" {{ $ApprovelAuthority->requisition_phase == 'pending' ? 'checked' : '' }} value="pending">
                                            <label for="pending">{{ __('admin.pending') }}</label>
                                        </div>
                                        <div class="item">
                                            <input type="radio" name="requisition_phase" id="reject" {{ $ApprovelAuthority->requisition_phase == 'reject' ? 'checked' : '' }} value="reject">
                                            <label for="reject">{{ __('admin.reject') }}</label>
                                        </div>
                                        <div class="item">
                                            <input type="radio" name="requisition_phase" id="approved" {{ $ApprovelAuthority->requisition_phase == 'approved' ? 'checked' : '' }} value="approved">
                                            <label for="approved">{{ __('admin.approved') }}</label>
                                        </div>
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
@endsection