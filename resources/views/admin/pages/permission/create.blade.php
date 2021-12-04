@extends('admin.layouts.app')


@section('page-title' , 'الصلاحيات')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.permission.store') }}" method="post" id="store">
                    @csrf
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">اضافة صلاحية</h3>
                            </div>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-lg btn-light-primary">
                                    <i class="icon-md fas fa-plus"></i> <strong>اضافة</strong>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group w-50">
                                <label for="name">اسم الصلاحية</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="أدخل اسم الصلاحية" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection