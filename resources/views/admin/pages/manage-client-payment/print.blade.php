<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fatoora</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Cairo Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Cairo', sans-serif;
        }
        .container{
            border: solid 1px;
            padding: 30px 50px;
            height: 1380px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .footer {
            position: relative;
            top: 18px;
        }
        .qr__container div:first-child{
            margin: auto !important;
        }
        table,table th,tfoot td{
            border: 1px solid
        }
        @media print{
            .qr__container div:first-child{
                display: block !important
            }
        }
    </style>
</head>
<body>

    @php
    $late_days = 0;
    $price_per_order = 0;
    $late_days_price = 0;
    $final = 0;
@endphp
    <main class="py-4">
        <div class="container">
            {{-- <div class="row py-4">
                <div class="col-md-8 text-center">
                    <h3>{{ $system_name }}</h3>
                    <h4>{{ $system_address }}</h4>
                    <h4>الرقم الضريبي : {{ $system_tax_number }}</h4>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ $logo }}" alt="">
                </div>
            </div> --}}
            <div>
                <div class="row" style="border-bottom: 3px solid ;padding: 10px;">
                    {{-- <div class="col-4">
                        @if (!is_null($system->invoice_header))
                        <img src="{{ url($system->invoice_header) }}" class="img-fluid" alt="" style="width: 300px;height: 167px;" >
                        @endif
                    </div> --}}
                    <div class="col-8" style="text-align: right">
                        <p>{{ $system->system_name }}</p>
                        <p>{{ $system->address }}</p>
                        <p>{{ $system->tax_number }}</p>
                        <p>{{ date('Y-m-d') }}</p>


                    </div>
                    <div class="col-4">
                        <div class="col-md-4 text-center">
                            <img src="{{ url($system->logo) }}"  style="width: 300px;height: 167px;" alt="">
                        </div>

                    </div>

                </div>
                {{-- <div class="row py-p">
                    <div class="col">
                        <img src="" alt="">
                    </div>
                </div> --}}
                <div class="row pt-5">
                    <div class="col-8 text-right">
                        <table class="table table-bordered table-sm">
                            <tbody>

                                {{-- <tr>
                                    <td> العميل</td>
                                    <td>{{ $client == 'any' ? 'كل العملاء' : $client->name }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>التاريخ</td>
                                    <td>{{ date('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <td>الوقت</td>
                                    <td>{{ date("h:i:sa") }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td>تاريخ الفاتورة</td>
                                    <td>{{ date('Y-m-d') }}</td>
                                </tr>

                            </tbody>
                        </table>
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td> اسم الشركة</td>
                                    <td>{{ $system->system_name }}</td>
                                </tr>

                            </tbody>
                        </table>
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td>  الرقم الضريبي</td>
                                    <td>{{ $system->tax_number }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="row my-3 col-4">
                        <div class="col-12 text-center qr__container">
                            {!! DNS2D::getBarcodeSVG('
                                اسم الشركة : '.$system->system_name.'
                                الرقم الضريبي : '.$system->tax_number.'
                                تاريخ الفاتورة : '.date("Y-m-d").',
                                الضريبة  : '.$vat_amount.',
                                اجمالي المبلغ مع الضريبة : '.$total_with_vat.',
                            ', 'QRCODE',2,2) !!}
                        </div>
                        <br>
                       <div class="col-12">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td>  ص . ب 123456</td>
                                    <td>رمز بريدي 12345</td>
                                </tr>
                                <tr>
                                    <td colspan="2">  المملكة العربية السعودية</td>
                                </tr>

                            </tbody>
                        </table>
                       </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col text-center">
                        <table class="table table-striped table-sm">
                            <thead >
                                <tr>
                                    <th> تاريخ الاستلام</th>
                                    <th> تاريخ التسليم</th>
                                    <th>  رقم الشحنة</th>
                                    <th>  رقم السيارة</th>
                                    <th>العميل</th>
                                    <th colspan="2">
                                         <p style="border-bottom: 1px solid">المدينة</p>
                                         <p><span style="border-left:1px solid;padding:5px">من</span><span style="padding:5px">الي</span></p>
                                    </th>
                                    <th> العقد</th>
                                    <th> ايام التاخير</th>
                                    <th> قيمة التاخير</th>
                                    <th>الصافي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requisitions as $requisition)
                                @php
                                $price_per_order += $requisition->price_per_order;
                                $late_days += $requisition->late_days;
                                $late_days_price += $requisition->late_days_price;
                                $final += ($requisition->place->price_per_order + $requisition->late_days_price);
                               @endphp
                                    <tr>
                                        <td>{{ $requisition->received_from_date }}</td>
                                        <td>{{ $requisition->received_to_date }}</td>
                                        <td>{{ $requisition->charge_number }}</td>
                                        <td>{{ $requisition->vehicle->license_plate ?? '' }}</td>
                                        <td>{{ $requisition->client->name ?? '' }}</td>
                                        <td>{{ $requisition->place->from ?? '' }}</td>
                                        <td>{{ $requisition->place->to ?? '' }}</td>
                                        <td>{{ $requisition->place->price_per_order ?? '' }}</td>
                                        <td>{{ $requisition->late_days ?? '' }}</td>
                                        <td>{{ $requisition->late_days_price ?? '' }}</td>
                                        <td>{{ ($requisition->place->price_per_order + $requisition->late_days_price) ?? '' }}</td>
                                        {{-- <td>
                                            <a target="_blank" href="{{ route('admin.requisition.show',$requisition->id) }}">NO. {{ $requisition->id }}</a>
                                        </td>
                                        <td>{{ $requisition->place->from }} -> {{ $requisition->place->to }}</td>
                                        <td>{{ $requisition->number_of_orders }}</td>
                                        <td>{{ $requisition->place->price_per_order }}</td>
                                        <td>{{ $requisition->total_requisition_price }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"> الاجمالي (غير شامل ضؤيبة القيمة المضافة) </td>
                                    <td colspan="1">{{ $price_per_order }} </td>
                                    <td colspan="1">{{ $late_days }}</td>
                                    <td colspan="1">{{ $late_days_price }} </td>
                                    <td colspan="1">{{ $final }} </td>
                                </tr>
                                <tr>
                                    <td colspan="5">ضريبة القيمة المضافة</td>
                                    <td colspan="5">{{ $vat }} %</td>
                                    <td colspan="1">{{ $final * $vat / 100 }}  SAR</td>
                                </tr>
                                <tr>
                                    <td colspan="10">الاجمالي ( شامل ضؤيبة القيمة المضافة)</td>
                                    <td colspan="1">{{ $final + ($final * $vat / 100) }} SAR</td>
                                </tr>
                                {{-- <tr>
                                    <td colspan="5">الاجمالي (غير شامل ضؤيبة القيمة المضافة)</td>
                                    <td colspan="6">{{ $total }} SAR</td>
                                </tr>
                                <tr>
                                    <td colspan="5">اجمالي ضريبة القيمة المضافة</td>
                                    <td colspan="6">{{ $vat_amount }} SAR</td>
                                </tr>
                                <tr>
                                    <td colspan="5">اجمالي القيمة المستحقة</td>
                                    <td colspan="6">{{ $total_with_vat }} SAR</td>
                                </tr> --}}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div style="text-align: center">
                @if (!is_null($system->invoice_footer))
                <img src="{{ url($system->invoice_footer) }}" class="img-fluid" alt="" style="width:100%;height: 100px;">
                @endif
            </div> --}}
            <div class="footer">
                <footer>
                    <div style="">
                        <img style="max-height: 110px; width: 100%;" src="{{ url($system->invoice_footer) }}"
                            class="img img-responsive">
                    </div>
                </footer>
            </div>
        </div>
    </main>
    <script>
        window.onload = function(){
            setTimeout(() => {
                window.print();
            }, 15);
        }
    </script>
</body>
</html>
