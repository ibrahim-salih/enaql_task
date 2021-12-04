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
            padding: 30px 50px
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
                <div class="col-md-4 text-center">
                    <img src="{{ $logo }}" alt="">
                </div>
            </div> --}}
            @if (!is_null($invoice_header))
                <img src="{{ $invoice_header }}" class="img-fluid" alt="">
            @endif
            {{-- <div class="row my-3">
                <div class="col text-center qr__container">
                    {!! DNS2D::getBarcodeSVG('
                        اسم الشركة : '.$system_name.'
                        الرقم الضريبي : '.$system_tax_number.'
                        تاريخ الفاتورة : '.date("Y-m-d").',
                        الضريبة  : '.$vat_amount.',
                        اجمالي المبلغ مع الضريبة : '.$total_with_vat.',
                    ', 'QRCODE',2,2) !!}
                </div>
            </div> --}}
            {{-- <div class="row py-p">
                <div class="col">
                    <img src="" alt="">
                </div>
            </div> --}}
            <div class="row py-2">
                <div class="col text-right">
                    <table class="table table-bordered">
                        <tbody>
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
            </div>
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
            @if (!is_null($invoice_footer))
            <img src="{{ $invoice_footer }}" class="img-fluid" alt="">
        @endif
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
