@extends('Dashboard.layouts.master')
@section('css')
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/insurance_trans.insurances') }}</span>
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
										<h4 class="card-title mg-b-0 mb-3">{{ trans('Dashboard/insurance_trans.all_insurances') }}</h4>
										<a href="{{route('Insurances.create')}}" class="btn btn-primary">
											{{ trans('Dashboard/insurance_trans.add_insurance') }}
									</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap" id="example1">
											<thead>
												<tr>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.id') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.insurance_code') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.insurance_name') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.status') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.discount_percentage') }}%</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.company_rate') }}%</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.insurance_notes') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/insurance_trans.operations') }}</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($insurances as $insurance)
																<tr>
																	<td>{{$insurance->id}}</td>
																	<td>{{$insurance->insurance_code}}</td>
																	<td><a href="{{route('Insurances.show', $insurance->id)}}">{{$insurance->name}}</a></td>
																	<td class="text-white text-center bg-{{$insurance->status == 1 ? 'success' : 'danger'}}">{{$insurance->status == 1 ? trans('Dashboard/insurance_trans.active') : trans('Dashboard/insurance_trans.deactive')}}</td>
																	<td>{{$insurance->discount_percentage}}</td>
																	<td>{{$insurance->company_rate}}</td>
																	<td>{{\Str::limit($insurance->notes, 50)}}</td>
																	<td>
																		<a class="btn btn-sm btn-info"	href="{{route('Insurances.edit', $insurance->id)}}">
																		<i class="las la-pen"></i>
																	</a>
																		<a class="btn btn-sm btn-danger" data-effect="effect-scale"
																		href="#delete{{$insurance->id}}" data-toggle="modal" >
																		<i class="las la-trash"></i>	</a>
																	</td>
																</tr>
																@include('Dashboard.Services.InsuranceServices.delete')
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