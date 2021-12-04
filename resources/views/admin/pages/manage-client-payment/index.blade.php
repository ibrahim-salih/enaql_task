@extends('admin.layouts.app')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.manage_client_payment')}}</h4>
            </div>
        </div>
    </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title mg-b-0">

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.show-client-payment') }}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="client">{{ __('admin.clients') }}</label>
                                        <select name="client" id="client" class="form-control select2">
                                            <option value="any">كل العملاء</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_date">{{ __('admin.start_date') }}</label>
                                        <input type="date" id="start_date" name="start_date" value="{{ date('Y-m-d') }}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_date">{{ __('admin.end_date') }}</label>
                                        <input type="date" id="end_date" name="end_date" value="{{ date('Y-m-d') }}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from">{{ __('admin.from') }}</label>
                                        <select name="from" id="from" class="form-control select2">
                                            <option value="any">  من اي مدينة </option>
                                            @foreach ($places_from as $key =>  $place)
                                                <option value="{{ $places_from[$key] }}">{{ $places_from[$key] }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="to">{{ __('admin.to') }}</label>
                                        <select name="to" id="to" class="form-control select2">
                                            <option value="any">  الي اي مدينة </option>
                                            @foreach ($places_to as $key =>  $place)
                                                <option value="{{ $places_to[$key] }}">{{ $places_to[$key] }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="padding-top: 36px;">
                                        <label for="single">{{ __('admin.single_page') }}</label>
                                        <input type="radio" name="page" value="single" id="single" checked>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="padding-top: 36px;">
                                        <label for="collected">{{ __('admin.collected_page') }}</label>
                                        <input type="radio" name="page" value="collected" id="collected">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                    {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from">{{ __('admin.from') }}</label>
                                        <input type="date" name="from" id="from" class="form-control">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to">{{ __('admin.to') }}</label>
                                        <input type="date" name="to" id="to" class="form-control">
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">{{ __('admin.show') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>



@endsection


@section('js')

@endsection
