@extends('Dashboard/layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{route('Patients.index')}}" class="text-dark">{{ trans('Dashboard/patient_trans.patients') }}</a></span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/patient_trans.edit_patient') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5 mb-3">
									{{ trans('Dashboard/patient_trans.edit_patient') }}
								</div>
								<form class="" action="{{route('Patients.update', 'test')}}" method="post" autocomplete="off">
										@csrf
										@method('put')
									<div class="pt-3 row bg-gray-200">
                  <input type="hidden" value="{{$patient->id}}" name="id">
										<div class="form-group col-md-4">
											<label for="patient_name">{{ trans('Dashboard/patient_trans.patient_name') }} <span class="text-danger">*</span></label>
											<input type="text" id="patient_name" name="name" class="form-control" value="{{ $patient->name }}">
										</div>
										<div class="form-group col-md-4">
											<label for="email">{{ trans('Dashboard/patient_trans.email') }} <span class="text-danger">*</span></label>
											<input type="email" id="email" name="email" class="form-control" value="{{ $patient->email }}">
										</div>
										<div class="form-group col-md-4">
											<label for="date_of_birth">{{ trans('Dashboard/patient_trans.date_of_birth') }} <span class="text-danger">*</span></label>
											<input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ $patient->date_of_birth }}">
										</div>
										<div class="form-group col-md-4">
											<label for="phone">{{ trans('Dashboard/patient_trans.phone_number') }} <span class="text-danger">*</span></label>
											<input type="tel" id="phone" name="phone" class="form-control" value="{{ $patient->phone }}">
										</div>
										<div class="form-group col-md-4">
											<label for="gender">{{ trans('Dashboard/patient_trans.gender') }} <span class="text-danger">*</span></label>
											<select id="gender" name="gender" class="form-control">
												<option value="1" {{$patient->gender == 1 ? "selected='selected'" : ""}}>{{ trans('Dashboard/patient_trans.male') }}</option>
												<option value="0" {{$patient->gender == 0 ? "selected='selected'" : ""}}>{{ trans('Dashboard/patient_trans.female') }}</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="blood_type">{{ trans('Dashboard/patient_trans.blood_type') }} <span class="text-danger">*</span></label>
											<select id="blood_type" name="blood_type" class="form-control">
												<option value="O-" {{$patient->blood_type == "O-" ? "selected='selected'" : ""}}>O-</option>
												<option value="O+" {{$patient->blood_type == "O+" ? "selected='selected'" : ""}}>O+</option>
												<option value="A-" {{$patient->blood_type == "A-" ? "selected='selected'" : ""}}>A-</option>
												<option value="A+" {{$patient->blood_type == "A+" ? "selected='selected'" : ""}}>A+</option>
												<option value="B-" {{$patient->blood_type == "B-" ? "selected='selected'" : ""}}>B-</option>
												<option value="B+" {{$patient->blood_type == "B+" ? "selected='selected'" : ""}}>B+</option>
												<option value="AB-" {{$patient->blood_type == "AB-" ? "selected='selected'" : ""}}>AB-</option>
												<option value="AB+" {{$patient->blood_type == "AB+" ? "selected='selected'" : ""}}>AB+</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label for="address">{{ trans('Dashboard/patient_trans.address') }} <span class="text-danger">*</span></label>
											<textarea id="address" name="address" class="form-control">{{ $patient->address }}</textarea>
										</div>
									</div>
									<div class="row mt-4">
										<button class="btn btn-success pd-x-20">{{ trans('Dashboard/patient_trans.save_changes') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script>
  const discount_percentage_input = document.getElementById('discount_percentage');
  const company_rate_input = document.getElementById('company_rate');
  discount_percentage_input.oninput = function(e){
    company_rate.value = 100 - discount_percentage_input.value;
  }
</script>

<!-- Form-layouts js -->
<script src="{{URL::asset('Dashboard/js/form-layouts.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
@endsection