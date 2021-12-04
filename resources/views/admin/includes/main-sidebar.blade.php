<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
                {{-- @if (count(App\Models\SystemSetting::first()->getMedia('logo')) > 0)
				<a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{App\Models\SystemSetting::first()->getMedia('logo')->first()->getUrl()}}" class="main-logo" alt="logo"></a>
                @else
                @endif --}}
				<a class="desktop-logo logo-light active" href="{{ url('/' ) }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
                            {{-- @php($profile_photo = count(Auth::user()->getMedia('profile_photo')) > 0 ? Auth::user()->getMedia('profile_photo')->first()->getUrl('profile_photo') : null) --}}
                            @if (!is_null(auth()->user()->profile))
							<img alt="user-img" class="avatar avatar-xl brround" src="{{ url(auth()->user()->profile)}}"><span class="avatar-status profile-status bg-green"></span>
                            @else
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                            @endif
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="slide">
						<a class="side-menu__item {{ is_active('dashboard') }}" href="{{ route('admin.dashboard')}}">
							<i class="fas fa-home sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.dashboard') }}</span></a>
					</li>
                    @can('roles_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('role') }}" data-toggle="slide" href="#">
							<i class="fas fa-user-cog sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.roles') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.role.index') }}">{{ __('admin.show_all_roles') }}</a></li>
                            @can('add_role')
							<li><a class="slide-item" href="{{ route('admin.role.create') }}">{{ __('admin.add_new_role') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan

                    @can('system_settings')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('system-setting') }}" href="{{ route('admin.system-setting.index')}}">
							<i class="fas fa-wrench sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.system_settings') }}</span></a>
					</li>
                    @endcan

                    @can('manage_client_payment')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('manage-client-payment') }}" href="{{ route('admin.manage-client-payment.index')}}">
							<i class="fas fa-money-bill-wave sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.manage_client_payment') }}</span></a>
					</li>
                    @endcan

                    @can('income')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('manage-income') }}" href="{{ route('admin.manage-income.index')}}">
							<i class="fas fa-money-bill-wave sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.income') }}</span></a>
					</li>
                    @endcan

                    @can('driver_count_order')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('driver-count-order') }}" href="{{ route('admin.driver-count-order.index')}}">
							<i class="fas fa-sort-numeric-up-alt sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.driver_count_order') }}</span></a>
					</li>
                    @endcan


                    @can('requisitions_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('requisition') }}" data-toggle="slide" href="#">
							<i class="fas fa-truck-pickup sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.requisitions') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.requisition.index') }}">{{ __('admin.show_all_requisitions') }}</a></li>
							@can('add_requisition')
                            <li><a class="slide-item" href="{{ route('admin.requisition.create') }}">{{ __('admin.add_new_requisition') }}</a></li>
                            {{-- <li><a class="slide-item" href="{{ route('admin.requisition.receive_requisition') }}">{{ __('admin.receive_requisition') }}</a></li> --}}
                            @endcan
                            @can('items_page')
                            <li><a class="slide-item" href="{{ route('admin.requisition-data.index') }}">{{ __('admin.items') }}</a></li>
                            @endcan
                            @can('settings_page')
                            <li><a class="slide-item" href="{{ route('admin.vehicle-type.index') }}">{{ __('admin.vehicle_types') }}</a></li>
                            @endcan
                            @can('settings_page')
                            <li><a class="slide-item" href="{{ route('admin.price-control.index') }}">{{ __('admin.price_settings') }}</a></li>
                            @endcan
                            @can('settings_page')
                            <li><a class="slide-item" href="{{ route('admin.purpose.index') }}">{{ __('admin.purposes') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan



                    @if(Auth::user()->hasRole('client'))
                    <li class="slide">
						<a class="side-menu__item {{ is_active('client-payment-notification') }}" href="{{ route('admin.client-payment-notification.index')}}">
							<i class="fas fa-sort-numeric-up-alt sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.fatoora_pay') }}</span></a>
					</li>
                    @endif

                    @can('settings_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('settings') }}" data-toggle="slide" href="#">
							<i class="fas fa-cogs sidebar__icon side-menu__icon "></i>
							<span class="side-menu__label">{{ __('admin.settings') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.price-control.index') }}">{{ __('admin.price_settings') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.purpose.index') }}">{{ __('admin.purposes') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.designation.index') }}">{{ __('admin.designations') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.city.index') }}">{{ __('admin.cities') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.department.index') }}">{{ __('admin.departments') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.vehicle-type.index') }}">{{ __('admin.vehicle_types') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.vehicle-division.index') }}">{{ __('admin.vehicle_divisions') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.office.index') }}">{{ __('admin.offices') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.vendor.index') }}">{{ __('admin.vendors') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.company.index') }}">{{ __('admin.companies') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.license-type.index') }}">{{ __('admin.license_types') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.maintenance-type.index') }}">{{ __('admin.maintenance_types') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.trip-type.index') }}">{{ __('admin.trip_types') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.part-category.index') }}">{{ __('admin.part_categories') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.location.index') }}">{{ __('admin.locations') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.fuel-type.index') }}">{{ __('admin.fuel_types') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.station.index') }}">{{ __('admin.stations') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.requisition-type.index') }}">{{ __('admin.requisiton_types') }}</a></li>
						</ul>
					</li>
                    @endcan
                    @can('drivers_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('driver') }}" data-toggle="slide" href="#">
							<i class="fas fa-user-tie sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.drivers') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.driver.index') }}">{{ __('admin.show_all_drivers') }}</a></li>
                            @can('add_driver')
							<li><a class="slide-item" href="{{ route('admin.driver.create') }}">{{ __('admin.add_new_driver') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.driver-performance.index') }}">{{ __('admin.drivers_perfromances') }}</a></li>
                            @endcan
                            @can('settings_page')
                            <li><a class="slide-item" href="{{ route('admin.license-type.index') }}">{{ __('admin.license_types') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan

                    @can('clients_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('client') }}" data-toggle="slide" href="#">
							<i class="fas fa-user-secret sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.clients') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.client.index') }}">{{ __('admin.show_all_clients') }}</a></li>
                            @can('add_client')
							<li><a class="slide-item" href="{{ route('admin.client.create') }}">{{ __('admin.add_new_client') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan

                    @can('vehicles_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('vehicle') }}" data-toggle="slide" href="#">
							<i class="fas fa-car sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.vehicles') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.vehicle.index') }}">{{ __('admin.show_all_vehicles') }}</a></li>
							@can('add_vehicle')
                            <li><a class="slide-item" href="{{ route('admin.vehicle.create') }}">{{ __('admin.add_new_vehicle') }}</a></li>
                            @endcan
                            @can('settings_page')
                            <li><a class="slide-item" href="{{ route('admin.department.index') }}">{{ __('admin.departments') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.vehicle-type.index') }}">{{ __('admin.vehicle_types') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.office.index') }}">{{ __('admin.offices') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan


                    @can('insurances_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('insurance') }}" data-toggle="slide" href="#">
							<i class="fas fa-car-crash sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.insurances') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.insurance.index') }}">{{ __('admin.show_all_insurnaces') }}</a></li>
							@can('add_insurance')
                            <li><a class="slide-item" href="{{ route('admin.insurance.create') }}">{{ __('admin.add_new_insurnace') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan

                    @can('employees_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('employee') }}" data-toggle="slide" href="#">
							<i class="fas fa-users sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.employees') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.employee.index') }}">{{ __('admin.show_all_employees') }}</a></li>
							@can('add_employee')
                            <li><a class="slide-item" href="{{ route('admin.employee.create') }}">{{ __('admin.add_new_employee') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan




                    @can('routes_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('route') }}" data-toggle="slide" href="#">
							<i class="fas fa-route sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.routes') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.route.index') }}">{{ __('admin.show_all_routes') }}</a></li>
							@can('add_route')
                            <li><a class="slide-item" href="{{ route('admin.route.create') }}">{{ __('admin.add_new_route') }}</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan

					{{-- <li class="slide">
						<a class="side-menu__item {{ is_active('approval-authority') }}" data-toggle="slide" href="#">
							<i class="fas fa-life-ring sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.approval_authorities') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.approval-authority.index') }}">{{ __('admin.show_all_approval_authorities') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.approval-authority.create') }}">{{ __('admin.add_new_approval_authority') }}</a></li>
						</ul>
					</li> --}}
					{{-- <li class="slide">
						<a class="side-menu__item {{ is_active('pick-drop-requisition') }}" data-toggle="slide" href="#">
							<i class="fas fa-shipping-fast sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.pick_drop_requisition') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.pick-drop-requisition.index') }}">{{ __('admin.show_all_pick_drop_requisition') }}</a></li>
							<li><a class="slide-item" href="{{ route('admin.pick-drop-requisition.create') }}">{{ __('admin.add_new_pick_drop_requisition') }}</a></li>
						</ul>
					</li> --}}
                    @can('maintenances_page')
                    <li class="slide">
						<a class="side-menu__item {{ is_active('maintenance') }}" data-toggle="slide" href="#">
							<i class="fas fa-tools sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.maintenance') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('admin.maintenance.index') }}">{{ __('admin.show_all_maintenance') }}</a></li>
							@can('add_maintenance')
                            <li><a class="slide-item" href="{{ route('admin.maintenance.create') }}">{{ __('admin.add_new_maintenance') }}</a></li>
                            @endcan
						</ul>
                    </li>
                    @endcan


                    @can('expenses_page')

                    <li class="slide">
                        <a class="side-menu__item {{ is_active('expense') }}" data-toggle="slide" href="#">
                            <i class="fas fa-money-bill-wave sidebar__icon side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('admin.expenses') }}</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('admin.expense.index') }}">{{ __('admin.show_all_expenses') }}</a></li>
                            @can('add_expense')
                            <li><a class="slide-item" href="{{ route('admin.expense.create') }}">{{ __('admin.add_new_expense') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('parts_page')
                    <li class="slide">
                        <a class="side-menu__item {{ is_active('part') }}" data-toggle="slide" href="#">
                            <i class="fas fa-cog sidebar__icon side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('admin.parts') }}</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('admin.part.index') }}">{{ __('admin.show_all_parts') }}</a></li>
                            @can('add_part')
                            <li><a class="slide-item" href="{{ route('admin.part.create') }}">{{ __('admin.add_new_part') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('purchases_page')
                    <li class="slide">
                        <a class="side-menu__item {{ is_active('purchase') }}" data-toggle="slide" href="#">
                            <i class="fas fa-money-check-alt sidebar__icon side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('admin.purchases') }}</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('admin.purchase.index') }}">{{ __('admin.show_all_purchases') }}</a></li>
                            @can('add_purchase')
                            <li><a class="slide-item" href="{{ route('admin.purchase.create') }}">{{ __('admin.add_new_purchase') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('fuel_settings_page')
                    <li class="slide">
                        <a class="side-menu__item {{ is_active('refuel-setting') }}" data-toggle="slide" href="#">
                            <i class="fas fa-gas-pump sidebar__icon side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('admin.refuel_settings') }}</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('admin.refuel-setting.index') }}">{{ __('admin.show_all_refuel_settings') }}</a></li>
                            @can('add_fuel_setting')
                            <li><a class="slide-item" href="{{ route('admin.refuel-setting.create') }}">{{ __('admin.add_new_refuel_setting') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('refueling_requisitions_page')
                    <li class="slide">
                        <a class="side-menu__item {{ is_active('refueling-requisition') }}" data-toggle="slide" href="#">
                            <i class="fas fa-sort-amount-up-alt sidebar__icon side-menu__icon"></i>
                            <span class="side-menu__label">{{ __('admin.refueling_requisitions') }}</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('admin.refueling-requisition.index') }}">{{ __('admin.show_all_refueling_requisitions') }}</a></li>
                            @can('add_refueling_requisition')
                            <li><a class="slide-item" href="{{ route('admin.refueling-requisition.create') }}">{{ __('admin.add_new_refueling_requisition') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

					<li class="slide">
						<a class="side-menu__item" href="#" onclick="document.getElementById('logout_form').submit()">
							<i class="fas fa-sign-out-alt sidebar__icon side-menu__icon"></i>
							<span class="side-menu__label">{{ __('admin.logout') }}</span></a>
						<form action="{{ route('admin.logout')}}" method="post" id="logout_form">
							@csrf
						</form>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
