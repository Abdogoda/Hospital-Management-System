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
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{route('Insurances.index')}}" class="text-dark">{{ trans('Dashboard/insurance_trans.insurances') }}</a></span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/insurance_trans.edit_insurance') }}</span>
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
									{{ trans('Dashboard/insurance_trans.edit_insurance') }}
								</div>
								<form class="row" action="{{route('Insurances.update', 'test')}}" method="post" autocomplete="off">
                  @csrf
                  @method('put')
                  <input type="hidden" value="{{$insurance->id}}" name="id">
									<div class="col-lg-12">
										<div class="bg-gray-200 p-4">
											<div class="form-group">
                        <label for="name">{{ trans('Dashboard/insurance_trans.insurance_name') }}</label>
                       <input type="text" id="name" name="name" class="form-control" autofocus value="{{ $insurance->name }}">
                       </div>
                       <div class="form-group">
                         <label for="insurance_code">{{ trans('Dashboard/insurance_trans.insurance_code') }}</label>
                       <input type="text" id="insurance_code" name="insurance_code" class="form-control" value="{{ $insurance->insurance_code}}">
                       </div>
                       <div class="form-group">
                         <label for="status">{{ trans('Dashboard/insurance_trans.status') }}</label>
                       <select id="status" name="status" class="form-control" >
																								<option value="1" {{$insurance->status == 1 ? "selected='selected'" : ""}}>{{ trans('Dashboard/insurance_trans.active') }}</option>
																								<option value="0" {{$insurance->status == 0 ? "selected='selected'" : ""}}>{{ trans('Dashboard/insurance_trans.deactive') }}</option>
																							</select>
                       </div>
                       <div class="form-group">
                         <label for="discount_percentage">{{ trans('Dashboard/insurance_trans.discount_percentage') }}</label>
                       <input type="number" id="discount_percentage" name="discount_percentage" class="form-control" value="{{ $insurance->discount_percentage}}">
                      </div>
                      <div class="form-group">
                        <label for="company_rate">{{ trans('Dashboard/insurance_trans.company_rate') }}</label>
                        <input  readonly id="company_rate" name="company_rate" class="form-control bg-white" value="{{ $insurance->company_rate }}">
                      </div>
                      <div class="form-group">
                       <label for="notes">{{ trans('Dashboard/insurance_trans.insurance_notes') }}</label>
                      <textarea id="notes" name="notes" class="form-control" rows="5">{{$insurance->notes}}</textarea>
                      </div>
                    </div><button class="btn btn-main-primary pd-x-20 mt-3">{{ trans('Dashboard/insurance_trans.save_changes') }}</button>
										</div>
									</form>
								</div>
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