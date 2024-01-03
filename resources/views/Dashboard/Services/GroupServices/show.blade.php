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
							<h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/main_sidebar_trans.dashboard') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ <a href="{{route('Sections.index')}}" class="text-dark">{{ trans('Dashboard/section_trans.departments') }}</a></span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $section->name }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
    <div class="row row-sm">
     <div class="col-xl-12">
      <div class="card">
       <div class="card-header pb-0">
        <h4 class="card-title mg-b-0">{{$section->name}} {{ trans('Dashboard/doctor_trans.doctors') }}</h4>
       </div>
       <div class="card-body">
        <div class="table-responsive">
         <table class="table table-striped table-hover key-buttons text-nowrap">
          <thead>
           <tr>
            <th class="wd-15p border-bottom-0">#</th>
            <th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.doctor_name') }}</th>
            <th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.doctor_email') }}</th>
            <th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.doctor_phone') }}</th>
            <th class="wd-20p border-bottom-0">{{ trans('Dashboard/doctor_trans.added_at') }}</th>
            <th class="wd-20p border-bottom-0">{{ trans('Dashboard/doctor_trans.appoinments') }}</th>
            <th class="wd-20p border-bottom-0">{{ trans('Dashboard/doctor_trans.status') }}</th>
            <th class="wd-15p border-bottom-0">{{ trans('Dashboard/doctor_trans.operations') }}</th>
           </tr>
          </thead>
          <tbody>
           @foreach ($doctors as $doctor)
               <tr>
                <td>{{$doctor->id}}</td>
                <td>
                 <div class="d-flex align-items-center">
                  <img src="{{$doctor->image ? URL::asset('storage/Dashboard/img/doctors/'.$doctor->image->filename) : URL::asset('Dashboard/img/doctor.png')}}" alt="doctor{{$doctor->id}}_image" style="width:30px; height:30px; border-radius:50%; margin-right:15px">
                  <span>{{$doctor->name}}</span>
                 </div>
                </td>
                <td>{{$doctor->email}}</td>
                <td>{{$doctor->phone}}</td>
                <td>{{$doctor->created_at->diffForHumans()}}</td>
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
<script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>

@endsection