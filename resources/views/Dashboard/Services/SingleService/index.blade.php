@extends('Dashboard.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/service_trans.services') }}</span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/service_trans.single_services') }}</span>
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
										<h4 class="card-title mg-b-0">{{ trans('Dashboard/service_trans.single_services') }}</h4>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModel">
											{{ trans('Dashboard/service_trans.add_service') }}
									</button>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-striped table-hover key-buttons">
											<thead>
												<tr>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/service_trans.id') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/service_trans.service_name') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/service_trans.service_description') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/service_trans.status') }}</th>
													<th class="wd-20p border-bottom-0">{{ trans('Dashboard/service_trans.created_at') }}</th>
													<th class="wd-15p border-bottom-0">{{ trans('Dashboard/service_trans.operations') }}</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($services as $service)
																<tr>
																	<td>{{$service->id}}</td>
																	<td><a href="{{route('Services.show', $service->id)}}">{{$service->name}}</a></td>
																	<td>{{\Str::limit($service->description, 50)}}</td>
																	<td class="text-center"><span class="w-50 badge badge-pill {{$service->status == 1 ? 'badge-success' : 'badge-danger' }}">{{$service->status == 1 ? trans('Dashboard/service_trans.active') : trans('Dashboard/service_trans.active') }}</span></td>
																	<td>{{$service->created_at->diffForHumans()}}</td>
																	<td>
																		<a class="btn btn-sm btn-info" data-effect="effect-scale"
																		href="#edit{{$service->id}}" data-toggle="modal">
																			<i class="las la-pen"></i>
																	</a>
																		<a class="btn btn-sm btn-danger" data-effect="effect-scale"
																		href="#delete{{$service->id}}" data-toggle="modal" >
																		<i class="las la-trash"></i>	</a>
																	</td>
																</tr>
																@include('Dashboard.Services.SingleService.edit')
																@include('Dashboard.Services.SingleService.delete')
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
						<!-- row closed -->
						{{-- Include Modals --}}
						@include('Dashboard.Services.SingleService.add')
				</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')<!-- Internal Data tables -->
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
{{-- Notify --}}
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
@endsection