@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.parts')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_part')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.part.update',$part->id) }}" method="post" id="store" enctype="multipart/form-data">
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
                                        <input type="text" name="name" value="{{ $part->name }}" id="name" class="form-control" placeholder="{{__('admin.name')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock_limit">{{__('admin.stock_limit')}}</label>
                                            <input type="number" value="{{ $part->stock_limit }}" name="stock_limit" id="stock_limit" class="form-control" placeholder="{{__('admin.stock_limit')}}">
                                        </div>
                                    </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{__('admin.category')}}</label>
                                    <select name="category" id="category" class="form-control select2">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $part->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">{{__('admin.location')}}</label>
                                    <select name="location" id="location" class="form-control select2">
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}" {{ $part->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">{{__('admin.description')}}</label>
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $part->description }}</textarea>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remarks">{{__('admin.remarks')}}</label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="5" class="form-control">{{ $part->remarks }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="is_active" {{ $part->is_active == 1 ? 'checked' : '' }} id="is_active" value="1">
                                    <label for="is_active">{{__('admin.is_active')}}</label>
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
