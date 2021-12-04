@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.manage_payment')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0 d-flex" style="justify-content: space-evenly;">
                            <form action="{{ route('admin.print-client-payment') }}" method="get" target="_blank">
                                <button type="submit" class="btn btn-success">{{ __('admin.print') }}</button>
                                <input type="hidden" name="from" value="{{ request()->from }}">
                                <input type="hidden" name="to" value="{{ request()->to }}">
                                <input type="hidden" name="client" value="{{ request()->client }}">
                                <input type="hidden" name="start_date" value="{{ request()->start_date }}">
                                <input type="hidden" name="end_date" value="{{ request()->end_date }}">
                                <input type="hidden" name="page" value="{{ request()->page }}">
                            </form>
                            @if (request()->client != 'any' && App\Models\User::findOrFail(request()->client)->ClientPaymentNotifications()->get()->count() == 0)
                            @if ($requisitions->count() > 0 &&  $requisitions->first()->is_paid == 0)
                            {{-- <form action="{{ route('admin.notify-client-payment') }}" method="get">
                                <button type="submit" class="btn btn-success">{{ __('admin.notify_payment') }}</button>
                                <input type="hidden" name="client" value="{{ request()->client }}">
                                <input type="hidden" name="month" value="{{ request()->month }}">
                            </form> --}}
                            @endif

                            @endif

                            @if ($requisitions->count() > 0)
                                @if ($requisitions->first()->is_paid == 0)
                                <form action="{{ route('admin.pay-client-payment') }}" method="get">
                                    <button type="submit" class="btn btn-primary">{{ __('admin.pay') }}</button>
                                    <input type="hidden" name="client" value="{{ request()->client }}">
                                    <input type="hidden" name="month" value="{{ request()->month }}">
                                </form>
                                @else
                                <strong class="text-primary">{{ __('admin.paid') }}</strong>
                                @endif
                            @endif



                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>شحنة رقم</th>
                                            <th>البيان</th>
                                            <th>عدد الردود</th>
                                            <th>قيمة الرد</th>
                                            <th>المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisitions as $requisition)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ route('admin.requisition.show',$requisition->id) }}">NO. {{ $requisition->id }}</a>
                                                </td>
                                                <td>{{ $requisition->place->from . ' => ' . $requisition->place->to }}</td>
                                                <td>{{ $requisition->number_of_orders }}</td>
                                                <td>{{ $requisition->place->price_per_order }}</td>
                                                <td>{{ $requisition->total_requisition_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">الاجمالي (غير شامل ضؤيبة القيمة المضافة)</td>
                                            <td colspan="4">{{ $total }} SAR</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">ضريبة القيمة المضافة</td>
                                            <td colspan="4">{{ $vat }} %</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">اجمالي ضريبة القيمة المضافة</td>
                                            <td colspan="4">{{ $vat_amount }} SAR</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">اجمالي القيمة المستحقة</td>
                                            <td colspan="4">{{ $total_with_vat }} SAR</td>
                                        </tr>
                                    </tfoot>
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
