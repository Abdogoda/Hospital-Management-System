@extends('Dashboard.layouts.master')
@section('css')
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/ambulance_trans.ambulances') }}</span>
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
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0 mb-3">{{ trans('Dashboard/ambulance_trans.all_ambulances') }}</h4>
										<a href="{{route('Ambulances.create')}}" class="btn btn-primary">
											{{ trans('Dashboard/ambulance_trans.add_ambulance') }}
									</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap" id="example1">
											<thead>
												<tr>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.id') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.ambulance_number') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.ambulance_model') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.car_year_made') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.ambulance_type') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.driver_name') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.driver_phone') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.ambulance_status') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.ambulance_notes') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/ambulance_trans.operations') }}</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($ambulances as $index => $ambulance)
																<tr>
																	<td>{{$index}}</td>
																	<td><a href="{{route('Ambulances.show', $ambulance->id)}}">{{$ambulance->car_number}}</a></td>
																	<td>{{$ambulance->car_model}}</td>
																	<td>{{$ambulance->car_year_made}}</td>
																	<td>{{$ambulance->car_type == 1 ? trans('Dashboard/ambulance_trans.owned') : trans('Dashboard/ambulance_trans.rental')}}</td>
																	<td>{{$ambulance->driver_name}}</td>
																	<td>{{$ambulance->driver_phone}}</td>
																	<td><div class="dot-label bg-{{$ambulance->is_available == 1 ? 'success' : 'danger'}} mx-1"></div><p>{{$ambulance->is_available == 1 ? trans('Dashboard/ambulance_trans.available') : trans('Dashboard/ambulance_trans.not_available')}}</p></td>
																	<td>{{\Str::limit($ambulance->notes, 50)}}</td>
																	<td>
																		<a class="btn btn-sm btn-info"	href="{{route('Ambulances.edit', $ambulance->id)}}">
																		<i class="las la-pen"></i>
																	</a>
																		<a class="btn btn-sm btn-danger" data-effect="effect-scale"
																		href="#delete{{$ambulance->id}}" data-toggle="modal" >
																		<i class="las la-trash"></i>	</a>
																	</td>
																</tr>
																@include('Dashboard.Services.AmbulanceServices.delete')
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
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection