@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.fatoora_pay')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0">
                            <!-- Button trigger modal -->
                            @if ($notifications->count()>0)

                            <button class="btn btn-primary">{{ __('admin.month') }} : {{ Carbon\Carbon::parse(App\Models\requisition::findOrFail($notifications->first()->requisition_id)->delivered_at)->format('m') }}</button>
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
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($notifications as $notification)
                                            @php
                                                $requisition = App\Models\requisition::findOrFail($notification->requisition_id);
                                                $total += $requisition->total_requisition_price;

                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ route('admin.requisition.show',$requisition->id) }}">NO. {{ $requisition->id }}</a>
                                                </td>
                                                <td>{{ $requisition->place->from }} -> {{ $requisition->place->to }}</td>
                                                <td>{{ $requisition->number_of_orders }}</td>
                                                <td>{{ $requisition->place->price_per_order }}</td>
                                                <td>{{ $requisition->total_requisition_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        @php
                                             $vat_amount = ($total * $vat) / 100;
                                                $total_with_vat = $total + $vat_amount;
                                        @endphp
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
