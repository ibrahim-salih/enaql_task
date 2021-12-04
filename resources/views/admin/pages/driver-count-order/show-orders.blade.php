@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.driver_count_order')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0">
                            <form action="{{ route('admin.driver-count-order.print') }}" method="get" target="_blank">
                                <button type="submit" class="btn btn-success">{{ __('admin.print') }}</button>
                                <input type="hidden" name="driver_id" value="{{ request()->driver_id }}">
                                <input type="hidden" name="start_date" value="{{ request()->start_date }}">
                                <input type="hidden" name="end_date" value="{{ request()->end_date }}">
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>السائق</th>
                                            <th>شحنة رقم</th>
                                            <th>عدد الردود</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisitions as $requisition)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $requisition->driver->name }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ route('admin.requisition.show',$requisition->id) }}">NO. {{ $requisition->id }}</a>
                                                </td>
                                                <td>{{ $requisition->number_of_orders }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



@endsection


@section('js')

@endsection
