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
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.signaturepad.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}">


    <style>
        *{
            font-family: 'Cairo', sans-serif;
        }
        .sigWrapper.current , .sigWrapper{
            border: none !important
        }
        pre{
            max-width: 100%;
            padding: 0;
            width: 1000px !important;
            min-height: 300px;
            position: relative;
            top: -86px;
            /* overflow: hidden; */
        }

    </style>
</head>
<body>
    <main class="py-4">
        <div class="container">
            {{-- <div class="row">
                <div class="col-md-4 text-center">
                    <div class="ar">
                        <h4>مؤسسة المؤسسة لتجارة السكر</h3>
                        <h4>للنقل البري للبضائع</h4>
                        <h4>0120463642</h4>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="image">
                        <img src="{{ asset('assets/img/train-station.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="ar">
                        <h4>Corporation for trading</h3>
                        <h4>For transporting</h4>
                        <h4>0120463642</h4>
                    </div>
                </div>
            </div> --}}
            @if (!is_null($invoice_header))
            <img src="{{ $invoice_header }}" class="img-fluid" alt="">
            @endif

            <div class="row pt-2">
                <div class="col-md-6 text-center">
                    <label for="">التاريخ</label> : {{ $requisition->requisition_date }}
                </div>
                <div class="col-md-6 text-center">
                    <label for="">الرقم</label> : {{ $requisition->id }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="">اسم السائق</label> : {{ $requisition->driver->name }}
                </div>
                <div class="col-md-6 text-center">
                    <label for="">رقم الاقامة</label> : {{ $requisition->driver->DriverData->residency_number ?? '' }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="">رقم الجوال</label> : {{ $requisition->driver->DriverData->mobile ?? '' }}
                </div>
                <div class="col-md-6 text-center">
                    <label for="">رقم اللوحة</label> : {{ $vehicle->license_plate ?? '' }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="">اسم العميل المرسل</label> : {{ $requisition->client->name ?? '' }}
                </div>
                <div class="col-md-6 text-center">
                    <label for="">اسم العميل المرسل اليه</label> : {{ $requisition->client_to }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="">عدد الردود</label> : {{ $requisition->number_of_orders }}
                </div>
                <div class="col-md-6 text-center">
                    <label for=""> المسار</label> : {{ $requisition->place->from  . '=>' . $requisition->place->to  .'(' . $requisition->place->price_per_order . 'SAR)' }}
                </div>

            </div>
            <div class="row pt-3">
                <div class="col text-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>بيان الحمولة</th>
                                <th>رقم العنصر</th>
                                <th>ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->item_number }}</td>
                                <td>{{ $item->notes }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <label for="">أمين المستودع</label>
                    <div>
                        <label for="">الاسم</label> : ..................................................
                    </div>
                    <div>
                        <label for="">التوقيع</label> :
                        @if ($requisition->client_first_signature)

                        <div>
                            <img src="" id="client_first_signature" alt="">
                            <pre class="brush:xml; d-none" >
                                <form method="post" class="sigPad" id="sign2">
                                            <div class="sig sigWrapper">
                                                <canvas class="pad" id="canvas2"></canvas>
                                                <input type="hidden" name="output" class="output">
                                            </div>


                              </form>
                            </pre>
                        </div>
                        @else
                        ..................................................
                        @endif
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <label for="">توقيع السائق بما يفيد الاستلام</label>
                    <div>
                        <label for="">الاسم</label> : {{ $requisition->driver->name }}
                    </div>
                    <div>
                        <label for="">التوقيع</label> :
                        @if ($requisition->driver_first_signature)

                        <img src="" id="driver_first_signature" alt="">
                        <pre class="brush:xml; d-none" >
                            <form method="post" class="sigPad" id="sign1">
                                        <div class="sig sigWrapper">
                                            <canvas class="pad" id="canvas1"></canvas>
                                            <input type="hidden" name="output" class="output">
                                        </div>


                          </form>
                        </pre>
                        @else
                        ......................................
                        @endif
                    </div>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col text-center">
                    <h5>استلمت الكميات الموضحة بعاليه الي عهدتي</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <label for="">أمين المستودع المستلم</label>
                    <div>
                        <label for="">الاسم</label> : .........................................................
                    </div>
                    <div>
                        <label for="">التوقيع</label> :
                        @if ($requisition->client_second_signature)

                        <div>
                            <img src="" id="client_second_signature" alt="">
                            <pre class="brush:xml; d-none" >
                                <form method="post" class="sigPad" id="sign3">
                                            <div class="sig sigWrapper">
                                                <canvas class="pad" id="canvas3"></canvas>
                                                <input type="hidden" name="output" class="output">
                                            </div>


                              </form>
                            </pre>
                        </div>
                        @else
                        ..................................................
                        @endif


                    </div>
                </div>
            </div>
            @if (!is_null($invoice_footer))
            <img src="{{ $invoice_footer }}" class="img-fluid" alt="">
            @endif
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/json2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.signaturepad.min.js') }}"></script>
    @if ($requisition->driver_first_signature)
    <script>
        $(function(){
            var sig = [];
            @foreach(json_decode($requisition->driver_first_signature) as $sig)
                sig.push({
                    'lx' : "{{ $sig->lx }}",
                    'ly' : "{{ $sig->ly }}",
                    'mx' : "{{ $sig->mx }}",
                    'my' : "{{ $sig->my }}",
                })
            @endforeach
            $('#sign1').signaturePad({
                displayOnly:true
            }).regenerate(sig);
        })
        setTimeout(() => {
                var canvas = document.getElementById('canvas1');
                var dataURL = canvas.toDataURL();
                console.log(dataURL);
                img = $('#driver_first_signature').attr('src',dataURL);
        }, 10);

    </script>
    @endif

    @if ($requisition->client_first_signature)
    <script>
        $(function(){
            var sig = [];
            @foreach(json_decode($requisition->client_first_signature) as $sig)
                sig.push({
                    'lx' : "{{ $sig->lx }}",
                    'ly' : "{{ $sig->ly }}",
                    'mx' : "{{ $sig->mx }}",
                    'my' : "{{ $sig->my }}",
                })
            @endforeach
            $('#sign2').signaturePad({
                displayOnly:true
            }).regenerate(sig);
        })
        setTimeout(() => {
                var canvas = document.getElementById('canvas2');
                var dataURL = canvas.toDataURL();
                console.log(dataURL);
                img = $('#client_first_signature').attr('src',dataURL);
        }, 10);

    </script>
    @endif


    @if ($requisition->client_second_signature)
    <script>
        $(function(){
            var sig = [];
            @foreach(json_decode($requisition->client_second_signature) as $sig)
                sig.push({
                    'lx' : "{{ $sig->lx }}",
                    'ly' : "{{ $sig->ly }}",
                    'mx' : "{{ $sig->mx }}",
                    'my' : "{{ $sig->my }}",
                })
            @endforeach
            $('#sign3').signaturePad({
                displayOnly:true
            }).regenerate(sig);
        })
        setTimeout(() => {
                var canvas = document.getElementById('canvas3');
                var dataURL = canvas.toDataURL();
                console.log(dataURL);
                img = $('#client_second_signature').attr('src',dataURL);
        }, 10);

    </script>
    @endif

    <script>
        window.onload = function(){
            setTimeout(() => {
                window.print();
            }, 15);
        }
    </script>
</body>
</html>
