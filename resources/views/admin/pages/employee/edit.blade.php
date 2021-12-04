@extends('admin.layouts.app')


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin.employees')}}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{__('admin.edit_new_employee')}} </span>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col">
            <form action="{{ route('admin.employee.update',$employee->id) }}" method="post" id="store" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <input type="hidden" name="employee_data_id" value="{{ $employee_data->id }}">
                <div class="card card-custom">
                    <div class="card-header d-flex">
                        <div class="card-title">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="icon-md fas fa-edit"></i> <strong> {{__('admin.edit')}}</strong>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('admin.name') }}</label>
                                    <input type="text" name="name" id="name" placeholder="{{ __('admin.name') }}" class="form-control" required value="{{ $employee->name }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="employee_nid">{{ __('admin.NID') }}</label>
                                    <input type="number" name="employee_nid" id="employee_nid" placeholder="{{ __('admin.employee_nid') }}" class="form-control" required value="{{ $employee_data->NID }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">صلاحيات المستخدم</label>
                                    <select name="roles_name" id="roles_name" class="form-control" >
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}" {{ $role == $employee_data->roles_name ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
{{--                                    {!! Form::select('roles[]', $roles,$employeeRole, array('class' => 'form-control','multiple'))--}}
{{--                            !!}--}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pay_roll_type">{{ __('admin.pay_roll_type') }}</label>
                                    <select name="pay_roll_type" id="pay_roll_type" class="form-control">
                                        @foreach ($pay_roll_types as $type)
                                            <option value="{{ $type }}" {{ $type == $employee_data->pay_roll_type ? 'selected' : '' }}>{{ __('admin.' . $type) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="designation">{{ __('admin.designation') }}</label>
                                    <select name="designation" id="designation" class="form-control select2">
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}" {{ $designation->id == $employee_data->designation_id ? 'selected' : '' }}>{{ $designation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">{{ __('admin.department') }}</label>
                                    <select name="department" id="department" class="form-control select2">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $department->id == $employee_data->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">{{ __('admin.mobile') }}</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control" placeholder="{{ __('admin.mobile') }}" required value="{{ $employee_data->mobile }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('admin.email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('admin.email') }}" required value="{{ $employee->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_optional">{{ __('admin.mobile_optional') }}</label>
                                    <input type="number" name="mobile_optional" id="mobile_optional" class="form-control" placeholder="{{ __('admin.mobile_optional') }}" value="{{ $employee_data->mobile_optional }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_optional">{{ __('admin.email_optional') }}</label>
                                    <input type="email" name="email_optional" id="email_optional" class="form-control" placeholder="{{ __('admin.email_optional') }}" value="{{ $employee_data->email_optional }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="join_date">{{ __('admin.join_date') }}</label>
                                    <input type="date" name="join_date" id="join_date" class="form-control" placeholder="{{ __('admin.join_date') }}" value="{{ $employee_data->join_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blood_group">{{ __('admin.blood_group') }}</label>
                                    <select name="blood_group" id="blood_group" class="form-control">
                                        @foreach ($blood_groups as $group)
                                            <option value="{{ $group }}" {{ $group == $employee_data->blood_group ? 'selected' : '' }}>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">{{ __('admin.date_of_birth') }}</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="{{ __('admin.date_of_birth') }}" value="{{ $employee_data->date_of_birth }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="working_slot_from">{{ __('admin.working_slot_from') }}</label>
                                    <input type="time" name="working_slot_from" id="working_slot_from" class="form-control" placeholder="{{ __('admin.working_slot_from') }}" value="{{ $employee_data->working_slot_from }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="working_slot_to">{{ __('admin.working_slot_to') }}</label>
                                    <input type="time" name="working_slot_to" id="working_slot_to" class="form-control" placeholder="{{ __('admin.working_slot_to') }}" value="{{ $employee_data->working_slot_to }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_name">{{ __('admin.father_name') }}</label>
                                    <input type="text" name="father_name" id="father_name" class="form-control" placeholder="{{ __('admin.father_name') }}" value="{{ $employee_data->father_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mother_name">{{ __('admin.mother_name') }}</label>
                                    <input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="{{ __('admin.mother_name') }}" value="{{ $employee_data->mother_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_contact_number">{{ __('admin.present_contact_number') }}</label>
                                    <input type="number" name="present_contact_number" id="present_contact_number" class="form-control" placeholder="{{ __('admin.present_contact_number') }}" value="{{ $employee_data->present_contact_number }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_contact_number">{{ __('admin.permanent_contact_number') }}</label>
                                    <input type="number" name="permanent_contact_number" id="permanent_contact_number" class="form-control" placeholder="{{ __('admin.permanent_contact_number') }}" value="{{ $employee_data->permanent_contact_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_address">{{ __('admin.present_address') }}</label>
                                    <input type="text" name="present_address" id="present_address" class="form-control" placeholder="{{ __('admin.present_address') }}" value="{{ $employee_data->present_address }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_address">{{ __('admin.permanent_address') }}</label>
                                    <input type="text" name="permanent_address" id="permanent_address" class="form-control" placeholder="{{ __('admin.permanent_address') }}" value="{{ $employee_data->permanent_address }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="present_city">{{ __('admin.present_city') }}</label>
                                    <select name="present_city" id="present_city" class="selct2 form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" {{ $city->id == $employee_data->present_city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent_city">{{ __('admin.permanent_city') }}</label>
                                    <select name="permanent_city" id="permanent_city" class="selct2 form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" {{ $city->id == $employee_data->permanent_city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reference_name">{{ __('admin.reference_name') }}</label>
                                    <input type="text" name="reference_name" id="reference_name" class="form-control" placeholder="{{ __('admin.reference_name') }}" value="{{ $employee_data->reference_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reference_mobile">{{ __('admin.reference_mobile') }}</label>
                                    <input type="number" name="reference_mobile" id="reference_mobile" class="form-control" placeholder="{{ __('admin.reference_mobile') }}" value="{{ $employee_data->reference_mobile }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reference_address">{{ __('admin.reference_address') }}</label>
                                    <input type="text" name="reference_address" id="reference_address" class="form-control" placeholder="{{ __('admin.reference_address') }}" value="{{ $employee_data->reference_address }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reference_email">{{ __('admin.reference_mobile') }}</label>
                                    <input type="email" name="reference_email" id="reference_email" class="form-control" placeholder="{{ __('admin.reference_email') }}" value="{{ $employee_data->reference_email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_account_number">{{ __('admin.bank_account_number') }}</label>
                                    <input type="number" value="{{ $employee_data->bank_account_number }}" name="bank_account_number" id="bank_account_number" placeholder="{{ __('admin.bank_account_number') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_photograph">{{ __('admin.employee_photograph') }}</label>
                                    <input type="file" name="employee_photograph" id="employee_photograph" class="d-block">
                                </div>
                            </div>
                            @if (!is_null($employee_photograph))
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="current_photograph">{{ __('admin.current_photograph') }}</label>
                                        <img src="{{ $employee_photograph }}" alt="">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
