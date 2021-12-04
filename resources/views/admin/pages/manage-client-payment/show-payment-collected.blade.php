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







                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>البيان</th>
                                            <th>مجموع الردود </th>
                                            <th>قيمة الرد</th>
                                            <th>المجموع</th>
                                            <th> عدد الطلبات المجمعة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i = 0; $i <count($requisitions_collected) ; $i++)

                                        <tr>
                                            <td>{{ $i + 1 }}</td>

                                                <td>{{ $requisitions_collected[$i]['place']->from . ' => ' . $requisitions_collected[$i]['place']->to }}</td>
                                                <td>{{ $requisitions_collected[$i]['total_orders'] }}</td>
                                                <td>{{ $requisitions_collected[$i]['place']->price_per_order }}</td>
                                                <td>{{ $requisitions_collected[$i]['total'] }}</td>
                                                <td>{{ $requisitions_collected[$i]['requistions_num'] }}</td>
                                            </tr>
                                            @endfor
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
                                        <tr>
                                            <td colspan="2">اجمالي عدد الطلبات المجمعة</td>
                                            <td colspan="4">{{ $total_of_requistions_num }} </td>
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
