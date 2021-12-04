@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.signaturepad.css') }}">
    <style>
        .sigWrapper.current , .sigWrapper{
            border: none !important
        }
        pre{
            max-width: 100%;
            padding: 0;
            /* overflow: hidden; */
        }
        .pad{
            /* position: absolute;
            top: 30%;
            left: 30%; */
        }
    </style>
@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('admin.requisitions')}}</h4>
            <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.track_requsition')}} </span>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if ($requisition->status == App\Models\Requisition::SENTFORMODIFICATION)
        <div class="row row-sm">
            <div class="col-md-6">
                <label for="">{{ __('admin.status') }}</label>
                <h3>{{ $requisition->status() }}</h3>
            </div>
            <div class="col-md-6">
                <label for="">{{ __('admin.driver') }}</label>
                <h3>{{ $requisition->driver->name }}</h3>
            </div>
        </div>
        <hr>
            @if (!is_null($modificaion))
                <div class="row">
                    <div class="col-md-12">
                        <h4>{{ __('admin.modification') }}</h4>
                    </div>
                </div>
              <form action="{{ route("admin.requisition-client-accept") }}" method="POST" id="accept_form">
                @csrf
                <input type="hidden" name="requisition_id" value="{{ $requisition->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="new_time_from">{{__('admin.new_time_from')}}</label>
                            <input type="time" name="new_time_from" id="new_time_from" value="{{ $modificaion->new_time_from }}" class="form-control" placeholder="{{__('admin.time_from')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="new_time_to">{{__('admin.new_time_to')}}</label>
                            <input type="time" name="new_time_to" id="new_time_to" value="{{ $modificaion->new_time_to }}" class="form-control" placeholder="{{__('admin.time_to')}}">
                        </div>
                    </div>
                </div>
              </form>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-success accept_btn">{{ __('admin.accept') }}</button>
                    </div>
                    <div class="col-md-">
                        <form action="{{ route('admin.requisition-client-deny',$requisition->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('admin.delete') }}</button>
                        </form>
                    </div>
                </div>
            @endif

        @elseif ($requisition->status == App\Models\Requisition::VERIFIED && is_null($requisition->client_first_signature))
        <div class="row">
            <div class="col">
                <div class="form-group">
                <button type="button" class="btn btn-success sigPad_btn">{{ __('admin.done') }}</button>

                </div>
            </div>
        </div>
        <pre class="brush:xml;" >
            <form method="post" action="{{ route('admin.requisition-client-first-signature') }}" class="sigPad">
                @csrf
                <input type="hidden" name="id" value="{{ $requisition->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="sigNav">
                            <li class="clearButton"><a class="btn btn-danger" href="#clear">{{ __('admin.clear') }}</a></li>
                            </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="sig sigWrapper">
                            <canvas class="pad" id="thecanvas"></canvas>
                            <input type="hidden" name="output" class="output">
                        </div>
                    </div>
                </div>


          </form>
        </pre>

        @elseif($requisition->status == App\Models\Requisition::STARTED && is_null($requisition->client_second_signature))
        <div class="row">
            <div class="col">
                <div class="form-group">
                <button type="button" class="btn btn-success sigPad_btn">{{ __('admin.done') }}</button>

                </div>
            </div>
        </div>
        <pre class="brush:xml;" >
            <form method="post" action="{{ route('admin.requisition-client-second-signature') }}" class="sigPad">
                @csrf
                <input type="hidden" name="id" value="{{ $requisition->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="sigNav">
                            <li class="clearButton"><a class="btn btn-danger" href="#clear">{{ __('admin.clear') }}</a></li>
                            </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="sig sigWrapper">
                            <canvas class="pad" id="thecanvas"></canvas>
                            <input type="hidden" name="output" class="output">
                        </div>
                    </div>
                </div>


          </form>
        </pre>
        @else

        <div class="row">
            <div class="col-md-6">
                <h1>{{ $requisition->status() }}</h1>
            </div>
            <div class="col-md-6">
                <h1>{{ __('admin.driver') }}: {{ $requisition->driver->name }}</h1>
            </div>
        </div>

        @endif

    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/js/json2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.signaturepad.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/canvas2image.js') }}"></script> --}}
    <script>
        $(function(){
            $('.sigPad').signaturePad({
                defaultAction :'drawIt',
                drawOnly :true,
            });
            // function to_image(){
            //     var canvas = document.getElementById("thecanvas");
            //     document.getElementById("theimage").src = canvas.toDataURL();
            // }

            $('.accept_btn').click(function(){
              $('#accept_form').submit()
            })
            $('.sigPad_btn').click(function(){
                // to_image();
                $('.sigPad').submit();
            })
        });
    </script>
@endsection
