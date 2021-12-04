@extends('admin.layouts.app')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('admin.dashboard')}}</h4>
        </div>
    </div>
</div>
@if (Auth::user()->hasRole('driver'))
<div class="row row-sm">
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::ACCEPTED }}">
          <div class="card bg-primary-gradient text-white ">
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                      </div>
                      <div class="col-6">
                          <div class="mt-0 text-center"> <span class="text-white">{{__('admin.accepted_requisitions')}}</span>
                              <h2 class="text-white mb-0">{{ App\Models\Requisition::where('driver_id',Auth::id())->where('status',App\Models\Requisition::ACCEPTED)->count() }}</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
      <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::STARTED }}">
          <div class="card bg-success-gradient text-white ">
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                      </div>
                      <div class="col-6">
                          <div class="mt-0 text-center"> <span class="text-white">{{__('admin.started_requisitions')}}</span>
                              <h2 class="text-white mb-0">{{ App\Models\Requisition::where('driver_id',Auth::id())->where('status',App\Models\Requisition::STARTED)->count() }}</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
      <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::DELIVERED }}">
          <div class="card bg-danger-gradient text-white ">
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                      </div>
                      <div class="col-6">
                          <div class="mt-0 text-center"> <span class="text-white">{{__('admin.delivered_requisitions')}}</span>
                              <h2 class="text-white mb-0">{{ App\Models\Requisition::where('driver_id',Auth::id())->where('status',App\Models\Requisition::DELIVERED)->count() }}</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
</div>
@endif

@if (Auth::user()->hasRole('client'))
<div class="row row-sm">
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
      <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::PENDING }}">
        <div class="card bg-primary-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.pending_requisitions')}}</span>
                            <h2 class="text-white mb-0">{{ App\Models\Requisition::where('client_id',Auth::id())->where('status',App\Models\Requisition::PENDING)->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </a>
    </div>
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::SENTFORMODIFICATION }}">
          <div class="card bg-danger-gradient text-white ">
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                      </div>
                      <div class="col-6">
                          <div class="mt-0 text-center"> <span class="text-white">{{__('admin.sent_for_modification_requisitions')}}</span>
                              <h2 class="text-white mb-0">{{ App\Models\Requisition::where('client_id',Auth::id())->where('status',App\Models\Requisition::SENTFORMODIFICATION)->count() }}</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
      <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::ACCEPTED }}">
          <div class="card bg-success-gradient text-white ">
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                      </div>
                      <div class="col-6">
                          <div class="mt-0 text-center"> <span class="text-white">{{__('admin.accepted_requisitions')}}</span>
                              <h2 class="text-white mb-0">{{ App\Models\Requisition::where('client_id',Auth::id())->where('status',App\Models\Requisition::ACCEPTED)->count() }}</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
      <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::STARTED }}">
          <div class="card bg-success-gradient text-white ">
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                      </div>
                      <div class="col-6">
                          <div class="mt-0 text-center"> <span class="text-white">{{__('admin.started_requisitions')}}</span>
                              <h2 class="text-white mb-0">{{ App\Models\Requisition::where('client_id',Auth::id())->where('status',App\Models\Requisition::STARTED)->count() }}</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
      <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <a href="{{ route('admin.requisition.index') . '?status=' . App\Models\Requisition::DELIVERED }}">
          <div class="card bg-secondary-gradient text-white ">
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                      </div>
                      <div class="col-6">
                          <div class="mt-0 text-center"> <span class="text-white">{{__('admin.delivered_requisitions')}}</span>
                              <h2 class="text-white mb-0">{{ App\Models\Requisition::where('client_id',Auth::id())->where('status',App\Models\Requisition::DELIVERED)->count() }}</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </a>
      </div>
</div>
@endif


@if (Auth::user()->hasRole('admin'))

<div class="row row-sm">
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <div class="card bg-primary-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-user-tie tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.drivers')}}</span>
                            <h2 class="text-white mb-0">{{ $drivers }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <div class="card bg-success-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-car tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.vehicles')}}</span>
                            <h2 class="text-white mb-0">{{ $vehicles }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <div class="card bg-danger-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-car-crash tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.insurances')}}</span>
                            <h2 class="text-white mb-0">{{ $insurances }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <div class="card bg-danger-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-users tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.employee')}}</span>
                            <h2 class="text-white mb-0">{{ $employees }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <div class="card bg-primary-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-truck-pickup tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.requisitions')}}</span>
                            <h2 class="text-white mb-0">{{ $requsitions }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <div class="card bg-secondary-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-route tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.routes')}}</span>
                            <h2 class="text-white mb-0">{{ $routes }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
        <div class="card bg-danger-gradient text-white ">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center"> <i class="fas fa-tools tx-40"></i> </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center"> <span class="text-white">{{__('admin.maintenance')}}</span>
                            <h2 class="text-white mb-0">{{ $maintenances }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center"> <i class="fas fa-money-bill-wave tx-40"></i> </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center"> <span class="text-white">{{__('admin.expenses')}}</span>
                                <h2 class="text-white mb-0">{{ $expenses }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-danger-gradient text-white ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="icon1 mt-2 text-center"> <i class="fas fa-cog tx-40"></i> </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center"> <span class="text-white">{{__('admin.parts')}}</span>
                                    <h2 class="text-white mb-0">{{ $parts }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                    <div class="card bg-success-gradient text-white ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center"> <i class="fas fa-money-check-alt tx-40"></i> </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center"> <span class="text-white">{{__('admin.purchases')}}</span>
                                        <h2 class="text-white mb-0">{{ $purchases }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                    <div class="card bg-success-gradient text-white ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center"> <i class="fas fa-user-secret tx-40"></i> </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center"> <span class="text-white">{{__('admin.clients')}}</span>
                                        <h2 class="text-white mb-0">{{ $clients }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@endif

@endsection
