@extends('admin.layouts.app')


@section('page-title' , 'الصلاحيات')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.permission.update' , $Permission->id) }}" method="post" id="update">
                    @csrf
                    @method('PUT')
                    <div class="card card-custom">
                        <div class="card-header d-flex">
                            <div class="card-title">
                                <button type="submit" class="btn btn-md btn-primary">
                                    <i class="icon-md fas fa-edit"></i> <strong>تعديل</strong>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group w-50">
                                <label for="name">اسم الصلاحية</label>
                                <input value="{{ $Permission->name }}" type="text" name="name" id="name" class="form-control" placeholder="أدخل اسم التصنيف" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection