@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    معلومات المريض
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$patient->name}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">سجل المريض</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">الاشعة</a></li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">المختبر</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                         <div class="card custom-card">
                                          <div class="card-body">
                                              <div class="vtimeline">
                                                  @foreach($patient_records as $patient_record)
                                                      <div
                                                          class="timeline-wrapper {{ $loop->first ? '' : 'timeline-inverted' }} timeline-wrapper-primary">
                                                          <div class="timeline-badge"><i class="las la-check-circle"></i></div>
                                                          <div class="timeline-panel">
                                                              <div class="timeline-heading">
                                                                  <h6 class="timeline-title">
                                                                      @if ($patient_record->review_date !=  Null)
                                                                          كشف مراجعة عند  {{ $patient_record->review_date}}
                                                                      @else
                                                                          كشف منتهي
                                                                      @endif
                                                                  </h6>
                                                              </div>
                                                              <div class="timeline-body">
                                                                  <p>{{$patient_record->diagnosis}}</p>
                                                                  <p class="text-muted"><i>{{$patient_record->medicine}}</i></p>
                                                              </div>
                                                              <div class="timeline-footer d-flex align-items-center justify-content-between flex-wrap">
                                                                  <div>
                                                                   <i class="fas fa-user-md"></i>&nbsp;
                                                                  <span>{{$patient_record->Doctor->name}}</span>
                                                                  </div>
                                                                  <span><i class="fe fe-calendar text-muted mr-1"></i>{{$patient_record->date}}</span>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  @endforeach
                                              </div>
                                          </div>
                                      </div>
                                        </div>

                                        {{-- End Show Information Patient --}}



                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">

                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الخدمه</th>
                                                        <th>اسم الطبيب</th>
                                                        <th>اسم طبيب الاشعة</th>
                                                        <th>حالة الاشعة</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($patient_rays as $patient_ray)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$patient_ray->description}}</td>
                                                            <td>{{$patient_ray->doctor->name}}</td>
                                                            <td>{{$patient_ray->employee_id != null ? $patient_ray->RayEmployee->name : "No Employee"}}</td>
                                                            <td class="text-{{$patient_ray->case == 0 ? 'danger' : 'success'}}">{{$patient_ray->case == 0 ? 'غير مكتمل' : 'مكتمل'}}</td>
                                                            @if($patient_ray->doctor_id == auth()->user()->id)
                                                            @if ($patient_ray->case == 0)
                                                                <td>
                                                                    <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"  data-toggle="modal" href="#edit_xray_conversion{{$patient_ray->id}}"><i class="fas fa-edit"></i></a>
                                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$patient_ray->id}}"><i class="las la-trash"></i></a>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <a class="btn btn-sm btn-success" href="{{route('Invoices.show', $patient_ray->id)}}"><i class="fas fa-eye"></i></a>
                                                                </td>
                                                            @endif
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        @include('Dashboard.Doctor.Invoices.edit_xray_conversion')
                                                        @include('Dashboard.Doctor.Invoices.deleted')
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Invices Patient --}}



                                        {{-- Start Receipt Patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                               <table class="table table-hover text-md-nowrap text-center">
                                                   <thead>
                                                   <tr>
                                                       <th>#</th>
                                                       <th>اسم التحليل</th>
                                                       <th>اسم الطبيب</th>
                                                       <th>العمليات</th>
                                                   </tr>
                                                   </thead>
                                                   <tbody>
                                                   @foreach($patient_labs as $patient_lab)
                                                       <tr>
                                                         <td>{{$loop->iteration}}</td>
                                                         <td>{{$patient_lab->description}}</td>
                                                         <td>{{$patient_lab->doctor->name}}</td>
                                                         @if($patient_lab->doctor_id == auth()->user()->id)
                                                         @if ($patient_lab->case == 0)
                                                            <td>
                                                                <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"  data-toggle="modal" href="#edit_laboratorie_conversion{{$patient_lab->id}}"><i class="fas fa-edit"></i></a>
                                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#deleted_laboratorie{{$patient_lab->id}}"><i class="las la-trash"></i></a>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <a class="btn btn-sm btn-success" href="{{route('ViewLaboratories', $patient_lab->id)}}"><i class="fas fa-eye"></i></a>
                                                            </td>
                                                        @endif
                                                         @else
                                                         <td></td>
                                                         @endif
                                                       </tr>
                                                       <br>
                                                       @include('Dashboard.Doctor.Invoices.edit_laboratorie_conversion')
                                                       @include('Dashboard.Doctor.Invoices.deleted_laboratorie')
                                                   @endforeach
                                                   </tbody>
                                               </table>
                                            </div>
                                        </div>

                                        {{-- End Receipt Patient  --}}


                                        {{-- Start payment accounts Patient --}}
                                        <div class="tab-pane" id="tab4">
{{--                                            <div class="table-responsive">--}}
{{--                                                <table class="table table-hover text-md-nowrap text-center" id="example1">--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th>#</th>--}}
{{--                                                        <th>تاريخ الاضافه</th>--}}
{{--                                                        <th>الوصف</th>--}}
{{--                                                        <th>مدبن</th>--}}
{{--                                                        <th>دائن</th>--}}
{{--                                                        <th>الرصيد النهائي</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody>--}}
{{--                                                    @foreach($Patient_accounts as $Patient_account)--}}
{{--                                                        <tr>--}}
{{--                                                            <td>{{$loop->iteration}}</td>--}}
{{--                                                            <td>{{$Patient_account->date}}</td>--}}
{{--                                                            <td>--}}

{{--                                                               @if($Patient_account->invoice_id == true)--}}
{{--                                                              {{$Patient_account->invoice->Service->name ?? $Patient_account->invoice->Group->name}}--}}

{{--                                                                @elseif($Patient_account->Payment_id == true)--}}
{{--                                                                    {{$Patient_account->PaymentAccount->description}}--}}
{{--                                                                @endif--}}

{{--                                                            </td>--}}
{{--                                                            <td>{{ $Patient_account->Debit}}</td>--}}
{{--                                                            <td>{{ $Patient_account->credit}}</td>--}}
{{--                                                            <td></td>--}}
{{--                                                        </tr>--}}
{{--                                                        <br>--}}
{{--                                                    @endforeach--}}
{{--                                                    <tr>--}}
{{--                                                        <th colspan="3" scope="row" class="alert alert-success">--}}
{{--                                                            الاجمالي--}}
{{--                                                        </th>--}}
{{--                                                        <td class="alert alert-primary">{{ $Debit= $Patient_accounts->sum('Debit')}}</td>--}}
{{--                                                        <td class="alert alert-primary">{{ $credit =$Patient_accounts->sum('credit')}}</td>--}}
{{--                                                        <td class="alert alert-danger">--}}
{{--                                                           <span class="text-danger"> {{$Debit-$credit}}  {{ $Debit-$credit > 0 ? 'مدين' :'دائن'}}</span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tbody>--}}
{{--                                                </table>--}}

{{--                                            </div>--}}

                                            <br>

                                        </div>

                                        {{-- End payment accounts Patient --}}


                                        <div class="tab-pane" id="tab5">
                                            <p>praesentium voluptatum deleniti atque corrquas molestias excepturi sint
                                                occaecati cupiditate non provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <p>praesentium et quas molestias excepturi sint occaecati cupiditate non
                                                provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection