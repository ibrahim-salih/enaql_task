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
        .qr__container div:first-child{
            margin: auto !important;
        }
        @media print{
            .qr__container div:first-child{
                display: block !important
            }
        }
    </style>
</head>
<body>
    <main class="py-4">
        <div class="container">
            {{-- <div class="row py-4">
                <div class="col-md-8 text-center">
                    <h3>{{ $system_name }}</h3>
                    <h4>{{ $system_address }}</h4>
                    <h4>الرقم الضريبي : {{ $system_tax_number }}</h4>
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
                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <td> العميل</td>
                                    <td>{{ $client == 'any' ? 'كل العملاء' : $client->name }}</td>
                                </tr>
                                <tr>
                                    <td>التاريخ</td>
                                    <td>{{ date('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <td>الوقت</td>
                                    <td>{{ date("h:i:sa") }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row my-3 col-4">
                        <div class="col text-center qr__container">
                            {!! DNS2D::getBarcodeSVG('
                                اسم الشركة : '.$system->system_name.'
                                الرقم الضريبي : '.$system->tax_number.'
                                تاريخ الفاتورة : '.date("Y-m-d").',
                                الضريبة  : '.$vat_amount.',
                                اجمالي المبلغ مع الضريبة : '.$total_with_vat.',
                            ', 'QRCODE',2,2) !!}
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col text-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>البيان</th>
                                <th>مجموع الردود </th>
                                <th>قيمة الرد</th>
                                <th>  المجموع قبل الضريبة</th>
                                <th>قيمة الضريبة</th>
                                <th> المجموع بعد الضريبة</th>
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
                                    <td>{{ $requisitions_collected[$i]['vat_value'] }}</td>
                                    <td>{{ $requisitions_collected[$i]['total_and_vat'] }}</td>
                                </tr>
                                @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">الاجمالي (غير شامل ضؤيبة القيمة المضافة)</td>
                                <td colspan="6">{{ $total }} SAR</td>
                            </tr>
                            <tr>
                                <td colspan="2">ضريبة القيمة المضافة</td>
                                <td colspan="6">{{ $vat }} %</td>
                            </tr>
                            <tr>
                                <td colspan="2">اجمالي ضريبة القيمة المضافة</td>
                                <td colspan="6">{{ $vat_amount }} SAR</td>
                            </tr>
                            <tr>
                                <td colspan="2">اجمالي القيمة المستحقة</td>
                                <td colspan="6">{{ $total_with_vat }} SAR</td>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
           </div>
           {{-- <div style="text-align: center">
            @if (!is_null($system->invoice_footer))
            <img src="{{ url($system->invoice_footer) }}" class="img-fluid" alt="" style="width: 100%;height: 100px;">
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
