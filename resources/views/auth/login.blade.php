@extends('admin.layouts.app2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center"
                         @if (!is_null(App\Models\SystemSetting::first()->banner_login))
                         style="background:url('{{App\Models\SystemSetting::first()->banner_login}}');
                         @else
                         style="background:url('{{URL::asset('assets/img/brand/cover.jpeg')}}');
                         @endif

                             background-repeat: no-repeat;background-size: cover;background-attachment: fixed;
                             ">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <!--@if (count(App\Models\SystemSetting::first()->getMedia('logo')) > 0)-->
                            <!--<a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{App\Models\SystemSetting::first()->getMedia('logo')->first()->getUrl()}}" class="main-logo" alt="logo"></a>-->
                            <!--@else-->
                            <!--<a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{URL::asset('assets/img/brand/cover.jpeg')}}" class="main-logo" alt="logo"></a>-->
                            <!--@endif-->
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto" >
									<div class="card-sigin">
										<div class="mb-5 d-flex">
                                            @if (!is_null(App\Models\SystemSetting::first()->logo))
                                            <a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{App\Models\SystemSetting::first()->logo}}" class="main-logo" alt="logo" style="width: 166px;height: 90px;"></a>
                                            @else
                                            <a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo" style="width: 166px;height: 90px;"></a>
                                            @endif
                                        </div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{ __('admin.welcome_back') }}</h2>
												<h5 class="font-weight-semibold mb-4">{{ __('admin.please_sign_in') }}</h5>
												<form action="{{ route('admin.login') }}" method="POST">
                                                    @csrf
													<div class="form-group">
														<label>{{ __('admin.email') }}</label>
                                                        <input class="form-control" placeholder="{{ __('admin.email') }}" type="text" name="email">
													</div>
													<div class="form-group">
														<label>{{ __('admin.password') }}</label>
                                                        <input class="form-control" placeholder="{{ __('admin.password') }}" type="password" name="password">
													</div><button class="btn btn-main-primary btn-block" type="submit">{{ __('admin.sign_in') }}</button>
												</form>
												{{-- <div class="main-signin-footer mt-5">
													<p><a href="">Forgot password?</a></p>
												</div> --}}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
@endsection
