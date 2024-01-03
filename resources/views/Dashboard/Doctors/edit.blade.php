@extends('Dashboard/layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{route('Doctors.index')}}" class="text-dark">{{ trans('Dashboard/doctor_trans.doctors') }}</a></span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/doctor_trans.edit_doctor') }}</span>
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
								<div class="main-content-label mg-b-5">
									{{ trans('Dashboard/doctor_trans.edit_doctor') }}
								</div>
								<form class="row" action="{{route('Doctors.update', $doctor->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                  @csrf
                  @method('put')
									<div class="col-lg-12">
										<div class="bg-gray-200 p-4">
                      <input type="hidden" name="id" value="{{$doctor->id}}">
											<div class="form-group">
                        <label for="name">{{ trans('Dashboard/doctor_trans.doctor_name') }}</label>
                       <input type="text" id="name" name="name" class="form-control" value="{{$doctor->name}}" autofocus>
                       </div>
                       <div class="form-group">
                        <label for="email">{{ trans('Dashboard/doctor_trans.doctor_email') }}</label>
                       <input type="email" id="email" name="email" class="form-control" value="{{$doctor->email}}">
                       </div>
                       <div class="form-group">
                        <label for="phone">{{ trans('Dashboard/doctor_trans.doctor_phone') }}</label>
                       <input type="text" id="phone" name="phone" class="form-control" value="{{$doctor->phone}}">
                       </div>
                       <div class="form-group">
                         <label for="status">{{ trans('Dashboard/doctor_trans.status') }}</label>
                         <select name="status" id="status" class="form-control" >
                           <option {{$doctor->status == 1 ? "selected='selected'" : ""}} value="1">{{ trans('Dashboard/doctor_trans.active') }}</option>
                           <option {{$doctor->status == 0 ? "selected='selected'" : ""}} value="0">{{ trans('Dashboard/doctor_trans.deactive') }}</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="section_id">{{ trans('Dashboard/doctor_trans.doctor_section') }}</label>
                          <select name="section_id" id="section_id" class="form-control" >
                            <option value="" selected disabled>___{{ trans('Dashboard/doctor_trans.doctor_section') }}___</option>
                            @foreach ($sections as $section)
                            <option value="{{$section->id}}" {{$doctor->section_id == $section->id ? "selected='selected'" : ""}}>{{$section->name}}</option>
                          @endforeach
                        </select>
                      </div>
                        <div class="form-group">
                          <label for="appointments">{{ trans('Dashboard/doctor_trans.appoinments') }}</label>
                          <select multiple="multiple" name="appointments[]" id="appointments" class="form-control select2-no-search" >
                            @foreach ($appointments as $appointment) 
                            <option value="{{$appointment->id}}" {{in_array("$appointment->id" ,explode(',',$doctor->appointments)) ? "selected='selected'" : ''}}>{{$appointment->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                       <label for="image">{{ trans('Dashboard/doctor_trans.doctor_image') }}</label>
                      <input type="file" accept="image/*" onchange="loadFile(event)" id="image" name="image" class="form-control" >
                      @if ($doctor->image)
                        <img src="{{URL::asset('storage/Dashboard/img/doctors/'.$doctor->image->filename)}}" id="output" width="150px" height="150px">
                      @else
                        <img id="output" width="150px" height="150px">
                      @endif
                      </div>
											</div><button class="btn btn-main-primary pd-x-20 mt-3">{{ trans('Dashboard/doctor_trans.save_changes') }}</button>
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
  var loadFile = function(event){
    var preview = document.getElementById('output');
    var file    = event.target.files[0];
    var reader  = new FileReader();
    reader.onloadend = function () {
    preview.src = reader.result;
  }
  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
  }
</script>

<!--Internal  Select2 js -->
<script src="{{URL::asset('Dashboard/plugins/select2/js/select2.min.js')}}"></script>
<!-- Form-layouts js -->
<script src="{{URL::asset('Dashboard/js/form-layouts.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
@endsection