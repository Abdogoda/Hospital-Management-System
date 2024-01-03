@extends('Dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/patient_trans.patients') }}</span>
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
										<h4 class="card-title mg-b-0 mb-3">{{ trans('Dashboard/patient_trans.all_patients') }}</h4>
										<a href="{{route('Patients.create')}}" class="btn btn-primary">
											{{ trans('Dashboard/patient_trans.add_patient') }}
									</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap" id="example1">
											<thead>
												<tr>
													<th class="wd-15p border-bottom-0">#</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/patient_trans.patient_name') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/patient_trans.date_of_birth') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/patient_trans.phone_number') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/patient_trans.gender') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/patient_trans.blood_type') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/patient_trans.address') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/patient_trans.operations') }}</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($patients as $index => $patient)
																<tr>
																	<td>{{$index}}</td>
																	<td><a href="{{route('Patients.show', $patient->id)}}">{{$patient->name}}</a></td>
																	<td>{{$patient->email}}</td>
																	<td>{{$patient->date_of_birth}}</td>
																	<td>{{$patient->phone}}</td>
																	<td>{{$patient->gender == 1 ? trans('Dashboard/patient_trans.male') : trans('Dashboard/patient_trans.female')}}</td>
																	<td>{{$patient->blood_type}}</td>
																	<td>{{$patient->address}}</td>
																	<td>
																		<a class="btn btn-sm btn-info"	href="{{route('Patients.edit', $patient->id)}}">
																		<i class="las la-pen"></i>
																	</a>
																		<a class="btn btn-sm btn-danger" data-effect="effect-scale"
																		href="#delete{{$patient->id}}" data-toggle="modal" >
																		<i class="las la-trash"></i>	</a>
																		<a href="{{route('Patients.show', $patient->id)}}" class="btn btn-sm btn-success">
																			<i class="las la-eye"></i>
																		</a>
																	</td>
																</tr>
																@include('Dashboard.Patients.delete')
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