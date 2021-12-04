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
            width: 1000px !important;
            min-height: 300px;
            /* overflow: hidden; */
        }
        .pad{
            /* position: absolute;
            top: 30%;
            left: 30%; */
        }
        .clearButton a{
            position: relative;
            left: 40px
        }
    </style>
@endsection

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.requisitions')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_requisition')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
                <div class="card card-custom">
                    <div class="card-header d-flex">
                        <div class="card-title">

                            @if ($requisition->status == App\Models\Requisition::ACCEPTED)
                                <div class="form-group">
                                    <button class="btn btn-success verify_btn">{{ __('admin.verify') }}</button>
                                </div>
                            @endif

                            @if ($requisition->status == App\Models\Requisition::VERIFIED)
                                <div class="row py-3">
                                    <div class="col">
                                        <a target="_blank" href="{{ route('admin.requisition-print',$requisition->id) }}" class="btn btn-secondary">{{ __('admin.print') }}</a>
                                    </div>
                                </div>
                                @if (is_null($requisition->driver_first_signature))
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                        <button type="button" class="btn btn-success sigPad_btn">{{ __('admin.done') }}</button>

                                        </div>
                                    </div>
                                </div>
                                <pre class="brush:xml;" >
                                    <form method="post" action="{{ route('admin.requisition-driver-first-signature') }}" class="sigPad">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $requisition->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="sigNav">
                                                    <li class="clearButton"><a class="btn btn-danger btn-block" href="#clear">{{ __('admin.clear') }}</a></li>
                                                    </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="sig sigWrapper">
                                                    <canvas class="pad" id="canvas1"></canvas>
                                                    <input type="hidden" name="output" class="output">
                                                </div>
                                            </div>
                                        </div>


                                  </form>
                                </pre>
                                @else

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                        <button type="button" class="btn btn-success start_btn">{{ __('admin.start') }}</button>
                                        </div>
                                    </div>
                                </div>

                                @endif
                            @endif

                            @if ($requisition->status == App\Models\Requisition::STARTED)
                                @if (is_null($requisition->driver_second_signature))
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                        <button type="button" class="btn btn-success sigPad_btn">{{ __('admin.done') }}</button>

                                        </div>
                                    </div>
                                </div>
                                <pre class="brush:xml;" >
                                    <form method="post" action="{{ route('admin.requisition-driver-second-signature') }}" class="sigPad">
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
                                <div class="form-group">
                                    <button class="btn btn-success deliver_btn">{{ __('admin.deliver') }}</button>
                                    </div>
                                @endif

                            @endif


                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><h3>{{ __("admin.status") }}</h3></label>
                                    <h4>{{ $requisition->status() }}</h4>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_for">{{__('admin.requisition_for')}}</label>
                                    <select name="requisition_for" id="requisition_for" class="form-control select2" disabled>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ $employee->id == $requisition->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type">{{__('admin.vehicle_type')}}</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control select2" disabled>
                                        @foreach ($vehicle_types as $vehicle_type)
                                            <option value="{{ $vehicle_type->id }}" {{ $vehicle_type->id == $requisition->vehicle_type_id ? 'selected' : '' }}>{{ $vehicle_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_from">{{__('admin.time_from')}}</label>
                                    <input type="time" name="time_from" id="time_from" disabled value="{{ $requisition->time_from }}" class="form-control" placeholder="{{__('admin.time_from')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_to">{{__('admin.time_to')}}</label>
                                    <input type="time" name="time_to" id="time_to" disabled value="{{ $requisition->time_to }}" class="form-control" placeholder="{{__('admin.time_to')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="where_from">{{__('admin.where_from')}}</label>
                                    <input type="text" name="where_from" id="where_from" disabled value="{{ $requisition->where_from }}" class="form-control" placeholder="{{__('admin.where_from')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="where_to">{{__('admin.where_to')}}</label>
                                    <input type="text" name="where_to" id="where_to" disabled value="{{ $requisition->where_to }}" class="form-control" placeholder="{{__('admin.where_to')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tolerance_duration">{{__('admin.tolerance_duration')}}</label>
                                    <input type="text" name="tolerance_duration" disabled value="{{ $requisition->tolerance_duration }}" id="tolerance_duration" class="form-control" placeholder="{{__('admin.tolerance_duration')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_of_passengers">{{__('admin.no_of_passengers')}}</label>
                                    <input type="number" name="no_of_passengers" disabled id="no_of_passengers" value="{{ $requisition->no_of_passengers }}" class="form-control" placeholder="{{__('admin.no_of_passengers')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driven_by">{{__('admin.driven_by')}}</label>
                                    <select name="driven_by" id="driven_by" class="form-control select2" disabled>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $driver->id == $requisition->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purpose">{{__('admin.purpose')}}</label>
                                    <select name="purpose" id="purpose" class="form-control select2" disabled>
                                        @foreach ($purposes as $purpose)
                                            <option value="{{ $purpose }}" {{ $purpose == $requisition->purpose ? 'selected' : '' }}>{{ __('admin.' . $purpose) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pickup">{{__('admin.pickup')}}</label>
                                    <input type="text" name="pickup" id="pickup" disabled value="{{ $requisition->pickup }}" class="form-control" placeholder="{{__('admin.pickup')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="requisition_date">{{__('admin.requisition_date')}}</label>
                                    <input type="date" name="requisition_date" disabled value="{{ $requisition->requisition_date }}" id="requisition_date" class="form-control" placeholder="{{__('admin.requisition_date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="details">{{__('admin.details')}}</label>
                                    <textarea name="details" id="details" disabled cols="30" rows="5" class="form-control">{{ $requisition->details }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <img src="" id="image" alt="">
    <!-- Modal -->

@endsection

@section('js')
<script src="{{ asset('assets/js/json2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.signaturepad.min.js') }}"></script>
<script>
    $(function(){
        $('.sigPad').signaturePad({
            defaultAction :'drawIt',
            drawOnly :true,
        });
    })
</script>

<script>

    $(function(){


        $('.verify_btn').click(function(){
            $.ajax({
                url : '{{ route("admin.requisition-driver-verify") }}',
                data:{
                    id : "{{ $requisition->id }}"
                },
                success : function(response){
                    $('.card-title').html(' ').html(response);
                    toastr.success(response);
                }
            })
        })

        $('.deliver_btn').click(function(){
            $.ajax({
                url : '{{ route("admin.requisition-driver-deliver") }}',
                data:{
                    id : "{{ $requisition->id }}"
                },
                success : function(response){
                    $('.card-title').html(' ').html(response);
                    toastr.success(response);
                }
            })
        })
        $('.sigPad_btn').click(function(){
            // var canvas = document.getElementById('canvas1');
            // var dataURL = canvas.toDataURL();
            // console.log(dataURL);
            // img = $('#image').attr('src',dataURL);
                $('.sigPad').submit();
            })
        $('.start_btn').click(function(){
            $.ajax({
                url : '{{ route("admin.requisition-driver-start") }}',
                data:{
                    id : "{{ $requisition->id }}"
                },
                success : function(response){
                    $('.card-title').html(' ').html(response);
                    toastr.success(response);
                }
            })
        })


    });
</script>

@endsection
