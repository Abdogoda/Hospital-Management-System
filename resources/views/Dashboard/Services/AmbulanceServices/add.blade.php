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
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{route('Ambulances.index')}}" class="text-dark">{{ trans('Dashboard/ambulance_trans.ambulances') }}</a></span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/ambulance_trans.add_ambulance') }}</span>
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
									{{ trans('Dashboard/ambulance_trans.add_ambulance') }}
								</div>
								<form class="" action="{{route('Ambulances.store')}}" method="post" autocomplete="off">
										@csrf
										@method('post')
									<div class="pt-3 row bg-gray-200">
										<div class="form-group col-md-3">
											<label for="ambulance_number">{{ trans('Dashboard/ambulance_trans.ambulance_number') }} <span class="text-danger">*</span></label>
											<input type="text" id="ambulance_number" name="car_number" class="form-control" value="{{ old('ambulance_number') }}">
										</div>
										<div class="form-group col-md-3">
											<label for="ambulance_model">{{ trans('Dashboard/ambulance_trans.ambulance_model') }} <span class="text-danger">*</span></label>
											<input type="text" id="ambulance_model" name="car_model" class="form-control" value="{{ old('ambulance_model') }}">
										</div>
										<div class="form-group col-md-3">
											<label for="car_year_made">{{ trans('Dashboard/ambulance_trans.car_year_made') }} <span class="text-danger">*</span></label>
											<input type="date" id="car_year_made" name="car_year_made" class="form-control" value="{{ old('car_year_made') }}">
										</div>
										<div class="form-group col-md-3">
											<label for="ambulance_status">{{ trans('Dashboard/ambulance_trans.ambulance_status') }} <span class="text-danger">*</span></label>
											<select id="ambulance_status" name="car_type" class="form-control">
												<option value="1">{{ trans('Dashboard/ambulance_trans.owned') }}</option>
												<option value="0">{{ trans('Dashboard/ambulance_trans.rental') }}</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="driver_name">{{ trans('Dashboard/ambulance_trans.driver_name') }} <span class="text-danger">*</span></label>
											<input type="text" id="driver_name" name="driver_name" class="form-control" value="{{ old('driver_name') }}">
										</div>
										<div class="form-group col-md-4">
											<label for="driver_license_number">{{ trans('Dashboard/ambulance_trans.driver_license_number') }} <span class="text-danger">*</span></label>
											<input type="text" id="driver_license_number" name="driver_license_number" class="form-control" value="{{ old('driver_license_number') }}">
										</div>
										<div class="form-group col-md-4">
											<label for="driver_phone">{{ trans('Dashboard/ambulance_trans.driver_phone') }} <span class="text-danger">*</span></label>
											<input type="text" id="driver_phone" name="driver_phone" class="form-control" value="{{ old('driver_phone') }}">
										</div>
										<div class="form-group col-md-12">
											<label for="ambulance_notes">{{ trans('Dashboard/ambulance_trans.ambulance_notes') }}</label>
											<textarea id="ambulance_notes" name="notes" class="form-control" rows="5">{{ old('ambulance_notes') }}</textarea>
										</div>
									</div>
									<div class="row mt-4">
										<button class="btn btn-success pd-x-20">{{ trans('Dashboard/ambulance_trans.save_changes') }}</button>
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