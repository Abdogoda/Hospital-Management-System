@extends('Dashboard.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/doctor_trans.doctors') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
					<div class="row row-sm">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header pb-0">
									<h4 class="card-title mg-b-0">{{ trans('Dashboard/doctor_trans.all_doctors') }}</h4>
									<div class="d-flex f-wrap my-1">
										<a href="{{route("Doctors.create")}}" class="btn btn-primary m-1">
											{{ trans('Dashboard/doctor_trans.add_doctor') }}
										</a>
										<button type="button" id="btn_delete_all" class="btn btn-danger m-1">
											{{ trans('Dashboard/doctor_trans.delete_doctors') }}
									</button>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table key-buttons text-nowrap" id="example1">
											<thead>
												<tr>
													<th class="wd-15p border-bottom-0">#</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.select_all') }} <input type="checkbox" name="select_all" id="example-select-all" id=""></th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.doctor_name') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.doctor_email') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.doctor_phone') }}</th>
													<th class="wd-20p border-bottom-0">{{ trans('Dashboard/doctor_trans.added_at') }}</th>
													<th class="wd-20p border-bottom-0">{{ trans('Dashboard/doctor_trans.department') }}</th>
													<th class="wd-20p border-bottom-0">{{ trans('Dashboard/doctor_trans.appoinments') }}</th>
													<th class="wd-20p border-bottom-0">{{ trans('Dashboard/doctor_trans.status') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.operations') }}</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($doctors as $doctor)
																<tr>
																	<td>{{$doctor->id}}</td>
																	<td><input type="checkbox" 
																		class="delete_select" name="delete_select" value="{{$doctor->id}}" id="example-select-all" id=""></td>
																	<td>
																		<div class="d-flex align-items-center">
																			<img src="{{$doctor->image ? URL::asset('storage/Dashboard/img/doctors/'.$doctor->image->filename) : URL::asset('Dashboard/img/doctor.png')}}" alt="doctor{{$doctor->id}}_image" style="width:30px; height:30px; border-radius:50%; margin-right:15px">
																			<span>{{$doctor->name}}</span>
																		</div>
																	</td>
																	<td>{{$doctor->email}}</td>
																	<td>{{$doctor->phone}}</td>
																	<td>{{$doctor->created_at->diffForHumans()}}</td>
																	<td><a href="{{route('Sections.show', $doctor->section->id)}}">{{$doctor->section->name}}</a></td>
																	<td>
																		@foreach (explode(',',$doctor->appointments) as $appoinment)
																		 <span class="border p-1 rounded">{{$appointments->find(intval($appoinment))->name}}</span>
																		@endforeach
																	</td>
																	<td>
																		<div class="d-flex gap-1">
																			<div class="dot-label bg-{{$doctor->status == 1 ? 'success' : 'danger'}} mx-1"></div>
																	 <p>{{$doctor->status == 1 ? trans('Dashboard/doctor_trans.active') : trans('Dashboard/doctor_trans.deactive')}}</p>
																		</div>
																	</td>
																	<td>
																		<div class="dropdown">
																			<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary" data-toggle="dropdown" id="dropdownMenuButton" type="button">{{ trans('Dashboard/doctor_trans.operations') }} <i class="fas fa-caret-down ml-1"></i></button>
																			<div class="dropdown-menu tx-13">
																				<a class="dropdown-item" data-effect="effect-scale" href="{{route('Doctors.edit', $doctor->id)}}">{{ trans('Dashboard/doctor_trans.edit_doctor') }} <i class="las la-pen text-info"></i>
																				</a>
																				<a class="dropdown-item" data-effect="effect-scale" href="#change_status{{$doctor->id}}" data-toggle="modal" >{{ trans('Dashboard/doctor_trans.change_status') }} <i class="las la-star text-warning"></i>	
																				<a class="dropdown-item" data-effect="effect-scale" href="#change_password{{$doctor->id}}" data-toggle="modal" >{{ trans('Dashboard/doctor_trans.change_password') }} <i class="las la-lock text-green"></i>	
																				</a>
																				<a class="dropdown-item" data-effect="effect-scale" href="#delete{{$doctor->id}}" data-toggle="modal" >{{ trans('Dashboard/doctor_trans.delete_doctor') }} 
																				<i class="las la-trash text-danger"></i>	</a>
																			</div>
																		</div>
																	</td>
																</tr>
																@include('Dashboard.Doctors.delete')
																@include('Dashboard.Doctors.change_status')
																@include('Dashboard.Doctors.change_password')
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
						<!-- row closed -->
				</div>
				{{-- Include Modals --}}
				@include('Dashboard.Doctors.delete_select')
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')<!-- Internal Data tables -->
<!--Internal  Datatable js -->
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>

<script>
	$(function() {
		jQuery("[name=select_all]").click(function(source) {
			checkboxs = jQuery("[name=delete_select]");
			for (var i in checkboxs){
				checkboxs[i].checked = source.target.checked;
			}
		})
	})
</script>

<script>
	$(function() {
		$("#btn_delete_all").click(function() {
			var selected = [];
			$("table input[name=delete_select]:checked").each(function(){
				selected.push(this.value);
			})
			if(selected.length > 0){
				$("#delete_selected_doctors").modal('show');
				$("input[id='delete_select_id']").val(selected);
				$("span.count").text(selected.length);
			}

		});
	});
</script>

@endsection