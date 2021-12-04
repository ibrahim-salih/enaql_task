<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
                            <!--@if (count(App\Models\SystemSetting::first()->getMedia()) > 0)-->
                            <!--<a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{App\Models\SystemSetting::first()->getMedia()->first()->getUrl()}}" class="main-logo" alt="logo"></a>-->
                            <!--@else-->
                            <!--@endif-->
                            <a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>

					</div>
					<div class="main-header-right">
						<ul class="nav">
							<li class="">
								<div class="dropdown  nav-itemd-none d-md-flex">
									<a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
										<span class="avatar country-Flag mr-0 align-self-center bg-transparent">
                                            @if (App::getLocale() == 'ar')
                                            <img src="{{URL::asset('assets/img/saudi.png')}}" alt="img">
                                            @else
                                            <img src="{{URL::asset('assets/img/flags/us_flag.jpg')}}" alt="img">

                                            @endif
                                        </span>
										<div class="my-auto">
											<strong class="mr-2 ml-2 my-auto">{{LaravelLocalization::getCurrentLocaleName()}}</strong>
										</div>
									</a>


									<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
										@foreach (LaravelLocalization::getSupportedLocales() as $langKey => $langValue)
										<form method="POST" action="{{ route('admin.set-locale') }}">
											@csrf
											<input type="hidden" name="locale" value="{{$langKey}}" />
											<input type="hidden" name="url" value="{{Request::url()}}" />

											<button class="btn dropdown-item d-flex " type="submit">
                                                @if ($langKey == 'ar')

												<span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/saudi.png')}}" alt="img"></span>
                                                @else
												<span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/us_flag.jpg')}}" alt="img"></span>

                                                @endif
												<div class="d-flex">
													<span class="mt-2">{{ $langValue['name'] }}</span>
												</div>
											</button>
										</form>
										@endforeach

									</div>
								</div>
							</li>
						</ul>
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>
{{--
							<div class="dropdown nav-item main-header-notification">
                                @php
                                    $requistion_modification_requests = App\Models\RequisitionModificationRequest::where('client_id',Auth::id())->get();
                                @endphp
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                @if ($requistion_modification_requests->count()>0)
                                <span class=" pulse"></span>
                                @endif
                            </a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
										</div>
									</div>
									<div class="main-notification-list Notification-scroll">

                                        @if ($requistion_modification_requests->count() > 0)
                                            @foreach ($requistion_modification_requests as $requistion_modification_request)
                                            <a class="d-flex p-3 border-bottom" href="{{ URL::to('requisition-client-track') . '?id=' . $requistion_modification_request->requisition_id }}">
                                                <div class="notifyimg bg-primary">
                                                    <i class="la la-check-circle text-white"></i>
                                                </div>
                                                <div class="ml-2 mt-2">
                                                    <h5 class="notification-label mb-1">Modification for Requsition NO. {{ $requistion_modification_request->requisition->id }}</h5>
                                                </div>
                                            </a>
                                            @endforeach
                                        @endif

									</div>
									<div class="dropdown-footer">
										<a href="">VIEW ALL</a>
									</div>
								</div>
							</div> --}}
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
                                {{-- @php($profile_photo = count(Auth::user()->getMedia('profile_photo')) > 0 ? Auth::user()->getMedia('profile_photo')->first()->getUrl('profile_photo') : null) --}}
                                @if (!is_null(auth()->user()->profile))
								<a class="profile-user d-flex" href=""><img alt="" src="{{ url(auth()->user()->profile)}}"></a>
                                @else
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></a>
                                @endif
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user">
                                                @if (!is_null(auth()->user()->profile))
                                                <img alt="" src="{{url(auth()->user()->profile)}}" class="">
                                                @else
                                                <img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}" class="">
                                                @endif
                                            </div>
											<div class="mr-3 my-auto">
												<h6>{{ Auth::user()->name }}</h6>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href="{{ URL::to('my-account') }}"><i class="bx bx-user-circle"></i>{{ __('admin.my_account') }}</a>
									{{-- <a class="dropdown-item" href="{{ URL::to('my-account') }}"><i class="bx bx-cog"></i> Edit Profile</a> --}}
									{{-- <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a> --}}
									{{-- <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a> --}}
									{{-- <a class="dropdown-item" href="{{ URL::to('my-account') }}"><i class="bx bx-slider-alt"></i> Account Settings</a> --}}
									<a class="dropdown-item" href="#" onclick="document.getElementById('logout_form').submit()"><i class="bx bx-log-out"></i>{{ __('admin.logout') }}</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
